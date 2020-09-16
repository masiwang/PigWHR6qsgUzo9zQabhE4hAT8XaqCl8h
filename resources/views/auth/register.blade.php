@extends('app')
@section('content')
    @if (Session::has('success'))
    @include('components.navigation.auth-topnav')
    <div class="container mb-5">
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    </div>
    @include('components.navigation.footer')
    @else
    <div class="auth-container shadow bg-white" style="height: 35rem; width: 70rem; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; border-radius: 5px">
        <div class="row">
            <div class="col-12">
                <img src="/image/makarya-dark-160x48.png" style="height: 48px" alt="" srcset="">
            </div>
        </div>
        <div class="row">
            <div class="col-7 text-center" style="border-right: #ddd 1px solid; height: 28rem;">
                <img src="/image/undraw_stepping_up_g6oo.png" style="height: 100%;" alt="" srcset="">
            </div>
            <div class="col-5">
                <h1>Buat Akun</h1>
                <p>Dengan melakukan registrasi Akun, Anda setuju dengan <a href="" class="text-decoration-none text-success">syarat dan ketentuan kami.</a>.</p>
                <div class="row mt-3">
                    <form action="{{ route('register-do') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="firstName" class="form-label">Nama Depan</label>
                                <input type="text" name="firstName" class="form-control" id="firstName">                              
                            </div>
                            <div class="col-6">
                                <label for="lastName" class="form-label">Nama Belakang</label>
                                <input type="text" name="lastName" class="form-control" id="lastName">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" id="email">
                        </div>
                        <div class="mt-3">
                            <label for="lastName" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" placeholder="password" aria-describedby="buttonEye">
                                <span class="border d-flex align-items-center px-2" type="button" id="buttonEye"><i class="fa fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="input-group mt-4 row">
                            <div class="col-12 text-right">
                                <button class="btn btn-success" type="submit" id="submitForm">Registrasi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var eye = $('#buttonEye');
        var pw = $('input[name="password"]');
        eye.on('click', function(){
            var state = pw.attr('type');
            if (state === 'password'){
                pw.attr('type', 'text');
                eye.html('<i class="fa fa-eye-slash"></i>')
            }else{
                pw.attr('type', 'password');
                eye.html('<i class="fa fa-eye"></i>')
            }
        });
    </script>
    
    @endif
    @if (count($errors) > 0)
   <div class = "alert alert-danger">
      <ul>
         @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
@endif
@endsection