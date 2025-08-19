<?php
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\CetakController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

//Halaman Pendaftaran Pasien
Route::get('/', [PendaftaranController::class, 'form'])->name('form');
Route::post('/daftar', [PendaftaranController::class, 'daftar'])->name('daftar');

Route::get('/cetak/{id}', [CetakController::class, 'cetak'])->name('cetak');
Route::get('/monitoring', [PendaftaranController::class, 'monitoring'])->name('monitoring');
Route::post('/monitoring/update-status/{id}', [PendaftaranController::class, 'updateStatus'])->name('monitoring.updateStatus');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Monitoring
Route::get('/monitoring', [PendaftaranController::class, 'monitoring'])->name('monitoring');
Route::post('/monitoring/update-status/{id}', [PendaftaranController::class, 'updateStatus'])->name('monitoring.updateStatus');


Route::get('/form', [PendaftaranController::class, 'form'])->name('form');


Route::get('/monitoring', [PendaftaranController::class, 'monitoring'])->name('monitoring.index');
Route::post('/monitoring/{id}/update-status', [PendaftaranController::class, 'updateStatus'])->name('monitoring.updateStatus');
