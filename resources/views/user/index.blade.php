@extends('app')
@section('content')
    @include('components.navigation.topnav')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ma-bg">
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
                                <div class="col-6">
                                    <label for="firstName" class="form-label">Nama depan</label>
                                    <input type="text" class="form-control" id="firstName" value="{{ $user->name }}">
                                </div>
                                <div class="col-6">
                                    <label for="lastName" class="form-label">Nama belakang</label>
                                    <input type="text" class="form-control" id="lastName" value="{{ $user->last_name }}">
                                </div>
                            </div>
                            <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control" id="email" value="{{ $user->email }}">
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="phone" class="form-label">Nomor Ponsel</label>
                                    <input type="phone" class="form-control" id="phone" value="{{ $user->phone }}">
                                </div>
                                <div class="col-6">
                                    <label for="phone" class="form-label">Tanggal Lahir</label>
                                    <input id="datepicker" class="form-controll" placeholder="{{ $user->birthday }}"/>
                                    <script>
                                        $('#datepicker').datepicker({
                                            uiLibrary: 'bootstrap'
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="mb-3">
                                <p class="form-label">Jenis kelamin</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" @if ($user->gender == 1) {{ checked }} @endif type="radio" name="gender" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1"><i class="fas fa-mars text-primary"></i></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" @if ($user->gender == 2) {{ checked }} @endif id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2"><i class="fas fa-venus text-danger"></i></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-6">
                                    <label for="email" class="form-label">Kartu Tanda Penduduk</label>
                                    <input type="email" class="form-control" id="email" placeholder="Nomor KTP" value="{{ $user->ktp }}">
                                </div>
                                <div class="col-6">
                                    <label for="email" class="form-label text-white">&nbsp;</label><br>
                                    @if ($user->ktp_image)
                                        <img src="" alt="" srcset="">
                                    @else
                                        <button class="btn btn-success">Upload Scan KTP</button>
                                    @endif
                                </div>
                                <small class="text-info pt-1">*KTP diperlukan apabila Anda ingin berinvestasi di Makarya</small>
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
    @include('components.navigation.footer')
    @include('components.navigation.copyright')
@endsection