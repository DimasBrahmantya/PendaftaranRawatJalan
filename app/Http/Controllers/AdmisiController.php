<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admisi;
use Illuminate\Support\Facades\Hash;

class AdmisiController extends Controller
{
    public function showLogin()
    {
        return view('login'); // resources/views/login.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admisi')->attempt($credentials)) {
            $request->session()->regenerate();

            // Ubah dari 'form.pendaftaran' menjadi 'admisi.dashboard'
            return redirect()->route('admisi.dashboard');
        }

        return back()->withErrors(['error' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admisi')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admisi.login');
    }

    public function showRegisterForm()
    {
    return view('register');
    }

    public function register(Request $request)
    {
    $request->validate([
        'username' => 'required|unique:admisis,username|min:4',
        'password' => 'required|min:6|confirmed',
    ]);

    $admisi = Admisi::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
    ]);

    // login otomatis setelah register
    Auth::guard('admisi')->login($admisi);

    return redirect()->route('admisi.dashboard')->with('success', 'Registrasi berhasil, selamat datang!');
    }

}
