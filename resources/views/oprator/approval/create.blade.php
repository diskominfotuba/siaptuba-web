@extends('layouts.main')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
                <div class="col-md-8 mb-4 mb-md-0">
                    <div class="card">
                        <h5 class="card-header">Pegawai</h5>
                        <div class="card-body">
                            @include('layouts._loading')
                            <div class="table-responsive text-nowrap" id="dataTable">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <form id="approval">
                        <div class="card">
                            <h5 class="card-header">Pemberi persetujuan</h5>
                            <div class="card-body">
                                @include('layouts._loading')
                                <div class="table-responsive text-nowrap" id="dataApproval">
                                    <select name="approval_id" class="form-control select2">
                                        <option value="">--pilih pemberi persetujuan--</option>
                                        @foreach ($approvals as $approval)
                                            <option value="{{ $approval->id }}">{{ $approval->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button id="btn_loading" class="btn btn-primary mt-3 d-none" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Tunggu sebentar yah...
                          </button>
                        <button id="btn_submit" class="btn btn-primary mt-3" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        var page = 1;
        var search = "";
        $(document).ready(function() {
            loadTable();
            $('.select2').select2();
        });

        $('#loadMore').click(function() {
            loadTable();
        });

        $("#search").on("keypress", function(e) {
            search = $('#search').val();
            if(e.which == 13) {
                loadTable();
                return false;
            }
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

            await transAjax(param).then((result) => {
                loading(false);
                $('#dataTable').html(result);
            }).catch((err) => {
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

            if(checkedValues.length === 0) {
                swal({
                    text: "Harap pilih pegawai",
                    icon: 'error',
                    timer: 3000,
                });
                return;
            }

            if(approvalId === "") {
                swal({
                    text: "Harap pilih pemberi persetujuan",
                    icon: 'error',
                    timer: 3000,
                });
                return;
            }

            var param = {
                url: '/oprator/approval/store',
                method: 'POST',
                data: {users: checkedValues, approval_id: approvalId},
            }

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                swal({
                    text: result.message,
                    icon: 'success',
                    timer: 3000,
                }).then(() => {
                    loading(false);
                    window.location.href = '{{ url()->current() }}';
                });
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

        function loadPaginate(to) {
            page = to
            loadTable();
        }
    </script>
@endpush
