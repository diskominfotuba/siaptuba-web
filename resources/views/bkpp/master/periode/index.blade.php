@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('bkpp.master.kategori') }}">Kategori Layanan</a> / <a
                        href="{{ route('bkpp.master.layanan', $layanan->kategori_id) }}">{{ $layanan->kategori->nama_kategori }}</a>
                    /</span>
                Periode {{ $layanan->nama_layanan }}
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
                                        <label for="nameWithTitle" class="form-label">Nama Periode</label>
                                        <input type="text" id="nama_periode" name="nama_periode"
                                            placeholder="Periode 2025 Tahap II" class="form-control">
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-3">
                                        <label for="nameWithTitle" class="form-label">Mulai</label>
                                        <input type="date" id="mulai" name="mulai" placeholder="SK PNS"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-3">
                                        <label for="nameWithTitle" class="form-label">Berakhir</label>
                                        <input type="date" id="berakhir" name="berakhir" placeholder="SK PNS"
                                            class="form-control">
                                    </div>
                                </div>
                                <button id="btnLoading" class="btn btn-primary d-none" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Tunggu sebentar yaah...
                                </button>
                                <button id="btnSubmit" type="submit" class="btn btn-primary">Tambah Periode</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--/ Basic Alerts -->
                <!-- Basic Alerts -->
                <div class="col-md-8 mb-4 mb-md-0">
                    <div class="card">
                        <h5 class="card-header">Periode</h5>
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
                var _url = '/bkpp/kepegawaian/show/' + {{ $layanan->kategori_id }} + '/layanan/' +
                    {{ $layanan->id }} +
                    '/periode/update/' +
                    id_kategori;
            } else {
                var _url = '/bkpp/kepegawaian/show/' + {{ $layanan->kategori_id }} + '/layanan/' +
                    {{ $layanan->id }} +
                    '/periode/store';
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
                $('#nama_periode').val('');
                $('#mulai').val('');
                $('#berakhir').val('');
                $('#btnSubmit').html("Tambah Periode");
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
        function updateKategori(id, nama_periode, mulai, berakhir) {
            id_kategori = id;
            $('#nama_periode').val(nama_periode);
            $('#mulai').val(mulai);
            $('#berakhir').val(berakhir);
            $('#btnSubmit').html("<i class='bx bx-paper-plane'></i> Simpan perubahan");
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
                    url: '/bkpp/kepegawaian/show/' + {{ $layanan->kategori_id }} + '/layanan/' +
                        {{ $layanan->id }} +
                        '/periode/destroy/' + id,
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
