@extends('layouts.general')
@push('css')
<style>
    .action-sheet-contents {
        max-height: 500px;
        overflow-y: auto;
    }

    .action-sheet-contents::-webkit-scrollbar {
        display: none;
    }

    .action-sheet-contents {
        scrollbar-width: none; /* Hilangkan scrollbar */
    }


</style>
@endpush
@section('content')
<div class="container mt-3">
    <div style="padding-top: 50px">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-primary font-weight-bold">Tugas harian, {{ \Illuminate\Support\Carbon::now()->translatedFormat('d F Y') }}</div>
            <a class="btn btn-primary btn-sm" href="/user/dashboard">&lt; kembali</a>
        </div>
        <hr>
    </div>
</div>
<div class="container">
    <div class="row mt-2">
        <div class="col-6">
            {{-- <a href="/user/presensi"> --}}
            <div class="stat-box" style="border-top: 3px solid #1e2a5e;">
                <div class="title">Tugas hari ini</div>
                <div class="value">{{ $tugas_hari_ini }}</div>
            </div>
            {{-- </a> --}}
        </div>
        <div class="col-6">
            {{-- <a href="/user/presensi"> --}}
            <div class="stat-box" style="border-top: 3px solid #1e2a5e;">
                <div class="title">Semua tugas</div>
                <div class="value">{{ $total_tugas }}</div>
            </div>
            {{-- </a> --}}
        </div>
    </div>
</div>
<div class="app-container section mt-3">
    <div class="card mb-3">
        <div class="card-header">
            <div>Filter tugas</div>
        </div>
        <div class="card-body">
            <div class="row">
                @if (auth()->user()->role == 'oprator')
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" placeholder="Cari pegawai" id="cari">
                </div>
                @endif
                <div class="col-6">
                    <select name="month" class="form-control" id="month">
                        <option value="">--bulan--</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="col-6">
                    <select name="paginate" class="form-control" id="paginate">
                        <option value="10">--halaman--</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="transactions" id="dataTable" style="margin-bottom: 85px">

    </div>
    <div class="app-container form-button-group transparent">
        <a href="#" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#createTask">Buat tugas sekarang</a>
    </div>
</div>


