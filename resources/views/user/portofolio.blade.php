@extends('app')
@section('content')
    @include('components.navigation.topnav')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Akun</li>
                    </ol>
                </nav>
            </div>
            <hr>
        </div>
        <div class="row mb-5">
            <div class="col-3 mt-3">
                @include('user/_sidenav')
            </div>
            <div class="col-9">
                <div class="row py-3 ml-xl-2 bg-bg">
                    <div class="col-12">
                        <!-- TODO: search & select, di server databasenya belum di update -->
                        <div class="mb-3 d-flex bd-highlight">
                            <div class="flex-grow-1">
                                <input type="text" list="portofolioOptions" class="form-control" id="portofolioSearch" placeholder="Cari pendanaan">
                                <datalist id="portofolioOptions">
                                </datalist>
                            </div>
                            <div class="ml-1">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" data-display="static"  aria-expanded="false">
                                        <i class="fas fa-filter"></i> 
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                      <li><a class="dropdown-item" href="#"><i class="fas fa-clock"></i> Menunggu pembayaran</a></li>
                                      <li><a class="dropdown-item" href="#"><i class="fas fa-chart-line"></i> Dalam pendanaan</a></li>
                                      <li><a class="dropdown-item" href="#"><i class="fas fa-coins"></i> Pendanaan selesai</a></li>
                                      <li><a class="dropdown-item" href="#"><i class="fas fa-exclamation-triangle"></i> Pendanaan gagal</a></li>
                                    </ul>
                                  </div>
                            </div>
                        </div>
                        @foreach ($portofolios as $portofolio)
                            @if ($portofolio->fund_checkout_status_id == 1)
                            <div class="card w-100 mb-3 shadow-sm" style="border: 0px">
                                <div class="card-body border-none">
                                    <div class="row d-flex align-items-stretch">
                                        <div class="col-1">
                                            <div class="circular-img mb-3" 
                                                style="position: relative;
                                                    margin: 0 auto;
                                                    width: 40px;
                                                    height: 40px;
                                                    overflow: hidden;
                                                    border-radius: 50%;">
                                                <img src="https://images.unsplash.com/photo-1503235930437-8c6293ba41f5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" srcset=""
                                                    style="width: 100%;
                                                        height: 100%;
                                                        object-fit: cover;">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mb-0">{{ $portofolio->name }}</h6>
                                            <p class="mb-0" style="font-size: .8rem">{{ $portofolio->vendor_name }}</p>
                                        </div>
                                        <div class="col-3 text-right d-flex align-items-center">
                                            <div class="w-100 text-right">
                                                <small style="font-size: 0.8rem" class="badge bg-warning text-dark">Menunggu pembayaran</small>
                                                <h5 class="ml-auto">Rp.{{ number_format((int)$portofolio->price*(int)$portofolio->lots, 0, ',', '.') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <span style="font-size: .8rem">Return</span><br>
                                            <p class="mb-0">{{ $portofolio->return }}%/{{ $portofolio->return_type }}</p>
                                        </div>
                                        <div class="col-4 text-center">
                                            <span style="font-size: .8rem">Tgl. Mulai</span><br>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($portofolio->started_at)->format('j F Y') }}</p>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span style="font-size: .8rem">Tgl. Selesai</span><br>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($portofolio->ended_at)->format('j F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($portofolio->fund_checkout_status_id == 2)
                            <div class="card w-100 mb-3">
                                <div class="card-body">
                                    <div class="row d-flex align-items-stretch">
                                        <div class="col-1">
                                            <div class="circular-img mb-3" 
                                                style="position: relative;
                                                    margin: 0 auto;
                                                    width: 40px;
                                                    height: 40px;
                                                    overflow: hidden;
                                                    border-radius: 50%;">
                                                <img src="https://images.unsplash.com/photo-1503235930437-8c6293ba41f5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" srcset=""
                                                    style="width: 100%;
                                                        height: 100%;
                                                        object-fit: cover;">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mb-0">{{ $portofolio->name }}</h6>
                                            <p class="mb-0" style="font-size: .8rem">{{ $portofolio->vendor_name }}</p>
                                        </div>
                                        <div class="col-3 text-right d-flex align-items-center">
                                            <div class="w-100 text-right">
                                                <small style="font-size: 0.8rem" class="badge bg-success">Dalam pendanaan</small>
                                                <h5 class="ml-auto">Rp.{{ number_format((int)$portofolio->price*(int)$portofolio->lots, 0, ',', '.') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <span style="font-size: .8rem">Return</span><br>
                                            <p class="mb-0">{{ $portofolio->return }}%/{{ $portofolio->return_type }}</p>
                                        </div>
                                        <div class="col-4 text-center">
                                            <span style="font-size: .8rem">Tgl. Mulai</span><br>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($portofolio->started_at)->format('j F Y') }}</p>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span style="font-size: .8rem">Tgl. Selesai</span><br>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($portofolio->ended_at)->format('j F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($portofolio->fund_checkout_status_id == 3)
                            <div class="card w-100 mb-3">
                                <div class="card-body">
                                    <div class="row d-flex align-items-stretch">
                                        <div class="col-1">
                                            <div class="circular-img mb-3" 
                                                style="position: relative;
                                                    margin: 0 auto;
                                                    width: 40px;
                                                    height: 40px;
                                                    overflow: hidden;
                                                    border-radius: 50%;">
                                                <img src="https://images.unsplash.com/photo-1503235930437-8c6293ba41f5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" srcset=""
                                                    style="width: 100%;
                                                        height: 100%;
                                                        object-fit: cover;">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mb-0">{{ $portofolio->name }}</h6>
                                            <p class="mb-0" style="font-size: .8rem">{{ $portofolio->vendor_name }}</p>
                                        </div>
                                        <div class="col-3 text-right d-flex align-items-center">
                                            <div class="w-100 text-right">
                                                <small style="font-size: 0.8rem" class="badge bg-primary">Pendanaan selesai</small>
                                                <h5 class="ml-auto">Rp.{{ number_format((int)$portofolio->price*(int)$portofolio->lots, 0, ',', '.') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <span style="font-size: .8rem">Return</span><br>
                                            <p class="mb-0">{{ $portofolio->return }}%/{{ $portofolio->return_type }}</p>
                                        </div>
                                        <div class="col-4 text-center">
                                            <span style="font-size: .8rem">Tgl. Mulai</span><br>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($portofolio->started_at)->format('j F Y') }}</p>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span style="font-size: .8rem">Tgl. Selesai</span><br>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($portofolio->ended_at)->format('j F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($portofolio->fund_checkout_status_id == 4)
                            <div class="card w-100 mb-3">
                                <div class="card-body">
                                    <div class="row d-flex align-items-stretch">
                                        <div class="col-1">
                                            <div class="circular-img mb-3" 
                                                style="position: relative;
                                                    margin: 0 auto;
                                                    width: 40px;
                                                    height: 40px;
                                                    overflow: hidden;
                                                    border-radius: 50%;">
                                                <img src="https://images.unsplash.com/photo-1503235930437-8c6293ba41f5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" srcset=""
                                                    style="width: 100%;
                                                        height: 100%;
                                                        object-fit: cover;">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mb-0">{{ $portofolio->name }}</h6>
                                            <p class="mb-0" style="font-size: .8rem">{{ $portofolio->vendor_name }}</p>
                                        </div>
                                        <div class="col-3 text-right d-flex align-items-center">
                                            <div class="w-100 text-right">
                                                <small style="font-size: 0.8rem" class="badge bg-danger">Pendanaan gagal</small>
                                                <h5 class="ml-auto">Rp.{{ number_format((int)$portofolio->price*(int)$portofolio->lots, 0, ',', '.') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <span style="font-size: .8rem">Return</span><br>
                                            <p class="mb-0">{{ $portofolio->return }}%/{{ $portofolio->return_type }}</p>
                                        </div>
                                        <div class="col-4 text-center">
                                            <span style="font-size: .8rem">Tgl. Mulai</span><br>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($portofolio->started_at)->format('j F Y') }}</p>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span style="font-size: .8rem">Tgl. Selesai</span><br>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($portofolio->ended_at)->format('j F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.navigation.footer')
    @include('components.navigation.copyright')
    <script>
        var portSearch = $('#portofolioSearch');
        var portOptions = $('#portofolioOptions');
        var csrf = $('meta[name="csrf-token"]').attr('content');
        portSearch.on('keyup', function(){
            var query = portSearch.val();
            if(query.length > 2){
                $.ajax({
                    type: "post",
                    url: "/api/portofolio/search",
                    data: {
                        '_token': csrf,
                        'query':query
                    },
                    dataType: "json",
                    success: function (response) {
                        array.forEach(element => {
                            element
                        });
                    }
                });
            }
        });
    </script>
@endsection