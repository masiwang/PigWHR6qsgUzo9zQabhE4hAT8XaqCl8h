<div class="row mb-3 shadow-sm">
  <div class="col-12 text-center p-3 bg-white">
      <div class="circular-img mb-3" 
          style="position: relative;
              margin: 0 auto;
              width: 5rem;
              height: 5rem;
              overflow: hidden;
              border-radius: 50%;">
          <img src="https://images.unsplash.com/photo-1503235930437-8c6293ba41f5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" srcset=""
              style="width: 100%;
              height: 100%;
              object-fit: cover;">
      </div>
      <div class="profile-title">
          <h4 class="mb-3">{{ $user->name }} {{ $user->last_name }}</h4>
          <h5 class="mb-0">Rp.5.000.000</h5>
          <small class="text-muted">Saldo</small>
      </div>
  </div>
</div>
<div class="row mb-3 py-3 shadow-sm bg-white">
  <div class="col-12">
      <ul class="list-group">
          <li class="list-group-item" style="border: 0px">
              <a href="{{ route('account') }}" class="text-decoration-none {{Request::is('account') ? 'text-success' : 'text-dark'}}">
                <span class="mr-2">@include('components.icon.user')</span> Informasi Pribadi</a>
          </li>
          <li class="list-group-item" style="border: 0px">
              <a href="{{ route('account-addresses') }}"class="text-decoration-none  {{Request::is('account/addresses') ? 'text-success' : 'text-dark'}}">
                <span class="mr-2">@include('components.icon.pin')</span> Daftar Alamat</a>
          </li>
          <li class="list-group-item" style="border: 0px">
              <span class="mr-2">@include('components.icon.credit-card')</span>
              <a href="#"class="text-decoration-none text-dark">Metode Pembayaran</a>
          </li>
      </ul>
  </div>
</div>

<div class="row mb-3 shadow-sm py-3 bg-white">
    <div class="col-12">
        <ul class="list-group">
            <li class="list-group-item" style="border: 0px">
                <a href="{{ route('account-portofolio') }}" class="text-decoration-none {{Request::is('account/portofolio') ? 'text-success' : 'text-dark'}}">
                <span class="mr-2">@include('components.icon.chart')</span> Portofolio
            </a>
          </li>
          <li class="list-group-item" style="border: 0px">
              <span class="mr-2">@include('components.icon.cart')</span>
              <a href="#"class="text-decoration-none text-dark">Pesanan</a>
          </li>
        </ul>
  </div>
</div>

<div class="row mb-3 py-3 shadow-sm bg-white">
  <div class="col-12">
      <ul class="list-group">
          <li class="list-group-item" style="border: 0px">
              <span class="mr-2">@include('components.icon.help')</span>
              <a href="#"class="text-decoration-none text-dark">Bantuan</a>
          </li>
      </ul>
  </div>
</div>
<div class="row mb-3 py-3 shadow-sm bg-white">
  <div class="col-12">
      <ul class="list-group">
          <li class="list-group-item" style="border: 0px">
              <span class="mr-2">@include('components.icon.signout')</span>
              <a href="#"class="text-decoration-none text-dark">Keluar</a>
          </li>
      </ul>
  </div>
</div>