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




// Protected routes - require auth + OTP verified
Route::middleware(['auth', 'otp.verified'])->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // user management
    Route::get('/visitor', [VisitorController::class, 'index'])->name('visitor.index');
    Route::put('/visitor/{id}', [VisitorController::class, 'accept'])->name('visitor.update');
    Route::get('/visitor/supply/{id}', [VisitorController::class, 'showSupply'])->name('supply.show');
    Route::get('/visitor/contractor/{id}', [VisitorController::class, 'showContractor'])->name('contractor.show');
    Route::get('/visitor/{id}', [VisitorController::class, 'show'])->name('visitor.show');

    //Checkin
    Route::get('/checkin', [CheckinController::class, 'index'])->name('check.in.index');
    Route::post('/checkin', [CheckinController::class, 'checkin'])->name('scan.store');
   
    //Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('check.out.index');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('scan-out.store');

    // visitor acc
    Route::get('/visitor-acc', [TransactionController::class, 'index'])->name('transaction.index');
    Route::put('/visitor-acc/{id}', [TransactionController::class, 'update'])->name('transaction.update');
    Route::get('/visitor-acc/{id}', [TransactionController::class, 'show'])->name('transaction.show');

    // barcode 
    Route::get('/barcode', [BarcodeController::class, 'index'])->name('barcode.index');
    Route::post('/barcode', [BarcodeController::class, 'store'])->name('barcode.store');
    Route::delete('/barcode/{id}', [BarcodeController::class, 'destroy'])->name('barcode.destroy');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'indexlog'])->name('login');
});

Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// OTP Routes - require auth only (not otp.verified)
Route::middleware('auth')->group(function () {
    Route::get('/otp', [OtpController::class, 'showOtp'])->name('otp.show');
    Route::post('/otp/verify', [OtpController::class, 'verify'])->name('otp.verify');
    Route::get('/otp/resend', [OtpController::class, 'resendOtp'])->name('otp.resend');
});
