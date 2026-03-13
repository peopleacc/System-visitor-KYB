<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('check.out.index');
    }

    /**
     * API endpoint: check-out via AJAX
     */
    public function checkout(Request $request)
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

        if ($transaction->status !== 'check_in') {
            return response()->json([
                'success' => false,
                'message' => 'Visitor belum check-in atau sudah check-out. Status: ' . $transaction->status,
            ], 400);
        }

        // Lakukan check-out
        $transaction->update([
            'check_out' => now(),
            'status' => 'check_out',
        ]);

        // Kembalikan status card
        $card->update([
            'status' => 'available',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Check-out berhasil!',
            'data' => [
                'id' => $transaction->id,
                'name' => $transaction->name,
                'no_hp' => $transaction->no_hp,
                'user_meeting' => $transaction->user_meeting,
                'type' => $transaction->type,
                'date' => $transaction->date,
                'check_in' => $transaction->check_in,
                'check_out' => $transaction->check_out,
                'status' => $transaction->status,
                'card_code' => $card->code,
            ],
        ]);
    }
}
