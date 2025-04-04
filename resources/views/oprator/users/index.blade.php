@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
                <!-- Basic Alerts -->
                <div class="col-md mb-4 mb-md-0">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Informasi!</h4>
                        <p>Secara default status pegawai adalah <span class="fw-bold">ASN</span>. Silakan update status pegawai yang bukan <span class="fw-bold">ASN</span> menjadi <span class="fw-bold">NON ASN</span></p>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card">
                                <h5 class="card-header">Filter pegawai</h5>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <select name="" id="status" class="form-control">
                                                <option value="">--status pegawai--</option>
                                                <option value="asn">ASN</option>
                                                <option value="non_asn">NON ASN</option>
                                                <option value="to">Tenaga Outsorcing</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select name="" id="paginate" class="form-control">
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
                        <div class="col-md-6">
                            <div class="card">
                                <h5 class="card-header">Tambah pegawai</h5>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#opratorModal">Tambah
                                                Pegawai</button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#importPegawai">Import
                                                Pegawai</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    <div class="card">
                        <h5 class="card-header">Pegawai </h5>
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
        <!-- Modal -->
        <div class="modal fade" id="opratorModal" tabindex="-1" aria-hidden="true">
            <form id="storeOprator">
                @csrf
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="opratorModalTitle">Tambah Pegawai</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span id="notif"></span>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Nama</label>
                                    <input name="nama" type="text" id="name" class="form-control"
                                        placeholder="Masukan nama lengkap" />
                                </div>
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">NIP</label>
                                    <input name="nip" type="text" id="nip" class="form-control"
                                        placeholder="Masukan NIP" />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Jabatan</label>
                                    <input name="jabatan" type="text" id="jabatan" class="form-control"
                                        placeholder="Masukan Jabatan" />
                                </div>
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Organisasi</label>
                                    <input name="organisasi" type="text" id="organisasi" class="form-control"
                                        value="{{ auth()->user()->opd->nama_opd }}" readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Unit Organisasi</label>
                                    <input name="unit_organisasi" type="text" id="unit_organisasi" class="form-control"
                                        placeholder="Masukan unit organisasi" />
                                </div>
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">No Tlp/WhatsApp</label>
                                    <input name="no_hp" type="text" id="no_hp" class="form-control"
                                        placeholder="Masukan no tlp" />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="email" id="email" class="form-control"
                                        placeholder="Masukan email" />
                                </div>
                                <div class="col mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input name="password" type="text" id="password" class="form-control"
                                        placeholder="Masukan password" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Tutup
                            </button>
                            @include('layouts._button')
                            <button id="btn_submit" type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal fade" id="importPegawai" tabindex="-1" aria-hidden="true">
            <form id="import">
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="opratorModalTitle">Tambah Pegawai</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span id="notif"></span>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">File Excel</label>
                                    <input name="file_excel" type="file" id="name" class="form-control" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Tutup
                                </button>
                                <button id="btn_loading_import" class="btn_loading btn btn-primary d-none" type="button"
                                    disabled>
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    Loading...
                                </button>
                                <button id="btn_submit_import" type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
        <div class="content-backdrop fade"></div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        var search = '';
        var page = 1;
        var status = '';
        var paginate = 10;
        $(document).ready(function() {
            loadTable();

            $('#search').on('keypress', function(e) {
                if (e.which == 13) {
                    filterTable();
                    return false;
                }
            });

            $('#status').change(function() {
                filterTable();
            });

            $('#paginate').change(function() {
                filterTable();
            });
        });

        function filterTable() {
            search = $('#search').val();
            status = $('#status').val();
            paginate = $('#paginate').val();
            loadTable();
        }

        async function loadTable() {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    search: search,
                    page: page,
                    status: status,
                    paginate: paginate,
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

        $('#storeOprator').on('submit', async function store(e) {
            e.preventDefault();

            var form = $(this)[0];
            var data = new FormData(form);
            var param = {
                url: '/oprator/pegawai/store',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
            }

            action(true);
            await transAjax(param).then((result) => {
                action(false);
                $('#notif').html(`<div class="alert alert-success">${result.message}</div>`);
                loadTable();
            }).catch((err) => {
                action(false);
                console.log(err);
                $('#notif').html(`<div class="alert alert-warning">${err.responseJSON.message}</div>`);
            });
        });

        $('#name').on('click', function() {
            $('#notif').html('');
        });

        $('#import').on('submit', async function store(e) {
            e.preventDefault();

            var form = $(this)[0];
            var data = new FormData(form);
            var param = {
                url: '/oprator/importuser',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
            }

            loadingBtn(true, 'btn_submit_import', 'btn_loading_import');
            await transAjax(param).then((result) => {
                loadingBtn(false, 'btn_submit_import', 'btn_loading_import');
                swal({
                    title: 'Berhasil',
                    text: result.message,
                    icon: 'success',
                    timer: 3000,
                });
                $('#importPegawai').modal('hide');
                loadTable();
            }).catch((err) => {
                $('#importPegawai').modal('hide');
                loadingBtn(false, 'btn_submit_import', 'btn_loading_import');
                swal({
                    title: 'Oops!',
                    text: err.responseJSON.message,
                    icon: 'error',
                    timer: 3000,
                });
            });
        });

        function action(state) {
            if (state) {
                $('#btn_loading').removeClass('d-none');
                $('#btn_submit').addClass('d-none');
            } else {
                $('#btn_loading').addClass('d-none');
                $('#btn_submit').removeClass('d-none');
            }
        }

        async function updateStatusPegawai(value, id)
        {
            var param = {
                url: '/oprator/statuspegawai/update?status_pegawai='+value+'&user_id='+id,
                method: 'POST',
            }

            await transAjax(param).then((result) => {
                loadTable();
            }).catch((err) => {
                console.log(err);
                // swal({
                //     title: 'Oops!',
                //     text: err.responseJSON.message,
                //     icon: 'error',
                //     timer: 3000,
                // });
            });
        }
    </script>
@endpush
