@extends('layouts.pegawai.app')
@section('content')
    <div id="appCapsule">
        <div class="section mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <div class="input-group">
                                        <input id="tanggalAwal" type="text" class="form-control datepicker start_date"
                                            name="tanggal_awal" placeholder="Tanggal awal" readonly>
                                        <div class="input-group-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon-sm"
                                                viewBox="0 0 512 512">
                                                <rect fill="none" stroke="currentColor" stroke-linejoin="round"
                                                    stroke-width="32" x="48" y="80" width="416" height="384"
                                                    rx="48" />
                                                <circle fill="currentColor" cx="296" cy="232" r="24" />
                                                <circle fill="currentColor" cx="376" cy="232" r="24" />
                                                <circle fill="currentColor" cx="296" cy="312" r="24" />
                                                <circle fill="currentColor" cx="376" cy="312" r="24" />
                                                <circle fill="currentColor" cx="136" cy="312" r="24" />
                                                <circle fill="currentColor" cx="216" cy="312" r="24" />
                                                <circle fill="currentColor" cx="136" cy="392" r="24" />
                                                <circle fill="currentColor" cx="216" cy="392" r="24" />
                                                <circle fill="currentColor" cx="296" cy="392" r="24" />
                                                <path fill="none" stroke="currentColor" stroke-linejoin="round"
                                                    stroke-width="32" stroke-linecap="round" d="M128 48v32M384 48v32" />
                                                <path fill="none" stroke="currentColor" stroke-linejoin="round"
                                                    stroke-width="32" d="M464 160H48" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4  col-md-4">
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <div class="input-group">
                                        <input id="tanggalAkhir" type="text" name="tanggal_akhir"
                                            placeholder="Tanggal akhir" class="form-control datepicker end_date" readonly>
                                        <div class="input-group-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon-sm"
                                                viewBox="0 0 512 512">
                                                <rect fill="none" stroke="currentColor" stroke-linejoin="round"
                                                    stroke-width="32" x="48" y="80" width="416" height="384"
                                                    rx="48" />
                                                <circle fill="currentColor" cx="296" cy="232" r="24" />
                                                <circle fill="currentColor" cx="376" cy="232" r="24" />
                                                <circle fill="currentColor" cx="296" cy="312" r="24" />
                                                <circle fill="currentColor" cx="376" cy="312" r="24" />
                                                <circle fill="currentColor" cx="136" cy="312" r="24" />
                                                <circle fill="currentColor" cx="216" cy="312" r="24" />
                                                <circle fill="currentColor" cx="136" cy="392" r="24" />
                                                <circle fill="currentColor" cx="216" cy="392" r="24" />
                                                <circle fill="currentColor" cx="296" cy="392" r="24" />
                                                <path fill="none" stroke="currentColor" stroke-linejoin="round"
                                                    stroke-width="32" stroke-linecap="round" d="M128 48v32M384 48v32" />
                                                <path fill="none" stroke="currentColor" stroke-linejoin="round"
                                                    stroke-width="32" d="M464 160H48" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 justify-content-between">
                            <button id="tampilkan" type="button" class="btn btn-primary mt-1 btn-sortir">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon-xs" viewBox="0 0 512 512">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32" d="M416 128L192 384l-96-96" />
                                </svg>
                                Tampilkan</button>
                            <button id="printPage" class="btn btn-warning mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon-xs" viewBox="0 0 512 512">
                                    <path
                                        d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                                        fill="none" stroke="currentColor" stroke-linejoin="round"
                                        stroke-width="32" />
                                    <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32"
                                        fill="none" stroke="currentColor" stroke-linejoin="round"
                                        stroke-width="32" />
                                    <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24"
                                        fill="none" stroke="currentColor" stroke-linejoin="round"
                                        stroke-width="32" />
                                    <circle cx="392" cy="184" r="24" />
                                </svg>
                                Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section my-3">
            <div class="section-title">Riwayat pengurangan TPP</div>
            <div id="dataTable">
                
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        var page = 1;
        var tanggalAwal = '';
        var tanggalAkhir = '';

        $('#dataTable').html(make_skeleton());
        $(document).ready(function() {
            loadTable();

            $('#tampilkan').click(function() {
                filterTable();
            });

            $('#printPage').click(function() {
                printPage();
            });
        });

        function filterTable() {
            tanggalAwal = $('#tanggalAwal').val();
            tanggalAkhir = $('#tanggalAkhir').val();
            if((tanggalAwal == "") || (tanggalAkhir == "")) {
                swal({
                    title: "Opss",
                    text: "Tanggal awal dan tanggal akhir tidak boleh kosong",
                    icon: "error",
                });
                return;
            }

            loadTable();
        }

        async function loadTable() {
            var param = {
                method: 'GET',
                url: '{{ url()->current() }}',
                data: {
                    load: 'table',
                    page: page,
                    tanggal_awal: tanggalAwal,
                    tanggal_akhir: tanggalAkhir,
                }
            }

            loading(true)
            await transAjax(param).then((result) => {
                loading(false)
                $('#dataTable').html(result);
            }).catch((err) => {
                loading(false)
                console.log('err');
            });

            function loading(state) {
                if (state) {
                    $('#loading').removeClass('d-none');
                } else {
                    $('#loading').addClass('d-none');
                }
            }
        }

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

        function loadPaginate(to) {
            page = to
            filterTable()
        }

        function printPage() {
            swal({
                title: "Opss",
                text: "Fitur ini belum bisa digunakan!",
                icon: "warning",
            });
            return;
            // var tanggalAwal = $('#tanggalAwal').val();
            // var tanggalAkhir = $('#tanggalAkhir').val();
            // window.location.href = "/user/izin/print?tanggal_awal=" + tanggalAwal + "&tanggal_akhir=" + tanggalAkhir;
        }
    </script>
@endpush
