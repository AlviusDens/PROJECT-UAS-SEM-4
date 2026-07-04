<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Book
{
    private static $cipherKey = 7;


    public static function encryptCaesar($plainText)
    {
        if (!$plainText) return $plainText;
        $effectiveKey = self::$cipherKey % 95;
        $cipherText = "";
        $length = strlen($plainText);

        for ($i = 0; $i < $length; $i++) {
            $char = $plainText[$i];
            $ascii = ord($char);


            if ($ascii >= 32 && $ascii <= 126) {

                $encryptedAscii = (($ascii - 32 + $effectiveKey) % 95) + 32;
                $cipherText .= chr($encryptedAscii);
            } else {
                $cipherText .= $char;
            }
        }
        return $cipherText;
    }


    public static function decryptCaesar($cipherText)
    {
        if (!$cipherText) return $cipherText;
        $effectiveKey = self::$cipherKey % 95;
        $plainText = "";
        $length = strlen($cipherText);

        for ($i = 0; $i < $length; $i++) {
            $char = $cipherText[$i];
            $ascii = ord($char);

            if ($ascii >= 32 && $ascii <= 126) {

                $decryptedAscii = (($ascii - 32 - $effectiveKey + 95) % 95) + 32;
                $plainText .= chr($decryptedAscii);
            } else {
                $plainText .= $char;
            }
        }
        return $plainText;
    }

    public static function getAllBooks()
    {
        $books = DB::table('books')->get();
        foreach ($books as $book) {
            $book->author = self::decryptCaesar($book->author);
            if (isset($book->penerbit)) $book->penerbit = self::decryptCaesar($book->penerbit);
            if (isset($book->sinopsis)) $book->sinopsis = self::decryptCaesar($book->sinopsis);
        }
        return $books;
    }

    public static function findBookById($id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        if ($book) {
            $book->author = self::decryptCaesar($book->author);
            if (isset($book->penerbit)) $book->penerbit = self::decryptCaesar($book->penerbit);
            if (isset($book->sinopsis)) $book->sinopsis = self::decryptCaesar($book->sinopsis);
        }
        return $book;
    }

    public static function insertBook($data)
    {
        if (isset($data['author']))   $data['author'] = self::encryptCaesar($data['author']);
        if (isset($data['penerbit'])) $data['penerbit'] = self::encryptCaesar($data['penerbit']);
        if (isset($data['sinopsis'])) $data['sinopsis'] = self::encryptCaesar($data['sinopsis']);

        return DB::table('books')->insert($data);
    }

    public static function updateBook($id, $data)
    {
        if (isset($data['author']))   $data['author'] = self::encryptCaesar($data['author']);
        if (isset($data['penerbit'])) $data['penerbit'] = self::encryptCaesar($data['penerbit']);
        if (isset($data['sinopsis'])) $data['sinopsis'] = self::encryptCaesar($data['sinopsis']);

        return DB::table('books')->where('id', $id)->update($data);
    }

    public static function deleteBook($id)
    {
        return DB::table('books')->where('id', $id)->delete();
    }

    public static function incrementDownloadCount($id)
    {
        return DB::table('books')->where('id', $id)->increment('total_download');
    }

    public static function recordDownloadLog($data)
    {
        return DB::table('download_logs')->insert($data);
    }

    public static function getAllNewReleases()
    {
        $books = DB::table('books')
            ->select('id', 'title', 'author', 'image', 'pdf_file', 'total_download', 'created_at')
            ->get()
            ->map(function ($item) {
                $item->author = self::decryptCaesar($item->author);
                $item->type_display = 'Buku';
                $item->is_book = true;
                return $item;
            });

        $materials = DB::table('reading_materials')
            ->select('id', 'title', 'author', 'pdf_file', 'total_download', 'created_at', 'type as type_display')
            ->get()
            ->map(function ($item) {
                $item->image = null;
                $item->is_book = false;
                return $item;
            });

        return $books->concat($materials)->sortByDesc('created_at')->take(5);
    }

    public static function getAllTopDownloads()
    {
        $books = DB::table('books')
            ->select('id', 'title', 'author', 'image', 'pdf_file', 'total_download', 'created_at')
            ->get()
            ->map(function ($item) {
                $item->author = self::decryptCaesar($item->author);
                $item->type_display = 'Buku';
                $item->is_book = true;
                return $item;
            });

        $materials = DB::table('reading_materials')
            ->select('id', 'title', 'author', 'pdf_file', 'total_download', 'created_at', 'type as type_display')
            ->get()
            ->map(function ($item) {
                $item->image = null;
                $item->is_book = false;
                return $item;
            });

        return $books->concat($materials)->sortByDesc('total_download');
    }

    public static function searchBooks($keyword)
    {
        $encryptedKeyword = self::encryptCaesar($keyword);

        $books = DB::table('books')
            ->where('title', 'like', '%' . $keyword . '%')
            ->orWhere('author', 'like', '%' . $encryptedKeyword . '%')
            ->orWhere('sinopsis', 'like', '%' . $encryptedKeyword . '%')
            ->get();

        foreach ($books as $book) {
            $book->author = self::decryptCaesar($book->author);
            if (isset($book->penerbit)) $book->penerbit = self::decryptCaesar($book->penerbit);
            if (isset($book->sinopsis)) $book->sinopsis = self::decryptCaesar($book->sinopsis);
        }
        return $books;
    }

    public static function getUniqueBookAuthors()
    {
        $authors = DB::table('books')
            ->select('author', DB::raw('count(*) as total_buku'))
            ->groupBy('author')
            ->orderBy('author', 'asc')
            ->get();

        foreach ($authors as $a) {
            $a->author = self::decryptCaesar($a->author);
        }
        return $authors;
    }
}
