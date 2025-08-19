<?php
namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function form()
    {
        return view('form');
    }

    public function daftar(Request $request)
    {
    $request->validate([
        'nama' => 'required',
        'no_ktp' => 'required',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required',
        'jenis_pembayaran' => 'required',
        'poli' => 'required',
    ]);

    // Cek apakah pasien sudah ada
    $pasien = Pasien::firstOrCreate(
        ['no_ktp' => $request->no_ktp],
        $request->only(['nama', 'tanggal_lahir', 'alamat', 'jenis_pembayaran', 'no_bpjs'])
    );

    $tanggal_kunjungan = now()->toDateString();

    // Cari nomor antrian terakhir di poli dan tanggal yang sama
    $lastAntrian = Pendaftaran::where('tanggal_kunjungan', $tanggal_kunjungan)
        ->where('poli', $request->poli)
        ->orderBy('nomor_antrian', 'desc')
        ->first();

    if ($lastAntrian) {
        $lastNumber = (int) preg_replace('/[^0-9]/', '', $lastAntrian->nomor_antrian);
        $nextNumber = $lastNumber + 1;
    } else {
        $nextNumber = 1;
    }

    $nomorAntrian = strtoupper(substr($request->poli, 0, 1)) . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

    // Simpan pendaftaran
    $pendaftaran = Pendaftaran::create([
        'pasien_id' => $pasien->id,
        'poli' => $request->poli,
        'nomor_antrian' => $nomorAntrian,
        'tanggal_kunjungan' => $tanggal_kunjungan
    ]);

    return redirect()->route('cetak', $pendaftaran->id);
    {
    $tanggal_kunjungan = now()->toDateString();
    $data = \App\Models\Pendaftaran::with('pasien')
        ->where('tanggal_kunjungan', $tanggal_kunjungan)
        ->orderBy('poli')
        ->orderBy('nomor_antrian')
        ->get();

    return view('monitoring', compact('data'));
    }
}

    // public function updateStatus($id)
    // {
    // $pendaftaran = \App\Models\Pendaftaran::findOrFail($id);
    // $pendaftaran->status = $pendaftaran->status === 'Terdaftar' ? 'Selesai' : 'Terdaftar';
    // $pendaftaran->save();

    // return redirect()->route('monitoring')->with('success', 'Status berhasil diubah.');
    // }

    public function updateStatus($id)
{
    $pendaftaran = \App\Models\Pendaftaran::findOrFail($id);

    // toggle status
    $pendaftaran->status = $pendaftaran->status === 'Terdaftar' ? 'Selesai' : 'Terdaftar';
    $pendaftaran->save();

    return redirect()->route('monitoring.index')->with('success', 'Status berhasil diperbarui');
}


    public function monitoring()
    {
    // ambil data antrian dari database
    $data = \App\Models\Pendaftaran::with('pasien')->get();

    // kirim ke view
    return view('monitoring', compact('data'));
    }

    
}
