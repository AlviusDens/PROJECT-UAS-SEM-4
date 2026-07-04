<?php

namespace App\Http\Controllers;

use App\Models\ReadingMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReadingMaterialController extends Controller
{
    public function store(Request $request)
    {
        if (session('user_role') !== 'admin' && session('user_role') !== 'petugas') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk tindakan ini.');
        }

        $request->validate([
            'title'    => 'required',
            'author'   => 'required',
            'type'     => 'required', 
            'pdf_file' => 'required|mimes:pdf|max:12000'
        ]);

        $pdfName = null;
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('materials', 'public');
            $pdfName = basename($pdfPath);
        }

        ReadingMaterial::insert([
            'title'          => $request->title,
            'author'         => $request->author,
            'type'           => $request->type,
            'pdf_file'       => $pdfName,
            'total_download' => 0,
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        return redirect()->back()->with('success', 'Bahan bacaan baru berhasil diterbitkan!');
    }

    public function update(Request $request, $id)
    {
        $material = ReadingMaterial::findById($id);

        $request->validate([
            'title'  => 'required',
            'author' => 'required',
            'type'   => 'required',
            'pdf_file' => 'mimes:pdf|max:12000'
        ]);

        $dataUpdate = [
            'title'      => $request->title,
            'author'     => $request->author,
            'type'       => $request->type,
            'updated_at' => now()
        ];

        if ($request->hasFile('pdf_file')) {
            if ($material->pdf_file) {
                Storage::disk('public')->delete('materials/' . $material->pdf_file);
            }
            $pdfPath = $request->file('pdf_file')->store('materials', 'public');
            $dataUpdate['pdf_file'] = basename($pdfPath);
        }

        ReadingMaterial::update($id, $dataUpdate);
        return redirect()->back()->with('success', 'Bahan bacaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $material = ReadingMaterial::findById($id);
        if ($material->pdf_file) {
            Storage::disk('public')->delete('materials/' . $material->pdf_file);
        }

        ReadingMaterial::delete($id);
        return redirect()->back()->with('success', 'Bahan bacaan berhasil dihapus!');
    }

    public function downloadMaterial($id)
    {
        $material = ReadingMaterial::findById($id);

        if (!$material || !$material->pdf_file) {
            return redirect()->back()->with('error', 'File dokumen PDF tidak ditemukan.');
        }

        $pathToFile = storage_path('app/public/materials/' . $material->pdf_file);

        if (!file_exists($pathToFile)) {
            return redirect()->back()->with('error', 'Berkas PDF fisik tidak ditemukan di server.');
        }

        ReadingMaterial::incrementDownloadCount($id);

        \App\Models\Book::recordDownloadLog([
            'user_id'             => session('user_id'),
            'reading_material_id' => $id,
            'downloaded_at'       => now()
        ]);

        return response()->download($pathToFile, $material->title . '.pdf');
    }
}
