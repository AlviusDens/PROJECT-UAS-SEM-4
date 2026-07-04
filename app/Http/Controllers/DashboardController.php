<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::findById(session('user_id'));

        $totalUser = User::countAll();

        $data = [
            "title"          => "Dashboard",
            "menuDashboard"  => "active",
            "user"           => $user,
            "totalUser"      => $totalUser
        ];

        return view('dashboard', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir'  => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'telepon'       => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
        ]);

        User::updateUser(session('user_id'), [
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telepon'       => $request->telepon,
            'alamat'        => $request->alamat,
            'updated_at'    => now()
        ]);

        session(['user_nama' => $request->nama]);

        return redirect()->back()->with('success', 'Data profil perpustakaan Anda berhasil diperbarui!');
    }
}
