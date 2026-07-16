<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// ROUTING OTENTIKASI (Bisa diakses siapa saja / guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ROUTING SISTEM (Terkunci, wajib login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PenggajianController::class, 'dashboard'])->name('dashboard');
    Route::resource('penggajian', PenggajianController::class);
    Route::resource('karyawan', KaryawanController::class);

    // Rute Baru untuk Profil
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

// Fitur Lupa Password (Simulasi OTP)
    Route::get('/lupa-password', [AuthController::class, 'showForgot'])->name('forgot');
    Route::post('/lupa-password', [AuthController::class, 'sendOtp'])->name('forgot.post');
    Route::get('/verifikasi-otp', [AuthController::class, 'showVerifyOtp'])->name('verify.otp');
    Route::post('/verifikasi-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp.post');
    Route::get('/reset-password', [AuthController::class, 'showReset'])->name('reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.post');