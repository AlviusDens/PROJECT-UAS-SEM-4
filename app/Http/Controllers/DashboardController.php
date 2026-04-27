<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Users::find(session('user_id'));
        $totalUser = Users::count();

        $data = array(
            "title"          => "Dashboard",
            "menuDashboard"  => "active",
            "user"           => $user,
            "totalUser"      => $totalUser
        );

        return view('dashboard', $data);
    }

    // Fungsi untuk memperbarui data profil
    public function updateProfile(Request $request)
    {
        $user = Users::find(session('user_id'));

        // Validasi data yang masuk
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nim'      => 'required|string',
            'jurusan'  => 'required|string',
            'semester' => 'required|integer',
        ]);

        // Update data (Role tidak dimasukkan di sini agar tidak bisa diubah)
        $user->update([
            'nama'     => $request->nama,
            'nim'      => $request->nim,
            'jurusan'  => $request->jurusan,
            'semester' => $request->semester,
        ]);

        // Perbarui nama di session jika berubah
        session(['user_nama' => $request->nama]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
