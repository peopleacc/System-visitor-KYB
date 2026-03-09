<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpVerified
{
    /**
     * Handle an incoming request.
     * Check if OTP has been verified for authenticated users.
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika user belum login, redirect ke login
        if (!Auth::guard('lembur')->check()) {
            return redirect()->route('login');
        }

        // Jika OTP belum diverifikasi, redirect ke halaman OTP
        if (!session('otp_verified')) {
            return redirect()->route('otp.show');
        }

        return $next($request);
    }
}
