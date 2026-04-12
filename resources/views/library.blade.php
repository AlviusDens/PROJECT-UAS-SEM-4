@extends('layouts/new')

@section('content')
<div>
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
    <section id="library-hero" class="hero section" style="padding-top: 60px; padding-bottom: 20px; background: #f9f9f9;">
        <div class="container text-center">
            <h2 data-aos="fade-up" class="mb-2">Manajemen Perpustakaan</h2>
            <p data-aos="fade-up" data-aos-delay="100" class="mb-0">Temukan dan pinjam buku favoritmu dengan mudah.</p>
        </div>
    </section>

    <section id="book-gallery" class="section">
        <div class="container">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                    <h3 class="fw-bold text-primary">Trending Books</h3>
                    <a href="#" class="text-decoration-none">View All</a>
                </div>
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4">
                    @foreach($books as $book)
                    <div class="col" data-aos="fade-up">
                        <div class="card h-100 border-0 shadow-sm transition-hover" style="border-radius: 10px; overflow: hidden;">
                            <div class="position-absolute top-0 end-0 p-2">
                                @if($book->is_available)
                                <span class="badge bg-success">Tersedia</span>
                                @else
                                <span class="badge bg-danger">Terpinjam</span>
                                @endif
                            </div>

                            <div style="height: 250px; overflow: hidden; background: #eee;">
                                @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top w-100 h-100" style="object-fit: cover;" alt="{{ $book->title }}">
                                @else
                                <div class="d-flex align-items-center justify-content-center h-100 text-muted">No Image</div>
                                @endif
                            </div>

                            <div class="card-body p-3 text-center">
                                <h6 class="card-title fw-bold mb-1 text-truncate" title="{{ $book->title }}">{{ $book->title }}</h6>
                                <p class="small text-muted mb-3">{{ $book->author }}</p>

                                @if($book->is_available)
                                <button type="button" class="btn btn-sm btn-primary w-100" data-bs-toggle="modal" data-bs-target="#borrowModal{{ $book->id }}">
                                    Pinjam
                                </button>
                                @else
                                <button class="btn btn-sm btn-secondary w-100" disabled>Terpinjam</button>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($book->is_available)
                    <div class="modal fade" id="borrowModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('library.borrow', $book->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Pinjam Buku: {{ $book->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="alert alert-info small">
                                            Maksimal peminjaman adalah 1 bulan dari hari ini.
                                        </div>
                                        <div class="mb-3">
                                            <label for="due_date" class="form-label">Pilih Tanggal Pengembalian</label>
                                            <input type="date" name="due_date" class="form-control"
                                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                max="{{ date('Y-m-d', strtotime('+1 month')) }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Konfirmasi Pinjam</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <style>
        #library-hero {
            min-height: auto !important;
            /* Mencegah tinggi minimal yang terlalu besar */
        }

        #library-hero h2 {
            margin-top: 0;
            /* Menghapus jarak tambahan di atas judul */
        }

        .transition-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .transition-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
        }

        .card-title {
            font-size: 0.95rem;
            color: #333;
        }

        .hero h2 {
            font-weight: 700;
            color: #222;
        }
    </style>
</div>
@endsection