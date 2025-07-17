<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AnggotaController;


Route::resource('anggota', AnggotaController::class);
Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
Route::get('/anggota/{id}', [AnggotaController::class, 'show'])->name('anggota.show');
Route::get('/anggota/qr/all', [AnggotaController::class, 'qrAll'])->name('anggota.qrAll');
Route::get('/anggota/{id}/rekap', [AnggotaController::class, 'rekap'])->name('anggota.rekap');
Route::get('/rekap-harian', [AbsensiController::class, 'rekapHarian'])->name('absensi.rekapHarian');


Route::get('/absen', [AbsensiController::class, 'form'])->name('absen.form');
Route::post('/absen', [AbsensiController::class, 'store'])->name('absen.store');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
