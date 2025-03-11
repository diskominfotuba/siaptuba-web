@extends('layouts.pages')
@section('content')
        <div id="appCapsule">
            <div class="section">
                {{-- untuk notifikasi pemberitahuan kegiatan --}}
                @if ($id_halaman == 'kegiatan')
                    <div class="splash-page mb-3">
                        <img src="{{ asset('assets/img') }}/vector1.png" lazy="loading" alt="image" class="imaged w-50 mb-2">
                        <h3>{{ $title }}</h3>
                    </div>
                    <div id="konten">
                        <div class="card mb-3">
                            <div class="card-body">
                                <ul class="list-group mb-2">
                                    <li class="list-group-item">Nama kegiatan: <span class="text-primary">{{ $nama_kegiatan }}</span></li>
                                    <li class="list-group-item">Tanggal mulai: <span class="text-primary">{{ \Carbon\Carbon::parse($tanggal_mulai)->isoFormat('dddd, D MMMM YYYY, H:mm:ss') }}</span></li>
                                    <li class="list-group-item">Tanggal akhir: <span class="text-primary">{{ \Carbon\Carbon::parse($tanggal_akhir)->isoFormat('dddd, D MMMM YYYY, H:mm:ss') }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="splash-page">
                        <a href="javascript:void(0)" id="btn-kembali" class="btn btn-primary">Kembali ke dashboard</a>
                    </div>
                 @endif
                {{-- akhir dari notifikasi pemberitahuan kegiatan --}}
            </div>  
        </div>
        <script type="text/javascript">
            document.getElementById("btn-kembali").addEventListener("click", function() {
                window.location.href = "/user/dashboard";
            });
        </script>
@endsection
