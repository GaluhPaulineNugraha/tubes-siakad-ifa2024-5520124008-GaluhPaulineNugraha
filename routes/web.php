<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KRSController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // KRS Routes
    Route::get('/krs', [KRSController::class, 'index'])->name('krs.index');
    Route::post('/krs', [KRSController::class, 'store'])->name('krs.store');
    Route::delete('/krs/{id}', [KRSController::class, 'destroy'])->name('krs.destroy');
    Route::get('/krs/export-pdf', [KRSController::class, 'exportPdf'])->name('krs.export.pdf');
    
    // Admin KRS Routes
    Route::get('/admin/krs', [KRSController::class, 'index'])->name('krs.admin');
    Route::get('/admin/krs/export-excel', [KRSController::class, 'exportExcel'])->name('krs.export.excel');
    
    // Jadwal Routes
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    
    // Nilai Routes
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::put('/nilai/{id}', [NilaiController::class, 'update'])->name('nilai.update');
    
    // Resource Routes
    Route::resource('dosen', DosenController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('matakuliah', MatakuliahController::class);
});

require __DIR__.'/auth.php';