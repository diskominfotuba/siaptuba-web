<style>
    .detail-profile-pegawai {
        max-height: 400px;
        overflow: auto;
    }
</style>
<div class="detail-profile-pegawai">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="email" class="form-control" id="nip" value="{{ $profile->nip }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nama" class="form-label">NAMA LENGKAP</label>
                <input type="email" class="form-control" id="nama" value="{{ $profile->namalengkap }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nama" class="form-label">TANGGAL LAHIR</label>
                <input type="email" class="form-control" id="nama" value="{{ $profile->tanggallahir }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nama" class="form-label">JENIS KELAMIN</label>
                <input type="email" class="form-control" id="nama" value="{{ $profile->jeniskelamin }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nama" class="form-label">STATUS KEPEGAWAIAN</label>
                <input type="email" class="form-control" id="nama" value="{{ $profile->kepegawaianstatus }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nama" class="form-label">GOL RUANG NAMA</label>
                <input type="email" class="form-control" id="nama" value="{{ $profile->golruangnama }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nip" class="form-label">PANGKAT</label>
                <input type="email" class="form-control" id="nip" value="{{ $profile->pangkat }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nip" class="form-label">NAMA JABATAN</label>
                <input type="email" class="form-control" id="nip" value="{{ $profile->jabatannama }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nip" class="form-label">JENIS JABATAN</label>
                <input type="email" class="form-control" id="nip" value="{{ $profile->jabatanjenis }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nip" class="form-label">KELOMPOK JABATAN</label>
                <input type="email" class="form-control" id="nip" value="{{ $profile->jabatankelompok }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nama" class="form-label">OPD</label>
                <input type="email" class="form-control" id="nama" value="{{ $profile->skpdnama }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nama" class="form-label">OPD ORGANISASI</label>
                <input type="email" class="form-control" id="nama" value="{{ $profile->skpdorganisasinama }}">
            </div>
        </div>
    </div>
</div>
