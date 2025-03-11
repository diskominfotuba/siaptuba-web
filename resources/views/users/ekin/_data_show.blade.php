
<div class="form-group rounded">
    <div class="input-wrapper">
        <label for="nama_tugas">Nama tugas</label>
        <input type="text" class="form-control" name="nama_tugas" value="{{ $kinerja->nama_tugas }}">
    </div>
</div>
<div class="form-group rounded">
    <div class="input-wrapper">
        <label for="deskripsi">Deskripsi</label>
        <textarea type="text" class="form-control" name="deskripsi">{{ $kinerja->nama_tugas }}</textarea>
    </div>
</div>
<div class="form-group rounded">
    <div class="input-wrapper">
        <label for="bukti_dukung">Bukti dukung</label>
        <input type="file" class="form-control" name="bukti_dukung">
    </div>
</div>
<div class="form-group basic">
    <button type="button" class="btn btn-primary btn-block btn-lg" data-dismiss="modal">Tutup</button>
</div>