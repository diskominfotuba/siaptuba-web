@extends('layouts.pegawai.auth')
@section('content')
<section class="section">
  <div class="mt-3">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-6">
        <div class="login-brand text-center my-3">
          <img src="{{ asset('assets') }}/pegawai/img/logo.png" alt="logo" width="80">
        </div>

        @if ($errors->any())
        <div class="alert alert-danger mb-2">
            @foreach ($errors->all() as $error)
            @if ($error == "We can't find a user with that email address.")
            Kami tidak dapat menemukan pengguna dengan alamat email tersebut.
            @endif
            @endforeach
        </div>
        @endif
        @if (session('status'))
        <div class="alert alert-success mb-2">
            Kami baru saja mengirim link reset password ke email Anda
        </div>
        @endif
        <form action="/forgot-password" method="POST">
        <div class="card card-primary mb-3">
          <div class="card-header"><h4>{{ __('Lupa password') }}</h4></div>
          <div class="card-body">
                @csrf
                <input type="hidden" name="key" value="{{ request()->key }}">
                <div class="form-group">
                  <label for="email">{{ __('Silakan masukan email Anda yang tedaftar pada sistem') }}</label>
                  <input id="email" type="email" class="form-control x-email" name="email" tabindex="1" required autofocus>
                </div>
            </div>
          </div>
          @include('layouts.pegawai._loading_submit')
          <button type="submit" id="btn_login" class="btn btn-primary btn-block btn-lg">Kirim link reset password</button>
        </form>
        <div class="simple-footer text-center mt-3">
          <a href="/">Kembali login</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@push('js')
    <script>
      $('#btn_login').click(function() {
        $('#btn_login').hide();
        $('#loadingSubmit').removeClass('d-none');
      });
    </script>
@endpush

   

