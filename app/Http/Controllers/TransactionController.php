<?php

namespace App\Http\Controllers;

use App\Models\Handphone;
use App\Models\notifikasi;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VisitorApprovedMail;
use Illuminate\Support\Facades\Log;
use App\Models\Card;

class TransactionController extends Controller
{
    public function index()
    {
        $dept = session('dept');

        $transactions = Transaction::with('visitor_1')
            ->where('dept', $dept)
            ->get();

        return view('transaction.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['visitor_1', 'card_qr'])->findOrFail($id);
        return view('transaction.show', compact('transaction'));


    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'location' => 'required',
        ]);

        if ($validated['location'] == 'office') {

            $cards = Card::where('tipe', 'office')->first();
            $cardid = $cards->id;
            $transaction = Transaction::with('visitor_1')->findOrFail($id);
            $transaction->update([
                'status' => 'approved',
                'card_id' => $cardid,
            ]);


        } else if ($validated['location'] == 'plant') {

            $cards = Card::where('tipe', 'plant')->first();
            $cardid = $cards->id;
            $transaction = Transaction::with('visitor_1')->findOrFail($id);
            $transaction->update([
                'status' => 'approved',
                'card_id' => $cardid,
            ]);
        }

        // Kirim email ke visitor jika ada email
        try {
            $email = null;

            // Ambil email dari relasi visitor
            if ($transaction->visitor_1 && $transaction->visitor_1->email) {
                $email = $transaction->visitor_1->email;
            }

            if ($email) {
                Mail::to($email)->send(new VisitorApprovedMail($transaction));
            }
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email visitor approved: ' . $e->getMessage());
        }

        return redirect()->route('transaction.index')
            ->with('success', 'Visitor berhasil disetujui.');
    }
}
