<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class DashboardAdmisiController extends Controller
{
    public function index()
    {
        return view('dashboard_admisi'); // di resources/views/dashboard_admisi.blade.php
    }

    public function form()
    {
        return view('form'); // form.blade.php
    }

    public function monitoring()
    {
        $data = Pendaftaran::orderBy('created_at', 'asc')->get();
        return view('monitoring', compact('data')); // monitoring.blade.php
    }
}
