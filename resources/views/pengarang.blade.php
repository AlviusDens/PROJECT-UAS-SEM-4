@extends('layouts/new')

@section('content')
<div class="container mt-5 pt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-person-feather text-primary"></i> {{ $title }}</h3>
        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali ke Home</a>
    </div>

    <div class="mb-5">
        <x-section-header icon="bi-book" color="primary" title="Kategori Buku Teks Utama" />
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            @forelse($bookAuthors as $ba)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm p-3 d-flex flex-row align-items-center gap-3 transition-card">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle text-primary">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="overflow-hidden">
                        <h6 class="fw-bold text-dark mb-0 text-truncate small" title="{{ $ba->author }}">{{ $ba->author }}</h6>
                        <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-files text-secondary"></i> Kontribusi: {{ $ba->total_buku }} E-Book</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-muted small italic ps-2">Belum ada kontributor penulis buku.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="mb-5">
        <x-section-header icon="bi-file-earmark-text" color="success" title="Kategori Artikel Ilmiah" />
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            @forelse($artikelAuthors as $aa)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm p-3 d-flex flex-row align-items-center gap-3 transition-card">
                    <div class="bg-success bg-opacity-10 p-2 rounded-circle text-success">
                        <i class="bi bi-person-workspace" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="overflow-hidden">
                        <h6 class="fw-bold text-dark mb-0 text-truncate small" title="{{ $aa->author }}">{{ $aa->author }}</h6>
                        <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-file-pdf text-secondary"></i> Kontribusi: {{ $aa->total_materi }} Artikel</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-muted small italic ps-2">Belum ada kontributor penulis artikel.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="mb-5">
        <x-section-header icon="bi-journal-bookmark" color="danger" title="Kategori Jurnal & Majalah Ilmiah" />
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            @forelse($jurnalAuthors as $ja)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm p-3 d-flex flex-row align-items-center gap-3 transition-card">
                    <div class="bg-danger bg-opacity-10 p-2 rounded-circle text-danger">
                        <i class="bi bi-journal-text" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="overflow-hidden">
                        <h6 class="fw-bold text-dark mb-0 text-truncate small" title="{{ $ja->author }}">{{ $ja->author }}</h6>
                        <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-bookmark-star text-secondary"></i> Kontribusi: {{ $ja->total_materi }} Jurnal</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-muted small italic ps-2">Belum ada kontributor penulis jurnal.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="mb-4">
        <x-section-header icon="bi-journal-text" color="warning" title="Kategori Modul Pembelajaran" />
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            @forelse($modulAuthors as $ma)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm p-3 d-flex flex-row align-items-center gap-3 transition-card">
                    <div class="bg-warning bg-opacity-10 p-2 rounded-circle text-warning">
                        <i class="bi bi-file-earmark-code" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="overflow-hidden">
                        <h6 class="fw-bold text-dark mb-0 text-truncate small" title="{{ $ma->author }}">{{ $ma->author }}</h6>
                        <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-book-half text-secondary"></i> Kontribusi: {{ $ma->total_materi }} Modul</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-muted small italic ps-2">Belum ada kontributor penulis modul.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .transition-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 8px;
    }

    .transition-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08) !important;
    }
</style>
@endsection