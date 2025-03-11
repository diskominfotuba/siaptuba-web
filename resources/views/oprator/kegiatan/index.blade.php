@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Basic Alerts -->
            <div class="col-md mb-md-0">
              <a href="{{ route('oprator.kegiatan.create') }}" class="btn btn-primary mb-2">Buat kegiatan baru</a>
              <div class="card">
                  <h5 class="card-header">List kegiatan</h5>
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
                if(e.which == 13) {
                    filterTable();
                    return false;
                }
            });
        });

        function filterTable() {
            search = $('#search').val();
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

          var form 	= $(this)[0]; 
          var data 	= new FormData(form);
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

          var form 	= $(this)[0]; 
          var data 	= new FormData(form);
          var param = {
              url: '/oprator/importuser',
              method: 'POST',
              data: data,
              processData: false,
              contentType: false,
              cache: false,
          }

          loadingBtn(true,'btn_submit_import', 'btn_loading_import');
          await transAjax(param).then((result) => {
            loadingBtn(false,'btn_submit_import', 'btn_loading_import');
            swal({ title: 'Berhasil', text: result.message, icon: 'success', timer: 3000, });
            $('#importPegawai').modal('hide');
            loadTable();
          }).catch((err) => {
            $('#importPegawai').modal('hide');
            loadingBtn(false,'btn_submit_import', 'btn_loading_import');
            swal({ title: 'Oops!', text: err.responseJSON.message, icon: 'error', timer: 3000, });
          });
        });

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
    </script>
@endpush

