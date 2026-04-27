@extends('layouts/new')

@section('content')
<div class="container mt-5 pt-5 mb-5">
    <h2 class="fw-bold mb-4 text-dark">Dashboard</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow h-100 py-2 border-0" style="border-radius: 12px;">
                <div class="card-body">
                    <h5 class="fw-bold mb-3 border-bottom pb-2">Profil Saya</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th width="150px">Nama Lengkap</th>
                            <td>: {{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td>: {{ $user->nim }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>: {{ $user->jurusan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Semester</th>
                            <td>: {{ $user->semester ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>: <span class="badge bg-success">Aktif</span></td>
                        </tr>
                    </table>
                    <div class="text-end">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="bi bi-pencil-square"></i> Edit Profil
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
                    <h5 class="modal-title">Edit Data Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" value="{{ $user->nim }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" value="{{ $user->jurusan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <input type="number" name="semester" class="form-control" value="{{ $user->semester }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection