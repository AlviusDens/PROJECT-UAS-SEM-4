<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function daftarPengguna()
    {
        $currentRole = session('user_role');

        if ($currentRole === 'admin') {
            $users = User::getUsersByRole('petugas');
            $pageTitle = "Manajemen Akun Petugas (Staf Perpustakaan)";
            $targetRole = "petugas";
            $viewPath = "admin.daftar_pengguna";
        } elseif ($currentRole === 'petugas') {
            $users = User::getUsersByRole('member');
            $pageTitle = "Data Keanggotaan Member (Siswa)";
            $targetRole = "member";
            $viewPath = "petugas.daftar_pengguna"; 
        } else {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman manajemen ini.');
        }

        return view($viewPath, [
            'users' => $users,
            'pageTitle' => $pageTitle,
            'targetRole' => $targetRole
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'email'    => 'required|email',
            'nim'      => 'required',
            'password' => 'required',
            'role'     => 'required'
        ]);

        User::insertUser([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'nim'           => $request->nim,
            'password'      => $request->password,
            'role'          => $request->role,
            'telepon'       => $request->telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        return redirect()->back()->with('success', 'Data pengguna baru berhasil didaftarkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'role' => 'required'
        ]);

        User::updateUser($id, [
            'nama'          => $request->nama,
            'role'          => $request->role,
            'telepon'       => $request->telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'updated_at'    => now()
        ]);

        return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::deleteUser($id);
        return redirect()->back()->with('success', 'Akun pengguna telah berhasil dihapus!');
    }
}
