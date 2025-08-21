<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class MonitoringController extends Controller
{
    // Tampilkan semua antrian
    public function index()
    {
        $data = Pendaftaran::with('pasien')->orderBy('nomor_antrian')->get();
        return view('monitoring', compact('data'));
    }

    // Panggil pasien (ubah status jadi Dipanggil)
    public function panggil($id)
    {
        $antrian = Pendaftaran::findOrFail($id);
        $antrian->status = 'Dipanggil';
        $antrian->save();

        return redirect()->route('monitoring')->with('success', 'Pasien berhasil dipanggil!');
    }

    // Tandai selesai
    public function selesai($id)
    {
        $antrian = Pendaftaran::findOrFail($id);
        $antrian->status = 'Selesai';
        $antrian->save();

        return redirect()->route('monitoring')->with('success', 'Pasien telah selesai!');
    }
}
