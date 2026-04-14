<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'category', 'image', 'is_available'];

    // Relasi: Satu buku bisa punya banyak catatan peminjaman
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
