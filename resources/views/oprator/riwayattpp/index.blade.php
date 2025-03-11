@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Basic Alerts -->
                <div class="col-md mb-md-0">
                    <div class="card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-header">Data Riwayat TPP</h5>
                            <div class="card-header">
                                <div class="d-flex gap-2">
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="">--pilih bulan--</option>
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
                                    <a href="javascript:void(0)" onclick="printAll()" class="btn btn-primary">Print</a>
                                </div>
                            </div>
                        </div>
                        <hr>
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
    <script type="text/javascript">
        var search = '';
        var page = 1;
        var bulan = new Date().getMonth() + 1;
        $(document).ready(function() {
            loadTable();

            $('#search').on('keypress', function(e) {
                if (e.which == 13) {
                    filterTable();
                    return false;
                }
            });
        });

        $('#bulan').change(function() {
            filterTable();
        });

        function filterTable() {
            search = $('#search').val();
            bulan = $('#bulan').val();
            loadTable();
        }

        async function loadTable() {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    bulan: bulan,
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

        function printAll()
        {
            window.location.href = "/oprator/riwayattpp/print/all?bulan="+bulan
        }
    </script>
@endpush
