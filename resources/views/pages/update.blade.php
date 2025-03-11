@extends('layouts.pages')
@section('content')
        <!-- App Capsule -->
        <div id="appCapsule">
            <div class="section">
                <div class="splash-page mb-5">
                    <img lazy="loading" src="{{ asset('assets/img') }}/vector1.png" alt="image" class="imaged w-50 ">
                    <h1>Update aplikasi</h1>
                    <p>
                        Silakan update aplikasi Anda di <br><span class="font-weight-bold text-primary">Google Ply Store</span>
                    </p>
                </div>
                <h4 class="font-weight-bold">Cara update</h4>
                <p>1. Buka google playstore <br>2. Ketikan kata pencarian "SIAP TUBA" <br>3. Klik Update</p>
                <h4 class="font-weight-bold">Catatan</h4>
                <p>Jika terjadi error saat update aplikasi, coba hapus dulu kemudian install ulang</p>
            </div>  
        </div>
        <!-- * App Capsule -->
@endsection
