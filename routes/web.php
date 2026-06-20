<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KRSController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminJadwalController;
use Illuminate\Support\Facades\Route;

// Route publik
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/beranda', [BerandaController::class, 'beranda'])->name('beranda');
Route::get('/beranda/visi-misi', [BerandaController::class, 'visiMisi'])->name('beranda.visi-misi');

// Route yang membutuhkan login
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
    
    // Admin Jadwal Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('jadwal', AdminJadwalController::class);
        Route::get('jadwal/export-excel', [AdminJadwalController::class, 'exportExcel'])->name('jadwal.export');
    });
    
    // Jadwal Routes untuk Mahasiswa
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/export-pdf', [JadwalController::class, 'exportPdf'])->name('jadwal.export.pdf');
   
    // Dosen Routes
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{nidn}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen/{nidn}', [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/dosen/{nidn}', [DosenController::class, 'destroy'])->name('dosen.destroy');
    Route::get('/dosen/export-excel', [DosenController::class, 'exportExcel'])->name('dosen.export');
    
    // Mahasiswa Resource
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('/mahasiswa/export-excel', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.export');
    
    // Matakuliah Resource
    Route::resource('matakuliah', MatakuliahController::class);
    Route::get('/matakuliah/export-excel', [MatakuliahController::class, 'exportExcel'])->name('matakuliah.export');
    
    // Route untuk Dosen
    Route::prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');
        Route::get('/jadwal', [DosenController::class, 'jadwalIndex'])->name('jadwal');
        Route::get('/mahasiswa', [DosenController::class, 'mahasiswaIndex'])->name('mahasiswa');
        Route::get('/jadwal/export-pdf', [DosenController::class, 'exportJadwalPdf'])->name('jadwal.export');
        Route::get('/mahasiswa/export-pdf', [DosenController::class, 'exportMahasiswaPdf'])->name('mahasiswa.export');
    });
});

require __DIR__.'/auth.php';