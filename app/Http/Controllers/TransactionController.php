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
            ->orderBy('created_at', 'desc')
            ->orderBy('status', 'asc')
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
            'location' => 'required|array|min:1',
            'location.*' => 'in:office,plant',
        ]);

        $locations = $validated['location'];
        $resolvedLocation = (count($locations) === 2 || in_array('plant', $locations))
            ? 'plant'
            : 'office';

        try {
            $transaction = DB::transaction(function () use ($resolvedLocation, $id) {

                $card = Card::where('tipe', $resolvedLocation)
                    ->where('status', 'available')
                    ->first();

                if (!$card) {
                    throw new \Exception('Card tidak tersedia untuk lokasi ' . $resolvedLocation . '.');
                }

                $card->update(['status' => 'booked']);

                $transaction = Transaction::findOrFail($id);

                $transaction->update([
                    'status' => 'approved',
                    'card_id' => $card->id,
                ]);

                return $transaction;
            });

            // Cek apakah vendor atau visitor
            if ($transaction->vendor_id == null) {
                // Visitor
                $transaction->load(['card_qr', 'visitor_1']);

                try {
                    $email = $transaction->visitor_1->email ?? null;
                    if ($email) {
                        Mail::to($email)->send(new VisitorApprovedMail($transaction));
                    }
                } catch (\Exception $e) {
                    Log::error('Gagal mengirim email visitor approved: ' . $e->getMessage());
                }
            } else {
                // Vendor
                $transaction->load(['card_qr', 'vendors_1']);

                try {
                    $email = $transaction->vendors_1->email ?? null;
                    if ($email) {
                        Mail::to($email)->send(new VisitorApprovedMail($transaction));
                    }
                } catch (\Exception $e) {
                    Log::error('Gagal mengirim email vendor approved: ' . $e->getMessage());
                }
            }
            return redirect()->route('transaction.show', ['id' => $id])
                ->with('success', 'Visitor berhasil disetujui.');
                
        } catch (\Throwable $e) {
            Log::error('Gagal approve transaction: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}
