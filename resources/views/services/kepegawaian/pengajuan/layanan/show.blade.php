@extends('layouts.general')
@section('content')
    <div class="container mt-3" style="padding-bottom: 10px">
        <div style="padding-top: 50px">
            <a href="{{ route('user.kepegawaian') }}" class="btn btn-primary btn-sm mb-2">
                < Kembali</a>
                    <h4>Formulir Pengajuan {{ $pengajuan->layanan->nama_layanan }}</h4>
                    <hr>
        </div>
        <div class="card mb-2">
            <div class="card-header">
                Data diri Anda
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->nama }}" readonly>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->nip }}" readonly>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->jabatan }}" readonly>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                Hasil pengajuan
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Status</label>
                    @if (
                        $pengajuan->status == 'pending' ||
                            $pengajuan->status == 'terverifikasi operator' ||
                            $pengajuan->status == 'diajukan')
                        <span class="badge bg-warning">{{ $pengajuan->status }}</span>
                    @elseif($pengajuan->status == 'diproses')
                        <span class="badge bg-info">{{ $pengajuan->status }}</span>
                    @elseif($pengajuan->status == 'diterima')
                        <span class="badge bg-primary">{{ $pengajuan->status }}</span>
                    @elseif($pengajuan->status == 'ditolak bkpp' || $pengajuan->status == 'ditolak operator')
                        <span class="badge bg-danger">{{ $pengajuan->status }}</span>
                    @else
                        <span class="badge bg-success">{{ $pengajuan->status }}</span>
                    @endif
                </div>
                @isset($pengajuan->file)
                    <div class="form-group">
                        <label class="text-dark">Dokumen Balasan</label>
                        <a href="{{ route('pdfviewer', ['dir' => 'dokumen_kepegawaian|' . $pengajuan->user_id, 'filename' => '|produk_kepegawaian|' . $pengajuan->file]) }}"
                            class="btn btn-sm btn-primary btn-block mb-1">lihat file</a>
                    </div>
                    <hr>
                @endisset
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                Diskusi
            </div>
            <div class="card-body">
                <div style="height: 200px; overflow-y: auto;" id="komentarContainer">
                    <div class="mb-2" id="dataKomentar">
                    </div>
                </div>
                @if ($pengajuan->status !== 'selesai')
                    <form id="formKomentar">
                        <div class="input-group">
                            <input type="hidden" name="user_id" value="{{ $pengajuan->user->id }}">
                            <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">
                            <input type="text" class="form-control" style="font-size: inherit!important"
                                placeholder="Tulis komentar" name="komentar" id="komentar">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" id="btnSubmit" type="submit">Kirim</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <div class="alert alert-danger mb-1" role="alert">
            <h4 class="alert-heading">Penting!</h4>
            <p>Hanya menerima file format PDF dengan ukuran file maksimal 1MB</p>
        </div>

        <x-modal-dokumen></x-modal-dokumen>
        <form id="formSubmit">
            @csrf
            @forelse ($input as $key => $item)
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">{{ $item->nama_input }}</label>
                            @php
                                $berkas = $item->berkas->first();
                                $dokumen = $berkas ? $berkas->dokumen : null;
                            @endphp
                            @if ($dokumen)
                                <x-input-dokumen file="{{ $dokumen->file }}" status="{{ $pengajuan->status }}"
                                    name="{{ $item->slug }}" dokumenId="{{ $dokumen->id }}"
                                    namaDokumen="{{ $dokumen->nama_file }}"
                                    inputLayananId="{{ $item->id }}"></x-input-dokumen>
                            @else
                                <p class="text-muted">Berkas belum tersedia.</p>
                            @endif
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


            @if ($pengajuan->status == 'ditolak bkpp' || $pengajuan->status == 'ditolak operator')
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
            @endif

        </form>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        async function loadKomentar() {
            var param = {
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    'load': 'table'
                }
            }

            await transAjax(param).then((result) => {
                $('#dataKomentar').html(result);
                var komentarContainer = document.getElementById('komentarContainer');
                komentarContainer.scrollTop = komentarContainer.scrollHeight;
            });
        }
        $(document).ready(function() {
            loadKomentar();
        });

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
                    window.location.href = "{{ url()->current() }}";
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

        $('#formKomentar').submit(async function(e) {
            e.preventDefault();

            var data = new FormData(this);
            var param = {
                url: "{{ route('bkpp.user.komentar') }}",
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                cache: false
            }

            await transAjax(param).then((res) => {
                loadKomentar();
                $('#komentar').val('');
            }).catch((err) => {
                swal({
                    text: err.responseJSON.message,
                    icon: 'error',
                });
            });
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
            $('#modalDokumen').data('layananId', {{ $pengajuan->layanan_id }});
        }
    </script>
@endpush
