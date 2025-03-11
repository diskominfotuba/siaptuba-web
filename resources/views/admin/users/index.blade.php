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
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#opratorModal">Tambah Pegawai</button>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#importPegawai">Import Pegawai</button>
                <a href="/admin/export/user" class="btn btn-primary mb-3">Export Pegawai</a>
                <div class="col-md-12 mb-3">
                  <div class="card">
                      <h5 class="card-header">Filter pegawai</h5>
                      <div class="card-body">
                          <div class="row g-3">
                              <div class="col-12 col-md-4">
                                  <select name="opdId" id="opdId" class="form-select select2">
                                      <option value="">--filter by opd--</option>
                                      @foreach ($opds as $opd)
                                          <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col-12 col-md-4">
                                  <select name="statusPegawai" id="statusPegawai" class="form-select">
                                      <option value="asn">--by status--</option>
                                      <option value="asn">ASN</option>
                                      <option value="non_asn">NON ASN</option>
                                  </select>
                              </div>
                              <div class="col-12 col-md-4">
                                  <select name="paginate" id="paginate" class="form-select">
                                      <option value="15">--data perhalaman--</option>
                                      <option value="25">25</option>
                                      <option value="50">50</option>
                                      <option value="100">100</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                <div class="card">
                  <h5 class="card-header">DATA PEGAWAI</h5>
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
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
              <span id="notif"></span>
              <div class="row g-2">
                <div class="col mb-3">
                  <label for="nameWithTitle" class="form-label">Nama</label>
                  <input
                    name="nama"
                    type="text"
                    id="name"
                    class="form-control"
                    placeholder="Masukan nama lengkap"
                  />
                </div>
                <div class="col mb-3">
                  <label for="nameWithTitle" class="form-label">NIP</label>
                  <input
                    name="nip"
                    type="text"
                    id="nip"
                    class="form-control"
                    placeholder="Masukan NIP"
                  />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-3">
                  <label for="nameWithTitle" class="form-label">Jabatan</label>
                  <input
                    name="jabatan"
                    type="text"
                    id="jabatan"
                    class="form-control"
                    placeholder="Masukan Jabatan"
                  />
                </div>
                <div class="col mb-3">
                  <label for="nameWithTitle" class="form-label">Organisasi</label>
                  <input
                    name="organisasi"
                    type="text"
                    id="organisasi"
                    class="form-control"
                    value="{{ auth()->user()->opd->nama_opd }}"
                    readonly
                  />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-3">
                  <label for="nameWithTitle" class="form-label">Unit Organisasi</label>
                  <input
                    name="unit_organisasi"
                    type="text"
                    id="unit_organisasi"
                    class="form-control"
                    placeholder="Masukan unit organisasi"
                  />
                </div>
                <div class="col mb-3">
                  <label for="nameWithTitle" class="form-label">No Tlp/WhatsApp</label>
                  <input
                    name="no_hp"
                    type="text"
                    id="no_hp"
                    class="form-control"
                    placeholder="Masukan no tlp"
                  />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    name="email"
                    type="email"
                    id="email"
                    class="form-control"
                    placeholder="Masukan email"
                  />
                </div>
                <div class="col mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input
                    name="password"
                    type="text"
                    id="password"
                    class="form-control"
                    placeholder="Masukan password"
                  />
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
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
              <span id="notif"></span>
              <div class="row g-2">
                <div class="col mb-3">
                  <label for="nameWithTitle" class="form-label">File Excel</label>
                  <input
                    name="file_excel"
                    type="file"
                    id="name"
                    class="form-control"
                  />
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                  </button>
                  <button id="btn_loading_import" class="btn_loading btn btn-primary d-none" type="button" disabled>
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
        var opdId   = '';
        var statusPegawai = 'asn';
        $(document).ready(function() {
            loadTable();

            $('#search').on('keypress', function(e) {
                if(e.which == 13) {
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

        async function loadTable()
        {
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

        $('#storeOprator').on('submit', async function store(e) {
          e.preventDefault();

          var form 	= $(this)[0]; 
          var data 	= new FormData(form);
          var param = {
            url: '/admin/pegawai/store',
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

        $('#import').on('submit', async function store(e) {
          e.preventDefault();

          var form 	= $(this)[0]; 
          var data 	= new FormData(form);
          var param = {
              url: '/admin/importuser',
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

        $('#name').on('click', function() {
          $('#notif').html('');
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

