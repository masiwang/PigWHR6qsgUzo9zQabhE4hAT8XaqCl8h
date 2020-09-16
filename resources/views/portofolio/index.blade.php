@extends('app')
@section('content')
    @include('components.navigation.topnav')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Portofolio</li>
                    </ol>
                </nav>
            </div>
            <hr>
        </div>
        <div class="row mb-5">
            <div class="col-sm-12" style="min-height: 400px">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col" width="20%">Kode Portofolio</th>
                        <th scope="col" width="20%">Kode Pembayaran</th>
                        <th scope="col" >Status</th>
                        <th scope="col" >Imbal Hasil</th>
                        <th scope="col" >Nilai Portofolio</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if ($checkouts)
                            {{ $n = 0 }}
                            @foreach ($checkouts as $checkout)
                                <tr>
                                    <td>{{ $checkout->portofolio_code }}</td>
                                    <td>{{ $checkout->invoice_code }}</td>
                                    <td>
                                        <p class="mb-1">{{ $checkout->status }}</p>
                                        @if ($checkout->status_id == 1)
                                        <a href="{{ url('payment/'.$checkout->invoice_code.'/fund') }}" class="text-decoration-none">Bayar sekarang</a><br>
                                        <small class="text-danger">*)tenggat pembayaran 24 jam setelah anda checkout</small>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $checkout->monthly_return }}% x @if ($running_portofolios[$n] < 0)
                                            {{ 0 }}
                                        @else
                                            {{ $running_portofolios[$n] }}
                                        @endif

                                        bulan
                                    </td>
                                    <td>
                                        {{-- $checkout->fund_nominal * (((1+ $checkout->monthly_return)^(( $running_portofolios[$n] < 0) ? 2 : $running_portofolios[$n]))-1) --}}
                                        {{ $checkout->fund_nominal*(((1+$checkout->monthly_return)^2)-1) }}
                                    </td>
                                </tr>
                                {{ $n++ }}
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">- Portofolio Anda kosong :( -</td>
                            </tr>
                        @endif
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    @include('components.navigation.footer')
    @include('components.navigation.copyright')
@endsection