<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tanggal_kunjungan = now()->toDateString();

        $totalPasien = Pendaftaran::where('tanggal_kunjungan', $tanggal_kunjungan)->count();
        $totalSelesai = Pendaftaran::where('tanggal_kunjungan', $tanggal_kunjungan)->where('status', 'Selesai')->count();
        $totalMenunggu = Pendaftaran::where('tanggal_kunjungan', $tanggal_kunjungan)->where('status', 'Terdaftar')->count();

        $perPoli = Pendaftaran::select('poli')
            ->where('tanggal_kunjungan', $tanggal_kunjungan)
            ->groupBy('poli')
            ->selectRaw('poli, COUNT(*) as total')
            ->get();

        // Ambil semua pendaftaran + relasi pasien
        $pendaftaran = Pendaftaran::with('pasien')
            ->where('tanggal_kunjungan', $tanggal_kunjungan)
            ->get();

        // Nomor antrian yang sedang dipanggil (paling kecil yang masih Terdaftar)
        $antrianSekarang = Pendaftaran::where('tanggal_kunjungan', $tanggal_kunjungan)
            ->where('status', 'Terdaftar')
            ->orderBy('nomor_antrian', 'asc')
            ->first();

        return view('dashboard', compact(
            'totalPasien',
            'totalSelesai',
            'totalMenunggu',
            'perPoli',
            'pendaftaran',
            'antrianSekarang'
        ));
    }
}
