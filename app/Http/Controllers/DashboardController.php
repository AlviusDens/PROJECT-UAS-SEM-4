<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users; // Pastikan Model Users sudah diimport
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data user yang sedang login dari database
        $user = Users::find(session('user_id'));

        // 2. Hitung total user di database
        $totalUser = Users::count();

        $data = array(
            "title"          => "Dashboard",
            "menuDashboard"  => "active",
            "user"           => $user,      // Kirim data user ke view
            "totalUser"      => $totalUser  // Kirim total user ke view
        );

        return view('dashboard', $data);
    }
}
