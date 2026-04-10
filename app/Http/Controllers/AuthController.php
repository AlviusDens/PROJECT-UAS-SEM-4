<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // 2. Cek data  
        $user = DB::table('pengguna')
            ->where('email', $email)
            ->where('password', $password)
            ->first();

        if ($user) {
            session(['login' => true]);
            return redirect('/daftar_pengguna');
        } else {
            return redirect('/login')->with('error', 'Email atau password salah');
        }
    }

    public function daftarPengguna()
    {
        $users = DB::table('pengguna')->get();

        return view('daftar_pengguna', compact('users'));
    }

    public function logout()
    {
        session()->forget('is_logged_in'); // Hapus tanda login
        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}
