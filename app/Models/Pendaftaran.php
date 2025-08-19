<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'pasien_id', 'poli', 'nomor_antrian', 'tanggal_kunjungan', 'status'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
