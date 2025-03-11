@extends('layouts.general')
@section('content')
    <div class="container mt-3" style="padding-bottom: 10px">
        <div style="padding-top: 50px">
            <a href="{{ route('services.kepegawaian') }}" class="btn btn-primary btn-sm mb-2">
                < Kembali</a>
                    <h4>Formulir Pengajuan {{ $layanan->nama_layanan }}</h4>
                    <hr>
        </div>
        <div class="card mb-2">
            <div class="card-header">
                Data diri Anda
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->nama }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">NIP</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->nip }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Jabatan</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->jabatan }}" readonly>
                </div>
            </div>
        </div>
        <div class="alert alert-danger mb-1" role="alert">
            <h4 class="alert-heading">Penting!</h4>
            <p>Hanya menerima file format PDF dengan ukuran file maksimal 1MB</p>
        </div>

        <x-modal-dokumen></x-modal-dokumen>
        <form id="formSubmit">
            @csrf
            @forelse ($data as $item)
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">{{ $item->nama_input }}</label>
                            <x-input-dokumen name="{{ $item->slug }}"
                                inputLayananId="{{ $item->id }}"></x-input-dokumen>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card mb-2">
                    <div class="card-body">
                        Data tidak ditemukan
                    </div>
                </div>
            @endforelse

            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <button id="btnLoading" class="btn btn-primary btn-lg btn-block d-none" disabled type="button">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Tunggu sebentar yah...
                        </button>
                        <button type="submit" id="btnSubmit" class="btn btn-primary btn-block btn-lg">KIRIM</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#formSubmit').submit(async function(e) {
            e.preventDefault();
            loadingsubmit(true);

            var data = new FormData(this);
            var param = {
                url: "{{ url()->current() }}",
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                cache: false
            }

            await transAjax(param).then((res) => {
                swal({
                    text: res.message,
                    icon: 'success',
                    timer: 3000,
                }).then(() => {
                    loadingsubmit(false);
                    window.location.href = "{{ route('user.kepegawaian') }}";
                });
            }).catch((err) => {
                loadingsubmit(false);
                swal({
                    text: err.responseJSON.message,
                    icon: 'error',
                });
                if (err.responseJSON && err.responseJSON.errors) {
                    let errors = err.responseJSON.errors;
                    $('.text-danger').html('');
                    $.each(errors, function(key, value) {
                        let errorElement = $('#error-' + key);
                        if (errorElement.length) {
                            errorElement.html(value[0]);
                        }
                    });
                } else {
                    console.error("An error occurred");
                }
            });

            function loadingsubmit(state) {
                if (state) {
                    $('#btnSubmit').addClass('d-none');
                    $('#btnLoading').removeClass('d-none');
                } else {
                    $('#btnSubmit').removeClass('d-none');
                    $('#btnLoading').addClass('d-none');
                }
            }
        });

        function removeFile(inputFieldId) {
            $(`#${inputFieldId}`).val('');
            $(`#${inputFieldId}_name`).text('');

            $(`#${inputFieldId}`).closest('.file-input-container').removeClass('d-flex').addClass('d-none');
            $(`#${inputFieldId}`).closest('.file-input-container').siblings('.add-file-button').removeClass('d-none')
                .addClass('d-flex');
        }

        function modalDokumen(inputFieldId) {
            $('#modalDokumen').modal('show');
            $('#modalDokumen').data('inputFieldId', inputFieldId);
            $('#modalDokumen').data('layananId', {{ $layanan->id }});
        }
    </script>
@endpush
