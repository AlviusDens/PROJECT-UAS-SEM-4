@extends('layouts/new')

@section('content')
<!-- HERO SECTION UTAMA MEMBER -->
<section id="library-hero" class="hero section" style="padding-top: 100px; padding-bottom: 40px; background: #f9f9f9; min-height: auto;">
    <div class="container text-center">
        <h2 class="mb-1 fw-bold text-primary" style="font-size: 1.5rem;"><i class="bi bi-book-half"></i> Perpustakaan Digital Siswa</h2>
        <p class="mb-4 small text-muted">Selamat belajar, silakan akses e-book utama dan dokumen literatur ilmiah secara berkala.</p>

        <!-- Navigasi Tab Modular Aktor Member -->
        <ul class="nav nav-pills justify-content-center gap-2 mb-2" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active btn-sm small px-4 shadow-sm" id="pills-buku-tab" data-bs-toggle="pill" data-bs-target="#pills-buku" type="button" role="tab"><i class="bi bi-book"></i> E-Book Utama</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn-sm small px-4 shadow-sm" id="pills-bacaan-tab" data-bs-toggle="pill" data-bs-target="#pills-bacaan" type="button" role="tab"><i class="bi bi-file-earmark-text"></i> Bahan Bacaan (Artikel/Jurnal/Modul)</button>
            </li>
        </ul>
    </div>
</section>

<section id="book-gallery" class="section" style="padding-top: 10px;">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success py-2 small alert-dismissible fade show" role="alert">
            {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger py-2 small alert-dismissible fade show" role="alert">
            {{ session('error') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="tab-content" id="pills-tabContent">

            <!-- ======================= TAB 1: KATALOG E-BOOK UTAMA ======================= -->
            <div class="tab-pane fade show active" id="pills-buku" role="tabpanel">
                @foreach($groupedBooks as $category => $books)
                <div class="category-section mb-4">
                    <h6 class="fw-bold text-primary mb-3 border-bottom pb-1 text-uppercase"><i class="bi bi-tag"></i> Kategori {{ $category }}</h6>
                    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
                        @foreach($books as $book)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm transition-hover">
                                <div style="height: 170px; background: #eee;">
                                    @if($book->image)
                                    <img src="{{ asset('storage/books/' . $book->image) }}" class="w-100 h-100" style="object-fit: cover;">
                                    @else
                                    <div class="d-flex align-items-center justify-content-center h-100 text-muted small">No Image</div>
                                    @endif
                                </div>
                                <div class="card-body p-2 text-center d-flex flex-column justify-content-between">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-truncate small" title="{{ $book->title }}">{{ $book->title }}</h6>
                                        <p class="text-muted mb-1" style="font-size: 0.7rem;">{{ $book->author }}</p>
                                    </div>

                                    <!-- Aksi Tombol Detail dan Unduh Berdampingan -->
                                    <div class="d-flex gap-1 mt-2">
                                        <button type="button" class="btn btn-xs btn-outline-info w-100" style="font-size: 0.65rem;" data-bs-toggle="modal" data-bs-target="#detailBookModal{{ $book->id }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </button>
                                        <form action="{{ route('library.download', $book->id) }}" method="POST" class="w-100">
                                            @csrf
                                            <button type="submit" class="btn btn-xs btn-primary w-100 py-1" style="font-size: 0.65rem;"><i class="bi bi-download"></i> Unduh</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL BOX: POP-UP DETAIL INFORMASI BUKU -->
                        <div class="modal fade" id="detailBookModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-start">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold"><i class="bi bi-info-circle text-info"></i> Detail Informasi Buku</h5>
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
                                                <td class="fw-bold text-muted">Tahun Edisi</td>
                                                <td>: {{ $book->thn_edisi ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold text-muted">Kategori Buku</td>
                                                <td>: <span class="badge bg-secondary">{{ $book->category }}</span></td>
                                            </tr>
                                        </table>
                                        <hr class="my-2">
                                        <h6 class="fw-bold small text-dark mb-1"><i class="bi bi-blockquote-left text-secondary"></i> Sinopsis Cerita:</h6>
                                        <p class="text-muted small mb-0" style="text-align: justify; line-height: 1.4;">{{ $book->sinopsis ?? 'Tidak ada sinopsis deskripsi untuk buku ini.' }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <!-- ======================= TAB 2: BAHAN BACAAN (ARTIKEL / JURNAL / MODUL) ======================= -->
            <div class="tab-pane fade" id="pills-bacaan" role="tabpanel">
                @if(count($readingMaterials) == 0)
                <div class="text-center py-4">
                    <p class="text-muted small">Belum ada dokumen bahan bacaan ilmiah yang tersedia saat ini.</p>
                </div>
                @else
                <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
                    @foreach($readingMaterials as $material)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm transition-hover">
                            <div class="card-body p-3 text-center d-flex flex-column justify-content-between">
                                <div class="mb-2">
                                    <div class="text-center mb-2"><i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 2.5rem;"></i></div>
                                    <span class="badge {{ $material->type == 'Jurnal' ? 'bg-danger' : ($material->type == 'Artikel' ? 'bg-success' : 'bg-warning text-dark') }} small mb-1" style="font-size: 0.65rem;">{{ $material->type }}</span>
                                    <h6 class="fw-bold mb-0 text-truncate small" title="{{ $material->title }}">{{ $material->title }}</h6>
                                    <small class="text-muted d-block text-truncate mt-1" style="font-size: 0.7rem;">Oleh: {{ $material->author }}</small>
                                </div>
                                <form action="{{ route('materials.download', $material->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-success w-100 py-1 shadow-sm" style="font-size: 0.7rem;"><i class="bi bi-download"></i> Unduh {{ $material->type }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>
</section>

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
        background-color: #0d6efd !important;
        color: white !important;
    }

    .nav-pills .nav-link {
        color: #555;
        background-color: #eee;
    }
</style>
@endsection