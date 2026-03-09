<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index()
    {
        return view('check.in.index');
    }

    /**
     * API endpoint: check-in via AJAX
     */
    public function checkinApi(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|min:1',
        ]);

        $kode = $request->kode;

        // Cari card berdasarkan kode
        $card = Card::with('transaction_qr')->where('code', $kode)->first();

        if (!$card) {
            return response()->json([
                'success' => false,
                'message' => 'Kode card tidak ditemukan.',
            ], 404);
        }

        $transaction = $card->transaction_qr;

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada transaksi yang terkait dengan card ini.',
            ], 404);
        }

        if ($transaction->status == 'approved') {
            // Lakukan check-in
            $transaction->update([
                'check_in' => now(),
                'status' => 'checked_in',
            ]);

            $card->update([
                'status' => 'Used',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Check-in berhasil!',
                'data' => [
                    'id' => $transaction->id,
                    'name' => $transaction->name,
                    'no_hp' => $transaction->no_hp,
                    'user_meeting' => $transaction->user_meeting,
                    'type' => $transaction->type,
                    'date' => $transaction->date,
                    'check_in' => $transaction->check_in,
                    'status' => $transaction->status,
                    'card_code' => $card->code,
                ],
            ]);
        } elseif ($transaction->status == 'checked_in') {
            // Sudah check-in, tampilkan data saja
            return response()->json([
                'success' => true,
                'message' => 'Visitor sudah check-in sebelumnya.',
                'data' => [
                    'id' => $transaction->id,
                    'name' => $transaction->name,
                    'no_hp' => $transaction->no_hp,
                    'user_meeting' => $transaction->user_meeting,
                    'type' => $transaction->type,
                    'date' => $transaction->date,
                    'check_in' => $transaction->check_in,
                    'status' => $transaction->status,
                    'card_code' => $card->code,
                ],
            ]);
        } elseif ($transaction->status == 'checked_out') {
            return response()->json([
                'success' => false,
                'message' => 'Visitor sudah check-out.',
            ], 400);
        } elseif ($transaction->status == 'waiting') {
            return response()->json([
                'success' => false,
                'message' => 'Visitor belum disetujui (masih menunggu approval).',
            ], 400);
        }

        return response()->json([
            'success' => false,
            'message' => 'Status transaksi tidak valid: ' . $transaction->status,
        ], 400);
    }

    /**
     * API endpoint: check-out via AJAX
     */
    public function checkoutApi(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $transaction = Transaction::findOrFail($request->id);

        if ($transaction->status !== 'checked_in') {
            return response()->json([
                'success' => false,
                'message' => 'Visitor belum check-in atau sudah check-out.',
            ], 400);
        }

        $transaction->update([
            'check_out' => now(),
            'status' => 'checked_out',
        ]);

        // Kembalikan status card ke available
        if ($transaction->card_id) {
            $card = Card::find($transaction->card_id);
            if ($card) {
                $card->update(['status' => 'available']);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Check-out berhasil!',
            'data' => [
                'id' => $transaction->id,
                'name' => $transaction->name,
                'status' => $transaction->status,
                'check_out' => $transaction->check_out,
            ],
        ]);
    }
}
