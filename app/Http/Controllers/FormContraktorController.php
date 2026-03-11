<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Transaction;
use App\Models\Notifikasi;
use App\Models\Handphone;
use App\Models\Ct_hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

class FormContraktorController extends Controller
{

    public function formContraktor()
    {
        return view('form.contraktor');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_pt' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'area_pekerjaan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_police' => 'required|string|max:255',
            'pic' => 'nullable|string|max:255',
            'jumlah_mp' => 'required|integer|min:0',
            'safety_officer_nama' => 'nullable|string|max:255',
            'safety_officer_hp' => 'nullable|string|max:25',
            'foto' => 'nullable|string',
        ]);

        $limiterKey = 'store-contraktor:' . $request->ip();

        if (RateLimiter::tooManyAttempts($limiterKey, 10)) {
            $seconds = RateLimiter::availableIn($limiterKey);
            $minutes = ceil($seconds / 60);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "Terlalu banyak permintaan. Anda sudah submit form lebih dari 3 kali. Silakan coba lagi dalam {$minutes} menit.");
        }

        RateLimiter::hit($limiterKey, 60 * 60); // 60 minutes

        // Cari NPK berdasarkan no HP user kayaba
        $handphone = Handphone::select('npk')
            ->where('no_hp', $validated['safety_officer_hp'])
            ->first();

        if (!$handphone) {
            return redirect()->back()->withInput()->with('error', 'Nomor HP tidak ditemukan.');
        }


        // Cari department berdasarkan NPK
        $dept = Ct_hash::select('dept')
            ->where('npk', $handphone->npk)
            ->value('dept');

        if (!$dept) {
            return redirect()->back()->withInput()->with('error', 'Department tidak ditemukan.');
        }

        try {
            DB::transaction(function () use ($validated, $dept) {
                $vendor = Vendor::create(
                    [
                        'email' => $validated['email'],
                        'nama_pt' => $validated['nama_pt'],
                        'nama_perusahaan' => $validated['nama_perusahaan'],
                        'no_police' => $validated['no_police'],
                        'area_pekerjaan' => $validated['area_pekerjaan'],
                        'tanggal_masuk' => $validated['tanggal'],
                        'pic' => $validated['pic'] ?? null,
                        'jumlah_mp' => $validated['jumlah_mp'],
                        'safety_officer_nama' => $validated['safety_officer_nama'] ?? null,
                        'safety_officer_hp' => $validated['safety_officer_hp'] ?? null,
                    ]
                );

                Notifikasi::create(
                    [
                        'vendor_id' => $vendor->id,
                        'user_meeting' => $validated['safety_officer_nama'],
                        'no_hp' => $validated['safety_officer_hp'],
                        'message' => $this->buildNotificationMessage($validated),
                    ]
                );

                Transaction::create(
                    [
                        'vendor_id' => $vendor->id,
                        'status' => 'waiting',
                        'dept' => $dept,
                        'type' => 'Vendor/Contraktor',
                        'no_hp' => $validated['safety_officer_hp'],
                        'user_meeting' => $validated['safety_officer_nama'],
                        'name' => $validated['nama_pt'],
                        'date' => now(),
                        'foto' => !empty($validated['foto']) ? base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $validated['foto'])) : null,
                    ]
                );

                Log::info('Vendor & Transaction created or updated successfully', [
                    'vendor_id' => $vendor->id,
                    'nama_pt' => $validated['nama_pt'],
                    'email' => $validated['email'],
                ]);
            });

            return redirect()->route('transaction.index')->with('success', 'Informasi kontraktor berhasil disimpan.');

        } catch (\Throwable $e) {
            Log::error('Failed to create vendor', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    private function buildNotificationMessage(array $data): string
    {
        return "Pendaftaran kontraktor baru: {$data['nama_pt']} - {$data['nama_perusahaan']} di {$data['area_pekerjaan']}.";
    }
}
