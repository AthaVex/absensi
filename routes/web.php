<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Admin\AbsensiRekapController; // ← tambahkan ini

// Halaman utama
Route::get('/', fn() => view('welcome'));

// Autentikasi dan dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Anggota
    Route::resource('anggota', AnggotaController::class);
    Route::get('/anggota/{id}/rekap', [AnggotaController::class, 'rekap'])->name('anggota.rekap');
    Route::get('/anggota/qr/all', [AnggotaController::class, 'qrAll'])->name('anggota.qrAll');

    // Absensi QR & Manual
    Route::get('/absen', [AbsensiController::class, 'form'])->name('absen.form');
    Route::post('/absen', [AbsensiController::class, 'store'])->name('absen.store');
    Route::get('/absensi/manual', [AbsensiController::class, 'manualForm'])->name('absensi.manual.form');
    Route::post('/absensi/manual', [AbsensiController::class, 'manualStore'])->name('absensi.manual.store');

    // Rekap harian
    Route::get('/rekap-harian', [AbsensiController::class, 'rekapHarian'])->name('absensi.rekapHarian');

    // 🔥 Rekap absensi semua anggota (tambahan)
    Route::get('/rekap', [AbsensiRekapController::class, 'index'])->name('admin.rekap.index');
});

// Autentikasi breeze
require __DIR__ . '/auth.php';
use Carbon\Carbon;