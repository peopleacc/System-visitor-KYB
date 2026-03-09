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
        $isLemburAuth = Auth::guard('lembur')->check();
        $isDefaultAuth = Auth::check();
        $otpVerified = session('otp_verified');

        // Belum login sama sekali → ke login
        if (!$isLemburAuth && !$isDefaultAuth) {
            return redirect()->route('login');
        }

        // Sudah login tapi OTP belum diverifikasi → ke OTP
        if (!$otpVerified) {
            return redirect()->route('otp.show');
        }

        return $next($request);
    }
}
