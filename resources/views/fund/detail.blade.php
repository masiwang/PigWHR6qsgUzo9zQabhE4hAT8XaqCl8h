@extends('app')
@section('content')
    @include('components.navigation.topnav')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('fund') }}" class="text-decoration-none">Pendanaan</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('fund/'.$product->category_slug) }}" class="text-decoration-none">{{ $product->category_name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ url('fund/'.$product->category_slug.'/'.$product->slug.'/checkout') }}" method="POST">
                    @csrf
                    <div class="row m-3">
                        <div class="col-sm-5 text-center">
                            <img src="/image/kacang-panjang-300x300.jpg" alt="" srcset="">
                        </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <h4 class="col-12">{{ $product->name }}</h4>
                                <small class="col-12 text-info mb-4">PT. Majukarya Sentosa Gemilang Abadi</small>
                                <div class="col-12 mb-4">
                                    <h4 class="text-success" style="font-weight: 600">Rp. {{ number_format($product->price,0,",",".") }}/{{ $product->size }}</h4>
                                </div>
                                <div class="col-12">
                                    <p>Tersedia : {{ $product->stock }}</p>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-5">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Qty</span>
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <select name="lots" class="form-select" aria-describedby="basic-addon1">
                                                <option value="1" selected>1</option>
                                                @for ($i = 2; $i < $product->max_lot+1; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                              </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h5 class="text-success"><span class="text-dark">Estimasi harga: </span>Rp. <span id="estimasi">0</span></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        @if($is_verified->email_verified_at)
                                            @if($is_verified->ktp_verified_at)
                                            <button class="btn btn-success w-100" style="position: relative">
                                                <span class="text-light" style="position: relative; bottom: 2px">@include('components.icon.dollar')</span> <span style="position: relative">Danai</span>
                                            </button>
                                            @endif
                                        @else
                                        <div class="alert alert-danger" role="alert">
                                            Untuk melakukan pendanaan, harap konfirmasi alamat email dan Kartu Tanda Penduduk Anda.
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12" style="min-height: 400px">
                <hr>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Deskripsi</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Simulasi</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <div class="row mt-3">
                            <div class="col-12">
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        Simulasi
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }
        var price = $('input[name=price]');
        var qty = $('select[name=lots]');
        var est = $('#estimasi');
        qty.on('change', function(){
            est.text(addCommas(price.val() * qty.val()));
        });
    </script>
    @include('components.navigation.footer')
    @include('components.navigation.copyright')
@endsection