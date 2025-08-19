<?php
namespace App\Http\Controllers;

use App\Models\Pendaftaran;

class CetakController extends Controller
{
    public function cetak($id)
    {
        $data = Pendaftaran::with('pasien')->findOrFail($id);
        return view('cetak', compact('data'));
    }
}

