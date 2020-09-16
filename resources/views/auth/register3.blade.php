@extends('app')
@section('content')
    @include('components.navigation.auth-topnav')
    <form action="{{ route('register-do') }}" method="POST" class="container mb-5">
        @csrf
        <div class="row mb-3">
            <div class="col-12">
                <h1 class="mt-3">Buat Akun Anda</h1>
                <p>Dengan melakukan registrasi, Anda telah setuju dengan <a href="#" class="text-decoration-none text-success">syarat dan ketentuan</a> kami. </p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="firstName" class="form-label">Nama Depan</label>
                        <input type="text" name="first-name" class="form-control" id="firstName">                              
                    </div>
                    <div class="col-6">
                        <label for="lastName" class="form-label">Nama Belakang</label>
                        <input type="text" name="last-name" class="form-control" id="lastName">
                    </div>
                </div>
                <div class="mt-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="mt-3">
                    <label for="phone" class="form-label">Nomor Ponsel</label>
                    <input type="phone" name="phone" class="form-control" id="phone">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3">
                    <label for="passwordConfirm" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password-confirm" class="form-control" id="passwordConfirm">
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin</label><br/>
                    <select class="form-select" name="gender" id="gender">
                        <option value="1" selected>Laki-laki</option>
                        <option value="2">Perempuan</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <span>Sudah punya akun? <a href="{{ route('login') }}" class="text-success text-decoration-none">Masuk</a></span>
                <button type="submit" class="btn btn-success mb-3">Registrasi</button>
            </div>
        </div>
    </form>
    @include('components.navigation.footer')
@endsection