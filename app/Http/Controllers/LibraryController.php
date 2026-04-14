<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    public function index()
    {
        // Mengambil semua buku dan dikelompokkan berdasarkan kategori
        $groupedBooks = Book::all()->groupBy('category');

        // Kirim variabel $groupedBooks (sesuai yang diminta oleh View)
        return view('library', compact('groupedBooks'));
    }

    // Menambah Buku Baru
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required',
            'author'   => 'required',
            'category' => 'required', // Tambahkan ini
            'image'    => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = basename($imagePath);
        }

        Book::create($data);
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }

    // Update Data Buku
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($book->image) {
                Storage::disk('public')->delete('books/' . $book->image);
            }
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = basename($imagePath);
        }

        $book->update($data);
        return redirect()->back()->with('success', 'Data buku berhasil diperbarui!');
    }

    // Hapus Buku
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->image) {
            Storage::disk('public')->delete('books/' . $book->image);
        }
        $book->delete();
        return redirect()->back()->with('success', 'Buku berhasil dihapus!');
    }

    public function borrow(Request $request, $id)
    {
        $maxDate = Carbon::now()->addMonth()->format('Y-m-d');

        $request->validate([
            'due_date' => "required|date|after:today|before_or_equal:$maxDate",
        ], [
            'due_date.before_or_equal' => 'Maksimal waktu peminjaman adalah 1 bulan.',
            'due_date.after' => 'Tanggal pengembalian tidak boleh hari ini atau masa lalu.'
        ]);

        $book = Book::findOrFail($id);

        if (!$book->is_available) {
            return back()->with('error', 'Buku ini sedang tidak tersedia.');
        }

        Loan::create([
            'user_id'     => session('user_id'),
            'book_id'     => $id,
            'borrowed_at' => now(),
            'due_date'    => $request->due_date,
        ]);

        $book->update(['is_available' => false]);

        return redirect()->back()->with('success', 'Buku "' . $book->title . '" berhasil dipinjam!');
    }
}
