@extends('layouts/new')

@section('content')

<!-- ini bagian judul -->
<section id="library-hero" class="hero section" style="padding-top: 100px; padding-bottom: 100px; background: #f9f9f9; min-height: auto;">
    <div class="container text-center">
        <h2 data-aos="fade-up" class="mb-1" style="font-size: 1.5rem;">Manajemen Perpustakaan</h2>
        <p data-aos="fade-up" data-aos-delay="100" class="mb-4 small text-muted">Temukan dan kelola koleksi buku dengan mudah.</p>

        <button type="button" class="btn btn-sm btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#addBookModal">
            <i class="bi bi-plus-circle"></i> Tambah Buku Baru
        </button>
    </div>
</section>

<!-- ini bagian isi -->
<section id="book-gallery" class="section" style="padding-top: 10px;">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success py-2 small alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($groupedBooks->isEmpty())
        <div class="text-center py-5">
            <p class="text-muted">Belum ada koleksi buku. Silakan tambah buku baru.</p>
        </div>
        @endif

        @foreach($groupedBooks as $category => $books)
        <div class="category-section mb-4">
            <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-1">
                <h5 class="fw-bold text-primary mb-0" style="letter-spacing: 1px;">{{ strtoupper($category) }}</h5>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
                @foreach($books as $book)
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 border-0 shadow-sm transition-hover" style="border-radius: 8px; overflow: hidden;">
                        <div class="position-absolute top-0 end-0 p-1" style="z-index: 2;">
                            <span class="badge {{ $book->is_available ? 'bg-success' : 'bg-danger' }}" style="font-size: 0.6rem;">
                                {{ $book->is_available ? 'Tersedia' : 'Terpinjam' }}
                            </span>
                        </div>

                        <div style="height: 180px; overflow: hidden; background: #eee;">
                            @if($book->image)
                            <img src="{{ asset('storage/books/' . $book->image) }}" class="card-img-top w-100 h-100" style="object-fit: cover;" alt="{{ $book->title }}">
                            @else
                            <div class="d-flex align-items-center justify-content-center h-100 text-muted" style="font-size: 0.7rem;">No Image</div>
                            @endif
                        </div>

                        <div class="card-body p-2 text-center">
                            <h6 class="card-title fw-bold mb-0 text-truncate" style="font-size: 0.85rem;" title="{{ $book->title }}">{{ $book->title }}</h6>
                            <p class="text-muted mb-2" style="font-size: 0.7rem;">{{ $book->author }}</p>

                            <div class="d-flex flex-column gap-1">
                                @if($book->is_available)
                                <button type="button" class="btn btn-xs btn-primary py-1" style="font-size: 0.75rem;" data-bs-toggle="modal" data-bs-target="#borrowModal{{ $book->id }}">Pinjam</button>
                                @else
                                <button class="btn btn-xs btn-secondary py-1" style="font-size: 0.75rem;" disabled>Terpinjam</button>
                                @endif

                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-xs btn-outline-warning w-100 py-1" data-bs-toggle="modal" data-bs-target="#editBookModal{{ $book->id }}"><i class="bi bi-pencil" style="font-size: 0.7rem;"></i></button>
                                    <form action="{{ route('library.destroy', $book->id) }}" method="POST" class="w-100" onsubmit="return confirm('Hapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-outline-danger w-100 py-1"><i class="bi bi-trash" style="font-size: 0.7rem;"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editBookModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content text-start">
                            <form action="{{ route('library.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Buku</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Judul Buku</label>
                                        <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Penulis</label>
                                        <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select name="category" class="form-select" required>
                                            <option value="Trending" {{ $book->category == 'Trending' ? 'selected' : '' }}>Trending</option>
                                            <option value="Harry Potter" {{ $book->category == 'Harry Potter' ? 'selected' : '' }}>Harry Potter</option>
                                            <option value="Romance" {{ $book->category == 'Romance' ? 'selected' : '' }}>Romance</option>
                                            <option value="Cryptography" {{ $book->category == 'Cryptography' ? 'selected' : '' }}>Cryptography</option>
                                            <option value="Sci-Fi" {{ $book->category == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Ganti Gambar</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if($book->is_available)
                <div class="modal fade" id="borrowModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content text-start">
                            <form action="{{ route('library.borrow', $book->id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Pinjam: {{ $book->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label">Tanggal Kembali</label>
                                    <input type="date" name="due_date" class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}" max="{{ date('Y-m-d', strtotime('+1 month')) }}" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>


<!-- ini bagian tambah buku baru -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('library.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Buku Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="category" class="form-select" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="Trending">Trending</option>
                            <option value="Harry Potter">Harry Potter</option>
                            <option value="Romance">Romance</option>
                            <option value="Cryptography">Cryptography</option>
                            <option value="Sci-Fi">Sci-Fi</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Buku</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan Buku</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .transition-hover {
        transition: all 0.3s;
    }

    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .btn-xs {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
</style>
@endsection