<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users; // Pastikan model sudah diubah namanya menjadi Users.php
use Illuminate\Support\Facades\Hash;

class UserController extends Controller // Ubah sesuai nama file
{
    public function daftarPengguna()
    {
        // Gunakan huruf kecil untuk variabel agar standar Laravel ($users)
        $users = Users::all(); 
        return view('daftar_pengguna', compact('users'));
    }

    // Fungsi Tambah Data
    public function store(Request $request)
    {
        // Validasi sederhana
        $data = $request->all();
        
        // Penting: Hash password agar bisa login!
        if($request->has('password')){
            $data['password'] = Hash::make($request->password);
        }

        Users::create($data); // Ubah dari Pengguna ke Users
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    // Fungsi Update Data
    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id); // Lebih aman pakai findOrFail
        
        $data = $request->all();
        if($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']); // Jangan update password jika kosong
        }

        $user->update($data);
        return redirect()->back()->with('success', 'Data berhasil diubah!');
    }

    // Fungsi Hapus Data
    public function destroy($id)
    {
        Users::destroy($id); // Lebih ringkas daripada where()->delete()
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}