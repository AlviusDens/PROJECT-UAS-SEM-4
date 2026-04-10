<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
    protected $table = 'public.pengguna';
    protected $fillable = ['email', 'password'];
    protected $primaryKey = 'id_pengguna';
}
