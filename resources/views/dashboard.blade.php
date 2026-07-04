@extends('layouts/new')

@section('content')
<div class="container mt-5 pt-4 mb-5">
    <h2 class="fw-bold mb-4 text-dark">Dashboard</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-7 col-md-12 mb-4">
            <div class="card shadow border-0" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 border-bottom pb-2 text-primary"><i class="bi bi-person-badge"></i> Profil Saya</h5>
                    <table class="table table-borderless align-middle mb-3">
                        <tr>
                            <th width="160px" class="text-muted small text-uppercase">Nama Lengkap</th>
                            <td>: <span class="fw-bold text-dark">{{ $user->nama }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted small text-uppercase">NIM / Nomor Identitas</th>
                            <td>: {{ $user->nim }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted small text-uppercase">Peran Sistem (Role)</th>
                            <td>: <span class="badge bg-info text-dark text-capitalize">{{ $user->role }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted small text-uppercase">Jenis Kelamin</th>
                            <td>: {{ $user->jenis_kelamin ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted small text-uppercase">Tempat, Tgl Lahir</th>
                            <td>: {{ $user->tempat_lahir ?? '-' }}, {{ $user->tanggal_lahir ? date('d-m-Y', strtotime($user->tanggal_lahir)) : '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted small text-uppercase">Nomor Kontak (HP)</th>
                            <td>: {{ $user->telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted small text-uppercase">Alamat Tinggal</th>
                            <td>: {{ $user->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                    <div class="text-end">
                        <button class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="bi bi-pencil-square"></i> Perbarui Profil
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('dashboard.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Data Profil Perpustakaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">NIM (Tidak dapat diubah)</label>
                        <input type="text" class="form-control bg-light" value="{{ $user->nim }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ $user->tempat_lahir }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $user->tanggal_lahir }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nomor Telepon / HP</label>
                        <input type="text" name="telepon" class="form-control" value="{{ $user->telepon }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Alamat Rumah</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ $user->alamat }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection