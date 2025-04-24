@extends('media.layouts.app')
@section('content')
<div class="container mt-3" style="padding-bottom: 20px">
    <form id="isiKehadiran">
        @csrf
        <div style="padding-top: 50px; margin-bottom: 60px">
            <h4>Anda akan hadir pada kegaiatan</h4>
            <div class="wallet-card">
                <div class="mt-0">
                    <label for="">Nama kegiatan</label>
                    <textarea class="form-control" style="height: 150px" readonly>{{ $kegiatan->nama_kegiatan }}</textarea>
                </div>
                <div class="mt-3">
                    <label for="">Tempat kegiatan</label>
                    <textarea class="form-control" style="height: 100px" readonly>{{ $kegiatan->deskripsi_kegiatan }}</textarea>
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="col d-flex align-items-center gap-1">
                        <img src="{{ $qr }}" alt="qrcode" width="25%">
                        <p class="ml-2"><small>QR Code ini berisi metadata diri dari refrensi profile Anda!</small></p>
                    </div>
                </div>
            </div>
            <div>
                <button id="btnLoading" class="btn btn-primary btn-lg btn-block d-none mt-2" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar yah...
                </button>
            </div>
            <button id="btnSubmit" type="submit" class="btn btn-primary btn-block btn-lg mt-2">Isi kehadiran</button>
        </div>
    </form>
</div>
@endsection 
@push('js')
    <script type="text/javascript">
        $('#isiKehadiran').submit(async function(e) {
            e.preventDefault();

            loadingsubmit(true);
            var tandatangan = "{{ $qr }}";
            var param = {
                url: '/media/kunjungan/store/'+"{{ $kegiatan_id }}",
                method: 'POST',
                data: {tandatangan: tandatangan},
            }

            await transAjax(param).then((result) => {
                swal({
                text: result.message,
                icon: 'success',
                timer: 3000,
                }).then(() => {
                    loadingsubmit(false);
                    window.location.href = '/media/dashboard';
                });
            }).catch((err) => {
                loadingsubmit(false);
                swal({
                    text: err.responseJSON.message,
                    icon: 'error',
                }).then(() => {
                    window.location.href = '/media/dashboard';
                });
            })
        })

        function loadingsubmit(state) {
            console.log(state);
            
            if (state) {
                $('#btnSubmit').addClass('d-none');
                $('#btnLoading').removeClass('d-none');
            } else {
                $('#btnSubmit').removeClass('d-none');
                $('#btnLoading').addClass('d-none');
            }
        }
    </script>
@endpush
