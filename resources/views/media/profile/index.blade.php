@extends('media.layouts.app')
@push('css')
    <style>
        .action-sheet-contents {
            max-height: 450px;
            overflow-y: auto
        }

        .action-sheet-contents::-webkit-scrollbar {
            display: none;
        }

        .action-sheet-contents {
            scrollbar-width: none;
            /* Hilangkan scrollbar */
        }
    </style>
@endpush
@section('content')
    <div id="appCapsule">
        <form action="/media/profile" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="section mt-3 text-center">
                <div class="avatar-section">
                    <img onclick="setWebcame(0)" id="imgPrev"
                        src="{{ asset('assets/img/avatar-1.png') }}" alt="image"
                        class="imaged w100">
                </div>
            </div>
            <div class="section mt-2 mb-2">
                <div class="card">
                    <div class="card-header">
                        Profil
                    </div>
                    <div class="card-body boxed">
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="text4">Nama</label>
                                <input type="text" class="form-control" value="{{ auth()->guard('media')->user()->nama }}"
                                    name="nama" id="text4" class="form-control">
                                    <span class="text-danger" id="error-nama"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="text4">Email</label>
                                <input type="email" class="form-control" value="{{ auth()->guard('media')->user()->email }}"
                                    name="email" id="text4" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="text4">No HP</label>
                                <input type="text" class="form-control" value="{{ auth()->guard('media')->user()->no_hp }}"
                                    name="no_hp" id="text4" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="text4">Nama media</label>
                                <input type="text" class="form-control" value="{{ auth()->guard('media')->user()->nama_media }}"
                                    name="nama_media" id="text4" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="text4">Alamat kantor media</label>
                                <input type="text" class="form-control" value="{{ auth()->guard('media')->user()->alamat_kantor }}"
                                    name="alamat_kantor" id="text4" class="form-control">
                            </div>
                        </div>
                        
                        <hr>
                        <button id="btn_loading_profile" class="btn btn-primary btn-lg btn-block d-none" disabled
                            type="button">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Tunggu sebentar yah...
                        </button>
                        <button id="btn_profile" onclick="loading(true, 'btn_loading_profile', 'btn_profile')" type="submit"
                            class="btn-submit btn btn-primary mr-1 btn-lg btn-block btn-profile">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="section mt-2 mb-2">
            <div class="card">
                <div class="card-header">
                    Update password
                </div>
                <div class="card-body">
                    <form action="/media/password" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="password">Password saat ini</label>
                            <input id="password" type="password" class="form-control" name="password" tabindex="3">
                            <span class="text-danger" id="error-password"></span>
                        </div>
                        <div class="form-group">
                            <label for="gender">Password Baru</label>
                            <input id="password" type="password" class="form-control" name="password_baru" tabindex="3">
                            <span class="text-danger" id="error-password_baru"></span>
                        </div>
                        <hr>
                        <button id="btn_loading_password" class="btn btn-primary btn-lg btn-block d-none" disabled
                            type="button">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Tunggu sebentar yah...
                        </button>
                        <button id="btn_password" onclick="loading('', 'btn_loading_password', 'btn_password')" type="submit" class="btn-submit btn btn-primary mr-1 btn-lg btn-block mb-2">Simpan</button>
                    </form>
                    <button class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#logout">Keluar</button>
                </div>
            </div>
       
        </div>
    </div>
    <div class="modal fade action-sheet" id="logout" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold">Logout</h3>
                </div>
                <div class="modal-body mt-1">
                    <div class="container action-sheet-contents">
                        <div class="section mb-3 text-center">
                            <h4>Apakah Anda yakin?</h4>
                            <div class="d-flex">
                                <button class="btn btn-primary w-100 mr-1" data-dismiss="modal">Batal</button>
                                <a href="/media/profile/logout" data-turbo="false" class="btn btn-danger w-100">Ya,
                                    keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

