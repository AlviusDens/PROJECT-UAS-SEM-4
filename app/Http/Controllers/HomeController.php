<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; 
use App\Models\ReadingMaterial;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        if ($keyword) {
            $newReleases = [];
            $topDownloads = Book::searchBooks($keyword);
            $titleHeader = "Hasil Pencarian untuk: '" . $keyword . "'";
        } else {
            $newReleases = Book::getAllNewReleases();
            $topDownloads = Book::getAllTopDownloads();
            $titleHeader = "Koleksi Terpopuler (Top Download)";
        }

        return view('home', [
            'newReleases'  => $newReleases,
            'topDownloads' => $topDownloads,
            'titleHeader'  => $titleHeader,
            'keyword'      => $keyword
        ]);
    }

    public function rilisBaru()
    {
        $books = Book::getAllNewReleases();

        return view('rilis_baru', [
            'books' => $books,
            'title' => 'Semua Koleksi Rilis Baru'
        ]);
    }

    public function downloadTerpopuler()
    {
        $books = Book::getAllTopDownloads();

        return view('top_downloads', [
            'books' => $books,
            'title' => 'Semua Koleksi Terpopuler'
        ]);
    }


    public function pengarang()
    {
        $bookAuthors    = Book::getUniqueBookAuthors();
        $artikelAuthors = ReadingMaterial::getUniqueAuthorsByType('Artikel');
        $jurnalAuthors  = ReadingMaterial::getUniqueAuthorsByType('Jurnal');
        $modulAuthors   = ReadingMaterial::getUniqueAuthorsByType('Modul'); 

        return view('pengarang', [
            'bookAuthors'    => $bookAuthors,
            'artikelAuthors' => $artikelAuthors,
            'jurnalAuthors'  => $jurnalAuthors,
            'modulAuthors'   => $modulAuthors,
            'title'          => 'Daftar Pengarang & Penulis Koleksi'
        ]);
    }

    public function contactUs()
    {
        return view('contact', [
            'title' => 'Hubungi Layanan Perpustakaan'
        ]);
    }
}
