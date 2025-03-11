@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
                <div class="col-md mb-4 mb-md-0">
                    <div class="card">
                        <h5 class="card-header">Filter presensi</h5>
                        <div class="card-body">
                            <div class="row text-center g-2 ">
                                <div class="col-12 col-md-2">
                                    <input id="tanggalAwal" type="text" class="form-control datepicker start_date"
                                        name="tanggal_awal" placeholder="Tanggal Awal" autocomplete="off">
                                </div>
                                <div class="col-12 col-md-2">
                                    <input id="tanggalAkhir" type="text" name="tanggal_akhir" placeholder="Tanggal Akhir"
                                        class="form-control datepicker end_date" autocomplete="off">
                                </div>
                                <div class="col-12 col-md-2">
                                    <select id="statusPegawai" name="status_pegawai" class="form-select"
                                        aria-label="Default select example">
                                        <option value="">--pilih status pegawai--</option>
                                        <option value="asn">ASN</option>
                                        <option value="non_asn">NON ASN</option>
                                        @if (auth()->user()->opd_id == '20')
                                        <option value="to">Tenaga Outsorcing</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12 col-md-2">
                                    <select id="statusPresensi" class="form-select" aria-label="Default select example">
                                        <option value="">--pilih status presensi--</option>
                                        <option value="Tepat waktu">Tepat Waktu</option>
                                        <option value="Terlambat">Terlambat</option>
                                        <option value="Apel">Apel</option>
                                        <option value="DL">DL</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <button id="tampilkan" class="btn btn-primary">TAMPILKAN</button>
                                    <button id="export" class="btn btn-primary">EXPORT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md mb-4 mb-md-0">
                    <div class="card">
                        <h5 class="card-header">Data presensi pegawai</h5>
                        <div class="card-body">
                            @include('layouts._loading')
                            <div class="table-responsive text-nowrap" id="dataTable">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade modalbox" id="modal-show" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Detail Presensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-12 col-md-4 mb-0">
                            <img id="photoAbsen" class="img-fluid rounded" src="" alt="">
                        </div>
                        <div class="col-12 col-md-8 mb-0">
                            <div class="form-group mb-3">
                                <label for="dobExLarge" class="form-label">Nama</label>
                                <input type="text" id="dobExLarge" class="form-control" name="nama" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="dobExLarge" class="form-label">Tanggal</label>
                                <input type="text" id="dobExLarge" class="form-control" name="tanggal" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="dobExLarge" class="form-label">Waktu Presensi</label>
                                <input type="text" id="dobExLarge" class="form-control" name="jam_masuk" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="dobExLarge" class="form-label">Lokasi Saat Presensi</label>
                                <input type="text" id="dobExLarge" class="form-control" name="latlong" />
                            </div>
                            <div class="form-group mb-3" id="inputketeragan">
                                <label for="dobExLarge" class="form-label">Keterangan</label>
                                <input readonly type="text" id="keterangan" class="form-control" />
                            </div>
                            <div class="form-group mb-3" id="buktidukung">
                                <label for="dobExLarge" class="form-label">Bukti Dukung Presensi</label>
                                <a href="" id="filebuktidukung" class="btn btn-sm btn-primary">Lihat File</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div id="map" style="height: 390px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('assets/pegawai') }}/js/plugins/datepicker/bootstrap-datepicker.js">
    </script>
       <script defer
       src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD8y5ZQcuol7vxOkXii_wsHqYhCNL0uEM&libraries=geometry&callback">
   </script>
    <script>
        var search = '';
        var tanggalAwal = '';
        var tanggalAkhir = '';
        var status_pegawai = '';
        var status_presensi = '';
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

            $('#statusPegawai').change(function() {
                filterTable();
            });

            $('#statusPresensi').change(function() {
                filterTable();
            });
        });

        function filterTable() {
            search = $('#search').val();
            tanggalAwal = $('#tanggalAwal').val();
            tanggalAkhir = $('#tanggalAkhir').val();
            status_pegawai = $('#statusPegawai').val();
            status_presensi = $('#statusPresensi').val();
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
                    status_pegawai: status_pegawai,
                    status: status_presensi,
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
            status_pegawai = $('#statusPegawai').val();
            status = $('#status').val();
            window.location.href = '/oprator/presensi/export?tanggal_awal=' + tanggalAwal + '&tanggal_akhir=' +
                tanggalAkhir + '&status_pegawai=' + status_pegawai + '&status_presensi=' + status_presensi;
        });

        function showPresensi(data, waktu) {
            if (waktu === 1) {
                $('.modal-title').html('Detail Presensi Pagi');
                $('#photoAbsen').attr('src', "{{ url('disk') }}/" + new Date().getFullYear() + '/' + data.photo_masuk);
                $('input[name=nama]').val(data.user.nama);
                $('input[name=tanggal]').val(data.tanggal);
                $('input[name=jam_masuk]').val(data.jam_masuk);
                $('input[name=latlong]').val(data.lat_long_masuk);
                if (!data.spt) {
                    $('#buktidukung').hide();
                    $('#inputketerangan').hide();
                } else {
                    $('#buktidukung').show();
                    $('#inputketerangan').show();
                    $('#keterangan').val(data.keterangan);
                    data.spt = data.spt.replace('public/', '');
                    $('#filebuktidukung').attr('href', "{{ url('/storage') }}/" + data.spt);
                }
            } else {
                $('.modal-title').html('Detail Presensi Sore');
                $('#photoAbsen').attr('src', "{{ url('disk') }}/" + new Date().getFullYear() + '/' + data.photo_pulang);
                $('input[name=nama]').val(data.user.nama);
                $('input[name=tanggal]').val(data.tanggal);
                $('input[name=jam_masuk]').val(data.jam_pulang);
                $('input[name=latlong]').val(data.lat_long_pulang);
                if (!data.spt) {
                    $('#buktidukung').hide();
                    $('#inputketerangan').hide();
                } else {
                    $('#buktidukung').show();
                    $('#inputketerangan').show();
                    $('#keterangan').val(data.keterangan);
                    data.spt = data.spt.replace('public/', '');
                    $('#filebuktidukung').attr('href', "{{ url('/storage') }}/" + data.spt);
                }
            };

            const lat = data.lat_long_masuk.substring(10, '');
            const long = data.lat_long_masuk.substring(11);

            let mapOptions, map, marker;
            infoWindow = '';

            element = document.getElementById('map');

            mapOptions = {
                zoom: 16,
                center: {
                    lat: parseFloat(lat),
                    lng: parseFloat(long),
                },
                disableDefaultUI: false,
                scrollWheel: true,
                draggable: false,
            };

            map = new google.maps.Map(element, mapOptions);

            marker = new google.maps.Marker({
                position: mapOptions.center,
                map: map,
                // icon: 'http://pngimages.net/sites/default/files/google-maps-png-image-70164.png',
                draggable: true
            });
        }
    </script>
@endpush
