@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
                <div class="col-md mb-4 mb-md-0">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card">
                        <h5 class="card-header">Filter Rekapitulasi Presensi</h5>
                        <div class="card-body">
                            <div class="row text-center g-2">
                                <div class="col-12 col-md-3">
                                    <input id="tanggalAwal" type="text" class="form-control datepicker start_date"
                                        name="tanggal_awal" placeholder="--tanggal awal--" autocomplete="off">
                                </div>
                                <div class="col-12 col-md-3">
                                    <input id="tanggalAkhir" type="text" name="tanggal_akhir"
                                        placeholder="--tanggal akhir--" class="form-control datepicker end_date"
                                        autocomplete="off">
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    <select id="status" class="form-select" aria-label="Default select example">
                                        <option value="">--status--</option>
                                        <option value="asn">ASN</option>
                                        <option value="non_asn">Non ASN</option>
                                        @if (auth()->user()->opd_id == '20')
                                        <option value="to">Tenaga Kontark</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12 col-md-2">
                                    <button id="tampilkan" class="form-control btn-primary">TAMPILKAN</button>
                                </div>
                                <div class="col-12 col-md-2">
                                    <button id="export" class="form-control btn-primary">EXPORT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md mb-4 mb-md-0">
                    <div class="card">
                        <h5 class="card-header">Rekapitulasi Presensi</h5>
                        <div class="card-body">
                            @include('layouts._loading')
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Total kehadiran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('assets/pegawai') }}/js/plugins/datepicker/bootstrap-datepicker.js">
        < script type = "text/javascript"
        src = "{{ asset('js/sweetalert.min.js') }}" >
    </script>
    </script>
    <script>
        var search = '';
        var tanggalAwal = '';
        var tanggalAkhir = '';
        var status = '';
        var page = 1;
        $(document).ready(function() {
            loadTable();

            $('#search').on('keypress', function(e) {
                if (e.which == 13) {
                    filterTable();
                    return false;
                }
            });

            $('#tampilkan').click(function() {
                filterTable();
            });

            $('#tanggal_awal').change(function() {
                filterTable();
            });

            $('#tanggal_akhir').change(function() {
                filterTable();
            });
        });

        function filterTable() {
            search = $('#search').val();
            tanggalAwal = $('#tanggalAwal').val();
            tanggalAkhir = $('#tanggalAkhir').val();
            status = $('#status').val();
            loadTable();
        }

        async function loadTable() {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    search: search,
                    tanggal_awal: tanggalAwal,
                    tanggal_akhir: tanggalAkhir,
                    status: status,
                    page: page,
                }
            }

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                $('#dataTable').html(result);
            }).catch((err) => {
                loading(false);
                console.log(err);
            })
        }

        function loadPaginate(to) {
            page = to
            filterTable()
        }

        $(".datepicker").datepicker({
            format: "dd-mm-yyyy",
            "autoclose": true
        });

        $('#export').click(function() {
            tanggalAwal = $('#tanggalAwal').val();
            tanggalAkhir = $('#tanggalAkhir').val();
            status = $('#status').val();

            window.location.href = '/oprator/rekap_presensi/export?tanggal_awal=' +
                tanggalAwal + '&tanggal_akhir=' +
                tanggalAkhir + '&status=' + status;
        });
    </script>
@endpush
