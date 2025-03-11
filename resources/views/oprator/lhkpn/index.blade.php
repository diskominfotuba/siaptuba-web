@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
                <!-- Basic Alerts -->
                <div class="col-md mb-4 mb-md-0">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importLhkpn">Import file</button>
                    <button class="btn btn-danger" onclick="hapusDataLhkpn()">Hapus semua data</button>
                    <div class="card mt-3">
                        <h5 class="card-header">Daftar wajib LHKPN yang belum menyelesaikan pengisian </h5>
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
        <div class="modal fade" id="importLhkpn" tabindex="-1" aria-hidden="true">
            <form id="import">
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="opratorModalTitle">Daftar Jabatan Wajib LHKPN 2024</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span id="notif"></span>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Pilih file excel</label>
                                    <input name="file_lhkpn" type="file" id="name" class="form-control" />
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
    <div class="modal fade" id="modalEditLhkpn" tabindex="-1" aria-hidden="true">
        <form id="updateDataLhkpn">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="opratordModalTitle">Edit data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="notif"></span>
                        <div class="row g-2">
                            <div class="col mb-2">
                                <label for="nameWithTitle" class="form-label">Unit Organisasi</label>
                                <input name="td_1" type="text" id="td_1" class="form-control" />
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-2">
                                <label for="nameWithTitle" class="form-label">Jabatan</label>
                                <input name="td_2" type="text" id="td_2" class="form-control" />
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-2">
                                <label for="nameWithTitle" class="form-label">Jumlah</label>
                                <input name="td_3" type="text" id="td_3" class="form-control" />
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
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        var search = '';
        var page = 1;
        $(document).ready(function() {
            loadTable();

            $('#search').on('keypress', function(e) {
                if (e.which == 13) {
                    filterTable();
                    return false;
                }
            });
        });

        function filterTable() {
            search = $('#search').val();
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

        $('#import').on('submit', async function store(e) {
            e.preventDefault();

            var form = $(this)[0];
            var data = new FormData(form);
            var param = {
                url: '/oprator/lhkpn/import_data',
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
                $('#importLhkpn').modal('hide');
                loadTable();
            }).catch((err) => {
                $('#importLhkpn').modal('hide');
                loadingBtn(false, 'btn_submit_import', 'btn_loading_import');
                swal({
                    title: 'Oops!',
                    text: err.responseJSON.message,
                    icon: 'error',
                });
            });
        });

        let id_lhkpn;
        function editDataLhkpn(element)
        {
            id_lhkpn    = $(element).data('id');
            const td_1  = $(element).data('td_1');
            const td_2  = $(element).data('td_2');
            const td_3  = $(element).data('td_3');

            $('#modalEditLhkpn').modal('show');
            $('#td_1').val(td_1);
            $('#td_2').val(td_2);
            $('#td_3').val(td_3);
        }

        $('#updateDataLhkpn').submit(async function (e) {
            e.preventDefault();

            var form = $(this)[0];
            var data = new FormData(form);
            var param = {
                url: '/oprator/lhkpn/update/'+id_lhkpn,
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
            }

            await transAjax(param).then((result) => {
                loadTable();
                $('#modalEditLhkpn').modal('hide');
                swal({
                    title: 'Berhasil',
                    text: result.message,
                    icon: 'success',
                    timer: 3000,
                });
            }).catch((err) => {
                console.log(err);
                swal({
                    title: 'Oops!',
                    text: err.responseJSON.message,
                    icon: 'error',
                });
            });
        });

        async function hapusData(id)
        {
            const willDelete = await swal({
            title: "Yakin?",
            text: "Apakah Anda yakin untuk mengahpus data ini?",
            icon: "warning",
            dangerMode: true,
            });

            var param = {
                url: '/oprator/lhkpn/delete/'+id,
                method: 'POST',
            }

            await transAjax(param).then((result) => {
                swal({
                    title: 'Berhasil',
                    text: result.message,
                    icon: 'success',
                    timer: 3000,
                });
                loadTable();
            }).catch((err) => {
                console.log(err);
                swal({
                    title: 'Oops!',
                    text: err.responseJSON.message,
                    icon: 'error',
                });
            });
        }

        async function hapusDataLhkpn()
        {
            const willDelete = await swal({
            title: "Yakin?",
            text: "Apakah Anda yakin untuk mengahpus semua data ini?",
            icon: "warning",
            dangerMode: true,
            });

            var param = {
                url: '/oprator/lhkpn/delete_all_data',
                method: 'POST',
            }

            await transAjax(param).then((result) => {
                console.log(result);

                swal({
                    title: 'Berhasil',
                    text: result.message,
                    icon: 'success',
                    // timer: 3000,
                });
                loadTable();
            }).catch((err) => {
                console.log(err);
                swal({
                    title: 'Oops!',
                    text: err.responseJSON.message,
                    icon: 'error',
                });
            });
        }

        function action(state) {
            if (state) {
                $('#btn_loading').removeClass('d-none');
                $('#btn_submit').addClass('d-none');
            } else {
                $('#btn_loading').addClass('d-none');
                $('#btn_submit').removeClass('d-none');
            }
        }

        function loadingBtn(state, btn_submit, btn_loading) {
            if (state) {
                $('#' + btn_submit).hide();
                $('#' + btn_loading).removeClass('d-none');
            } else {
                $('#' + btn_submit).show();
                $('#' + btn_loading).addClass('d-none');
            }
        }
    </script>
@endpush
