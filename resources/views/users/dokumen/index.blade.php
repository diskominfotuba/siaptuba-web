@extends('layouts.general')
@section('content')
<div class="container mt-3" style="padding-bottom: 10px">
    <div style="padding-top: 50px">
        <h3>{{ $title }}</h3>
        <hr>
    </div>
</div>
<div class="section" style="padding-bottom: 30px">
    @if (session('message'))
    <div class="alert alert-danger mb-1">{{ session('message') }}</div>
    @endif
    <div class="card">
        <div class="card-header">Tambah dokumen</div>
        <div class="card-body">
            <form id="dokumenStore">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nama dokumen">
                </div>
                <div class="form-group">
                    <input type="file" class="form-control">
                </div>
            </form>
        </div>
    </div>
    <button id="btn_loading" class="btn btn-primary btn-lg btn-block d-none mt-2" disabled type="button">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Tunggu sebentar yah...
    </button>
    <button id="btn_submit" type="submit" class="btn-submit btn btn-primary btn-block btn-lg mt-2">Simpan</button>
    <div class="card mt-2">
        <div class="card-body">
            ok
        </div>
    </div>
</div>
@endsection
@push('js')
    <script type="text/javascript">
    //simpan dokumen
    $("#dokumenStore").submit(async function(e) {
        e.preventDefault();
        loading(true);

        var form 	= $(this)[0]; 
        var data 	= new FormData(form);
        var param = {
            url: '/user/dokumen/store',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
        }

        await transAjax(param).then((result) => {
            loading(false);
            swal({
            title: 'Berhasil',
            text: result.message,
            icon: 'success',
            timer: 3000,
        }).then(() => {
            window.location.href = "/user/dokumen";
            });
        }).catch((err) => {
            loading(false);
            swal({
            title: 'Oops!',
            text: err.responseJSON.message,
            icon: 'error',
            timer: 3000,
            });
        });
    });

    function loading(state) {
        if(state) {
            $('#btn_submit').addClass('d-none');
            $('#btn_loading').removeClass('d-none');
        }else {
            $('#btn_submit').removeClass('d-none');
            $('#btn_loading').addClass('d-none');
        }
    }   
</script>
@endpush