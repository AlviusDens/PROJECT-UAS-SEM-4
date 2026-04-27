<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

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
            session([
                'is_logged_in' => true,
                'user_id'      => $user->id,
                'user_nama'    => $user->nama,
                'user_role'    => $user->role // Tambahkan ini
            ]);
            return redirect('/dashboard');
        } else {
            return redirect('/login')->with('error', 'Email/NIM atau password salah');
        }
    }

    // Di AuthController.php
    public function logout()
    {
        // Hapus semua data session terkait user
        session()->flush();
        return redirect('/login')->with('success', 'Berhasil logout!');
    }

    public function showRegister()
    {
        return view('register', ['title' => 'Sign Up']);
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nim' => 'required|unique:users,nim',
            'password' => 'required|min:6',
            'jurusan' => 'required',
            'semester' => 'required|integer',
        ]);

        // Simpan data ke tabel users
        Users::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nim' => $request->nim,
            'password' => $request->password, 
            'jurusan' => $request->jurusan,
            'semester' => $request->semester,
            'role' => 'mahasiswa' 
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}
