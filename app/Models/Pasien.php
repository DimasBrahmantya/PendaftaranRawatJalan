<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'nama', 'no_ktp', 'tanggal_lahir', 'alamat', 'jenis_pembayaran', 'no_bpjs'
    ];
}
