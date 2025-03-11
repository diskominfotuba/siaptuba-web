@extends('layouts.pegawai.auth')
@section('content')
    <section class="section">
        <div class="mt-3">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="login-brand text-center my-3">
                        <img src="{{ asset('assets') }}/pegawai/img/logo.png" alt="logo" width="80">
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger mb-2">{{ session('error') }}</div>
                    @endif
                    <form action="/user/login" method="POST">
                        <div class="card card-primary mb-3">
                            <div class="card-header">
                                <h4>{{ __('Silakan Masuk') }}</h4>
                            </div>
                            <div class="card-body">
                                @csrf
                                <input type="hidden" name="key" value="{{ request()->key }}">
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control x-email" name="email"
                                        value="{{ old('email') }}" tabindex="1" required autofocus>
                                </div>
                                <label for="password">{{ __('Password') }}</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control x-password" id="password" name="password"
                                        required>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="showPassword">
                                    <label class="form-check-label" for="showPassword">Perlihatkan password</label>
                                </div>
                            </div>
                        </div>
                        @include('layouts.pegawai._loading_submit')
                        <button type="submit" id="btn_login" class="btn btn-primary btn-block btn-lg">Masuk</button>
                    </form>
                    <div class="input-group mt-3">
                        <a href="{{ route('auth-redirect') }}" class="btn btn btn-lg btn-outline-primary btn-block"><span><img
                                    src="https://globalinnetwork.com/images/Google__G__logo.svg" alt=""> Login
                                dengan google</span></a>
                    </div>
                    <div class="simple-footer text-center mt-3">
                        <a href="/forgot-password">Lupa password?</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
