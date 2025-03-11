@extends('layouts.general')
@section('content')
    <div class="container mt-3" style="padding-bottom: 10px">
        <div style="padding-top: 50px">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary font-weight-bold">Detail permohonan izin/cuti</div>
                <a class="btn btn-primary btn-sm" href="/user/apps">&lt; kembali</a>
            </div>
            <hr>
        </div>
    </div>
    <div class="section" style="padding-bottom: 20px">
        <div class="card mb-2">
            <h5 class="card-header">Data diri pegawai</h5>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="{{ $data->user->nama }}" readonly>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" value="{{ $data->user->nip }}" readonly>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" value="{{ $data->user->jabatan }}" readonly>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Permohonan Cuti</h5>
            <div class="card-body">
              <div class="form-group mb-3">
                  <label for="">Tanggal mulai</label>
                  <input type="text" class="form-control" value="{{  \Carbon\Carbon::parse($data->tanggal_awal)->isoFormat('D MMMM Y') }}" readonly>
              </div>
              <div class="form-group mb-3">
                  <label for="">Tanggal akhir</label>
                  <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($data->tanggal_akhir)->isoFormat('D MMMM Y') }}" readonly>
              </div>
              <div class="form-group mb-3">
                  <label for="">Tanggal masuk</label>
                  <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($data->tanggal_masuk)->isoFormat('D MMMM Y') }}" readonly>
              </div>
              <div class="form-group mb-3">
                  <label for="">Jumlah cuti</label>
                  <input type="text" class="form-control" value="{{ $data->jumlah_izin }} Hari" readonly>
              </div>
              <div class="form-group mb-3">
                  <label for="">Keterangan</label>
                  <textarea type="text" class="form-control" readonly>{{ $data->keterangan }}</textarea>
              </div>
            <div class="form-group">
                <label class="text-dark">Lampiran</label>
                @isset($data->lampiran)
                    <a href="{{ url('/storage/' . str_replace('public/', '', $data->lampiran)) }}"
                        class="btn btn-sm btn-primary btn-block">lihat
                        file</a>
                @endisset
                @empty($data->lampiran)
                    tidak diupload
                @endempty
            </div>
              <div class="form-group mb-3">
                  @if ($data->approval_status == 'pending')
                    <hr>
                    <div class="m-0 row w-100">
                        <div class="pl-0 col-6">
                            <form id="formSubmitTolak">
                                <input name="approval_status" hidden value="ditolak">
                                <button class="btn btn-secondary w-100">Tolak</button>
                            </form>
                        </div>
                        <div class="pr-0 col-6">
                            <form id="formSubmitSetujui">
                                <input name="approval_status" hidden value="disetujui">
                                <button class="btn btn-success w-100">Setujui</button>
                            </form>
                        </div>
                    </div>
                @endif
              </div>
          </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        function submitForm(form) {
            var data = new FormData(form);
            var param = {
                url: "{{ route('user.approval.cuti.update', $data->id) }}",
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                cache: false
            };

            return transAjax(param).then((res) => {
                swal({
                    text: res.message,
                    icon: 'success',
                    timer: 3000,
                }).then(() => {
                    window.location.href = "{{ route('user.approval.cuti') }}";
                });
                console.log('okk');
            }).catch((err) => {
                swal({
                    text: err.responseJSON.message,
                    icon: 'error',
                });
                console.log('error');
            });
        }

        $('#formSubmitTolak, #formSubmitSetujui').submit(async function(e) {
            e.preventDefault();
            await submitForm(this);
        });
    </script>
@endpush
