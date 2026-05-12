<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes - FutsalHub
|--------------------------------------------------------------------------
*/

// 1. Landing Page
Route::get('/', function () { 
    return redirect('/login'); 
});

// 2. Guest Routes (Hanya bisa diakses jika belum login)
Route::middleware(['guest'])->group(function () {
    // Login & OTP
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/verifikasi', function () {
        if (!session()->has('otp')) return redirect('/login');
        return view('auth.verifikasi');
    })->name('verifikasi');
    Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('verify.otp');

    // Registrasi
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 3. Authenticated Routes (Harus Login)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard & Profil
    Route::get('/dashboard', [LapanganController::class, 'index'])->name('dashboard');
    Route::get('/profil', [AuthController::class, 'showProfile'])->name('profil.edit');
    Route::post('/profil', [AuthController::class, 'updateProfile'])->name('profil.update');

    // Manajemen Lapangan (CRUD UAS)
    Route::resource('lapangan', LapanganController::class)->except(['index']);

    // Alur Transaksi Booking
    Route::get('/booking/konfirmasi/{id}', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/riwayat-booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking/{id}/upload', [BookingController::class, 'uploadBukti'])->name('booking.upload');
    Route::get('/booking/kwitansi/{id}', [BookingController::class, 'kwitansi'])->name('booking.kwitansi');

    // Fitur Membership
    Route::get('/membership', function () {
        return view('member.index');
    })->name('membership.index');
    Route::post('/membership/join', [BookingController::class, 'joinMember'])->name('membership.join');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});