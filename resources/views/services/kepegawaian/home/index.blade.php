@extends('layouts.general')
@section('content')
    <div class="container mt-3" style="padding-bottom: 20px">
        <div style="padding-top: 50px">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary font-weight-bold">{{ $title }}</div>
                <a class="btn btn-primary btn-sm" href="/user/dashboard">&lt; kembali</a>
            </div>
            <div class="row my-3">
                <div class="col-6 col-md-6">
                    <a href="{{ route('kepgawaian.dokumen') }}" data-turbo="false">
                        <div class="card pb-1 text-center" style="border-top: 3px solid #1e2a5e;">
                            <img src="{{ asset('assets/icon/2666435.png') }}" alt="icon" width="90%" class="p-3 mx-auto d-block">
                            <h3>Dokumen</h3>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-6">
                    <a href="{{ route('services.kepegawaian') }}" data-turbo="false">
                        <div class="card pb-1 text-center" style="border-top: 3px solid #1e2a5e;">
                            <img src="{{ asset('assets/icon/icon_pengajuan.png') }}" alt="icon" width="95%" class="p-3 mx-auto d-block">
                            <h3>Pengajuan</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="section-title font-weight-bold">Riwayat pengajuan</div>
            <div class="transactions" id="dataTable">
            </div>
        </div>
    </div>
    @include('components._modal_commingsoon')
@endsection
@push('js')
    <script type="text/javascript">
        $('#dataTable').html(make_skeleton());
        $(document).ready(async function() {
            var param = {
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    'load': 'table'
                }
            }

            await transAjax(param).then((result) => {
                $('#dataTable').html(result);
            });
        });

        function make_skeleton() {
            var output = '';
            for (var count = 0; count < 3; count++) {
                output += '<div class="col-12">';
                output += '<div class="ph-item">';
                output += '<div class="ph-picture"></div>';
                output += '</div>';
                output += '</div>';
            }
            return output;
        }
    </script>
@endpush
