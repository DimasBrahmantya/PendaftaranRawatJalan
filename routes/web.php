<?php
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
// routes/web.php
use App\Http\Controllers\MonitoringController;

Route::get('/', [PendaftaranController::class, 'form'])->name('form');
Route::get('/form', [PendaftaranController::class, 'form'])->name('form');
Route::post('/daftar', [PendaftaranController::class, 'daftar'])->name('daftar');

Route::get('/cetak/{id}', [CetakController::class, 'cetak'])->name('cetak');

Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring'); 
Route::get('/monitoring/panggil/{id}', [MonitoringController::class, 'panggil'])->name('monitoring.panggil');
Route::get('/monitoring/selesai/{id}', [MonitoringController::class, 'selesai'])->name('monitoring.selesai');
Route::post('/monitoring/{id}/update-status', [PendaftaranController::class, 'updateStatus'])->name('monitoring.updateStatus');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/cek-ktp', [PendaftaranController::class, 'cekKtp'])->name('cek.ktp');


Route::get('/monitoring/{id}/panggil', [MonitoringController::class, 'panggil'])
    ->name('monitoring.panggil');
Route::get('/monitoring/{id}/selesai', [MonitoringController::class, 'selesai'])
    ->name('monitoring.selesai');
