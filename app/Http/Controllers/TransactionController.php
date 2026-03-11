<?php

namespace App\Http\Controllers;

use App\Models\Handphone;
use App\Models\notifikasi;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
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
            ->orderBy('status', 'desc')
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
            'location' => 'required|in:office,plant',
        ]);

        try {

            DB::transaction(function () use ($validated, $id, &$transaction) {

                // Ambil kartu available sesuai lokasi
                $card = Card::where('tipe', $validated['location'])
                    ->where('status', 'available')
                    ->first();

                if (!$card) {
                    throw new \Exception('Card tidak tersedia.');
                }

                // Booking card
                $card->update([
                    'status' => 'booked'
                ]);

                // Update transaction
                $transaction = Transaction::with('visitor_1')->findOrFail($id);

                $transaction->update([
                    'status' => 'approved',
                    'card_id' => $card->id,
                ]);
            });

            // Kirim email ke visitor
            try {

                $email = $transaction->visitor_1->email ?? null;

                if ($email) {
                    Mail::to($email)->send(new VisitorApprovedMail($transaction));
                }

            } catch (\Exception $e) {
                Log::error('Gagal mengirim email visitor approved: ' . $e->getMessage());
            }

            return redirect()->route('transaction.index')
                ->with('success', 'Visitor berhasil disetujui.');

        } catch (\Throwable $e) {

            Log::error('Gagal approve transaction: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
}
