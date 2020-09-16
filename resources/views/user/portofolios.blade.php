@extends('app')
@section('content')
    @include('components.navigation.topnav')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Akun</li>
                    </ol>
                </nav>
            </div>
            <hr>
        </div>
        <div class="row mb-5">
            <div class="col-3">
                @include('user/_sidenav')
            </div>
            <div class="col-9">
                <div class="row shadow-sm py-3 ml-xl-2 bg-white">
                    <div class="col-12 py-3">
                        <form class="mx-3">
                            <div class="row mb-3">
                                <div class="form-check border-bottom mb-2">
                                    <table class="table table-borderless mb-0">
                                        <td width="1rem">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        </td>
                                        <td>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                <h6>Rumah Maul</h6>
                                                <p class="mb-0">Jl. Makarya No.56, Dukuh</p>
                                                <p class="mb-0">Kec. Sragen, Kab. Sragen</p>
                                                <p class="mb-0">Jawa Tengah - 57261</p>
                                            </label>
                                        </td>
                                        <td width="4rem">
                                            <a class="text-decoration-none text-warning">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <a class="btn btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAddress">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="addressName" class="form-label">Nama Alamat</label>
                    <input type="text" class="form-control" id="addressName">
                </div>
                <div class="mb-3">
                    <label for="addressName" class="form-label">Jalan</label>
                    <input type="text" class="form-control" id="addressName">
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="addressName" class="form-label">Provinsi</label>
                        <input type="text" class="form-control" id="addressName">
                    </div>
                    <div class="col-6">
                        <label for="addressName" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="addressName">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-8">
                        <label for="addressName" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" id="addressName">
                    </div>
                    <div class="col-4">
                        <label for="addressName" class="form-label">Kode POS</label>
                        <input type="text" class="form-control" id="addressName">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        </div>
    </div>
    @include('components.navigation.footer')
    @include('components.navigation.copyright')
@endsection