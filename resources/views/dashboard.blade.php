@extends('layouts/new')

@section('content')
<div class="container mt-5 pt-5 mb-5">
    <h2 class="fw-bold mb-4 text-dark">Dashboard</h2>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">

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
                                    <th>Status</th>
                                    <td>: <span class="badge bg-success">Aktif</span></td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>: {{ ucfirst($user->role) }}</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection