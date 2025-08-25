<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admisi;
use Illuminate\Support\Facades\Hash;

class AdmisiSeeder extends Seeder
{
    public function run(): void
    {
        Admisi::create([
            'username' => 'admisi',
            'password' => Hash::make('password123'),
        ]);
    }
}
