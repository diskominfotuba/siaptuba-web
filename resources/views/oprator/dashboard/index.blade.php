@extends('layouts.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex">
            <h3>Overview data</h3>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3" style="border-top: 3px solid #696cff">
                  <div class="row g-0 align-items-center">
                      <div class="card-body">
                        <label for="">Total pegawai</label>
                        <h4 class="card-text fw-bold">
                            {{ $user }}
                        </h4>
                      </div>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3" style="border-top: 3px solid #696cff">
                  <div class="row g-0 align-items-center">
                      <div class="card-body">
                        <label for="">Sudah presensi</label>
                        <h4 class="card-text fw-bold">
                            {{ $sudahPresensi }}
                        </h4>
                      </div>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3" style="border-top: 3px solid #696cff">
                  <div class="row g-0 align-items-center">
                      <div class="card-body">
                        <label for="">Belum presensi</label>
                        <h4 class="card-text fw-bold">
                            {{ $belumPresensi }}
                        </h4>
                      </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="mb-3">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Filter presensi</h5>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <select name="" id="statusPegawai" class="form-select">
                                    <option value="">--status pegawai--</option>
                                    <option value="asn">ASN</option>
                                    <option value="non_asn">NON ASN</option>
                                    <option value="to">Tenaga Outsorcing</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <select id="statusPresensi" class="form-select" aria-label="Default select example">
                                    <option value="">--pilih status presensi--</option>
                                    <option value="sudah_presensi">Sudah presensi</option>
                                    <option value="belum_presensi">Belum presensi</option>
                                    <option value="Tepat waktu">Tepat Waktu</option>
                                    <option value="Terlambat">Terlambat</option>
                                    <option value="Apel">Apel</option>
                                    <option value="Dinas Luar (DL)">Dinas Luar (DL)</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <select name="" id="paginate" class="form-select">
                                    <option value="10">--data perhalaman--</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Presensi pegawai hari ini</h5>
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
    <div class="modal fade modalbox" id="modal-show" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
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
    <script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD8y5ZQcuol7vxOkXii_wsHqYhCNL0uEM&libraries=geometry&callback">
    </script>
    <script type="text/javascript">
        var page = 1;
        var paginate = 10;
        var statusPresensi = '';
        var statusPegawai = '';
        var search = '';
        $(document).ready(function() {
            loadTable();

            $('#search').on('keypress', function(e) {
                if (e.which == 13) {
                    filterTable();
                    return false;
                }
            });

            $('#statusPegawai').change(function() {
                filterTable();
            });

            $('#statusPresensi').change(function() {
                filterTable();
            });

            $('#paginate').change(function() {
                filterTable();
            });
        });

        function filterTable() {
            search = $('#search').val();
            statusPegawai = $('#statusPegawai').val();
            statusPresensi = $('#statusPresensi').val();
            paginate = $('#paginate').val();
            loadTable();
        }

        async function loadTable() {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    statusPegawai: statusPegawai,
                    statusPresensi: statusPresensi,
                    page: page,
                    paginate: paginate,
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

        function showPresensi(data, waktu) {
            if (waktu === 1) {
                $('.modal-title').html('Detail Presensi Pagi');
                $('#photoAbsen').attr('src', "{{ url('/disk') }}/" + new Date().getFullYear() + '/' + data.photo_masuk);
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
                $('#photoAbsen').attr('src', "{{ url('/disk') }}/" + new Date().getFullYear() + '/' + data.photo_pulang);
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
