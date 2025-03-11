@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4>{{ $title }}</h4>
            <div class="row mb-4">
                <!-- Basic Alerts -->
                <div class="col-md-6 col-lg-5 mb-4 mb-md-0">
                    <div class="card">
                        <h5 class="card-header">Data pegawai</h5>
                        <div class="card-body">
                            <label for="">Photo</label>
                            <img src="{{ route('photo-profile', ['filename' => $pengajuan->user->photo]) }}" alt=""
                                width="100%" class="rounded mb-3">
                            <div class="form-group mb-3">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" value="{{ $pengajuan->user->nama }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">NIP</label>
                                <input type="text" class="form-control" value="{{ $pengajuan->user->nip }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Jabatan</label>
                                <input type="text" class="form-control" value="{{ $pengajuan->user->jabatan }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Unit Organisasi</label>
                                <input type="text" class="form-control" value="{{ $pengajuan->user->unit_organisasi }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 mb-4 mb-md-0">
                    <div class="card mb-3">
                        <h5 class="card-header">Pengajuan</h5>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($pengajuan->status == 'pending' || $pengajuan->status == 'terverifikasi operator')
                                            <span class="badge bg-warning">{{ $pengajuan->status }}</span>
                                        @elseif($pengajuan->status == 'diproses')
                                            <span class="badge bg-info">{{ $pengajuan->status }}</span>
                                        @elseif($pengajuan->status == 'selesai')
                                            <span class="badge bg-primary">{{ $pengajuan->status }}</span>
                                        @elseif($pengajuan->status == 'diterima')
                                            <span class="badge bg-success">{{ $pengajuan->status }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $pengajuan->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal diajukan</th>
                                    <td>
                                        {{ Carbon\Carbon::parse($pengajuan->created_at)->isoFormat('D MMMM Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal diperbarui</th>
                                    <td>
                                        {{ Carbon\Carbon::parse($pengajuan->updated_at)->isoFormat('D MMMM Y') }}
                                    </td>
                                </tr>
                                @if ($pengajuan->file)
                                    <tr>
                                        <th>Produk Kepegawaian</th>
                                        <td>
                                            <a href="javascript:void(0)"
                                                onclick="modalPreviewPDF('{{ route('stream', ['filename' => 'dokumen_kepegawaian|' . $pengajuan->user_id . '|produk_kepegawaian|' . $pengajuan->file]) }}')">
                                                Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header w-100 d-flex justify-content-between">
                            <span class="fs-5 fw-bold w-auto">Dokumen lampiran</span>
                            <button id="btnSubmit" type="submit" class="btn btn-primary d-flex align-items-center me-2">
                                <i class='bx bx-download'></i>
                                <span>Unduh Semua</span></button>
                        </div>
                        <div class="card-body pb-0">
                            <ol class="list-group mb-3 ms-3">
                                @forelse ($berkas as $item)
                                    <li class="">
                                        <a href="javascript:void(0)"
                                            onclick="modalPreviewPDF('{{ route('stream', ['filename' => 'dokumen_kepegawaian|' . $item->pengajuan->user_id . '|' . $item->dokumen->file]) }}')">
                                            {{ $item->input ? $item->input->nama_input : 'Dokumen tidak tersedia' }}
                                        </a>
                                    </li>
                                    <hr>
                                @empty
                                    <li class="">Tidak ada berkas yang terlampir</li>
                                @endforelse
                            </ol>
                        </div>
                    </div>
                    @if ($pengajuan->status !== 'selesai')
                        @if ($pengajuan->status !== 'diproses')
                            <button class="btn btn-info mt-3" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalDiproses">Proses</button>
                        @endif
                        @if ($pengajuan->status == 'diproses')
                            <button class="btn btn-success mt-3" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalSelesai">Selesai</button>
                        @endif
                        @if (
                            $pengajuan->status == 'pending' ||
                                $pengajuan->status == 'terverifikasi operator' ||
                                $pengajuan->status == 'diproses')
                            <button class="btn btn-warning mt-3" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalPenolakan">Tolak</button>
                        @endif
                    @endif
                    <div class="card mt-3">
                        <h5 class="card-header">Komentar</h5>
                        <div class="card-body">
                            <div id="kontenKomentar">

                            </div>
                            @if ($pengajuan->status !== 'selesai')
                                <hr>
                                <form id="formKomentar">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $pengajuan->user->id }}">
                                    <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">
                                    <label for="">Balasan Anda</label>
                                    <textarea name="komentar" class="form-control mb-3 komentar" id="komentar" rows="3"></textarea>
                                    <button id="btnLoadingKomentar" class="btn btn-primary d-none" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Tunggu sebentar yaah...
                                    </button>
                                    <button id="btnSubmitKomentar" class="btn btn-primary">Kirim balasan</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tolak -->
    <div class="modal fade" id="modalPenolakan" tabindex="-1" aria-labelledby="modalPenolakanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPenolakanLabel">Alasan penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPenolakan">
                    <div class="modal-body">
                        <textarea name="komentar" class="form-control komentar" id="" cols="30" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button id="btnLoading" class="btn btn-primary d-none" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Tunggu sebentar yaah...
                        </button>
                        <button id="btnSubmit" type="submit" class="btn btn-primary">Kirim alasan penolakan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal diproses -->
    <div class="modal fade" id="modalDiproses" tabindex="-1" aria-labelledby="modalPenolakanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-bold" id="modalPenolakanLabel">Peringatan</h5>
                </div>
                <div class="modal-body">
                    <span>Apakah anda yakin ingin memproses pengajuan ini?</span>
                </div>
                <form id="formDiproses">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button id="btnLoading" class="btn btn-primary d-none" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Tunggu sebentar yaah...
                        </button>
                        <button id="btnSubmit" type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Selesai -->
    <div class="modal fade" id="modalSelesai" tabindex="-1" aria-labelledby="modalPenolakanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-bold" id="modalPenolakanLabel">Peringatan</h5>
                </div>
                <form id="formSelesai">
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin selesaikan pengajuan ini?</p>
                        <div class="form-group mt-2">
                            <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">
                            <input type="file" name="file" class="form-control">
                            <label for="file" class="text-muted">* Unggah berkas sebagai umpan balik (tidak
                                wajib)</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button id="btnLoading" class="btn btn-primary d-none" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Tunggu sebentar yaah...
                        </button>
                        <button id="btnSubmit" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal preview PDF -->
    <div class="modal fade" id="modalPreviewPDF" tabindex="-1" aria-labelledby="modalPenolakanLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-bold" id="modalPenolakanLabel">Preview PDF</h5>
                </div>
                <div class="modal-body py-0">
                </div>
                <form id="formVerifikasi">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            loadKontenKomentar();
        });

        async function loadKontenKomentar() {
            var param = {
                url: "{{ url()->current() }}",
                method: "GET",
            }

            await transAjax(param).then((result) => {
                $("#kontenKomentar").html(result)
            }).catch((err) => {
                console.log(err);
            });
        }

        $("#formPenolakan").submit(async function(e) {
            e.preventDefault();

            var data = new FormData(this);
            var param = {
                url: "{{ url()->current() }}/ditolak",
                method: "POST",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
            }

            loadingsubmit(true);
            await transAjax(param).then((result) => {
                $("#modalPenolakan").modal("hide");
                swal({
                    text: result.message,
                    icon: 'success',
                    timer: 3000,
                }).then(() => {
                    loadingsubmit(false);
                    $("#modalPenolakan").modal("hide");
                    window.location.href = '{{ url()->current() }}';
                });
            }).catch((err) => {
                loadingsubmit(false);
                $("#modalPenolakan").modal("hide");
                swal({
                    text: err.responseJSON.message,
                    icon: 'error',
                });
            });
        });

        $("#formDiproses").submit(async function(e) {
            e.preventDefault();

            var data = new FormData(this);
            var param = {
                url: "{{ url()->current() }}/diproses",
                method: "POST",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
            }

            loadingsubmit(true);
            await transAjax(param).then((result) => {
                $("#modalDiproses").modal("hide");
                swal({
                    text: result.message,
                    icon: 'success',
                    timer: 3000,
                }).then(() => {
                    loadingsubmit(false);
                    $("#modalDiproses").modal("hide");
                    window.location.href = '{{ url()->current() }}';
                });
            }).catch((err) => {
                loadingsubmit(false);
                $("#modalDiproses").modal("hide");
                swal({
                    text: err.responseJSON.message,
                    icon: 'error',
                });
            });
        });

        $("#formSelesai").submit(async function(e) {
            e.preventDefault();

            var data = new FormData(this);
            var param = {
                url: "{{ url()->current() }}/selesai",
                method: "POST",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
            }

            loadingsubmit(true);
            await transAjax(param).then((result) => {
                $("#modalSelesai").modal("hide");
                swal({
                    text: result.message,
                    icon: 'success',
                    timer: 3000,
                }).then(() => {
                    loadingsubmit(false);
                    $("#modalSelesai").modal("hide");
                    window.location.href = '{{ url()->current() }}';
                });
            }).catch((err) => {
                loadingsubmit(false);
                $("#modalSelesai").modal("hide");
                swal({
                    text: err.responseJSON.message,
                    icon: 'error',
                });
            });
        });

        function loadingsubmit(state) {
            if (state) {
                $("#btnSubmit").addClass('d-none');
                $("#btnLoading").removeClass('d-none');
            } else {
                $("#btnLoading").addClass('d-none');
                $("#btnSubmit").removeClass('d-none');
            }
        }

        //komentar
        $("#formKomentar").submit(async function(e) {
            e.preventDefault();

            var data = new FormData(this);
            var param = {
                url: "{{ route('bkpp.komentar') }}",
                method: "POST",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
            }

            loadingKomentar(true);
            await transAjax(param).then((result) => {
                loadingKomentar(false);
                loadKontenKomentar();
                $('#komentar').val('');
            }).catch((err) => {
                loadingKomentar(false);
                swal({
                    text: err.responseJSON.message,
                    icon: 'error',
                });
            });
        });

        function loadingKomentar(state) {
            if (state) {
                $("#btnSubmitKomentar").addClass('d-none');
                $("#btnLoadingKomentar").removeClass('d-none');
            } else {
                $("#btnLoadingKomentar").addClass('d-none');
                $("#btnSubmitKomentar").removeClass('d-none');
            }
        }

        function modalPreviewPDF(url) {
            $("#modalPreviewPDF").modal("show");
            $("#modalPreviewPDF .modal-body").html(
                `<embed src="${url}" type="application/pdf" width="100%" height="600px" />`);
        }
    </script>
@endpush
