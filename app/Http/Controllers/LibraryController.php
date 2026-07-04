<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ReadingMaterial;

class LibraryController extends Controller
{
    public function index()
    {
        $dataBuku = Book::getAllBooks();
        $groupedBooks = $dataBuku->groupBy('category');
        $dataBacaan = ReadingMaterial::getAll();

        $role = session('user_role');

        if (!$role) {
            return view('guest.library', [
                'groupedBooks' => $groupedBooks,
                'readingMaterials' => $dataBacaan
            ]);
        } elseif ($role === 'member') {
            return view('member.library', [
                'groupedBooks' => $groupedBooks,
                'readingMaterials' => $dataBacaan
            ]);
        } elseif ($role === 'petugas') {
            return view('petugas.library', [
                'groupedBooks' => $groupedBooks,
                'readingMaterials' => $dataBacaan
            ]);
        } elseif ($role === 'admin') {
            return view('admin.library', [
                'groupedBooks' => $groupedBooks,
                'readingMaterials' => $dataBacaan
            ]);
        }
    }

    public function store(Request $request)
    {
        if (session('user_role') !== 'admin' && session('user_role') !== 'petugas') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk tindakan ini.');
        }

        $request->validate([
            'title'    => 'required',
            'author'   => 'required',
            'category' => 'required',
            'image'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pdf_file' => 'required|mimes:pdf|max:12000'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $imageName = basename($imagePath);
        }

        $pdfName = null;
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('pdfs', 'public');
            $pdfName = basename($pdfPath);
        }

        Book::insertBook([
            'title'     => $request->title,
            'author'    => $request->author,
            'category'  => $request->category,
            'penerbit'  => $request->penerbit,
            'thn_edisi' => $request->thn_edisi,
            'sinopsis'  => $request->sinopsis,
            'image'     => $imageName,
            'pdf_file'  => $pdfName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Buku digital baru berhasil diterbitkan!');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findBookById($id);

        $request->validate([
            'title'  => 'required',
            'author' => 'required',
            'image'  => 'image|mimes:jpeg,png,jpg|max:2048',
            'pdf_file' => 'mimes:pdf|max:12000'
        ]);

        $dataUpdate = [
            'title'     => $request->title,
            'author'    => $request->author,
            'category'  => $request->category,
            'penerbit'  => $request->penerbit,
            'thn_edisi' => $request->thn_edisi,
            'sinopsis'  => $request->sinopsis,
            'updated_at' => now()
        ];

        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::disk('public')->delete('books/' . $book->image);
            }
            $imagePath = $request->file('image')->store('books', 'public');
            $dataUpdate['image'] = basename($imagePath);
        }

        if ($request->hasFile('pdf_file')) {
            if (isset($book->pdf_file) && $book->pdf_file) {
                Storage::disk('public')->delete('pdfs/' . $book->pdf_file);
            }
            $pdfPath = $request->file('pdf_file')->store('pdfs', 'public');
            $dataUpdate['pdf_file'] = basename($pdfPath);
        }

        Book::updateBook($id, $dataUpdate);
        return redirect()->back()->with('success', 'Data koleksi digital berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $book = Book::findBookById($id);
        if ($book->image) {
            Storage::disk('public')->delete('books/' . $book->image);
        }
        if (isset($book->pdf_file) && $book->pdf_file) {
            Storage::disk('public')->delete('pdfs/' . $book->pdf_file);
        }

        Book::deleteBook($id);
        return redirect()->back()->with('success', 'Buku digital berhasil dihapus dari sistem!');
    }

    public function downloadBook($id)
    {
        $book = Book::findBookById($id);

        if (!$book || !isset($book->pdf_file) || !$book->pdf_file) {
            return redirect()->back()->with('error', 'Maaf, berkas file PDF untuk buku ini tidak ditemukan di database.');
        }

        $pathToFile = storage_path('app/public/pdfs/' . $book->pdf_file);

        if (!file_exists($pathToFile)) {
            return redirect()->back()->with('error', 'Berkas PDF fisik tidak ditemukan di folder internal server. Coba unggah ulang buku baru.');
        }

        Book::incrementDownloadCount($id);

        Book::recordDownloadLog([
            'user_id'       => session('user_id'),
            'book_id'       => $id,
            'downloaded_at' => now()
        ]);

        return response()->download($pathToFile, $book->title . '.pdf');
    }
}
