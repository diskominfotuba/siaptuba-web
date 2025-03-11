@extends('layouts.pegawai.auth')
@section('content')
<section class="section">
  <div class="mt-3">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand text-center my-3">
          <img src="{{ asset('assets') }}/pegawai/img/logo.png" alt="logo" width="80">
        </div>

        @if (session('error'))
        <div class="alert alert-danger mb-2">{{ session('error') }}</div>
        @endif
        <div class="card card-primary">
          <div class="card-header"><h4>{{ __('Silakan Masuk') }}</h4></div>
          <form action="/user/login" method="POST">
          <div class="card-body">
                @csrf
                <input type="hidden" name="key" value="{{ request()->key }}">
                <div class="form-group">
                  <label for="email">{{ __('Email') }}</label>
                  <input id="email" type="email" class="form-control x-email" name="email" value="{{ old('email') }}" tabindex="1" required autofocus>
                </div>
                <label for="password">{{ __('Password') }}</label>
                <div class="input-group mb-3">
                  <input type="password" class="form-control x-password" id="password" name="password" required>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="showPassword">
                <label class="form-check-label" for="showPassword">Perlihatkan password</label>
              </div>
            </div>
            <div class="form-button-group  transparent">
              @include('layouts.pegawai._loading_submit')
              <button type="submit" id="btn_login" class="btn btn-primary btn-block btn-lg">Masuk</button>
            </div>
          </form>
        </div>
        <div class="simple-footer text-center mt-3">
         <a href="/forgot-password">Lupa password?</a>
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

   
