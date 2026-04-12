@extends('layouts/new')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="mb-4 text-center">Daftar Pengguna</h3>

            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Tambah Pengguna
            </button>

            <div class="table-responsive shadow-sm">
                <table class="table table-bordered">
                    <thead class="custom-thead">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->nim }}</td>
                            <td>{{ $user->jurusan }}</td>
                            <td>{{ $user->semester }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $user->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('pengguna.update', $user->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5>Edit Pengguna</h5>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" name="nama" value="{{ $user->nama }}" class="form-control mb-2" placeholder="Nama">
                                            <input type="email" name="email" value="{{ $user->email }}" class="form-control mb-2" placeholder="Email">
                                            <input type="text" name="nim" value="{{ $user->nim }}" class="form-control mb-2" placeholder="NIM">
                                            <input type="text" name="jurusan" value="{{ $user->jurusan }}" class="form-control mb-2" placeholder="Jurusan">
                                            <input type="number" name="semester" value="{{ $user->semester }}" class="form-control mb-2" placeholder="Semester">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('pengguna.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5>Tambah Pengguna Baru</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Lengkap" required>
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                    <input type="text" name="nim" class="form-control mb-2" placeholder="NIM" required>
                    <input type="text" name="jurusan" class="form-control mb-2" placeholder="Jurusan" required>
                    <input type="number" name="semester" class="form-control mb-2" placeholder="Semester" required>
                    <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection