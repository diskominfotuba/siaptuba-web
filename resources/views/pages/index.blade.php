@extends('layouts.pages')
@section('content')
        <div id="appCapsule">
            <div class="section pt-5">
                <div class="splash-page mt-5 mb-5">
                    <img src="{{ asset('assets/img') }}/vector1.png" lazy="loading" alt="image" class="imaged w-50 mb-2">
                    <h3>{{ $title }}</h3>
                    <p>
                        {{ $description }}
                    </p>
                    <a href="/user/dashboard" class="btn btn-primary">Kembali ke dashboard</a>
                </div>
            </div>  
        </div>
@endsection
