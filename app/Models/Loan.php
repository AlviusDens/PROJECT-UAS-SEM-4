<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['user_id', 'book_id', 'borrowed_at', 'due_date', 'returned_at'];

    public function user()
    {
        // Panggil Users::class yang baru saja kita buat
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
