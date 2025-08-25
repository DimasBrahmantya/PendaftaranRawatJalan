<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdmisiController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\DashboardAdmisiController;

// ----------------------------
// PUBLIC ROUTES
// ----------------------------
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/daftar', [PendaftaranController::class, 'daftar'])->name('daftar');
Route::get('/cetak/{id}', [CetakController::class, 'cetak'])->name('cetak');
Route::get('/cek-ktp', [PendaftaranController::class, 'cekKtp'])->name('cek.ktp');

// ----------------------------
// LOGIN ADMISI
// ----------------------------
Route::get('/admisi/login', [AdmisiController::class, 'showLogin'])->name('admisi.login');
Route::post('/admisi/login', [AdmisiController::class, 'login'])->name('admisi.login.submit');
Route::get('/admisi/logout', [AdmisiController::class, 'logout'])->name('admisi.logout');

// ----------------------------
// PROTECTED ROUTES (Hanya Admisi)
// ----------------------------
Route::middleware('admisi.auth')->group(function () {

    // Dashboard Admisi
    Route::get('/admisi/dashboard', [DashboardAdmisiController::class, 'index'])->name('admisi.dashboard');

    // Form Pendaftaran via dashboard Admisi
    Route::get('/admisi/form', [DashboardAdmisiController::class, 'form'])->name('admisi.form');
    Route::post('/admisi/form', [PendaftaranController::class, 'daftar'])->name('admisi.form.submit');

    // Monitoring Antrian via dashboard Admisi
    Route::get('/admisi/monitoring', [DashboardAdmisiController::class, 'monitoring'])->name('admisi.monitoring');
    Route::get('/admisi/monitoring/panggil/{id}', [MonitoringController::class, 'panggil'])->name('monitoring.panggil');
    Route::get('/admisi/monitoring/selesai/{id}', [MonitoringController::class, 'selesai'])->name('monitoring.selesai');
});

Route::middleware('web')->group(function () {
    Route::get('/admisi/login', [AdmisiController::class, 'showLogin'])->name('admisi.login');
    Route::post('/admisi/login', [AdmisiController::class, 'login'])->name('admisi.login.submit');
});

