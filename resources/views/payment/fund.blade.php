@extends('app')
@section('content')
    @include('components.navigation.topnav')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment</li>
                    </ol>
                </nav>
            </div>
            <hr>
        </div>
        <div class="row mb-5">
            <div class="col-sm-12" style="min-height: 400px">
                <form action="{{ url('payment/'.$invoice_code.'/fund') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="invoiceCode" class="col-sm-2 col-form-label">Invoice</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="invoiceCode" value="{{ $invoice_code }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="bank" class="col-sm-2 col-form-label">Nama Bank</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="bankType" list="bankList" id="bank" placeholder="Ketik untuk mencari...">
                            <datalist id="bankList">
                                @foreach ($banks as $bank)
                                <option value="{{$bank->name}}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="bankAcc" class="col-sm-2 col-form-label">Nomor Rekening</label>
                        <div class="col-sm-10">
                            <input type="text" name="bankAcc" class="form-control" id="bankAcc" value="">
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="trfImg" class="col-sm-2 col-form-label">Bukti Transfer</label>
                        <div class="col-sm-10">
                            <div class="form-file">
                                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="">
                            </div>
                        </div>
                    </div>
                    <p class="text-danger">NB: Kesalahan input data konfirmasi pembayaran dapat menyebabkan waktu konfirmasi pembayaran lebih dari 7x24 jam.</p>
                    <hr>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button class="btn btn-success">Konfirmasi pembayaran</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('components.navigation.footer')
    @include('components.navigation.copyright')
@endsection