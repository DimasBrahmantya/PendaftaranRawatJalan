<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_kunjungan = now()->toDateString();
        $filterPoli = $request->get('poli');

        $query = Pendaftaran::where('tanggal_kunjungan', $tanggal_kunjungan);

        if ($filterPoli) {
            $query->where('poli', $filterPoli);
        }

        $totalPasien = $query->count();
        $totalSelesai = (clone $query)->where('status', 'Selesai')->count();
        $totalMenunggu = (clone $query)->where('status', 'Terdaftar')->count();
        $totalDipanggil = (clone $query)->where('status', 'Dipanggil')->count();

        $listPoli = Pendaftaran::where('tanggal_kunjungan', $tanggal_kunjungan)
            ->select('poli')
            ->distinct()
            ->pluck('poli');

        $pendaftaran = $query->with('pasien')->get();

        // cari pasien yang statusnya Dipanggil, kalau kosong ambil Terdaftar pertama
        $antrianSekarang = (clone $query)
            ->whereIn('status', ['Dipanggil', 'Terdaftar'])
            ->orderByRaw("FIELD(status, 'Dipanggil', 'Terdaftar')")
            ->orderBy('nomor_antrian', 'asc')
            ->with('pasien')
            ->first();

        return view('dashboard', compact(
            'totalPasien',
            'totalSelesai',
            'totalMenunggu',
            'totalDipanggil',
            'pendaftaran',
            'antrianSekarang',
            'listPoli',
            'filterPoli'
        ));
    }
}
