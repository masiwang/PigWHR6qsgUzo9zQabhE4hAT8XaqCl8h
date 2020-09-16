@extends('app')
@section('content')
    @include('components.navigation.topnav')
    <div class="container">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="section slideshow">
                    <div class="row">
                        <div class="col-12">
                            <div style="height: 1rem"></div>
                        </div>
                    </div>
                </div>
                <div class="section category">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link {{(Request::is('market')) ? 'active' : ''}}" href="{{ url('/market') }}">Semua Produk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{(Request::is('market/sayur')) ? 'active' : ''}}" href="{{ url('/market/sayur') }}">Sayur</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{(Request::is('market/buah')) ? 'active' : ''}}" href="{{ url('/market/buah') }}">Buah</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{(Request::is('market/daging')) ? 'active' : ''}}" href="{{ url('/market/daging') }}">Daging</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{(Request::is('market/ikan')) ? 'active' : ''}}" href="{{ url('/market/ikan') }}">Ikan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{(Request::is('market/lain-lain')) ? 'active' : ''}}" href="{{ url('/market/lain-lain') }}">Lainnya</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="height:1rem"></div>
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-xl-2 col-md-3 col-sm-4 col-6 mb-3 d-flex align-items-stretch" >
                        <div class="card" style="">
                            @if ($product->image)
                            <img src="/image/{{ $product->image }}" alt="Avatar" class="card-img-top">
                            @else
                            <img src="/image/market-default.png" alt="Avatar" class="card-img-top">
                            @endif
                            <div class="card-body d-flex align-items-start flex-column">
                                <p class="card-title mb-auto" style="max-height: 44px; overflow: hidden; font-size: .9rem;">
                                    <a href="{{ url('market/'.$product->category.'/'.$product->slug) }}" class="text-decoration-none text-dark">
                                        {{ $product->name }}
                                    </a>
                                </p>
                                <p class="card-text"><b>Rp{{ number_format($product->price,0,",",".") }}/{{ $product->size }}</b></p>
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
                <div style="height: 30px"></div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-success">
                            Muat lebih banyak
                        </button>
                    </div>
                </div>
                <div style="height: 30px"></div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="">
                                <div class="row m-3">
                                    <div class="col-sm-6 text-center">
                                        <img src="{{asset('image/kacang-panjang-300x300.jpg')}}" alt="" srcset="">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <h4 class="col-12">Kacang Panjang</h4>
                                            <small class="col-12 text-info">PT. Majukarya Sentosa Gemilang Abadi</small>
                                            <div style="height: 20px;"></div>
                                            <div class="col-12">
                                                <h4 class="text-success">Rp. 12.000,-/kg</h4>
                                            </div>
                                            <div style="height: 20px;"></div>
                                            <div class="col-12">
                                                <p>Produk dari PT. Majukarya Sentosa Gemilang Abadi ini ditanam dengan metode hidroponik di atas gunung yang tinggi.</p>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-5">
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">Qty</span>
                                                        <input type="number" class="form-control" placeholder="0" aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="text-success"><span class="text-dark">Estimasi harga: </span>Rp. 12.000.000</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success">Tambahkan</button>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>
    @include('components.navigation.footer')
    @include('components.navigation.copyright')
@endsection