@extends('layouts.pegawai.auth')
@section('content')
<div class="appHeader bg-primary text-light">
  <span class="h5">Tulang Bawang</span>
</div>
<div class="banner">
  <img lazy="loading" src="{{ asset('img/banner/landingpage.png') }}" class="img-fluid" alt="banner" width="100%">
</div>
<section class="section">
  <div class="mt-3">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <h3>Layanan</h3>
        <div class="row text-center">
          <div class="col-6 col-md-6">
            <a href="/login">
              <div class="card">
                <div class="card-body">
                  <img lazy="loading" src="{{ asset('assets') }}/pegawai/img/logo.png" alt="logo" width="36">
                  <p style="color: #1e2a5e">SIAP TUBA</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-6 col-md-6">
            <div class="card">
              <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" style="fill: #1e2a5e;transform: ;msFilter:;"><path d="M4 4h4.01V2H2v6h2V4zm0 12H2v6h6.01v-2H4v-4zm16 4h-4v2h6v-6h-2v4zM16 4h4v4h2V2h-6v2z"></path><path d="M5 11h6V5H5zm2-4h2v2H7zM5 19h6v-6H5zm2-4h2v2H7zM19 5h-6v6h6zm-2 4h-2V7h2zm-3.99 4h2v2h-2zm2 2h2v2h-2zm2 2h2v2h-2zm0-4h2v2h-2z"></path></svg>
               <p style="color: #1e2a5e">Scanner</p>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-6 mt-2">
            <div class="card">
              <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" style="fill: #1e2a5e;transform: ;msFilter:;"><path d="M21 20V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2zM9 18H7v-2h2v2zm0-4H7v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm2-5H5V7h14v2z"></path></svg>
               <p style="color: #1e2a5e">Jadwal temu</p>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-6 mt-2">
            <div class="card">
              <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" style="fill: #1e2a5e;transform: ;msFilter:;"><path d="M11 8H9v3H6v2h3v3h2v-3h3v-2h-3z"></path><path d="M18 7c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-3.333L22 17V7l-4 3.333V7zm-1.999 10H4V7h12v5l.001 5z"></path></svg>
               <p style="color: #1e2a5e">Media Visit</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="pb-5 col-12 mt-3 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <h3>Informasi</h3>
        <div class="row justify-content-center">
          <div class="mt-2r text-center">
              <div class="empty">
                  <div class="empty-img">
                      <svg style="width: 96px; height: 96px" xmlns="http://www.w3.org/2000/svg"
                          class="icon icon-tabler icon-tabler-database-off" width="24" height="24"
                          viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                          stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path
                              d="M12.983 8.978c3.955 -.182 7.017 -1.446 7.017 -2.978c0 -1.657 -3.582 -3 -8 -3c-1.661 0 -3.204 .19 -4.483 .515m-2.783 1.228c-.471 .382 -.734 .808 -.734 1.257c0 1.22 1.944 2.271 4.734 2.74">
                          </path>
                          <path
                              d="M4 6v6c0 1.657 3.582 3 8 3c.986 0 1.93 -.067 2.802 -.19m3.187 -.82c1.251 -.53 2.011 -1.228 2.011 -1.99v-6">
                          </path>
                          <path d="M4 12v6c0 1.657 3.582 3 8 3c3.217 0 5.991 -.712 7.261 -1.74m.739 -3.26v-4"></path>
                          <line x1="3" y1="3" x2="21" y2="21"></line>
                      </svg>
                  </div>
                  <p class="empty-title">Tidak ada data yang tersedia</p>
                  <div class="empty-action">
                      <button onclick="loadData()" class="btn btn-primary">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh"
                              width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                              fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                              <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                          </svg>
                          Refresh
                      </button>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@push('js')
    <script type="text/javascript">
    //fungsi untuk menampilkan dan menutup password
      $('#showPassword').on('change', function() {
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');
            if ($(this).is(':checked')) {
                passwordField.attr('type', 'text'); // Show password
            } else {
                passwordField.attr('type', 'password'); // Hide password
            }
      });

      //digunakan untuk menampilkan animasi loading ketika tombol login ditekan
      $('#btn_login').click(function() {
        $('#btn_login').hide();
        $('#loadingSubmit').removeClass('d-none');
      });
    </script>
@endpush

   

