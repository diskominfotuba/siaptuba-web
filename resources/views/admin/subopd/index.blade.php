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
                <div class="mb-3">
                    <a href="/admin/subopd/create/" class="btn btn-primary mb-3">TAMBAH SUB OPD</a>
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-header">Filter OPD</h5>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <select name="opdId" id="opdId" class="form-select select2">
                                            <option value="">--filter by opd--</option>
                                            @foreach ($opds as $opd)
                                                <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select name="paginate" id="paginate" class="form-select">
                                            <option value="10">--data perhalaman--</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md mb-4 mb-md-0">
                    <div class="card">
                        @if (session('msg_delete_subopd'))
                        <div class="alert alert-danger">{{ session('msg_delete_subopd') }}</div>
                        @endif
                        <h5 class="card-header">DATA SUB OPD </h5>
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
    </div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        var search  = '';
        var page    = 1;
        var paginate = 15;
        var opdId   = '';
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

            $('.select2').select2({
                theme: 'bootstrap4',
            });
        });

        function filterTable() {
            search = $('#search').val();
            opdId = $('#opdId').val();
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
                    opdId: opdId,
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

        function loading(state) {
            if (state) {
                $('#loading').removeClass('d-none');
            } else {
                $('#loading').addClass('d-none');
            }
        }

        function loadPaginate(to) {
            page = to
            filterTable()
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
    </script>
@endpush
