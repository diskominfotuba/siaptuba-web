@extends('layouts.general')
@section('content')
        <!-- App Capsule -->
        <div id="appCapsule">
            <div class="section mt-2" style="height: 75vh; overflow: hidden;">
                <div class="splash-page" style="height: 100%; display: flex; justify-content: center; align-items: center;">
                    <iframe id="pdf-viewer" src="https://docs.google.com/gview?embedded=true&url={{ url('storage/dokumen/'.$path) }}" style="width:100%; height:100%;" frameborder="0"></iframe>
                    <div id="error" class="d-none" style="text-align: center;">
                        <img lazy="looading" src="{{ asset('img/icons/blank.png') }}" alt="" width="80%">
                        <p>Gagal memuat PDF</p>
                    </div>
                </div>
            </div>  
        </div>
        <!-- * App Capsule -->
        <div class="form-button-group transparent">
            <button id="btn_loading" class="btn btn-primary btn-lg btn-block d-none" disabled type="button">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Tunggu sebentar yah...
            </button>
            <a id="btn_kembali" href="javascript:void(0)" class="btn-submit btn btn-primary btn-block btn-lg d-none">Kembali</a>
            <a id="btn_refresh" href="{{ url()->current() }}" class="btn-submit btn btn-primary btn-block btn-lg d-none">Refresh halaman</a>
        </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#btn_loading').removeClass('d-none');
        var iframe = document.getElementById('pdf-viewer');
        iframe.onload = function() {
            $('#error').addClass('d-none');
            $('#btn_loading').addClass('d-none');
            $('#btn_kembali').removeClass('d-none');
        };

        // Set timer untuk memeriksa apakah PDF berhasil dimuat
        setTimeout(function() {
            // Cek apakah iframe menampilkan dokumen kosong
            if (iframe.contentDocument && iframe.contentDocument.body.innerHTML === "") {
                console.log('error');
                $('#btn_loading').addClass('d-none');
                $('#btn_refresh').removeClass('d-none');
                iframe.style.display = 'none';
                $('#error').removeClass('d-none');
            }
        }, 5000); // 5 detik menunggu PDF dimuat

        $('#btn_kembali').click(function() {
            window.location.href = "{{ $urlKembali }}";
            changeRefreshStatus(true);
        });
    </script>
@endpush    