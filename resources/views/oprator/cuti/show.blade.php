@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-4">
            <!-- Basic Alerts -->
            <div class="col-md-4 col-lg-4 mb-4 mb-md-0">
              <div class="card">
                  <h5 class="card-header">Data Pegawai</h5>
                  <div class="card-body">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($cuti->user->photo) }}" alt="photo" width="100%">
                    <div class="form-group mb-3">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" value="{{ $cuti->user->nama }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">NIP</label>
                        <input type="text" class="form-control" value="{{ $cuti->user->nip }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Jabatan</label>
                        <input type="text" class="form-control" value="{{ $cuti->user->jabatan }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Unit Organisasi</label>
                        <input type="text" class="form-control" value="{{ $cuti->user->unit_organisasi }}">
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-8 col-lg-8 mb-4 mb-md-0">
              <div class="card">
                  <h5 class="card-header">Permohonan Cuti</h5>
                  <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="">Tanggal mulai</label>
                        <input type="text" class="form-control" value="{{  \Carbon\Carbon::parse($cuti->tanggal_awal)->isoFormat('D MMMM Y') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Tanggal akhir</label>
                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($cuti->tanggal_akhir)->isoFormat('D MMMM Y') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Tanggal masuk</label>
                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($cuti->tanggal_masuk)->isoFormat('D MMMM Y') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Jumlah cuti</label>
                        <input type="text" class="form-control" value="{{ $cuti->jumlah_izin }} Hari">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Keterangan</label>
                        <textarea type="text" class="form-control">{{ $cuti->keterangan }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <a href="{{ asset('storage/lampiran') }}/{{ $cuti->lampiran }}">Lihat lampiran</a>
                        {{-- <a href="{{ asset('storage/lampiran') }}/{{ $cuti->lampiran }}" type="text" class="btn btn-primary btn-block">Lihat Lampiran</a> --}}
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-primary">Setujui</button>
                        <button class="btn btn-danger">Tolak</button>
                    </div>
                </div>
              </div>
            </div>
            <!--/ Basic Alerts -->
          </div>
      </div>
  </div>
@endsection


