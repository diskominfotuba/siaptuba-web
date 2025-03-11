@extends('layouts.general')
@section('content')
    <div class="container mt-3" style="padding-bottom: 20px">
        <div style="padding-top: 50px">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary font-weight-bold">Kategori layanan</div>
                <a href="{{ route('user.kepegawaian') }}" class="btn btn-primary btn-sm">&lt; kembali</a>
            </div>
            <hr>
            <div id="accordion">
            </div>
        </div>
    </div>
@endsection
@push('js')
    @if (session('error'))
        <script>
            swal({
                text: "{{ session('error') }}",
                icon: 'error',
                timer: 3000,
            });
        </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
            loadData();
        });

        async function loadData() {
            var param = {
                method: 'GET',
                url: '{{ url()->current() }}',
                data: {
                    load: 'table',
                }
            }
            await transAjax(param).then((result) => {
                $('#accordion').html(result)
            }).catch((err) => {
                console.log('error');
            });
        }
    </script>
@endpush
