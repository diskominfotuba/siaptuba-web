@extends('layouts.main')
@push('css')
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Basic Alerts -->
                <div class="col-md mb-md-0">
                    <div class="card mb-3">
                        <h5 class="card-header">Filter tugas harian</h5>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12 col-md-5">
                                    <select name="bulan" class="form-control" id="bulan">
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
                                </div>
                                <div class="col-12 col-md-5">
                                    <select name="" id="paginate" class="form-select">
                                        <option value="10">--data perhalaman--</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-2">
                                    <button class="btn btn-primary w-100" onclick="printAll()">Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="card-header">Tugas harian pegawai</h5>
                        <div class="card-body">
                            @include('layouts._loading')
                            <div class="table-responsive" id="dataTable">

                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Basic Alerts -->
            </div>
        </div>
        <div class="content-backdrop fade"></div>

        <div class="modal fade" id="showImage" tabindex="-1" aria-labelledby="showImageLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="showImageLabel">Data dukung tugas</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <img id="dataDukung" src="" alt="data-dukung" class="rounded" width="100%">
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        var search = '';
        var bulan = '';
        var page = 1;
        var paginate = '';
        $(document).ready(function() {
            loadTable();

            $('#search').on('keypress', function(e) {
                if (e.which == 13) {
                    filterTable();
                    return false;
                }
            });

            $('#paginate').change(function() {
                filterTable();
            });

            $('#bulan').change(function() {
                filterTable();
            });
        });

        function filterTable() {
            bulan = $('#bulan').val();
            paginate = $('#paginate').val();
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
                    bulan: bulan,
                    page: page,
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

        function printAll()
        {
            if(bulan == '') {
               swal({
                    title: 'Oops!',
                    text: 'Silakan pilih bulan terlebih dahulu!',
                    icon: 'error',
                });
                return;
            }
            window.location.href = "/oprator/tugas_harian/print_all?bulan="+bulan
        }

        function showImage(src)
        {
           $('#showImage').modal('show');
           $('#dataDukung').attr('src', src);
        }

        async function hapusTugas(id)
        {
            const willDelete = await swal({
            title: "Yakin?",
            text: "Apakah Anda yakin untuk mengahpus data ini?",
            icon: "warning",
            dangerMode: true,
            });

            if (willDelete) {
                let param = {
                url: '/oprator/tugas_harian/destroy/'+id,
                method: "POST",
                processData: false,
                contentType: false,
                cache: false,
                }

                await transAjax(param).then((result) => {
                    loadTable();
                    swal("Dihapus!", "Data berhasil dihapus", "success");
                }).catch((error) => {
                    swal("Opps!", "Internal server error!", "warning");
                });
            }
        }
    </script>
@endpush
