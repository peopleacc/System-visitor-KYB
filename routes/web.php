<?php

use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\FormvisitorController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\FormContraktorController;

// ── Guest Only ───────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'indexlog'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login.post');
});

// ── Captcha Refresh (public) ─────────────────────────────────
Route::get('/refresh-captcha', function () {
    return response()->json(['captcha' => captcha_img('math')]);
});

// ── Logout (public, tapi butuh session) ─────────────────────
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── OTP Routes ───────────────────────────────────────────────
// Pakai middleware custom karena ada 2 guard (lembur + satpam/default)
Route::middleware('auth.any')->group(function () {
    Route::get('/otp', [OtpController::class, 'showOtp'])->name('otp.show');
    Route::post('/otp/verify', [OtpController::class, 'verify'])->name('otp.verify');
    Route::post('/otp/resend', [OtpController::class, 'resendOtp'])->name('otp.resend'); // POST bukan GET
});

// ── Protected Routes (login + OTP verified) ──────────────────
Route::middleware(['auth.any', 'otp.verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Checkin
    Route::get('/checkin', [CheckinController::class, 'index'])->name('check.in.index');
    Route::post('/checkin', [CheckinController::class, 'checkinApi'])->name('scan.store');
    Route::post('/checkin/process', [CheckinController::class, 'processCheckinApi'])->name('checkin.process.api');
    Route::post('/checkin/checkout', [CheckinController::class, 'checkoutApi'])->name('checkin.checkout.api');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('check.out.index');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('scan-out.store');

    // Visitor Acc
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::put('/visitor-acc/{id}', [TransactionController::class, 'update'])->name('transaction.update');
    Route::get('/visitor-acc/{id}', [TransactionController::class, 'show'])->name('transaction.show');

    // Desk
// Desk
    Route::get('/desk', [DeskController::class, 'index'])->name('desk.index');
    Route::get('/desk/history', [DeskController::class, 'history'])->name('desk.history');
    Route::get('/desk/export', [DeskController::class, 'export'])->name('desk.export');
    Route::get('/desk/exportvisitor', [DeskController::class, 'exportvisitor'])->name('desk.exportvisitor');

    Route::get('/form-visitor', [FormVisitorController::class, 'form'])->name('form.visitor');
    Route::post('/form-visitor', [FormVisitorController::class, 'store'])->name('form.visitor-store');

    Route::get('/form-contraktor', [FormContraktorController::class, 'formContraktor'])->name('form.contraktor');
    Route::post('/form-contraktor', [FormContraktorController::class, 'store'])->name('form.contraktor-store');

    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/api', [HistoryController::class, 'api'])->name('history.api');
    Route::get('/history/dates', [HistoryController::class, 'dates'])->name('history.dates');
    Route::get('/history/export', [HistoryController::class, 'export'])->name('history.export');

});