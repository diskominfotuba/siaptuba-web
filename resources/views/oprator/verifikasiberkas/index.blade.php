@extends('layouts.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>{{ $title }}</h4>
        <div class="row">
            <div class="col-md-6">
                <a href="javascript:void()" id="pengajuanBaru">
                    <div class="card mb-3">
                        <div class="row g-0 align-items-center">
                            <div class="card-body">
                                <label for="" style="color: #566a7f">Pengajuan baru</label>
                                <h4 class="card-text fw-bold">
                                    {{ $pengajuan_diajukan }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="javascript:void()" id="pengajuanDitolak">
                    <div class="card mb-3">
                        <div class="row g-0 align-items-center">
                            <div class="card-body">
                                <label for="" style="color: #566a7f">Pengajuan ditolak</label>
                                <h4 class="card-text fw-bold">
                                    {{ $pengajuan_ditolak }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        @include('layouts._loading')
                        <div class="table-responsive text-nowrap" id="dataTable">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection
@push('js')
    <script type="text/javascript">
        var page = 1;
        var search = '';
        var status = '';
        $(document).ready(function() {
            loadTable();

            $('#search').on('keypress', function(e) {
                if (e.which == 13) {
                    filterTable();
                    return false;
                }
            });

            $('#pengajuanBaru').click(function() {
                filterTable('diajukan');
            });

            $('#pengajuanTerverifikasi').click(function() {
                filterTable('terverifikasi operator');
            });

            $('#pengajuanDitolak').click(function() {
                filterTable('ditolak operator');
            });
        });

        function filterTable(value) {
            search = $('#search').val();
            status = value
            loadTable();
        }

        async function loadTable() {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    status: status,
                    page: page,
                    search: search
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
        }

        function loadPaginate(to) {
            page = to;
            loadTable();
        }
    </script>
@endpush
