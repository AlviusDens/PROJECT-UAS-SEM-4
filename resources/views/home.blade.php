@extends('layouts/new')

@section('content')
<section id="hero" class="hero section" style="padding-top: 130px; padding-bottom: 40px;">
  <div class="hero-bg">
    <img src="/quickstart/assets/img/hero-bg-light.webp" alt="Background">
  </div>
  <div class="container text-center">
    <div class="d-flex flex-column justify-content-center align-items-center">
      <h1 data-aos="fade-up">Selamat Datang Di <span>Perpustakaan Digital</span></h1>
      <p data-aos="fade-up" data-aos-delay="100" class="fst-italic text-muted mb-4">
        "Sastra adalah sebuah gambar, atau lebih tepatnya dalam arti tertentu, baik gambar maupun cermin." - Fyodor Dostoevsky
      </p>

      <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="150">
        <form action="{{ route('home') }}" method="GET" class="d-flex gap-2 bg-white p-2 shadow-sm" style="border-radius: 50px;">
          <input type="text" name="search" class="form-control border-0 px-4" placeholder="Cari judul buku atau nama penulis di sini..." value="{{ $keyword ?? '' }}" style="border-radius: 50px;">
          <button type="submit" class="btn btn-primary px-4 d-flex align-items-center gap-1" style="border-radius: 50px;">
            <i class="bi bi-search"></i> <span>Cari</span>
          </button>
        </form>
        @if(isset($keyword))
        <a href="{{ route('home') }}" class="btn btn-sm btn-link text-secondary mt-2 text-decoration-none"><i class="bi bi-arrow-left"></i> Kembali ke Beranda Utama</a>
        @endif
      </div>
    </div>
  </div>
</section>

<section id="home-katalog" class="section pt-0 mb-5">
  <div class="container">

    @if(count($newReleases) > 0)
    <div class="mb-5">
      <h5 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="bi bi-clock-history text-primary"></i> Koleksi Rilis Baru</h5>
      <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
        @foreach($newReleases as $book)
        <x-card-buku :book="$book" />
        @endforeach
      </div>
    </div>
    @endif

    <div>
      <h5 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="bi bi-grid-3x3-gap text-success"></i> {{ $titleHeader }}</h5>
      <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
        @forelse($topDownloads as $book)
        <x-card-buku :book="$book" />
        @empty
        <div class="col-12 py-3">
          <p class="text-muted small italic ps-2">Maaf, koleksi buku tidak ditemukan atau kata kunci tidak cocok.</p>
        </div>
        @endforelse
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
    font-size: 0.72rem;
    border-radius: 4px;
  }
</style>
@endsection