@extends('layouts/new')

@section('content')
<div class="container mt-5 pt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-people-fill text-success"></i> {{ $pageTitle }}</h3>
        <button type="button" class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahMember">
            <i class="bi bi-person-plus-fill"></i> Tambah Member Baru
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss=\"alert\" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60px" class="text-center">No</th>
                        <th>NIM / No. Identitas</th>
                        <th>Nama Lengkap</th>
                        <th>Email Address</th>
                        <th>No. Telepon</th>
                        <th>Gender</th>
                        <th width="180px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $u)
                    <tr>
                        <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                        <td><span class="badge bg-secondary px-2 py-1">{{ $u->nim }}</span></td>
                        <td class="fw-bold text-dark">{{ $u->nama }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->telepon ?? '-' }}</td>
                        <td>{{ $u->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <button class="btn btn-xs btn-warning px-2" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $u->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <form action="{{ route('pengguna.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus member ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger px-2">
                                        <i class="bi bi-trash-fill"></i> Haps
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEdit{{ $u->id }}" data-bs-backdrop="static" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="fw-bold text-dark mb-0">Ubah Data Keanggotaan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('pengguna.update', $u->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="role" value="member">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Nama Lengkap Siswa</label>
                                            <input type="text" name="nama" class="form-control form-control-sm" value="{{ $u->nama }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-select form-select-sm" required>
                                                <option value="L" {{ $u->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ $u->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Nomor Telepon / HP</label>
                                            <input type="text" name="telepon" class="form-control form-control-sm" value="{{ $u->telepon }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Alamat Lengkap Rumah</label>
                                            <textarea name="alamat" class="form-control form-control-sm" rows="3">{{ $u->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-xs btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-xs btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted small italic">Belum ada siswa yang terdaftar sebagai member perpustakaan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahMember" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-bold text-dark mb-0">Registrasi Member Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('pengguna.store') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="member">
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nomor Induk Mahasiswa / Siswa (NIM)</label>
                        <input type="text" name="nim" class="form-control form-control-sm" placeholder="Masukkan Nomor Induk" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap Siswa</label>
                        <input type="text" name="nama" class="form-control form-control-sm" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Email Aktif</label>
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="contoh@domain.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password Akun</label>
                        <input type="password" name="password" class="form-control form-control-sm" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select form-select-sm" required>
                            <option value="" disabled selected>-- Pilih Gender --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nomor Telepon / HP</label>
                        <input type="text" name="telepon" class="form-control form-control-sm" placeholder="08xxxxxxx">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Alamat Rumah</label>
                        <textarea name="alamat" class="form-control form-control-sm" rows="3" placeholder="Alamat lengkap domisili saat ini"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-xs btn-primary">Daftarkan Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .btn-xs {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        border-radius: 4px;
    }
</style>
@endsection