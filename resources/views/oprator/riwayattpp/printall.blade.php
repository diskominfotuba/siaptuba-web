@extends('layouts.printpage')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <h3 class="text-center mb-3">
            Pengurangan Tambahan Penghasilan Pegawai (TPP) <br> {{ auth()->user()->opd->nama_opd }} Bulan
            {{ \Illuminate\Support\Carbon::createFromFormat('m', request()->bulan)->translatedFormat('F') }}
            {{ \Illuminate\Support\Carbon::now()->year }}</h3>
            <div class="row">
                <div class="table text-wrap" id="dataTable">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            loadTable();
        });

        async function loadTable() {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    bulan: '{{ request()->bulan }}',
                }
            }

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                $('#dataTable').html(result);
            }).catch((err) => {
                loading(false);
                console.log(err);
            });

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                window.print();
            }).catch((err) => {
                loading(false);
                console.log(err);
            });
        }
    </script>
@endpush
