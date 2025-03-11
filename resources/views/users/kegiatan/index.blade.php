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
                                            name="tanggal_awal" placeholder="Tanggal Awal" readonly>
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
                                            placeholder="Tanggal Akhir" class="form-control datepicker end_date" readonly>
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
            <div class="section-title">Data Kegiatan</div>
            <div class="cuti" id="dataTable">

            </div>
        </div>
        <div class="modal fade action-sheet" id="showKegiatan" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Kegiatan</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <div class="form-group rounded">
                                <div class="input-wrapper">
                                    <label for="nama_kegiatan">Nama kegiatan</label>
                                    <textarea id="nama_kegiatan" type="text" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group rounded">
                                <div class="input-wrapper">
                                    <label for="deskripsi_kegiatan">Deskripsi</label>
                                    <textarea id="deskripsi_kegiatan" type="text" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group rounded">
                                <div class="input-wrapper">
                                    <div id="tandatangan"></div>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <button type="button" class="btn btn-primary btn-block btn-lg" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.modal._modal')
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

            $('#tanggal_awal').change(function() {
                filterTable();
            });

            $('#tanggal_akhir').change(function() {
                filterTable();
            });
        });

        function showKegiatan(data) {
            $('#nama_kegiatan').val(data.kegiatan.nama_kegiatan);
            $('#deskripsi_kegiatan').val(data.kegiatan.deskripsi_kegiatan);
            let filename = data.tandatangan;
            let url = `{{ url('/bukti-hadir/') }}/${new Date().getFullYear()}/${filename}`;
            $('#tandatangan').html(`
            <hr>
            <div class="row">
                <div class="col d-flex align-items-center gap-1">
                    <img lazy="loading" src="${url}" alt="" class="rounded" alt="qrcode" width="25%">
                    <p class="ml-2"><small>QR Code ini berisi metadata diri dari refrensi profile Anda!</small></p>
                </div>
            </div>
            `);
        }

        function filterTable() {
            tanggalAwal = $('#tanggalAwal').val();
            tanggalAkhir = $('#tanggalAkhir').val();
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

        $('#awal-cuty').click(function() {
            $('#awal-cuty').attr('type', 'date');
        });
        $('#akhir-cuty').click(function() {
            $('#akhir-cuty').attr('type', 'date');
        });
        $('#tanggal-masuk').click(function() {
            $('#tanggal-masuk').attr('type', 'date');
        });
    </script>
@endpush
