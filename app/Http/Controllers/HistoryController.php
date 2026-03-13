<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index()
    {
        return view('history.index');
    }

    public function api(Request $request)
    {
        $query = Transaction::with(['card_qr:id,code,tipe'])
            ->where('status', 'check_out')
            ->whereNotNull('check_in')
            ->whereNotNull('check_out');

        if ($request->filled('date')) {
            $query->whereDate('check_out', $request->date);
        } elseif ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('check_out', [
                Carbon::parse($request->from)->startOfDay(),
                Carbon::parse($request->to)->endOfDay(),
            ]);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sq) use ($q) {
                $sq->where('name', 'like', "%{$q}%")
                    ->orWhere('no_hp', 'like', "%{$q}%")
                    ->orWhere('user_meeting', 'like', "%{$q}%")
                    ->orWhere('dept', 'like', "%{$q}%")
                    ->orWhereHas('card_qr', fn($c) => $c->where('code', 'like', "%{$q}%"));
            });
        }

        $rows = $query->orderBy('check_out', 'desc')->get();

        $data = $rows->map(function ($t) {
            $checkIn = Carbon::parse($t->check_in);
            $checkOut = Carbon::parse($t->check_out);
            $diffMins = max(0, $checkIn->diffInMinutes($checkOut));
            $hours = intdiv($diffMins, 60);
            $mins = $diffMins % 60;
            $duration = $hours > 0 ? "{$hours}j {$mins}m" : "{$mins}m";

            return [
                'id' => $t->id,
                'name' => $t->name,
                'no_hp' => $t->no_hp,
                'type' => $t->type,
                'user_meeting' => $t->user_meeting,
                'dept' => $t->dept ?? '-',
                'card_code' => $t->card_qr->code ?? '-',
                'card_tipe' => $t->card_qr->tipe ?? '-',
                'check_in' => $t->check_in ? Carbon::parse($t->check_in)->format('H:i') : '-',
                'check_out' => $t->check_out ? Carbon::parse($t->check_out)->format('H:i') : '-',
                'date' => $t->check_out ? Carbon::parse($t->check_out)->format('d M Y') : '-',
                'duration' => $duration,
                'duration_mins' => $diffMins,
            ];
        });

        return response()->json(['success' => true, 'total' => $data->count(), 'data' => $data]);
    }

    public function dates(Request $request)
    {
        $month = $request->filled('month') ? $request->month : now()->format('Y-m');
        [$year, $mon] = explode('-', $month);

        $dates = Transaction::where('status', 'check_out')
            ->whereNotNull('check_out')
            ->whereYear('check_out', $year)
            ->whereMonth('check_out', $mon)
            ->selectRaw('DATE(check_out) as date_only, COUNT(*) as total')
            ->groupByRaw('DATE(check_out)')
            ->orderByRaw('DATE(check_out)')
            ->get()
            ->mapWithKeys(fn($r) => [$r->date_only => $r->total]);

        return response()->json(['success' => true, 'dates' => $dates]);
    }

    public function export(Request $request)
    {
        $query = Transaction::with('card_qr:id,code,tipe')
            ->where('status', 'check_out')
            ->whereNotNull('check_in')
            ->whereNotNull('check_out');

        if ($request->filled('date')) {
            $query->whereDate('check_out', $request->date);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sq) use ($q) {
                $sq->where('name', 'like', "%{$q}%")
                    ->orWhere('no_hp', 'like', "%{$q}%")
                    ->orWhere('dept', 'like', "%{$q}%")
                    ->orWhereHas('card_qr', fn($c) => $c->where('code', 'like', "%{$q}%"));
            });
        }

        $rows = $query->orderBy('check_out', 'desc')->get();
        $filename = 'history_visitor_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$filename}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($rows) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, ['Kartu', 'Tipe Kartu', 'Nama', 'Dept', 'User Meeting', 'No HP', 'Tanggal', 'Check In', 'Check Out', 'Durasi']);
            foreach ($rows as $t) {
                $checkIn = Carbon::parse($t->check_in);
                $checkOut = Carbon::parse($t->check_out);
                $diff = max(0, $checkIn->diffInMinutes($checkOut));
                $dur = intdiv($diff, 60) > 0 ? intdiv($diff, 60) . 'j ' . ($diff % 60) . 'm' : ($diff % 60) . 'm';
                fputcsv($file, [
                    $t->card_qr->code ?? '-',
                    $t->card_qr->tipe ?? '-',
                    $t->name,
                    $t->dept ?? '-',
                    $t->user_meeting ?? '-',
                    $t->no_hp ?? '-',
                    $t->check_out ? Carbon::parse($t->check_out)->format('d M Y') : '-',
                    $t->check_in ? Carbon::parse($t->check_in)->format('H:i') : '-',
                    $t->check_out ? Carbon::parse($t->check_out)->format('H:i') : '-',
                    $dur,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}