@extends('layouts/new')

@section('content')
<section id="library-hero" class="hero section" style="padding-top: 100px; padding-bottom: 40px; background: #f9f9f9; min-height: auto;">
    <div class="container text-center">
        <h2 class="mb-1 fw-bold" style="font-size: 1.5rem;"><i class="bi bi-person-workspace text-success"></i> Panel Kontrol Kerja Petugas</h2>
        <p class="mb-4 small text-muted">Kelola siklus terbitan data e-book utama dan bahan bacaan literatur berkala sekolah.</p>

        <ul class="nav nav-pills justify-content-center gap-2 mb-2" id="pills-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active btn-sm small px-4 shadow-sm" id="pills-buku-tab" data-bs-toggle="pill" data-bs-target="#pills-buku" type="button"><i class="bi bi-book"></i> Kelola E-Book</button>
            </li>
            <li class="nav-item">
                <button class="nav-link btn-sm small px-4 shadow-sm" id="pills-bacaan-tab" data-bs-toggle="pill" data-bs-target="#pills-bacaan" type="button"><i class="bi bi-file-earmark-text"></i> Kelola Bahan Bacaan</button>
            </li>
        </ul>
    </div>
</section>

<section class="section" style="padding-top: 10px;">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success py-2 small alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger py-2 small alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-buku">
                <div class="mb-3 text-end">
                    <button type="button" class="btn btn-xs btn-success shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#addBookModal"><i class="bi bi-plus-circle"></i> Unggah E-Book Baru</button>
                </div>

                @foreach($groupedBooks as $category => $books)
                <div class="category-section mb-4">
                    <h6 class="fw-bold text-success mb-3 border-bottom pb-1 text-uppercase"><i class="bi bi-folder"></i> Kategori {{ $category }}</h6>
                    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
                        @foreach($books as $book)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm">
                                <div style="height: 140px; background: #eee;">
                                    <img src="{{ asset('storage/books/' . $book->image) }}" class="w-100 h-100" style="object-fit: cover;">
                                </div>
                                <div class="card-body p-2 text-center">
                                    <h6 class="fw-bold mb-1 text-truncate small">{{ $book->title }}</h6>

                                    <div class="d-flex flex-column gap-1 mt-2">
                                        <button type="button" class="btn btn-xs btn-outline-info w-100" style="font-size: 0.65rem;" data-bs-toggle="modal" data-bs-target="#detailBookModal{{ $book->id }}">
                                            <i class="bi bi-eye"></i> Lihat Detail
                                        </button>

                                        <div class="d-flex gap-1">
                                            <button type="button" class="btn btn-xs btn-warning w-100" style="font-size: 0.65rem;" data-bs-toggle="modal" data-bs-target="#editBookModal{{ $book->id }}"><i class="bi bi-pencil"></i> Edit</button>

                                            <form action="{{ route('library.destroy', $book->id) }}" method="POST" class="w-100" onsubmit="return confirm('Hapus e-book ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-outline-danger w-100" style="font-size: 0.65rem;"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="detailBookModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-start">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold"><i class="bi bi-info-circle text-info"></i> Detail Data Buku (Petugas Mode)</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center mb-3">
                                            <img src="{{ asset('storage/books/' . $book->image) }}" style="max-height: 180px; object-fit: cover; border-radius: 6px;" class="shadow-sm">
                                        </div>
                                        <table class="table table-sm table-borderless small mb-2">
                                            <tr>
                                                <td class="fw-bold text-muted" width="130px">Judul Buku</td>
                                                <td>: <span class="fw-bold text-dark">{{ $book->title }}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold text-muted">Nama Pengarang</td>
                                                <td>: {{ $book->author }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold text-muted">Penerbit</td>
                                                <td>: {{ $book->penerbit ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold text-muted">Kategori Letak</td>
                                                <td>: <span class="badge bg-success">{{ $book->category }}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold text-muted">Total Download</td>
                                                <td>: <i class="bi bi-download text-success"></i> {{ $book->total_download ?? 0 }}x diunduh</td>
                                            </tr>
                                        </table>
                                        <hr class="my-2">
                                        <h6 class="fw-bold small text-dark mb-1">Sinopsis Deskripsi:</h6>
                                        <p class="text-muted small mb-0" style="text-align: justify; line-height: 1.4;">{{ $book->sinopsis ?? 'Tidak ada sinopsis deskripsi untuk e-book ini.' }}</p>
                                    </div>
                                    <div class="modal-body border-top text-end p-2 bg-light">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup Halaman</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editBookModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-start">
                                    <form action="{{ route('library.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Ubah Informasi E-Book</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label class="form-label small fw-bold">Judul Buku</label>
                                                <input type="text" name="title" class="form-control form-control-sm" value="{{ $book->title }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small fw-bold">Nama Pengarang</label>
                                                <input type="text" name="author" class="form-control form-control-sm" value="{{ $book->author }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small fw-bold">Nama Penerbit</label>
                                                <input type="text" name="penerbit" class="form-control form-control-sm" value="{{ $book->penerbit ?? '' }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small fw-bold">Kategori Letak</label>
                                                <select name="category" class="form-select form-select-sm" required>
                                                    <option value="Romance" {{ $book->category == 'Romance' ? 'selected' : '' }}>Romance</option>
                                                    <option value="Psychology" {{ $book->category == 'Psychology' ? 'selected' : '' }}>Psychology</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small fw-bold">Sinopsis Deskripsi</label>
                                                <textarea name="sinopsis" class="form-control form-control-sm" rows="3" required>{{ $book->sinopsis ?? '' }}</textarea>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small fw-bold">Ganti Gambar Sampul (Kosongkan jika tetap)</label>
                                                <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small fw-bold">Ganti File Dokumen PDF (Kosongkan jika tetap)</label>
                                                <input type="file" name="pdf_file" class="form-control form-control-sm" accept=".pdf">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <div class="tab-pane fade" id="pills-bacaan">
                <div class="mb-3 text-end">
                    <button type="button" class="btn btn-xs btn-success shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#addMaterialModal"><i class="bi bi-plus-circle"></i> Unggah Bahan Bacaan</button>
                </div>

                <div class="table-responsive bg-white p-3 shadow-sm" style="border-radius: 8px;">
                    <table class="table table-hover align-middle border">
                        <thead class="table-light text-secondary text-uppercase small" style="font-size: 0.75rem;">
                            <tr>
                                <th>Judul Materi</th>
                                <th>Penulis / Kontributor</th>
                                <th>Jenis Klasifikasi</th>
                                <th>Total Unduhan</th>
                                <th class="text-center">Aksi Operasional</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.85rem;">
                            @forelse($readingMaterials as $material)
                            <tr>
                                <td class="fw-bold text-dark">{{ $material->title }}</td>
                                <td>{{ $material->author }}</td>
                                <td>
                                    <span class="badge {{ $material->type == 'Jurnal' ? 'bg-danger' : ($material->type == 'Artikel' ? 'bg-success' : 'bg-warning text-dark') }}">
                                        {{ $material->type }}
                                    </span>
                                </td>
                                <td><i class="bi bi-download text-success"></i> {{ $material->total_download }}x unduh</td>
                                <td class="text-center">
                                    <form action="{{ route('materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('Hapus dokumen bahan bacaan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-outline-danger"><i class="bi bi-trash"></i> Hapus Konten</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted small py-3">Belum ada kompilasi data dokumen Artikel, Jurnal, atau Modul yang diterbitkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-start">
            <form action="{{ route('library.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Form Registrasi E-Book Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2"><label class="form-label small fw-bold">Judul Buku</label><input type="text" name="title" class="form-control form-control-sm" placeholder="Judul Buku Utama" required></div>
                    <div class="mb-2"><label class="form-label small fw-bold">Nama Pengarang</label><input type="text" name="author" class="form-control form-control-sm" placeholder="Nama Penulis Karya" required></div>
                    <div class="mb-2"><label class="form-label small fw-bold">Nama Penerbit</label><input type="text" name="penerbit" class="form-control form-control-sm" placeholder="PT Penerbit Buku" required></div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Kategori Letak</label>
                        <select name="category" class="form-select form-select-sm" required>
                            <option value="Romance">Romance</option>
                            <option value="Psychology">Psychology</option>
                        </select>
                    </div>
                    <div class="mb-2"><label class="form-label small fw-bold">Sinopsis Deskripsi</label><textarea name="sinopsis" class="form-control form-control-sm" rows="3" placeholder="Tulis ringkasan isi e-book di sini..." required></textarea></div>
                    <div class="mb-2"><label class="form-label small fw-bold">Upload Gambar Sampul (`.jpg / .png`)</label><input type="file" name="image" class="form-control form-control-sm" accept="image/*" required></div>
                    <div class="mb-2"><label class="form-label small fw-bold">Upload Berkas PDF (`.pdf`)</label><input type="file" name="pdf_file" class="form-control form-control-sm" accept=".pdf" required></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-sm btn-success">Daftarkan E-Book</button></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addMaterialModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-start">
            <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Form Terbitan Bahan Bacaan Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2"><label class="form-label small fw-bold">Judul Dokumen Literatur</label><input type="text" name="title" class="form-control form-control-sm" placeholder="Judul Artikel / Karya Jurnal" required></div>
                    <div class="mb-2"><label class="form-label small fw-bold">Nama Penulis / Penyusun</label><input type="text" name="author" class="form-control form-control-sm" placeholder="Nama Penulis Ilmiah" required></div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Jenis Klasifikasi Bahan Bacaan</label>
                        <select name="type" class="form-select form-select-sm" required>
                            <option value="Artikel">Artikel Ilmiah</option>
                            <option value="Jurnal">Jurnal Pendek</option>
                            <option value="Modul">Modul Pembelajaran</option>
                        </select>
                    </div>
                    <div class="mb-2"><label class="form-label small fw-bold">Upload Berkas PDF (`.pdf`)</label><input type="file" name="pdf_file" class="form-control form-control-sm" accept=".pdf" required></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-sm btn-success">Unggah Dokumen</button></div>
            </form>
        </div>
    </div>
</div>

<style>
    .transition-hover {
        transition: all 0.3s;
        border-radius: 8px;
        overflow: hidden;
    }

    .transition-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
    }

    .btn-xs {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        border-radius: 4px;
    }

    .nav-pills .nav-link.active {
        background-color: #198754 !important;
        color: white !important;
    }

    .nav-pills .nav-link {
        color: #6c757d;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
</style>
@endsection