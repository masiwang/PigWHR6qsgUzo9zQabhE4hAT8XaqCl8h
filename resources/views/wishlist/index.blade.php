@extends('app')
@section('content')
    @include('components.navigation.topnav')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stock</th>
                        <th scope="col" width="15%"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($wishlists as $wishlist)
                            <tr>
                                <td>
                                    @if ($wishlist->image)
                                    <img src="/image/{{ $wishlist->image }}" alt="Avatar" style="height: 5rem">
                                    @else
                                    <img src="/image/market-default.png" alt="Avatar" style="height: 5rem">
                                    @endif
                                </td>
                                <td>{{ $wishlist->name }}</td>
                                <td>Rp.{{ number_format($wishlist->price,0,",",".") }}/{{ $wishlist->size }}</td>
                                <td>{{ $wishlist->stock }}</td>
                                <td>
                                    <button class="btn btn-success w-100 mb-2" style="position: relative">
                                        <span class="text-light" style="position: relative; bottom: 2px">@include('components.icon.cart_plus')</span> <span style="position: relative">Keranjang</span>
                                    </button>
                                    <button class="btn btn-outline-danger w-100">
                                        <span class="text-danger" style="position: relative; bottom: 2px">@include('components.icon.trash')</span> <span style="position: relative">Hapus</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
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
    @include('components.navigation.footer')
    @include('components.navigation.copyright')
@endsection