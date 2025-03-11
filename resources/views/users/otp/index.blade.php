@extends('layouts.general')
@section('content')
<div class="container mt-3 text-center" style="padding-bottom: 10px">
    <div style="padding-top: 50px">
        <h3>{{ $title }}</h3>
        <hr>
    </div>
</div>
<div class="section text-center" style="padding-bottom: 30px">
    @if (session('message'))
    <div class="alert alert-danger mb-1">{{ session('message') }}</div>
    @endif
    <div id="otp">

    </div>
    <button id="btn_loading" class="btn btn-primary btn-lg btn-block d-none mt-2" disabled type="button">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Tunggu sebentar yah...
    </button>
    <button id="btn_submit" type="submit" class="btn-submit btn btn-primary btn-block btn-lg mt-2">Refresh</button>
</div>
@endsection
@push('js')
    <script type="text/javascript">
    $(document).ready(function() {
        loadOtp();
    });

    async function loadOtp() {
        var param = {
            url: "{{ url()->current() }}",
            method: 'GET',
            data: {
                load: 'otp'
            }
        }

        loading(true);
        await transAjax(param).then((result) => {
            loading(false);
            $('#otp').html(result);
        }).catch((error) => {
            console.log(error);
            loading(false);
        });
    }

    function loading(state) {
        if(state) {
            $('#btn_submit').addClass('d-none');
            $('#btn_loading').removeClass('d-none');
        }else {
            $('#btn_submit').removeClass('d-none');
            $('#btn_loading').addClass('d-none');
        }
    }   

    $('#btn_submit').click(function() {
        loadOtp();
    });
</script>
@endpush