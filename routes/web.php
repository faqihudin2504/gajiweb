<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\KaryawanController;

Route::get('/', function () {
    return redirect()->route('penggajian.index');
});

// Rute khusus untuk Dashboard
Route::get('/dashboard', [PenggajianController::class, 'dashboard'])->name('dashboard');

// Rute CRUD Data Penggajian
Route::resource('penggajian', PenggajianController::class);
Route::resource('karyawan', KaryawanController::class);