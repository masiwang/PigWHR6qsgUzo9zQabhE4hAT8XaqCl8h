@extends('app')
@section('content')
    <div class="auth-container shadow bg-white" style="height: 35rem; width: 70rem; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; border-radius: 5px">
        <div class="row">
            <div class="col-12">
                <img src="/image/makarya-dark-160x48.png" style="height: 48px" alt="" srcset="">
            </div>
        </div>
        <div class="row">
            <div class="col-7 text-center" style="border-right: #ddd 1px solid; height: 28rem;">
                <img src="/image/makarya-farmer.png" style="height: 100%;" alt="" srcset="">
            </div>
            <div class="col-5">
                <h1>Selamat Datang</h1>
                <p>Untuk menggunakan layanan kami, harap autentikasi dengan email dan password Anda.</p>
                <div class="row mt-3">
                    <form action="{{ route('login-do') }}" method="POST">
                        @csrf
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="emailIcon">
                                @include('components.icon.mail')
                            </span>
                            <input type="text" name="email" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="emailIcon">
                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="passwordIcon">
                                @include('components.icon.key')
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="passwordIcon">
                        </div>
                        <div class="input-group mt-4 row">
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-success" type="submit" id="submitForm">Masuk</button>
                                <a href="{{ route('forgot') }}" class="btn btn-link text-decoration-none text-success">Lupa kata sandi?</a>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3">
                        <div class="col-12">
                           Belum memiliki akun? <a href="{{ route('register') }}" class="btn btn-link btn-sm text-decoration-none text-success">Registrasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection