<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexlog()
    {
        if (Auth::check()) {
            // Jika sudah login dan OTP terverifikasi, redirect ke dashboard
            if (session('otp_verified')) {
                return redirect()->route('dashboard');
            }
            // Jika sudah login tapi OTP belum terverifikasi, redirect ke OTP
            return redirect()->route('otp.show');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Generate OTP (6 digit)
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            // Store OTP in session
            session([
                'otp_code' => $otp,
                'otp_email' => Auth::user()->email,
                'otp_expires_at' => now()->addMinutes(5),
                'otp_verified' => false,
            ]);





            // In production, send OTP via email/SMS here
            // For demo purposes, we'll just log it
            \Log::info('OTP for ' . Auth::user()->email . ': ' . $otp);

            return redirect()->route('otp.show');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
