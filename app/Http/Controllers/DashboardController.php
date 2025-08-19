<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_kunjungan = now()->toDateString();

        // Ambil poli dari request (kalau ada)
        $filterPoli = $request->get('poli');

        $query = Pendaftaran::where('tanggal_kunjungan', $tanggal_kunjungan);

        if ($filterPoli) {
            $query->where('poli', $filterPoli);
        }

        $totalPasien = $query->count();
        $totalSelesai = (clone $query)->where('status', 'Selesai')->count();
        $totalMenunggu = (clone $query)->where('status', 'Terdaftar')->count();

        // List poli untuk dropdown
        $listPoli = Pendaftaran::where('tanggal_kunjungan', $tanggal_kunjungan)
            ->select('poli')
            ->distinct()
            ->pluck('poli');

        // Ambil semua pendaftaran + relasi pasien
        $pendaftaran = $query->with('pasien')->get();

        // Nomor antrian yang sedang dipanggil (paling kecil yang masih Terdaftar)
        $antrianSekarang = (clone $query)
            ->where('status', 'Terdaftar')
            ->orderBy('nomor_antrian', 'asc')
            ->first();

        return view('dashboard', compact(
            'totalPasien',
            'totalSelesai',
            'totalMenunggu',
            'pendaftaran',
            'antrianSekarang',
            'listPoli',
            'filterPoli'
        ));
    }
}
