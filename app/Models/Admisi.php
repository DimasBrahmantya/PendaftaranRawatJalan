<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admisi extends Authenticatable
{
    use Notifiable;

    protected $table = 'admisis'; // pastikan sesuai tabel

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
