@extends('layouts/new')

@section('content')
<div class="container mt-5 pt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="mb-4 text-dark fw-bold text-center"><i class="bi bi-shield-lock"></i> {{ $pageTitle }}</h3>

            @if(session('success'))
            <div class="alert alert-success py-2 small alert-dismissible fade show" role="alert">
                {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <button class="btn btn-sm btn-success shadow-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Tambah Data Baru
            </button>

            <div class="table-responsive shadow-sm bg-white p-3" style="border-radius: 8px;">
                <table class="table table-hover align-middle border">
                    <thead class="table-light text-secondary text-uppercase small" style="font-size: 0.75rem;">
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>NIM / No.Identitas</th>
                            <th>Hak Akses (Role)</th>
                            <th>Kontak HP</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.85rem;">
                        @forelse($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td class="fw-bold text-dark">{{ $u->nama }}</td>
                            <td>{{ $u->email }}</td>
                            <td><code class="text-dark">{{ $u->nim }}</code></td>
                            <td>
                                <span class="badge {{ $u->role == 'admin' ? 'bg-danger' : ($u->role == 'petugas' ? 'bg-warning text-dark' : 'bg-info text-dark') }} text-capitalize">
                                    {{ $u->role }}
                                </span>
                            </td>
                            <td>{{ $u->telepon ?? '-' }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-warning py-1 px-2" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $u->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('pengguna.destroy', $u->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger py-1 px-2" onclick="return confirm('Hapus pengguna ini dari sistem?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-start">
                                    <form action="{{ route('pengguna.update', $u->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Ubah Informasi Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label small fw-bold">Nama Lengkap</label>
                                                <input type="text" name="nama" class="form-control form-control-sm" value="{{ $u->nama }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-bold">Hak Akses Sistem (Locked)</label>
                                                <input type="text" class="form-control form-control-sm bg-light text-capitalize" value="{{ $u->role }}" readonly>
                                                <input type="hidden" name="role" value="{{ $u->role }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-bold">Nomor Telepon</label>
                                                <input type="text" name="telepon" class="form-control form-control-sm" value="{{ $u->telepon }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted small py-3">Belum ada data pengguna dalam klasifikasi kategori ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('pengguna.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Form Registrasi Akun Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-start">
                    <input type="hidden" name="role" value="{{ $targetRole }}">

                    <div class="mb-2">
                        <label class="form-label small fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control form-control-sm" placeholder="Nama Lengkap Pengguna" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Email</label>
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="alamat@email.com" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">NIM / Nomor Identitas</label>
                        <input type="text" name="nim" class="form-control form-control-sm" placeholder="Nomor Induk Registrasi" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Password Default</label>
                        <input type="password" name="password" class="form-control form-control-sm" placeholder="Sandi Keamanan" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select form-select-sm">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Nomor HP</label>
                        <input type="text" name="telepon" class="form-control form-control-sm" placeholder="08xxxxxxxx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">Daftarkan Akun {{ ucfirst($targetRole) }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection