@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Basic Alerts -->
            <div class="col-md mb-md-0">
                <div class="card">
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        <span>List daftar hadir kegiatan</span>
                        <div class="d-flex align-items-center">
                            <select name="opd" id="opd" class="form-control me-2" style="width: auto;">
                                <option value="">--tampilkan nama opd--</option>
                                <option value="Y">Ya</option>
                                <option value="N">Tidak</option>
                            </select>
                            <a href="javascript:void(0)" id="print" class="btn btn-primary">
                                <i class='bx bx-printer'></i> Print
                            </a>
                        </div>
                    </h5>
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
    <script type="text/javascript">
        var search = '';
        var page = 1;
        var opd = "";

        $(document).ready(function() {
            loadTable();

            $('#search').on('keypress', function(e) {
                if(e.which == 13) {
                    filterTable();
                    return false;
                }
            });
        });

        $('#opd').change(function() {
            filterTable();
        });

        function filterTable() {
            search = $('#search').val();
            opd = $('#opd').val();
            loadTable();
        }

        async function loadTable()
        {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    search: search,
                    page: page,
                    opd: opd,
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

        function action(state)
        {
            if(state) {
                $('#btn_loading').removeClass('d-none');
                $('#btn_submit').addClass('d-none');
            } else {
                $('#btn_loading').addClass('d-none');
                $('#btn_submit').removeClass('d-none');
            }
        }

        // {{ route('oprator.kegiatan.print', ['id' => $idKegiatan]) }}
        $('#print').click(function() {
            window.location.href = '/oprator/kegiatan/print/page/{{ $idKegiatan }}?opd='+opd;
        });
    </script>
@endpush

