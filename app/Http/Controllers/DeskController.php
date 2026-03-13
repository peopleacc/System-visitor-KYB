<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Card;
use Carbon\Carbon;

class DeskController extends Controller
{
    public function index()
    {
        $card = Card::with('transaction_qr.visitor_1')->get();

        $statCounts = Transaction::selectRaw("status, count(*) as total")
            ->whereIn('status', ['waiting', 'approved', 'check_in', 'check_out'])
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        foreach (['waiting', 'approved', 'check_in', 'check_out'] as $s) {
            $statCounts[$s] = $statCounts[$s] ?? 0;
        }

        $trendData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $count = Transaction::whereDate('date', $date)->count();
            $trendData[] = [
                'label' => $date->format('d/m'),
                'count' => $count,
            ];
        }

        return view('desk.index', compact('card', 'statCounts', 'trendData'));
    }

    public function history(Request $request)
    {
        $query = Transaction::with([
            'card_qr',
            'visitor_1' => fn($q) => $q->select('id', 'email', 'full_name', 'no_hp'),
        ])->select([
            'id', 'name', 'no_hp', 'dept', 'user_meeting',
            'visitor_id', 'vendor_id', 'card_id',
            'status', 'date', 'check_in', 'check_out',
            'purpose', 'type',
            'created_at', 'updated_at',
        ])->orderBy('date', 'desc')->orderBy('check_in', 'desc');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('dept', 'like', "%{$search}%")
                    ->orWhereHas('card_qr', fn($q) => $q->where('code', 'like', "%{$search}%"))
                    ->orWhereHas('visitor_1', fn($q) => $q->where('full_name', 'like', "%{$search}%")); // search by full_name saja, bukan institution
            });
        }

        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        $history = $query->get();

        return response()->json(['status' => 'success', 'data' => $history]);
    }

    public function export(Request $request)
    {
        $transactions = $this->buildExportQuery($request)->get();

        return $this->streamCsv(
            $transactions,
            ['Kartu', 'Nama', 'Instansi/Dept', 'Check In', 'Check Out', 'Status', 'Tipe'],
            fn($row) => [
                $row->card_qr->code ?? '-',
                $row->name,
                $row->visitor_1->institution ?? $row->dept,
                $row->check_in,
                $row->check_out ?? '-',
                $row->status,
                $row->type,
            ],
            'visitor_history'
        );
    }

    public function exportvisitor(Request $request)
    {
        $query = $this->buildExportQuery($request)->where('type', 'visitor');

        if ($request->filled('tanggalawal') && $request->filled('tanggalakhir')) {
            $query->whereBetween('date', [$request->tanggalawal, $request->tanggalakhir]);
        } elseif ($request->filled('tanggalawal')) {
            $query->whereDate('date', '>=', $request->tanggalawal);
        } elseif ($request->filled('tanggalakhir')) {
            $query->whereDate('date', '<=', $request->tanggalakhir);
        }

        $transactions = $query->get();

        return $this->streamCsv(
            $transactions,
            ['Kartu', 'Nama Visitor', 'Instansi/Dept', 'Check In', 'Check Out', 'Status'],
            fn($row) => [
                $row->card_qr->code ?? '-',
                $row->name,
                $row->visitor_1->institution ?? $row->dept,
                $row->check_in,
                $row->check_out ?? '-',
                $row->status,
            ],
            'export_visitor'
        );
    }

    private function buildExportQuery(Request $request)
    {
        $query = Transaction::with(['card_qr', 'visitor_1'])
            ->orderBy('date', 'desc')
            ->orderBy('check_in', 'desc');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('dept', 'like', "%{$search}%")
                    ->orWhereHas('card_qr', fn($q) => $q->where('code', 'like', "%{$search}%"))
                    ->orWhereHas('visitor_1', fn($q) => $q->where('full_name', 'like', "%{$search}%")); // search by full_name saja
            });
        }

        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        return $query;
    }

    private function streamCsv($rows, array $columns, callable $rowMapper, string $prefix)
    {
        $filename = $prefix . '_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$filename}",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $callback = function () use ($rows, $columns, $rowMapper) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, $columns);
            foreach ($rows as $row) {
                fputcsv($file, $rowMapper($row));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}