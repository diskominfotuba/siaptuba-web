@extends('layouts.general')
@section('content')
    <div class="container mt-3" style="padding-bottom: 10px">
        <div style="padding-top: 50px">
            <h4>Detail DL</h4>
            <hr>
        </div>
    </div>
    <div class="section" style="padding-bottom: 20px">
        <div class="card mb-2">
            <div class="card-body">
                <div class="form-group">
                    <img src="{{ route('photo-presensi', ['year' => $data->created_at->format('Y'), 'filename' => $data->photo_masuk]) }}"
                        alt="img" class="image-block imaged w-100">
                </div>
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
                <div class="form-group">
                    <label>Status</label>
                    @if ($data->approval_status == 'pending')
                        <span class="badge bg-warning">{{ $data->approval_status }}</span>
                    @elseif($data->approval_status == 'disetujui')
                        <span class="badge bg-success">{{ $data->approval_status }}</span>
                    @else
                        <span class="badge bg-danger">{{ $data->approval_status }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" value="{{ $data->keterangan }}" readonly>
                </div>
                <div class="form-group">
                    <label class="text-dark">Dokumen SPT</label>
                    @isset($data->spt)
                        <a href="{{ url('/storage/' . str_replace('public/', '', $data->spt)) }}"
                            class="btn btn-sm btn-primary btn-block">lihat
                            file</a>
                    @endisset
                    @empty($data->spt)
                        tidak diupload
                    @endempty
                </div>
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
@endsection
@push('js')
    <script type="text/javascript">
        function submitForm(form) {
            var data = new FormData(form);
            var param = {
                url: "{{ route('user.approval.dl.update', $data->id) }}",
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
                    window.location.href = "{{ route('user.approval.dl') }}";
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
