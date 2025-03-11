@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md mb-md-0">
              <div class="card">
                  <h5 class="card-header">Form tambah kegiatan</h5>
                  <hr>
                  <form id="submitKegiatan">
                  <div class="card-body">
                    <div class="from-group">
                        <label for="nama_kegiatan">Nama kegiatan</label>
                        <input type="text" class="form-control" name="nama_kegiatan" required>
                    </div>
                    <div class="from-group mt-3">
                        <label for="nama_kegiatan">Tempat kegiatan</label>
                        <input type="text" class="form-control" name="deskripsi_kegiatan" required></input>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="from-group mt-3">
                            <label for="tanggal_mulai">Tanggal mulai</label>
                            <input type="date" class="form-control" name="tanggal_mulai" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="from-group mt-3">
                            <label for="jam_mulai">Jam mulai</label>
                            <input type="time" class="form-control" name="jam_mulai" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="from-group mt-3">
                            <label for="tanggal_akhir">Tanggal akhir</label>
                            <input type="date" class="form-control" name="tanggal_akhir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="from-group mt-3">
                            <label for="jam_mulai">Jam akhir</label>
                            <input type="time" class="form-control" name="jam_akhir" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button id="btnLoading" class="btn btn-primary mt-3 d-none" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar yah...
            </button>
            <button type="submit" id="btnSubmit" class="btn btn-primary mt-3">Buat kegiatan</button>
            </form>
            </div>
          </div>
      </div>
    <div class="content-backdrop fade"></div>
  </div>
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        $('#submitKegiatan').on('submit', async function store(e) {
          e.preventDefault();

          var form 	= $(this)[0]; 
          var data 	= new FormData(form);
          var param = {
            url: '/oprator/kegiatan/store',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
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
                window.location.href = '/oprator/kegiatan';
            });
          }).catch((err) => {
            loading(false);
            swal({
                text: err.responseJSON.message,
                icon: 'error',
                timer: 3000,
            });
          });
        });

        function loading(state)
        {
            if(state) {
                $('#btnLoading').removeClass('d-none');
                $('#btnSubmit').addClass('d-none');
            } else {
                $('#btnLoading').addClass('d-none');
                $('#btnSubmit').removeClass('d-none');
            }
        }
    </script>
@endpush

