<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor_acc;
use App\Models\Contractor;
use App\Models\Barcode;
use Illuminate\Support\Facades\Mail;
use App\Mail\VisitorApprovedMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Visitor_acc::with('visitor')->get();
        return view("transaction.index", compact("transactions"));
    }

    public function show($id)
    {
        $transaction = Visitor_acc::with('visitor')->findOrFail($id);
        return view('transaction.show', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Update visitor_acc — barcode langsung disimpan di field barcode
        $transaction = Visitor_acc::with('visitor')->findOrFail($id);
        $transaction->update([
            'status' => 'approved',
            'barcode' => $otp,
        ]);

        // Kirim email ke visitor jika ada email
        try {
            $email = null;

            // Ambil email dari relasi visitor
            if ($transaction->visitor && $transaction->visitor->email) {
                $email = $transaction->visitor->email;
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
