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
                                    <a class="nav-link {{ Request::is('fund') ? 'active' : ''}}" href="{{ url('/fund') }}">Semua Produk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('fund/pertanian') ? 'active' : ''}}" href="{{ url('/fund/pertanian') }}">Pertanian</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('fund/peternakan') ? 'active' : ''}}" href="{{ url('/fund/peternakan') }}">Peternakan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('fund/perikanan') ? 'active' : ''}}" href="{{ url('/fund/perikanan') }}">Perikanan</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="height:1rem"></div>
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-xl-3 col-md-3 col-sm-6 col-6 mb-3 d-flex align-items-stretch" >
                        <div class="card" style="">
                            @if ($product->image)
                            <img src="/image/{{ $product->image }}" alt="Avatar" class="card-img-top">
                            @else
                            <img src="/image/market-default.png" alt="Avatar" class="card-img-top">
                            @endif
                            <div class="card-body d-flex align-items-start flex-column">
                                <p class="card-title mb-auto" style="max-height: 44px; overflow: hidden; font-size: .9rem;">
                                    <a href="{{ url('fund/'.$product->category.'/'.$product->slug) }}" class="text-decoration-none text-dark">
                                        {{ $product->name }}
                                    </a>
                                </p>
                                <p class="card-text mb-1 text-success"><b>Rp{{ number_format($product->price,0,",",".") }}/{{ $product->size }}</b></p>
                                <div class="d-flex flex-row w-100" style="font-size: .8rem">
                                    <div class="col-8">
                                        <b>Periode Kontrak</b>
                                    </div>
                                    <div class="col-4">
                                        {{ $product->periode }} Tahun
                                    </div>
                                </div>
                                <div class="d-flex flex-row w-100" style="font-size: .8rem">
                                    <div class="col-8">
                                        <b>Stock</b>
                                    </div>
                                    <div class="col-4">
                                        {{ $product->stock }} {{ $product->size }}
                                    </div>
                                </div>
                                <div class="d-flex flex-row w-100" style="font-size: .8rem">
                                    <div class="col-8">
                                        <b>Batas waktu</b>
                                    </div>
                                    <div class="col-4">
                                        {{ date('d M Y', strtotime($product->expired_at)) }}
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