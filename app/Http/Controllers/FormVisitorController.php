<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Transaction;
use App\Models\Notifikasi;
use App\Models\Handphone;
use App\Models\Ct_hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class FormVisitorController extends Controller
{


    public function form()
    {
        return view('form.visitor');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name_tamu' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'Alamat' => 'required|string|max:500',
            'no_telp' => 'required|string|max:15',
            'no_telp_user' => 'required|string|max:15',
            'no_police' => 'nullable|string|max:500',
            'user_meeting' => 'required|string|max:500',
            'keperluan' => 'required|string|max:500',
            'jumlah_pengunjung' => 'required|integer|min:1|max:500',
            'tanggal_masuk' => 'required|date',
            'penting' => 'required|accepted',
            'foto' => 'nullable|string',
        ]);

        $limiterKey = 'store-visitor:' . $request->ip();

        if (RateLimiter::tooManyAttempts($limiterKey, 10)) {
            $seconds = RateLimiter::availableIn($limiterKey);
            $minutes = ceil($seconds / 60);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "Terlalu banyak permintaan. Anda sudah submit form lebih dari 3 kali. Silakan coba lagi dalam {$minutes} menit.");
        }

        RateLimiter::hit($limiterKey, 60 * 60); // 60 minutes

        $handphone = Handphone::select('npk')
            ->where('no_hp', $validated['no_telp_user'])
            ->first();


        if (!$handphone) {
            return redirect()->back()->withInput()->with('error', 'Nomor HP tidak ditemukan.');
        }

        $dept = Ct_hash::select('dept')
            ->where('npk', $handphone->npk)
            ->value('dept'); // langsung ambil nilai string-nya

        if (!$dept) {
            return redirect()->back()->withInput()->with('error', 'Department tidak ditemukan.');
        }

        try {
            DB::transaction(function () use ($validated, $dept) {  // tambah $dept di sini
                $visitor = Visitor::create([
                    'full_name' => $validated['name_tamu'],
                    'email' => $validated['email'],
                    'alamat' => $validated['Alamat'],
                    'no_telp' => $validated['no_telp'],
                    'no_kendaraan' => $validated['no_police'] ?? null,
                    'yang_ditemui' => $validated['user_meeting'],
                    'urusan' => $validated['keperluan'],
                    'jumlah' => $validated['jumlah_pengunjung'],
                    'tanggal' => $validated['tanggal_masuk'],
                ]);

                Notifikasi::create(
                    [
                        'visitor_id' => $visitor->id,
                        'user_meeting' => $validated['user_meeting'],
                        'no_hp' => $validated['no_telp_user'],
                        'message' => $this->buildNotificationMessage($validated),
                    ]
                );

                Transaction::create([
                    'visitor_id' => $visitor->id,
                    'status' => 'waiting',
                    'type' => 'visitor',
                    'dept' => $dept,
                    'no_hp' => $validated['no_telp'],
                    'user_meeting' => $validated['user_meeting'],
                    'name' => $validated['name_tamu'],
                    'purpose' => $validated['keperluan'],
                    'date' => now(),
                    'foto' => !empty($validated['foto']) ? base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $validated['foto'])) : null,
                ]);

                Log::info('Visitor created successfully', [
                    'visitor_id' => $visitor->id,
                    'name' => $validated['name_tamu'],
                    'email' => $validated['email'],
                ]);
            });

            return redirect()
                ->route('transaction.index')
                ->with('success', 'Visitor information submitted successfully.');

        } catch (\Throwable $e) {
            Log::error('Failed to create visitor', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    private function buildNotificationMessage(array $data): string
    {
        return implode(', ', [
            "Ada tamu yang ingin bertemu dengan Anda dengan nama {$data['name_tamu']}",
            "keperluan: {$data['keperluan']}",
            "jumlah pengunjung: {$data['jumlah_pengunjung']}",
            "tanggal masuk: {$data['tanggal_masuk']}",
        ]);
    }
    //
}