<div class="modal fade action-sheet" id="createTask" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form input tugas</h5>
            </div>
            <div class="modal-body mt-1">
                <div class="container action-sheet-contents">
                    <form id="formTask">
                        @csrf
                        <div class="form-group rounded">
                            <div class="input-wrapper">
                                <label for="nama_tugas">Nama tugas</label>
                                <input type="text" class="form-control" name="nama_tugas" required>
                            </div>
                        </div>
                        <div class="form-group rounded">
                            <div class="input-wrapper">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea type="text" class="form-control" name="deskripsi" required></textarea>
                            </div>
                        </div>
                        <div class="form-group rounded">
                            <label for="bukti_dukung">Bukti dukung</label>
                            <span id="webCameResult"></span>
                            <input type="hidden" name="base64" id="base64" value="">
                            <div class="webcam-capture d-none">
                                <img id="imgPrev" src="" alt="" width="100%">
                            </div>
                            <div class="row" id="containerFile">
                                <div class="col-6">
                                    <div class="input-wrapper">
                                        <div class="custom-file-button">
                                            <input type="file" name="bukti_dukung" id="fileInput" onchange="previewImg()" style="display: none;">
                                            <label for="fileInput" class="btn btn-outline-primary btn-block">pilih file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <button type="button" onclick="openCamera()" id="openKamera" class="btn btn-outline-primary btn-block">buka kamera</button>
                                </div>
                            </div>
                            <p><small>Hanya menerima file jpg,jpeg,png</small></p>
                        </div>
                        <div class="form-group basic">
                        <button id="loadingTask" class="btn btn-primary btn-lg btn-block d-none mb-2" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar yah...
                        </button>
                        </div>
                        <button id="btnCapture" type="button" class="btn btn-primary btn-block btn-lg mb-2 d-none">Ambil photo</button>
                        <button id="btnSubmit" type="submit" class="btn btn-primary btn-block btn-lg mb-2">Kirim tugas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade action-sheet" id="showTask" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail tugas</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="form-group rounded">
                        <div class="input-wrapper">
                            <label for="nama_tugas">Nama tugas</label>
                            <input id="nama_tugas" type="text" class="form-control" name="nama_tugas">
                        </div>
                    </div>
                    <div class="form-group rounded">
                        <div class="input-wrapper">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" type="text" class="form-control" name="deskripsi"></textarea>
                        </div>
                    </div>
                    <div class="form-group rounded">
                        <div class="input-wrapper">
                            <label for="bukti_dukung">Bukti dukung</label>
                            <div id="bukti_dukung">

                            </div>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary btn-block btn-lg" data-dismiss="modal">Tutup</button>
                            </div>
                            <div class="col-6">
                                <button type="button" id="idTugas" class="btn btn-danger btn-block btn-lg">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
    <script src="{{ asset('assets/pegawai') }}/js/webcamjs/webcam.min.js"></script>
    <script type="text/javascript">
    $('#dataTable').html(make_skeleton());

    var page = 1;
    var search = '';
    var month = '';
    var paginate = '10';
    var idTugas = '';

    $(document).ready(function() {
        getData();

        $('#month').change(function() {
            console.log($(this).val());

            month = $(this).val();
            filter();
        });

        $('#paginate').change(function() {
            paginate = $(this).val();
            filter();
        });

        $('#cari').keyup(function() {
            search = $(this).val();
            filter();
        });

        // $('#createTask').on('show.bs.modal', function() {
        //     changeRefreshStatus(false);
        // });

        $('#createTask').on('hidden.bs.modal', function() {
            Webcam.reset();
            changeRefreshStatus(true);
        });

        $('#showTask').on('show.bs.modal', function() {
            changeRefreshStatus(false);
        });

        $('#showTask').on('hidden.bs.modal', function() {
            changeRefreshStatus(true);
        });
    });

    function filter() {
        search = $('#cari').val();
        paginate = $('#paginate').val();
        $('#dataTable').html(make_skeleton());
        getData();
    }

    async function getData()
    {
        var param = {
            url: "{{ url()->current() }}",
            method: "GET",
            data: {
                load: 'table',
                page: page,
                search: search,
                month: month,
                paginate: paginate
            }
        }

        await transAjax(param).then((result) => {
            $('#dataTable').html(result);
        });
    }

    $('#formTask').submit(async function(e) {
        e.preventDefault();
        loadingsubmit(true);

        var data = new FormData(this);
        var param = {
            url: '/user/ekin/store',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false
        }

        await transAjax(param).then((res) => {
            $('#createTask').modal('hide');
            swal({
                text: res.message,
                icon: 'success',
                timer: 3000,
            }).then(() => {
                loadingsubmit(false);
                changeRefreshStatus(true);
                window.location.href = '{{ url()->current() }}';
            });
        }).catch((err) => {
            loadingsubmit(false);
            $('#createTask').modal('hide');
            swal({
                text: err.responseJSON.message,
                icon: 'error',
            });
        });

        function loadingsubmit(state) {
            if (state) {
                $('#btnSubmit').addClass('d-none');
                $('#loadingTask').removeClass('d-none');
            } else {
                $('#btnSubmit').removeClass('d-none');
                $('#loadingTask').addClass('d-none');
            }
        }
    });

    async function showTask(id)
        {
            var param = {
                url: '/user/ekin/show/'+id,
                method: 'GET'
            }

            await transAjax(param).then((result) => {
                const data = JSON.parse(result.metadata);

                $('#nama_tugas').val(data.nama_tugas);
                $('#deskripsi').val(data.deskripsi);
                idTugas = data.id;

                const fileExtension = data.bukti_dukung.split('.').pop().toLowerCase();
                const year = new Date().getFullYear();

                if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
                    // Tampilkan gambar jika ekstensi cocok
                    $('#bukti_dukung').html(`
                        <img src="/ekin/${data.opd_id}/${year}/${data.bukti_dukung}" width="100%" alt="bukti_dukung" class="rounded">
                    `);
                } else {
                    // Opsi tambahan jika file tidak sesuai dengan format gambar
                    $('#bukti_dukung').html('<p>Format file tidak didukung untuk pratinjau.</p>');
                }
            });
        }

        function loadPaginate(to) {
            page = to
            filter()
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

    function openCamera() {
        $('.webcam-capture').removeClass('d-none');
        $('#openKamera').attr('disabled', 'disabled');
        $('#webCameResult').html('');
        Webcam.set({
            width: 490,
            height: 450,
            image_format: 'jpeg',
            jpeg_quality: 75,
        });

        var cameras = new Array();
        navigator.mediaDevices.enumerateDevices()
            .then(function(devices) {
                devices.forEach(function(device) {
                    var i = 0;
                    if (device.kind === "videoinput") {
                        cameras[i] = device.deviceId;
                        i++;
                    }
                });
            })
        Webcam.set('constraints', {
            width: 490,
            height: 450,
            image_format: 'jpeg',
            jpeg_quality: 90,
            sourceId: cameras[0]
        });

        Webcam.attach('.webcam-capture');
        $('#btnCapture').removeClass('d-none');
        $('#btnSubmit').addClass('d-none');
    }

    $('#btnCapture').click(function() {
        // shutter.play();
        Webcam.snap(function(data_uri) {
            $('#webCameResult').html(
                `<img class="x-img-fluid" id="imageprev" style="border-radius: 15px; object-fit: cover;" src="${data_uri}"/>`
            );
            Webcam.reset();
            $('#openKamera').removeAttr('disabled', 'disabled');
            $('#openKamera').html('photo ulang');
            $('#base64').attr('value', data_uri);
            $('#btnCapture').addClass('d-none');
            $('#btnSubmit').removeClass('d-none');
        });
        changeRefreshStatus(false);
    });

    $('#fileInput').click(function() {
        $('#openKamera').removeAttr('disabled');
        Webcam.reset();
        $('.webcam-capture').append('<img id="imgPrev" src="" alt="" width="100%">');
    });

    function previewImg(){
        $('.webcam-capture').removeClass('d-none');
        const imgPreview = document.querySelector('#imgPrev');
        const image = document.querySelector('#fileInput');
        const blob = URL.createObjectURL(image.files[0]);
        imgPreview.src = blob;
        changeRefreshStatus(false);
    }

    $('#idTugas').click(function() {
        $('#showTask').modal('hide');
        swal({
            title: "Apakah anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var param = {
                    url: '/user/ekin/destroy/'+idTugas,
                    method: 'POST',
                }

                transAjax(param).then((res) => {
                    swal({
                        text: res.message,
                        icon: 'success',
                        timer: 3000,
                    }).then(() => {
                        window.location.href = '{{ url()->current() }}';
                    });
                }).catch((err) => {
                    swal({
                        text: err.responseJSON.message,
                        icon: 'error',
                    });
                });
            }
        });
    });
    </script>
@endpush
