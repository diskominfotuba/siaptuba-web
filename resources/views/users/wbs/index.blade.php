@extends('layouts.pegawai.app')
@section('content')
<div id="appCapsule">
    <form id="form-submit-wbs">
    @csrf
    <div class="section mt-2 mb-2">
        <div class="card mt-2">
            <div class="card-body">
                <h3 class="mb-2 fw-bold">Selamat Datang di WBS Inspektorat Kabupaten Tulang Bawang</h3>
                <p class="">Laporkan segala kegiatan yang berindikasi pelanggaran di lingkungan
                    Pemerintah
                    Kabupaten Tulang Bawang. Bentuk materi pelanggaran yang dilaporkan:</p>
                <ol>
                    <li>Pelanggaran Disiplin Pegawai</li>
                    <li>Penyalahgunaan Wewenang, Mal Administrasi dan Pemerasan/Penganiayaan</li>
                    <li>Perilaku Amoral/Perselingkuhan dan Kekerasan dalam Rumah Tangga</li>
                    <li>Korupsi</li>
                    <li>Pengadaan Barang dan Jasa</li>
                    <li>Pungutan Liar, Percaloan, dan Pengurusan Dokumen</li>
                    <li>Narkoba</li>
                    <li>Pelayanan Publik</li>
                </ol>

                <div class="mb-3">
                    <label for="prihal" class="form-label">Prihal</label>
                    <input type="text" class="form-control" id="prihal" name="prihal" placeholder="Masukkan Prihal" autofocus="" autocomplete="off" value="">
                                                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Pelanggaran</label>
                    <select name="jenis" id="jenis" class="form-control" value="">
                        <option value="Pelanggaran Disiplin Pegawai">Pelanggaran Disiplin Pegawai</option>
                        <option value="Penyalahgunaan Wewenang, Mal Administrasi dan
                            Pemerasan/Penganiayaan">
                            Penyalahgunaan Wewenang, Mal Administrasi dan
                            Pemerasan/Penganiayaan</option>
                        <option value="Perilaku Amoral/Perselingkuhan dan Kekerasan dalam Rumah
                            Tangga">
                            Perilaku Amoral/Perselingkuhan dan Kekerasan dalam Rumah
                            Tangga</option>
                        <option value="Korupsi">Korupsi</option>
                        <option value="Pengadaan Barang dan Jasa">Pengadaan Barang dan Jasa</option>
                        <option value="Opsi Pungutan Liar, Percaloan, dan Pengurusan Dokumen">Opsi Pungutan
                            Liar, Percaloan, dan Pengurusan Dokumen
                        </option>
                        <option value="Narkoba">Narkoba</option>
                        <option value="Pelayanan Publik">Pelayanan Publik</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                                                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Kejadian</label>
                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3" placeholder="Jl Lintas Sumatera ... "></textarea>
                                                </div>

                <div class="mb-3">
                    <label for="opd" class="form-label">Unit Satuan Kerja/OPD Kejadian</label>
                    <input type="text" class="form-control" id="opd" name="opd" placeholder="Inspektorat" autofocus="" autocomplete="off" value="">
                                                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Perkiraan Waktu Kejadian</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Inspektorat" autofocus="" autocomplete="off" value="">
                                                </div>

                <div class="mb-3">
                    <label for="uraian" class="form-label">Uraian (Uraian Pengaduan Sebaiknya Mengandung
                        Unsur 4W+1H)</label>
                    <textarea name="uraian" id="uraian" class="form-control" cols="30" rows="3" placeholder="Terjadi pemerasaan terhadap ..."></textarea>
                                                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Lampiran (Bukti/Evidence)</label>
                    <input type="file" class="form-control" id="file" name="file">
                                                </div>
                <button class="btn btn-primary btn-lg btn-block">Kirim pengaduan</button>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-body boxed">
                <div class="form-group">
                    <div class="input-wrapper">
                        <label class="label" for="text4">NIP</label>
                        <input type="text" class="form-control" required value="{{ auth()->user()->nip }}" name="nip">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <label class="label" for="email4">Nama</label>
                        <input type="text" class="form-control" id="name" value="{{ auth()->user()->nama }}" name="nama">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <label class="label" for="password4">Organisasi</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->opd->nama_opd }}" name="organisasi">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <label class="label" for="password4">Nama OPD</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->opd->nama_opd }}" name="nama_opd">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <label class="label" for="password4">Unit Organisasi</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->unit_organisasi }}" name="unit_organisasi">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <label class="label" for="select4">Jabatan</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->jabatan }}" name="jabatan">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <label class="label" for="no_tlp">No Tlp</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->no_hp }}" name="no_hp">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <label class="label" for="email">Email</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->email }}" name="email">
                    </div>
                </div>
                <hr>
                <button id="btn_loading_profile" class="btn btn-primary btn-lg btn-block d-none" disabled type="button">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Tunggu sebentar yah...
                </button>
                <button id="btn_profile" type="submit" class="btn-submit btn btn-primary mr-1 btn-lg btn-block btn-profile">Simpan</button>
                </div>
            </div>
        </div> --}}
    </form>
</div>
@endsection
@push('js')
<script type="text/javascript">
$('#form-submit-wbs').submit(async function(e) {
    e.preventDefault();
    loadingsubmit(true);
    var param = {
        url: 'https://wbs-inspektorat.tulangbawangkab.go.id/api/wbs-inspektorat',
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
    }

    await transAjax(param).then((res) => {
        swal({
            text: res.message,
            icon: 'success',
            timer: 3000,
        }).then(() => {
            loadingsubmit(false);
            window.location.href = '/';
        });
    }).catch((err) => {
        loadingsubmit(false);
        swal({
            text: err.responseJSON.message,
            icon: 'error',
            timer: 3000,
        }).then(() => {});
    });

    function loadingsubmit(state) {
        if (state) {
            $('#btnUpdate').addClass('d-none');
            $('#loadingUpdate').removeClass('d-none');
        } else {
            $('#btnUpdate').removeClass('d-none');
            $('#loadingUpdate').addClass('d-none');
        }
    }
});
</script>
@endpush