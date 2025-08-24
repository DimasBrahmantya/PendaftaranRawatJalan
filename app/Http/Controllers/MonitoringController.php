<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class MonitoringController extends Controller
{
    public function index()
    {
        $data = Pendaftaran::with('pasien')
            ->orderBy('poli')
            ->orderBy('nomor_antrian')
            ->get();

        return view('monitoring', compact('data'));
    }

    // Fungsi untuk memanggil pasien
    public function panggil($id)
    {
        $antrian = Pendaftaran::findOrFail($id);

        // Cari pasien yang sedang Dipanggil di poli yang sama
        $sedangDipanggil = Pendaftaran::where('poli', $antrian->poli)
            ->where('status', 'Dipanggil')
            ->first();

        if ($sedangDipanggil) {
            $sedangDipanggil->status = 'Selesai';
            $sedangDipanggil->save();
        }

        // Ubah status pasien baru jadi Dipanggil
        $antrian->status = 'Dipanggil';
        $antrian->save();

        return redirect()->route('monitoring')->with('success', "Pasien $antrian->nomor_antrian - {$antrian->pasien->nama} dipanggil!");
    }

    // Tetap ada opsi ubah langsung ke selesai
    public function selesai($id)
    {
        $antrian = Pendaftaran::findOrFail($id);
        $antrian->status = 'Selesai';
        $antrian->save();

        return redirect()->route('monitoring')->with('success', "Pasien $antrian->nomor_antrian - {$antrian->pasien->nama} selesai!");
    }
}
