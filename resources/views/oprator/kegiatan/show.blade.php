@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-8 mb-md-0">
              <div class="card">
                  <h5 class="card-header">Form detail kegiatan</h5>
                  <hr>
                  <form id="updateKegiatan">
                    @method('PUT')
                  <div class="card-body">
                    <div class="from-group">
                        <label for="nama_kegiatan">Nama kegiatan</label>
                        <input type="text" class="form-control" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" readonly>
                    </div>
                    <div class="from-group mt-3">
                        <label for="nama_kegiatan">Deskripsi kegiatan</label>
                        <textarea type="text" class="form-control" readonly name="deskripsi_kegiatan">{{ $kegiatan->deskripsi_kegiatan }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="from-group mt-3">
                            <label for="tanggal_mulai">Tanggal mulai</label>
                            <input type="text" id="tanggal_mulai" class="form-control" name="tanggal_mulai" value="{{ Carbon\Carbon::parse($kegiatan->tanggal_mulai)->isoFormat('D MMMM Y') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="from-group mt-3">
                            <label for="jam_mulai">Jam mulai</label>
                            <input type="time" id="jam_mulai" class="form-control" name="jam_mulai" value="{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('H:i') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="from-group mt-3">
                            <label for="tanggal_akhir">Tanggal akhir</label>
                            <input type="text" id="tanggal_akhir" class="form-control" name="tanggal_akhir" value="{{ Carbon\Carbon::parse($kegiatan->tanggal_akhir)->isoFormat('D MMMM Y') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="from-group mt-3">
                            <label for="jam_akhir">Jam akhir</label>
                            <input type="time" id="jam_akhir" class="form-control" name="jam_akhir" value="{{ \Carbon\Carbon::parse($kegiatan->tanggal_akhir)->format('H:i') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="edit" class="btn btn-warning mt-3">Edit</button>
            <button id="btnLoading" class="btn btn-primary mt-3 d-none" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Tunggu sebentar yah...
            </button>
            <button type="submit" id="btnSubmit" class="btn btn-primary mt-3 d-none">Perbaharui</button>
            </form>
            </div>
            <div class="col-md-4 mb-md-0">
                <div class="card">
                    <h5 class="card-header">QR Code Kegiatan</h5>
                    <hr>
                    <div class="card-body">
                        <img src="{{ $qr }}" alt="qrcode" width="100%">
                    </div>
                </div>
                <div class="row g-1">
                    <div class="col-md-6">
                        <button data-bs-toggle="modal" data-bs-target="#sizeQR" class="btn btn-primary mt-3 w-100">Print QR Code</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ $qr }}" download="{{ $kegiatan->nama_kegiatan }}" class="btn btn-warning mt-3 w-100">Unduh</a>
                    </div>
                </div>
            </div>
            </div>
          </div>
      </div>
    <div class="content-backdrop fade"></div>
    <!-- Modal -->
    <div class="modal fade" id="sizeQR" tabindex="-1" aria-labelledby="sizeQRLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="sizeQRLabel">Custom ukuran QR Code</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="width">Lebar</label>
                    <input type="number" class="form-control" id="width" placeholder="400">
                </div>
                <div class="col-md-6">
                    <label for="height">Tinggi</label>
                    <input type="number" class="form-control" id="height" placeholder="400">
                </div>
                <span class="mt-3 text-muted">Ukuran normalnya adalah: Lebar 400, Tinggi 400, kosongkan jika ingin menggunakan ukuran normal</span>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" id="printQR" href="/oprator/kegiatan/print/qrcode/{{ $kegiatan->id }}" type="button" class="btn btn-primary">Print</button>
            </div>
        </div>
        </div>
    </div>
  </div>
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">

        $('#edit').click(function() {
            $('input').removeAttr('readonly');
            $('textarea').removeAttr('readonly');
            $('#tanggal_mulai').attr('type', 'date');
            $('#tanggal_akhir').attr('type', 'date');
            $('#btnSubmit').removeClass('d-none');
        });

        $('#updateKegiatan').on('submit', async function(e) {
          e.preventDefault();

          var form 	= $(this)[0]; 
          var data 	= new FormData(form);
          var param = {
            url: '/oprator/kegiatan/update/{{ $kegiatan->id }}',
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
                // window.location.href = '{{ url()->current() }}';
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

        $('#printQR').click(function() {
            var width = $('#width').val();
            var height = $('#height').val();
            var url = $(this).attr('href');
            if(width == '' && height == '') {
                window.open(url, '_blank');
            } else {
                window.open(url + '?width=' + width + '&height=' + height, '_blank');
            }

            $('#sizeQR').modal('hide');
        });
    </script>
@endpush

