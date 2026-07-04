@extends('layouts/new')

@section('content')
<div class="container mt-5 pt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-clock-history text-primary"></i> {{ $title }} <small class="text-muted" style="font-size: 0.8rem;">(Maksimal 5 Konten Terbaru)</small></h3>
        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali ke Home</a>
    </div>

    <div class="mb-5">
        <x-section-header icon="bi-book" color="primary" title="Kategori Buku Teks Utama" />
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
            @forelse($books->where('type_display', 'Buku') as $book)
            <x-card-buku :book="$book" />
            @empty
            <div class="col-12">
                <p class="text-muted small italic ps-2">Belum ada buku dalam rilis terbaru.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="mb-5">
        <x-section-header icon="bi-file-earmark-text" color="success" title="Kategori Artikel Ilmiah" />
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
            @forelse($books->where('type_display', 'Artikel') as $book)
            <x-card-buku :book="$book" />
            @empty
            <div class="col-12">
                <p class="text-muted small italic ps-2">Belum ada artikel dalam rilis terbaru.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="mb-5">
        <x-section-header icon="bi-journal-bookmark" color="danger" title="Kategori Jurnal Ilmiah" />
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
            @forelse($books->where('type_display', 'Jurnal') as $book)
            <x-card-buku :book="$book" />
            @empty
            <div class="col-12">
                <p class="text-muted small italic ps-2">Belum ada jurnal dalam rilis terbaru.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="mb-5">
        <x-section-header icon="bi-journal-text" color="warning" title="Kategori Modul Pembelajaran" />
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
            @forelse($books->where('type_display', 'Modul') as $book)
            <x-card-buku :book="$book" />
            @empty
            <div class="col-12">
                <p class="text-muted small italic ps-2">Belum ada modul dalam rilis terbaru.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .transition-hover {
        transition: all 0.3s;
    }

    .transition-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
    }

    .btn-xs {
        padding: 0.25rem 0.5rem;
        font-size: 0.72rem;
        border-radius: 4px;
    }
</style>
@endsection