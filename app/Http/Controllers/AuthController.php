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
        // Kita anggap input dari form login namanya tetap 'email' atau bisa ganti jadi 'login_id'
        $loginInput = $request->input('email');
        $password = $request->input('password');

        // Cek data: Cari yang email-nya cocok ATAU nim-nya cocok
        $user = DB::table('users')
            ->where(function ($query) use ($loginInput) {
                $query->where('email', $loginInput)
                    ->orWhere('nim', $loginInput); // Menambahkan pengecekan NIM
            })
            ->where('password', $password)
            ->first();

        if ($user) {
            session(['is_logged_in' => true]);
            session(['user_id' => $user->id]); // TAMBAHKAN INI
            session(['user_nama' => $user->nama]);

            return redirect('/daftar_pengguna');
        } else {
            return redirect('/login')->with('error', 'Email/NIM atau password salah');
        }
    }

    public function logout()
    {
        session()->forget('is_logged_in'); // Hapus tanda login
        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}
