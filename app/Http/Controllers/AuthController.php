<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class AuthController extends Controller
{
    public function index()
    {
        return view('login', ['title' => 'Login']);
    }

    public function authenticate(Request $request)
    {
        $loginInput = $request->input('email');
        $password = $request->input('password');

        
        $user = User::attemptLogin($loginInput, $password);

        if ($user) {
            session([
                'is_logged_in' => true,
                'user_id'      => $user->id,
                'user_nama'    => $user->nama,
                'user_role'    => $user->role
            ]);
            return redirect('/dashboard');
        } else {
            return redirect('/login')->with('error', 'Email/NIM atau password salah');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/home')->with('success', 'Berhasil logout!');
    }

    public function showRegister()
    {
        return view('register', ['title' => 'Sign Up']);
    }

    public function register(Request $request)
    {
        
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email',
            'nim'      => 'required',
            'password' => 'required|min:6',
            'jurusan'  => 'required',
            'semester' => 'required|integer',
        ]);

        
        User::insertUser([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'nim'           => $request->nim,
            'password'      => $request->password,
            'jurusan'       => $request->jurusan,
            'semester'      => $request->semester,
            'role'          => 'member',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        return redirect('/login')->with('success', 'Akun member berhasil dibuat! Silakan login.');
    }
}
