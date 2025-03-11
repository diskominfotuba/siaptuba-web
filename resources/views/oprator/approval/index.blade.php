@extends('layouts.main')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
                <div class="col-md-12 mb-4 mb-md-0">
                    <a href="{{ route('oprator.approval.create') }}" class="btn btn-primary mb-3">Tambah pemberi
                        persetujuan</a>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#updateModal">Update Pemberi
                        Persetujuan</button>

                    <!-- Modal -->
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
                        <form id="approval">
                            @csrf
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="opratorModalTitle">Tambah Oprator</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <span id="notif"></span>
                                        <div class="col">
                                            <label for="password" class="form-label">Pemberi Persetujuan</label>
                                            <select name="approval_id" class="form-control select2">
                                                <option value="">-- Pilih Pemberi Persetujuan --</option>
                                                @foreach ($approvals as $approval)
                                                    <option value="{{ $approval->id }}">{{ $approval->nama }}</option>
                                                @endforeach
                                            </select>
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

                    <div class="card">
                        <h5 class="card-header">List Pegawai & Pemberi Persetujuan</h5>
                        <div class="card-body">
                            @include('layouts._loading')
                            <div class="table-responsive text-nowrap" id="dataUser">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nama</th>
                                            <th>Unit Organisasi</th>
                                            <th>Pemberi persetujuan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
         var page = 1;
         var search = "";
        $(document).ready(function() {
            loadTable();
            $('.select2').select2({
                theme: 'bootstrap4',
                dropdownParent: $("#updateModal")
            });
        });

        $("#search").on("keypress", function(e) {
            search = $('#search').val();
            if(e.which == 13) {
                loadTable();
                return false;
            }
        });
        
        $('#loadMore').click(function() {
            loadTable();
        });

        async function loadTable() {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    search: search,
                    page: page
                }
            }

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                $('#dataTable').html(result);
                $('#loadMore').data('page', page + 1);
            }).catch((err) => {
                loading(false);
                console.log(err);
            })
        }

        $('#approval').on('submit', async function store(e) {
            e.preventDefault();

            let checkedValues = [];
            let approvalId = $('select[name=approval_id]').val();

            $('input.form-check-input:checked').each(function() {
                checkedValues.push($(this).val());
            });

            if (checkedValues.length === 0) {
                swal({
                    text: "Harap pilih pegawai",
                    icon: 'error',
                    timer: 3000,
                });
                return;
            }

            if (approvalId === "") {
                swal({
                    text: "Harap pilih pemberi persetujuan",
                    icon: 'error',
                    timer: 3000,
                });
                return;
            }

            var param = {
                url: '/oprator/approval/update',
                method: 'POST',
                data: {
                    users: checkedValues,
                    approval_id: approvalId
                },
            }

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                swal({
                    text: result.message,
                    icon: 'success',
                    timer: 3000,
                })
                $('#updateModal').modal('hide');
                loadTable();
            }).catch((err) => {
                console.log(err.responseJSON.message);
            });
        });

        function loading(state) {
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
