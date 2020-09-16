@extends('app')
@section('content')
    @include('components.navigation.topnav')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('market') }}" class="text-decoration-none">Market</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('market/'.$product->category_slug) }}" class="text-decoration-none">{{ $product->category_name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ url('market/'.$product->category_slug.'/'.$product->slug.'/cart') }}" method="POST">
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
                                            <input type="hidden" name="product" value="{{ $product->slug }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <input type="number" name="qty" class="form-control" placeholder="0" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h5 class="text-success"><span class="text-dark">Estimasi harga: </span>Rp. <span id="estimasi">0</span></h5>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        @if ($product->is_wishlist)
                                        <a href="#" class="btn btn-danger disabled" disabled style="position: relative">
                                            <span class="text-light" style="position: relative; bottom: 2px">@include('components.icon.heart_full')</span><span style="position: relative"> Disukai</span>
                                        </a>
                                        @else
                                        <a href="{{ url('market/'.$product->category_slug.'/'.$product->slug.'/wish') }}" class="btn btn-danger" style="position: relative">
                                            <span class="text-light" style="position: relative; bottom: 2px">@include('components.icon.heart')</span><span style="position: relative"> Wishlist</span>
                                        </a>
                                        @endif

                                        @if($email_is_verified->email_verified_at)
                                        <button class="btn btn-success" style="position: relative">
                                            <span class="text-light" style="position: relative; bottom: 2px">@include('components.icon.cart_plus')</span> <span style="position: relative">Keranjang</span>
                                        </button>
                                        @else
                                        <a class="btn btn-success disabled" disabled style="position: relative">
                                            <span class="text-light" style="position: relative; bottom: 2px">@include('components.icon.cart_plus')</span> <span style="position: relative">Keranjang</span>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        @if(!($email_is_verified->email_verified_at))
                                        <div class="alert alert-danger" role="alert">
                                        Mohon maaf, verifikasi email Anda terlebih dahulu sebelum melakukan pembelian.
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
        <div class="row">
            <div class="col-12" style="min-height: 400px">
                <hr>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Deskripsi</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Review</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Kontak</a>
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
                        Review
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        Kontak penjual
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <hr>
                <h3 class="mb-3">Rekomendasi</h3>
                <div class="row">
                    @foreach ($recommends as $recommend)
                        <div class="col-xl-2 col-md-3 col-sm-4 col-6 mb-3 d-flex align-items-stretch" >
                            <div class="card" style="">
                                @if ($recommend->image)
                                <img src="/image/{{ $recommend->image }}" alt="Avatar" class="card-img-top">
                                @else
                                <img src="/image/market-default.png" alt="Avatar" class="card-img-top">
                                @endif
                                <div class="card-body d-flex align-items-start flex-column">
                                    <p class="card-title mb-auto" style="max-height: 44px; overflow: hidden; font-size: .9rem;">
                                        <a href="{{ url('market/'.$recommend->category.'/'.$recommend->slug) }}" class="text-decoration-none text-dark">
                                            {{ $recommend->name }}
                                        </a>
                                    </p>
                                    <p class="card-text"><b>Rp{{ number_format($recommend->price,0,",",".") }}/{{ $recommend->size }}</b></p>
                                    <div class="d-flex flex-row" style="font-size: .8rem; width: 100%">
                                        <div class="col-6">
                                            <p class="mb-0" style="position: relative">
                                                <span class="text-danger" style="position: relative; bottom: 2px">@include('components.icon.heart')</span>
                                                <span style="position: relative">100</span>
                                            </p>
                                        </div>
                                        <div class="col-6 text-right">
                                            <p class="mb-0" style="position: relative">
                                                <span class="text-success" style="position: relative; bottom: 2px;">@include('components.icon.bag')</span>
                                                <span style="position: relative;"> 200</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @endforeach
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
        var qty = $('input[name=qty]');
        var est = $('#estimasi');
        qty.on('keyup', function(){
            est.text(addCommas(price.val() * qty.val()));
        });
    </script>
    @include('components.navigation.footer')
    @include('components.navigation.copyright')
@endsection