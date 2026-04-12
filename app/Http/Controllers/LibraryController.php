<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    // Menampilkan daftar buku (Dashboard Perpustakaan)
    public function index()
    {
        $books = Book::all();
        return view('library', compact('books'));
    }

    // Logika proses peminjaman
    public function borrow(Request $request, $id)
    {
        // 1. Tentukan batas maksimal pengembalian (1 bulan dari sekarang)
        $maxDate = Carbon::now()->addMonth()->format('Y-m-d');

        // 2. Validasi input tanggal
        $request->validate([
            'due_date' => "required|date|after:today|before_or_equal:$maxDate",
        ], [
            'due_date.before_or_equal' => 'Maksimal waktu peminjaman adalah 1 bulan.',
            'due_date.after' => 'Tanggal pengembalian tidak boleh hari ini atau masa lalu.'
        ]);

        $book = Book::findOrFail($id);

        // 3. Cek ketersediaan buku (Safety check)
        if (!$book->is_available) {
            return back()->with('error', 'Buku ini sedang tidak tersedia.');
        }
        // 4. Catat di tabel loans
        Loan::create([
            'user_id'     => session('user_id'), // Ambil dari session
            'book_id'     => $id,
            'borrowed_at' => now(),
            'due_date'    => $request->due_date,
        ]);
        // 5. Ubah status buku menjadi terpinjam (false)
        $book->update(['is_available' => false]);

        return redirect()->back()->with('success', 'Buku "' . $book->title . '" berhasil dipinjam!');
    }
}
