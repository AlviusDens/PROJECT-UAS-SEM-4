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
                            <div class="text-xs font-weight text-uppercase mb-1">
                                Total User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Profil Saya</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img class="img-profile rounded-circle mb-3" src="" style="width: 120px; height: 120px; object-fit: cover;" alt="Foto Profil">
                            <br>
                            <button class="btn btn-sm btn-outline">Ganti Foto</button>
                        </div>

                        <div class="col-md-9">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150px">Nama Lengkap</th>
                                    <td>: ALVIUS JONATHAN DENIS KURNIAWAN</td>
                                </tr>
                                <tr>
                                    <th>NIM</th>
                                    <td>: 24060013</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>: Aktif</td>
                                </tr>
                            </table>
                            <hr>
                            <div class="text-right d-flex justify-content-end">
                                <a href="#" class="btn btn-outline-secondary btn-sm">Edit Profil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection