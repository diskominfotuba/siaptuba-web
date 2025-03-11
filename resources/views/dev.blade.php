@extends('layouts.main')
@section('content')
<form action="/pengajuan-informasi" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="nama">Nama Lengkap</label>
      <input type="text" class="form-control" id="nama" name="nama">
    </div>
    <div class="form-group mt-2">
      <label for="nik">Alamat</label>
      <input type="text" class="form-control" id="nik" name="nik">
    </div>
    <div class="form-group mt-2">
      <label for="nik">Pekerjaan</label>
      <input type="text" class="form-control" id="nik" name="nik">
    </div>
    <div class="form-group mt-2">
      <label for="nik">Nomor telpon/email</label>
      <input type="text" class="form-control" id="nik" name="nik">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Kota Tempat Tinggal</label>
        <select class="form-control" id="exampleFormControlSelect1" name="alamat">
          <option>--pilih--</option>
          <option value="Banjar Agung">Banjar Agung</option>
          <option value="Banjar Baru">Banjar Baru</option>
          <option value="Banjar Margo">Banjar Margo</option>
          <option value="Dente Teladas">Dente Teladas</option>
          <option value="Gedung Aji">Gedung Aji</option>
          <option value="Gedung Aji Baru">Gedung Aji Baru</option>
          <option value="Gedung Meneng">Gedung Meneng</option>
          <option value="Menggala">Menggala</option>
          <option value="Menggala Timur">Menggala Timur</option>
          <option value="Penawar Aji">Penawar Aji</option>
          <option value="Rawa Jitu Selatan">Rawa Jitu Selatan</option>
          <option value="Rawa Jitu Timur">Rawa Jitu Timur</option>
          <option value="Rawa Pitu">Rawa Pitu</option>
          <option value="Lainya">Lainya</option>
        </select>
      </div>
      <div class="form-group mt-2">
        <label for="no_tlp">No Tlp/WhatsApp</label>
        <input type="text" class="form-control" id="no_tlp" name="no_tlp">
      </div>
      <div class="form-group mt-2">
        <label for="photo_ktp">Foto KTP</label>
        <input type="file" class="form-control" id="photo_ktp" name="photo_ktp">
      </div>
      <div class="form-group mt-2">
        <label for="swa_photo_ktp">Swa Foto  Dengan KTP</label>
        <input type="file" class="form-control" id="swa_photo_ktp" name="swa_photo_ktp">
      </div>
      {{-- <div class="form-group mt-2">
        <label for="akta_notaris">Akta Notaris/SK Lembaga</label>
        <input type="file" class="form-control" id="akta_notaris" name="akta_notaris">
      </div> --}}
      <div class="form-group mt-2">
        <label for="pekerjaan">Pekerjaan</label>
        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
      </div>
      <div class="form-group mt-2">
        <label for="informasi">Informasi Yang Dibutuhkan</label>
        <textarea class="form-control" id="informasi" name="informasi"></textarea>
      </div>
      <div class="form-group mt-2">
        <label for="alasan">Alasan</label>
        <textarea class="form-control" id="alasan" name="alasan"></textarea>
      </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </div>
</form>

@endsection