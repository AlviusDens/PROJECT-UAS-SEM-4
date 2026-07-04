@extends('layouts/new')

@section('content')
<div class="container mt-5 pt-4 mb-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold text-dark mb-1"><i class="bi bi-envelope-paper text-primary"></i> {{ $title }}</h3>
        <p class="text-muted small">Hubungi staf operasional kami untuk bantuan teknis akun perpustakaan digital.</p>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-5 col-md-6">
            <div class="bg-white p-4 shadow-sm h-100" style="border-radius: 12px;">
                <h5 class="fw-bold text-dark border-bottom pb-2 mb-4">Informasi Operasional</h5>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <i class="bi bi-geo-alt-fill text-danger style-icon" style="font-size: 1.3rem;"></i>
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">Alamat Lembaga</h6>
                        <p class="text-muted small mb-0">Jl. Sumatra No.118-120, Tegal Boto Lor, Kelurahan Sumbersari, Kecamatan Sumbersari, Kabupaten Jember, Jawa Timur 68121</p>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <i class="bi bi-telephone-fill text-success style-icon" style="font-size: 1.3rem;"></i>
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">Layanan Telepon</h6>
                        <p class="text-muted small mb-0">(0331) 334324 / Staf Perpustakaan</p>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3">
                    <i class="bi bi-envelope-fill text-primary style-icon" style="font-size: 1.3rem;"></i>
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">Email Resmi</h6>
                        <p class="text-muted small mb-0">alvius.jdk3@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection