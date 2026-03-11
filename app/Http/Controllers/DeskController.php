<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Card;

class DeskController extends Controller
{
    public function index()
    {
        $card = Card::with('transaction_qr.visitor_1')->get();

        return view('desk.index', compact('card'));
    }

    public function history(Request $request)
    {
        $query = \App\Models\Transaction::with([
            'card_qr',
            'visitor_1' => function ($q) {
                $q->select('id', 'email', 'full_name', 'institution', 'no_hp');
            }
        ])->orderBy('date', 'desc')->orderBy('check_in', 'desc');

        if ($request->has('q') && $request->q != '') {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('dept', 'like', "%{$search}%")
                    ->orWhereHas('card_qr', function ($q) use ($search) {
                        $q->where('code', 'like', "%{$search}%");
                    })
                    ->orWhereHas('visitor_1', function ($q) use ($search) {
                        $q->where('institution', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->has('from') && $request->from != '') {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->has('to') && $request->to != '') {
            $query->whereDate('date', '<=', $request->to);
        }

        $history = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $history
        ]);
    }

    public function export(Request $request)
    {
        $query = \App\Models\Transaction::with(['card_qr', 'visitor_1'])->orderBy('date', 'desc')->orderBy('check_in', 'desc');

        if ($request->has('q') && $request->q != '') {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('dept', 'like', "%{$search}%")
                    ->orWhereHas('card_qr', function ($q) use ($search) {
                        $q->where('code', 'like', "%{$search}%");
                    })
                    ->orWhereHas('visitor_1', function ($q) use ($search) {
                        $q->where('institution', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->has('from') && $request->from != '') {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->has('to') && $request->to != '') {
            $query->whereDate('date', '<=', $request->to);
        }

        $transactions = $query->get();

        $filename = 'visitor_history_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Kartu', 'Nama', 'Instansi/Dept', 'Check In', 'Check Out', 'Status', 'Tipe');

        $callback = function () use ($transactions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($transactions as $row) {
                $instansi = $row->visitor_1 ? $row->visitor_1->institution : $row->dept;
                $kartu = $row->card_qr ? $row->card_qr->code : '-';

                fputcsv($file, array(
                    $kartu,
                    $row->name,
                    $instansi,
                    $row->check_in,
                    $row->check_out ?? '-',
                    $row->status,
                    $row->type
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportvisitor(Request $request)
    {
        $tanggalawal = $request->tanggalawal;
        $tanggalakhir = $request->tanggalakhir;

        $query = \App\Models\Transaction::with(['card_qr', 'visitor_1'])
            ->where('type', 'visitor')
            ->orderBy('date', 'desc')->orderBy('check_in', 'desc');

        if ($request->has('q') && $request->q != '') {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('dept', 'like', "%{$search}%")
                    ->orWhereHas('card_qr', function ($q) use ($search) {
                        $q->where('code', 'like', "%{$search}%");
                    })
                    ->orWhereHas('visitor_1', function ($q) use ($search) {
                        $q->where('institution', 'like', "%{$search}%");
                    });
            });
        }

        if ($tanggalawal && $tanggalakhir) {
            $query->whereBetween('date', [$tanggalawal, $tanggalakhir]);
        } elseif ($tanggalawal) {
            $query->whereDate('date', '>=', $tanggalawal);
        } elseif ($tanggalakhir) {
            $query->whereDate('date', '<=', $tanggalakhir);
        }

        $transactions = $query->get();

        $filename = 'export_visitor_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Kartu', 'Nama Visitor', 'Instansi/Dept', 'Check In', 'Check Out', 'Status');

        $callback = function () use ($transactions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($transactions as $row) {
                $instansi = $row->visitor_1 ? $row->visitor_1->institution : $row->dept;
                $kartu = $row->card_qr ? $row->card_qr->code : '-';

                fputcsv($file, array(
                    $kartu,
                    $row->name,
                    $instansi,
                    $row->check_in,
                    $row->check_out ?? '-',
                    $row->status
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
