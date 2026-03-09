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
        if (!session('otp_code')) {
            return redirect()->route('login');
        }

        // Kirim OTP ke view untuk demo (di production hapus ini)
        $otp = session('otp_code');

        return view('auth.otp', compact('otp'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|numeric',
        ]);

        // Gabungkan 6 input menjadi 1 string
        $otpInput = implode('', $request->otp);
        $storedOtp = session('otp_code');
        $expiresAt = session('otp_expires_at');

        // Cek apakah OTP sudah expired
        if (!$storedOtp || now()->isAfter($expiresAt)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa. Silakan kirim ulang.']);
        }

        // Cek apakah OTP cocok
        if ($otpInput !== $storedOtp) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid. Silakan coba lagi.']);
        }



        // OTP berhasil diverifikasi
        session(['otp_verified' => true]);
        session()->forget(['otp_code', 'otp_expires_at']);

        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    public function resendOtp()
    {
        if (!Auth::guard('lembur')->check()) {
            return redirect()->route('login');
        }

        // Generate OTP baru
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        session([
            'otp_code' => $otp,
            'otp_email' => Auth::guard('lembur')->user()->no_hp ?? '',
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        otp::create([
            'code' => $otp,
            'expired_at' => now()->addMinutes(5),
        ]);

        // In production, send OTP via email/SMS here
        \Log::info('New OTP for user: ' . $otp);

        return redirect()->route('otp.show')->with('success', 'Kode OTP baru telah dikirim.');
    }
}