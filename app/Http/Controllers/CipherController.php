<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CipherController extends Controller
{
    public function index()
    {
        $data = [
            "title"         => "Cipher Decoder", // Tambahkan ini agar layout tidak error
            "menuCipher"    => "active",

        ];

        return view('cipher', $data);
    }

    public function process(Request $request)
    {
        $text = $request->input('text');
        $action = $request->input('action');
        $shift = (int) $request->input('shift', 13); // Default ke 13 jika kosong

        $result = "";

        // Logika Caesar Cipher
        $actualShift = ($action == 'decode') ? (26 - ($shift % 26)) : ($shift % 26);

        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];

            if (ctype_alpha($char)) { // Hanya proses huruf A-Z
                $asciiOffset = ctype_upper($char) ? 65 : 97;
                // Rumus: (Posisi Huruf + Pergeseran) mod 26
                $result .= chr((((ord($char) - $asciiOffset) + $actualShift) % 26) + $asciiOffset);
            } else {
                $result .= $char; // Karakter non-huruf (spasi, angka) tetap
            }
        }

        return view('cipher', [
            'title'  => 'Hasil Caesar Cipher',
            'result' => $result,
            'text'   => $text,
            'shift'  => $shift,
            'menuCipher' => 'active'
        ]);
    }
}
