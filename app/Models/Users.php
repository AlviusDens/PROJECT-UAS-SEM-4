<?php

namespace App\Models;

// Gunakan Authenticatable jika ini dipakai untuk Login
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;

    // Karena nama class 'Users' (jamak), Laravel biasanya otomatis mencari tabel 'users'.
    // Tapi karena kamu pakai PostgreSQL dengan schema public, sebaiknya tetap definisikan:
    protected $table = 'public.users';

    protected $fillable = ['email', 'nama', 'nim', 'jurusan', 'semester', 'password'];
}
