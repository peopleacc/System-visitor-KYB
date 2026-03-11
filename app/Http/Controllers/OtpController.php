<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\otp;
class OtpController extends Controller
{
    public function showOtp()
    {
        // Jika tidak ada OTP code, redirect ke login
        if (session('otp_code')) {
            $otp = session('otp_code');

            return view('auth.otp', compact('otp'));

        } elseif (session('otp_satpam')) {

            $otp = session('otp_satpam');
            return view('auth.otp', compact('otp'));
        }

        // Kirim OTP ke view untuk demo (di production hapus ini)

        return redirect()->route('login');

    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|numeric',
        ]);

        // Gabungkan 6 input menjadi 1 string
        $otpInput = implode('', $request->otp);

        // Prefer `otp_code` (lembur) fallback ke `otp_satpam` (satpam)
        $storedOtp = session('otp_code') ?? session('otp_satpam');
        $expiresAt = session('otp_expires_at');

        // Jika tidak ada OTP di session, minta login ulang
        if (!$storedOtp) {
            return redirect()->route('login')->withErrors(['otp' => 'Tidak ada kode OTP. Silakan login kembali.']);
        }

        // Cek apakah OTP sudah expired
        if ($expiresAt && now()->isAfter($expiresAt)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa. Silakan kirim ulang.']);
        }

        // Cek apakah OTP cocok
        if ($otpInput == $storedOtp) {
            session(['otp_verified' => true]);

            // Hapus keys terkait OTP
            session()->forget(['otp_code', 'otp_satpam', 'otp_expires_at']);

            return redirect()->route('desk.index')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['otp' => 'Kode OTP tidak valid. Silakan coba lagi.']);



        // OTP berhasil diverifikasi
    }

    public function resendOtp()
    {
        // Hanya izinkan jika salah satu guard ter-auth
        if (!Auth::guard('lembur')->check() && !Auth::check()) {
            return redirect()->route('login');
        }

        // Generate OTP baru
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(5);

        // Jika user lembur sedang login, simpan ke key `otp_code`
        if (Auth::guard('lembur')->check()) {
            $contact = Auth::guard('lembur')->user()->no_hp ?? '';
            session([
                'otp_code' => $otp,
                'otp_expires_at' => $expiresAt,
                'otp_verified' => false,
                'otp_email' => $contact,
            ]);
        } else {
            // Default guard (satpam)
            $contact = Auth::user()->email ?? '';
            session([
                'otp_satpam' => $otp,
                'otp_expires_at' => $expiresAt,
                'otp_verified' => false,
                'otp_email' => $contact,
            ]);
        }

        // Simpan ke DB untuk audit (opsional)
        otp::create([
            'code' => $otp,
            'expired_at' => $expiresAt,
        ]);

        // In production, send OTP via email/SMS here
        \Log::info('New OTP for user: ' . $otp);

        return redirect()->route('otp.show')->with('success', 'Kode OTP baru telah dikirim.');
    }
}