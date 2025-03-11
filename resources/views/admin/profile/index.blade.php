@extends('layouts.main')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
                <!-- Basic Alerts -->
                <div class="mb-4 mb-md-0">
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#importPegawai">Import
                        Profile</button>
                        {{-- <div class="card">
                            <h5 class="card-header">Master Presensi</h5>
                            <div class="card-body">
                                ok
                            </div>
                        </div> --}}
                    <div class="card">
                        <h5 class="card-header">DATA PROFILE PEGAWAI</h5>
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

        {{-- modal detail profile --}}
        <div class="modal fade" id="modalProfile" tabindex="-1" aria-labelledby="modalProfileLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalProfileLabel">Detail profile pegawai</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="button" class="btn btn-primary">Simpan perubahan</button>
                </div>
              </div>
            </div>
          </div>
        {{-- modal detail profile --}}

        <div class="modal fade" id="importPegawai" tabindex="-1">
            <form id="import">
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="opratorModalTitle">Tambah Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span id="notif"></span>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">File Excel</label>
                                    <input name="file" type="file" id="name" class="form-control" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Tutup
                                </button>
                                <button id="btn_loading_import" class="btn_loading btn btn-primary d-none" type="button"
                                    disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var search = '';
        var page = 1;
        var paginate = 15;
        var opdId = '';
        var statusPegawai = 'asn';
        $(document).ready(function() {
            loadTable();

            $('#search').on('keypress', function(e) {
                if (e.which == 13) {
                    filterTable();
                    return false;
                }
            });

            $('#opdId').change(function() {
                filterTable();
            });

            $('#paginate').change(function() {
                filterTable();
            });

            $('#statusPegawai').change(function() {
                filterTable();
            });

            $('.select2').select2({
                theme: 'bootstrap4',
            });
        });

        function filterTable() {
            search = $('#search').val();
            opdId = $('#opdId').val();
            paginate = $('#paginate').val();
            statusPegawai = $('#statusPegawai').val();
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
                    opd_id: opdId,
                    paginate: paginate,
                    status_pegawai: statusPegawai
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

        $('#modalProfile').on('show.bs.modal', async function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            
            var modal = $(this);

            var param = {
                url: '/admin/profile/show/' + id,
                method: 'GET',
                data: {
                    load: 'modal',
                    id: id
                }
            }

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                modal.find('.modal-body').html(result);
            }).catch((err) => {
                loading(false);
                console.log(err);
            });
        });
        
        $('#import').on('submit', async function store(e) {
            e.preventDefault();

            var form = $(this)[0];
            var data = new FormData(form);
            var param = {
                url: '/admin/profile/import',
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
                console.log(err);

                swal({
                    title: 'Oops!',
                    text: err.responseJSON.message,
                    icon: 'error',
                    // timer: 3000,
                });
            });
        });

        $('#name').on('click', function() {
            $('#notif').html('');
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
    </script>
@endpush
