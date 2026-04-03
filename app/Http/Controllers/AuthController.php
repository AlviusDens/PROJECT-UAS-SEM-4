<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login', ['title' => 'Login']);
    }

    public function authenticate(Request $request)
    {
        // 1. Ambil data dari form
        $email = $request->input('email');
        $password = $request->input('password');

        // 2. Cek data (Tanpa Database - Hardcoded) 
        if ($email == 'denis@email' && $password == 'email123') {
            session(['is_logged_in' => true]);
            // Jika benar, lempar ke dashboard
            return redirect('/dashboard')->with('success', 'Selamat Datang Admin!');
        }

        // 3. Jika salah, balikkan ke login dengan  pesan error
        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout()
    {
        session()->forget('is_logged_in'); // Hapus tanda login
        return redirect('/login')->with('success', 'Berhasil logout!');
    }

    
}
