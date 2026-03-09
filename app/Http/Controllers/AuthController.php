<?php

namespace App\Http\Controllers;

use App\Models\HP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\otp;
use App\Models\Handphone;

class AuthController extends Controller
{
    public function indexlog()
    {
        if (Auth::guard('lembur')->check()) {
            // Jika sudah login dan OTP terverifikasi, redirect ke dashboard
            if (session('otp_verified')) {
                return redirect()->route('dashboard');
            }
            // Jika sudah login tapi OTP belum terverifikasi, redirect ke OTP
            return redirect()->route('otp.show');
        } elseif (Auth::check()) {
            if (session('otp_satpam')) {
                return redirect()->route('dashboard');
            }
        }

        return view('auth.login');
    }

    // public function login(Request $request)
    // {
    //     $validated = $request->validate([
    //         'npk' => 'required|string',
    //         'password' => 'required',
    //         'captcha' => 'required|captcha'
    //     ]);

    //     $credentials = [
    //         'npk' => $validated['npk'],
    //         'password' => $validated['password'],
    //     ];

    //     $user = HP::where('npk', $validated['npk'])->first();

    //     if (!$user) {
    //         return back()->with('error', 'NPK tidak terdaftar');
    //     }

    //     $remember = $request->boolean('remember');

    //     if (Auth::guard('lembur')->attempt($credentials, $remember)) {
    //         $request->session()->regenerate();

    //         // Generate OTP (6 digit)
    //         $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

    //         // Store OTP in session
    //         session([
    //             'otp_code' => $otp,
    //             'otp_expires_at' => now()->addMinutes(5),
    //             'otp_verified' => false,
    //         ]);

    //         // In production, send OTP via email/SMS here
    //         // For demo purposes, we'll just log it

    //         return redirect()->route('otp.show');
    //     }

    //     return back()->with('error', 'Email atau password salah');
    // }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'npk' => 'required|string',
            'password' => 'required',
            'captcha' => 'required|captcha:math', // tambahkan nama captcha jika pakai custom (opsional)
        ], [
            // Custom pesan validasi (opsional, biar lebih bagus)
            'captcha.captcha' => 'Captcha yang Anda masukkan salah.',
            'npk.required' => 'NPK wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // buat satpam
        $creds = [
            'name' => $validated['npk'],
            'password' => validate['password']
        ];
        if (Auth::attempt($creds)) {
            $request->session()->regenerate();


            // OTP logic ...
            $otp_satpam = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            session([
                'dept' => Auth::guard('lembur')->user()->dept,
                'otp_satpam' => $otp_satpam,
                'otp_expires_at' => now()->addMinutes(5),
                'otp_verified' => false,
            ]);


            otp::create([
                'code' => $otp_satpam,
                'expired_at' => now()->addMinutes(5),
            ]);

            return redirect()->route('otp.show');
        }
        ;


        $user = Handphone::where('npk', $validated['npk'])->first();

        // Case 1: NPK tidak ditemukan
        if (!$user) {
            return back()
                ->withInput($request->only('npk', 'remember')) // biar npk tetap terisi
                ->withErrors(['npk' => 'NPK tidak terdaftar di tabel HP'])
                ->with('status', 'error'); // atau pakai 'error' key lain
        }

        $credentials = [
            'npk' => $validated['npk'],
            'password' => $validated['password'],
        ];

        $remember = $request->boolean('remember');

        // Case 2: Auth gagal → hampir pasti password salah (karena NPK sudah dicek ada)
        if (!Auth::guard('lembur')->attempt($credentials, $remember)) {
            Log::info('LOGIN GAGAL untuk NPK: ' . $validated['npk']);

            return back()
                ->withInput($request->only('npk', 'remember'))
                ->withErrors(['password' => 'Password yang Anda masukkan salah'])
                ->with('status', 'error');
        }

        // ── Login berhasil ───────────────────────────────────────
        Log::info('LOGIN BERHASIL untuk NPK: ' . $validated['npk']);

        $request->session()->regenerate();

        $no_hp = $user->no_hp;

        // OTP logic ...
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        session([
            'dept' => Auth::guard('lembur')->user()->dept,
            'otp_code' => $otp,
            'no_hp' => $no_hp,
            'otp_email' => $no_hp,
            'otp_expires_at' => now()->addMinutes(5),
            'otp_verified' => false,
        ]);


        otp::create([
            'code' => $otp,
            'expired_at' => now()->addMinutes(5),
        ]);

        return redirect()->route('otp.show');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
