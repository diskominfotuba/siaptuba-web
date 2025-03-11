@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('bkpp.master.kategori') }}">Kategori Layanan</a> / <a
                        href="{{ route('bkpp.master.layanan', $kategori->id) }}">{{ $kategori->nama_kategori }}</a>
                    /</span>
                Berkas {{ $layanan->nama_layanan }}
            </h4>
            <div class="row mb-4">
                <!-- Basic Alerts -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="card">
                        <div class="card-body">
                            <form id="formSubmit">
                                @csrf
                                <div class="row g-2">
                                    <div class="col mb-3">
                                        <label for="nameWithTitle" class="form-label">Nama Berkas</label>
                                        <input type="text" id="nama_input" name="nama_input" placeholder="SK PNS"
                                            class="form-control">
                                    </div>
                                </div>
                                <button id="btnLoading" class="btn btn-primary d-none" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Tunggu sebentar yaah...
                                </button>
                                <button id="btnSubmit" type="submit" class="btn btn-primary">Tambah Berkas</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--/ Basic Alerts -->
                <!-- Basic Alerts -->
                <div class="col-md-8 mb-4 mb-md-0">
                    <div class="card">
                        <h5 class="card-header">Berkas</h5>
                        <div class="card-body">
                            @include('layouts._loading')
                            <div class="table-responsive text-nowrap" id="dataTable">

                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Basic Alerts -->
            </div>
        </div>

        <div class="content-backdrop fade"></div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        let id_kategori = "";
        $(document).ready(function() {
            loadTable();
        });

        function loadingsubmit(state, btnSubmit, btnLoading) {
            if (state) {
                $('#' + btnSubmit).addClass('d-none');
                $('#' + btnLoading).removeClass('d-none');
            } else {
                $('#' + btnSubmit).removeClass('d-none');
                $('#' + btnLoading).addClass('d-none');
            }
        }

        async function loadTable() {
            let param = {
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    load: 'table'
                }
            }

            await transAjax(param).then((result) => {
                $("#dataTable").html(result);
            });
        }

        $("#formSubmit").submit(async function(e) {
            e.preventDefault();
            loadingsubmit(true, 'btnSubmit', 'btnLoading');

            //cek apakah id_kategori ada, jika ada arahakan url untuk update kategori
            //id_kategori di set pada function updateKategori
            if (id_kategori) {
                var _url = '/bkpp/kepegawaian/show/' + {{ $kategori->id }} + '/layanan/' + {{ $layanan->id }} +
                    '/update/' +
                    id_kategori;
            } else {
                var _url = '/bkpp/kepegawaian/show/' + {{ $kategori->id }} + '/layanan/' + {{ $layanan->id }} +
                    '/store';
            }

            let param = {
                url: _url,
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false
            }

            await transAjax(param).then((result) => {
                loadingsubmit(false, 'btnSubmit', 'btnLoading');
                swal({
                    title: 'Success',
                    text: result.message,
                    icon: 'success',
                    timer: 3000,
                });
                loadTable();
                $('#nama_input').val('');
                $('#btnSubmit').html("Tambah Berkas");
                id_kategori = "";
            }).catch((err) => {
                loadingsubmit(false, 'btnSubmit', 'btnLoading');
                swal({
                    title: "Opps!",
                    text: err.responseJSON.message,
                    icon: 'error',
                });
                if (err.responseJSON && err.responseJSON.errors) {
                    let errors = err.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        let errorElement = $('#error-' + key);
                        if (errorElement.length) {
                            errorElement.html(value[0]);
                        }
                    });
                } else {
                    loadingsubmit(false, 'btnSubmit', 'btnLoading');
                    swal({
                        title: "Opps!",
                        text: err.responseJSON.message,
                        icon: 'error',
                    });
                }
            });
        });

        // updateKategori
        function updateKategori(id, nama_input) {
            id_kategori = id;
            $('#nama_input').val(nama_input);
            $('#btnSubmit').html("<i class='bx bx-paper-plane'></i> Simpan perubahan");
        }

        async function updateStatus(input_id, e) {
            e.preventDefault();
            var param = {
                url: '/bkpp/kepegawaian/update_status/' + input_id,
                method: 'POST',
                data: "status",
                processData: false,
                contentType: false,
                cache: false,
            };

            try {
                const result = await transAjax(param);
                $('#notif').html(`<div class="alert alert-success">${result.message}</div>`);
                loadTable();
            } catch (err) {
                console.log(err);
                $('#notif').html(`<div class="alert alert-warning">${err.responseJSON.message}</div>`);
            }
        }

        async function hapusKategori(id) {
            const willDelete = await swal({
                title: "Yakin?",
                text: "Apakah Anda yakin untuk mengahpus data ini?",
                icon: "warning",
                dangerMode: true,
            });

            if (willDelete) {
                let param = {
                    url: '/bkpp/kepegawaian/show/' + {{ $kategori->id }} + '/layanan/' + {{ $layanan->id }} +
                        '/destroy/' + id,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                }

                await transAjax(param).then((result) => {
                    loadTable();
                    swal("Dihapus!", "Data ini berhasil dihapus", "success");
                }).catch((error) => {
                    swal("Opps!", "Internal server error!", "warning");
                });
            }
        }
    </script>
@endpush
