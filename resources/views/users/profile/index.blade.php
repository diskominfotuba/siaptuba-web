@extends('layouts.pegawai.app')
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
        <form action="/user/profile-information" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="section mt-3 text-center">
                <div class="avatar-section">
                    {{-- <input type="file" onclick="openWebcame(0)" id="image"  class="upload" name="photo" id="avatar" accept=".jpeg, .jpg, .png"> --}}
                    <img onclick="setWebcame(0)" id="imgPrev"
                        src="{{ route('photo-profile', ['filename' => auth()->user()->photo]) }}" alt="image"
                        class="imaged w100">
                </div>
            </div>
            <div class="section mt-2 mb-2">
                @if (session('status'))
                    <div class="alert alert-success">
                        @if (session('status') == 'profile-information-updated')
                            Profil berhasil diperbaharui.
                        @endif
                        @if (session('status') == 'password-updated')
                            Password berhasil diperbaharui.
                        @endif
                        @if (session('status') == 'two-factor-authentication-disabled')
                            Two factor authentication disabled.
                        @endif
                        @if (session('status') == 'two-factor-authentication-enabled')
                            Two factor authentication enabled.
                        @endif
                        @if (session('status') == 'recovery-codes-generated')
                            Recovery codes generated.
                        @endif
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Profil
                    </div>
                    <div class="card-body boxed">
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="text4">NIP</label>
                                <input type="text" class="form-control"
                                    {{ auth()->user()->status_sinkronisasi == 'Y' ? 'readonly' : '' }} required
                                    value="{{ auth()->user()->nip }}" name="nip">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="email4">Nama</label>
                                {{-- cek gelar depan dan belakang --}}
                                @php
                                    $gelarDepan = '';
                                    $gelarBelakang = '';
                                    $profileOne = auth()->user()->profile_one;
                                    if ($profileOne && $profileOne->gelardepan) {
                                        $gelarDepan = $profileOne->gelardepan . ' ';
                                    }
                                    if ($profileOne && $profileOne->gelarbelakang) {
                                        $gelarBelakang = ', ' . $profileOne->gelarbelakang;
                                    }
                                @endphp
                                {{-- end cek gelar depan dan belakang --}}

                                <input type="text" class="form-control"
                                    {{ auth()->user()->status_sinkronisasi == 'Y' ? 'readonly' : '' }} id="nama"
                                    value="{{ auth()->user()->status_sinkronisasi == 'Y' ? $gelarDepan . auth()->user()->profile_one->nama . $gelarBelakang : auth()->user()->nama }}"
                                    name="nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="email4">Status Kepegawaian</label>
                                <input type="text" class="form-control"
                                    {{ auth()->user()->status_sinkronisasi == 'Y' ? 'readonly' : '' }}
                                    id="status_kepegawaian"
                                    value="{{ auth()->user()->status_sinkronisasi == 'Y' ? auth()->user()->profile_one->kepegawaianstatus : '-' }}"
                                    name="status_kepegawaian">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="email4">Gol. Ruang</label>
                                <input type="text" class="form-control"
                                    {{ auth()->user()->status_sinkronisasi == 'Y' ? 'readonly' : '' }} id="gol_ruang"
                                    value="{{ auth()->user()->status_sinkronisasi == 'Y' ? auth()->user()->profile_one->golruangnama : '-' }}"
                                    name="gol_ruang">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Jabatan</label>
                                <input type="text" class="form-control"
                                    {{ auth()->user()->status_sinkronisasi == 'Y' ? 'readonly' : '' }}
                                    value="{{ auth()->user()->jabatan }}" name="jabatan">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Jenis Jabatan</label>
                                <input type="text" class="form-control"
                                    {{ auth()->user()->status_sinkronisasi == 'Y' ? 'readonly' : '' }} id="jenis_jabatan"
                                    value="{{ auth()->user()->status_sinkronisasi == 'Y' ? auth()->user()->profile_one->jabatanjenis : '-' }}"
                                    name="jenis_jabatan">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="password4">OPD</label>
                                <input type="text" class="form-control"
                                    {{ auth()->user()->status_sinkronisasi == 'Y' ? 'readonly' : '' }}
                                    value="{{ auth()->user()->status_sinkronisasi == 'Y' ? auth()->user()->profile_one->skpdnama : auth()->user()->opd->nama_opd }}"
                                    name="nama_opd">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-wrapper">
                                <label class="label" for="password4">OPD Organisasi</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->status_sinkronisasi == 'Y' ? auth()->user()->profile_one->skpdorganisasinama : '-' }}"
                                    name="opd_organisasi">
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
                        <button id="btn_loading_profile" class="btn btn-primary btn-lg btn-block d-none" disabled
                            type="button">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Tunggu sebentar yah...
                        </button>
                        <button id="btn_profile" type="submit"
                            class="btn-submit btn btn-primary mr-1 btn-lg btn-block btn-profile">Simpan</button>
                        <button id="sinkronDataModal" type="button" data-toggle="modal" data-target="#sinkronData"
                            class="btn-submit btn btn-primary mr-1 btn-lg btn-block btn-profile">Sinkronisasi data</button>
                        {{-- {{ auth()->user()->status_sinkronisasi == 'N' ? "sinkronDataModal" : ""}}     --}}
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
                    <form method="POST" action="{{ route('user-password.update') }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Password saat ini</label>
                            <input id="current_password" type="password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                name="current_password" tabindex="3">
                            @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Password Baru</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                tabindex="3">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Konfirmasi password</label>
                            <input id="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" tabindex="3">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <hr>
                        <button id="btn_loading_password" class="btn btn-primary btn-lg btn-block d-none" disabled
                            type="button">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Tunggu sebentar yah...
                        </button>
                        <button id="btn_password" type="submit"
                            class="btn-submit btn btn-primary mr-1 btn-lg btn-block mb-2">Simpan</button>
                    </form>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    @if (auth()->user()->role == 'admin')
                        <a href="/admin/dashboard" data-turbo="false"
                            class="btn-submit btn btn-primary mr-1 btn-lg btn-block">Kelola pegawai</a>
                        <button data-toggle="modal" data-target="#logout"
                            class="btn-submit btn btn-danger mr-1 btn-lg btn-block mt-2">Keluar</button>
                    @elseif(auth()->user()->role == 'oprator')
                        <a href="/oprator/dashboard" data-turbo="false"
                            class="btn-submit btn btn-primary mr-1 btn-lg btn-block">Kelola pegawai</a>
                        <button data-toggle="modal" data-target="#logout"
                            class="btn-submit btn btn-danger mr-1 btn-lg btn-block mt-2">Keluar</button>
                    @else
                        <button data-toggle="modal" data-target="#logout"
                            class="btn-submit btn btn-danger mr-1 btn-lg btn-block mt-2">Keluar</button>
                    @endif
                </div>
            </div>
        </div>

        {{-- modal persetujuan sinkron data --}}
        <div class="modal fade action-sheet" id="sinkronData" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title font-weight-bold">Sinkronisasi data</h3>
                    </div>
                    <div class="modal-body mt-1">
                        <div class="container action-sheet-contents">
                            <div class="section">
                                <h4>I. Latar Belakang</h4>
                                <p>Dalam rangka meningkatkan akurasi dan efisiensi pengelolaan data kepegawaian, diperlukan
                                    proses sinkronisasi data antara SIAP TUBA dengan data kepegawaian yang dikelola oleh OPD
                                    Badan Kepegawaian, Pendidikan dan Pelatihan (BKPP). Proses ini bertujuan untuk
                                    memastikan kesesuaian data pegawai dalam kedua sistem serta mempermudah proses
                                    administrasi kepegawaian di lingkungan Pemerintah Kabupaten Tulang Bawang.</p>
                            </div>

                            <div class="section">
                                <h4>II. Tujuan Sinkronisasi</h4>
                                <ul>
                                    <li>Menyamakan data pegawai yang terdapat di SIAP TUBA dengan data yang dimiliki oleh
                                        BKPP.</li>
                                    <li>Memastikan keakuratan informasi kepegawaian dalam sistem.</li>
                                    <li>Menghindari duplikasi atau inkonsistensi data antar sistem.</li>
                                    <li>Meningkatkan efisiensi dalam pengelolaan administrasi kepegawaian.</li>
                                </ul>
                            </div>

                            <div class="section">
                                <h4>III. Ruang Lingkup Sinkronisasi</h4>
                                <p>Data yang akan disinkronkan meliputi:</p>
                                <ul>
                                    <li>Nama lengkap</li>
                                    <li>NIP (Nomor Induk Pegawai)</li>
                                    <li>Jabatan</li>
                                    <li>Unit kerja/OPD</li>
                                    <li>Unit organisasi</li>
                                    <li>Status kepegawaian</li>
                                    <li>Nomor telepon</li>
                                    <li>Data tambahan yang relevan dengan kebutuhan administrasi</li>
                                </ul>
                                <p>Mekanisme sinkronisasi dilakukan secara mandiri dengan mengklik tombol sinkronkan
                                    sekarang</p>
                            </div>

                            <div class="section">
                                <h4>IV. Keamanan dan Kerahasiaan Data</h4>
                                <p>Seluruh data yang dipertukarkan dalam proses sinkronisasi hanya dapat diakses oleh pihak
                                    yang berwenang. Apabila terjadi pelanggaran terhadap keamanan data, maka akan dilakukan
                                    evaluasi serta tindakan sesuai dengan kebijakan yang berlaku.</p>
                            </div>

                            <div class="section mb-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" required>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Saya setuju
                                    </label>
                                </div>
                                <small class="text-danger d-none" id="checkbok">checkbox wajib diklik</small>
                                <form id="sinkronisasiData">
                                    <input type="text" name="nip" value="{{ auth()->user()->nip }}" hidden>
                                    <button id="btnSinkronisasiDataLoading" type="button"
                                        class="btn btn-primary btn-lg btn-block mt-3 d-none" disabled type="button">
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Tunggu sebentar yah...
                                    </button>
                                    <button id="btnSinkronisasiDataSubmit" type="submit"
                                        class="btn btn-primary btn-block btn-lg mt-3">Sinkronkan sekarang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal persetujuan sinkron data --}}
    {{-- modal persetujuan sinkron data --}}
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
                                <button class="btn btn-primary w-100 mr-1 btn-lg">Batal</button>
                                <a href="/user/logout" data-turbo="false" class="btn btn-danger w-100 btn-lg">Ya,
                                    keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- modal persetujuan sinkron data --}}

    @include('layouts.modal._modal')
    @include('layouts.modal._modal_webcame')
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        var image = "";
        //set camera
        function setWebcame() {
            $('#modalWebcame').modal('show');
            Webcam.set({
                width: 490,
                height: 450,
                image_format: 'jpeg',
                jpeg_quality: 90,
            });

            var cameras = new Array();
            navigator.mediaDevices.enumerateDevices()
                .then(function(devices) {
                    devices.forEach(function(device) {
                        var i = 0;
                        if (device.kind === "videoinput") {
                            cameras[i] = device.deviceId;
                            i++;
                        }
                    });
                })

            Webcam.set('constraints', {
                width: 490,
                height: 450,
                image_format: 'jpeg',
                jpeg_quality: 90,
                sourceId: cameras[0]
            });

            Webcam.attach('.xwebcam-capture');
            shutter.autoplay = false;
            shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : '/assets/pegawai/shutter.mp3';
        }

        function captureFace() {
            shutter.play();
            Webcam.snap(function(data_uri) {
                document.getElementById('webcameResult').innerHTML =
                    `
        <img class="x-img-fluid" id="imageprev" style="border-radius: 15px; object-fit: cover;" src="${data_uri}"/>
        `
                $('#registerFace').removeClass('d-none');
                Webcam.reset();
                document.getElementById('changeImage').setAttribute('onclick', 'resetCamera()');
                return image = data_uri;
            });
            setTimeout(() => {
                removeFile(image);
            }, 60000);
        };

        $('#formRegisterFace').submit(async function(e) {
            e.preventDefault();
            var param = {
                method: 'POST',
                url: '/user/register-face',
                data: {
                    face: image,
                }
            }

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                swal({
                    title: 'Berhasil',
                    text: result.message,
                    icon: 'success',
                    timer: 3000,
                }).then(() => {
                    window.location.href = "{{ url()->current() }}";
                });
            }).catch((error) => {
                loading(false);
                swal({
                    title: "Oppss",
                    text: "Internal Server Error!",
                    icon: "error",
                    timer: 3000,
                });
            });
        });


        // $('#sinkronDataModal').click(async function() {
        //     var param = {
        //         url: '/user/sso/login',
        //         method: 'POST',
        //         processData: false,
        //         contentType: false,
        //         cache: false,
        //     }
        //     await transAjax(param).then((result) => {
        //         let aksesToken = result.metadata;
        //         localStorage.setItem("akses_token", aksesToken);
        //     }).catch((err) => {
        //         console.log(err);
        //     })
        // });

        $('#sinkronisasiData').submit(async function(e) {
            e.preventDefault();
            let checkBok = $('#flexCheckDefault').prop('checked');
            if (!checkBok) {
                $('#checkbok').removeClass('d-none');
                return;
            }
            var form = $(this)[0];
            var param = {
                url: "{{ route('user.profile.sinkronisasi') }}",
                method: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                cache: false,
            }
            loading('btnSinkronisasiDataSubmit', 'btnSinkronisasiDataLoading', true);
            await transAjax(param).then((result) => {
                loading('btnSinkronisasiDataSubmit', 'btnSinkronisasiDataLoading', false);
                $("#sinkronData").modal("hide");
                swal({
                    title: 'Berhasil',
                    text: result.message,
                    icon: 'success',
                    timer: 3000,
                }).then(() => {
                    window.location.href = "{{ url()->current() }}";
                });
            }).catch((err) => {
                loading('btnSinkronisasiDataSubmit', 'btnSinkronisasiDataLoading', false);
                $("#sinkronData").modal("hide");
                swal({
                    title: "Oops!",
                    text: err.responseJSON.message,
                    icon: 'error',
                }).then(() => {
                    window.location.href = "{{ url()->current() }}";
                });
            });
        });


        $('#btn_profile').click(function() {
            $('#btn_profile').hide();
            $('#btn_loading_profile').removeClass('d-none');
        });

        $('#btn_password').click(function() {
            $('#btn_password').hide();
            $('#btn_loading_password').removeClass('d-none');
        });

        function redirect(url) {
            window.location.href = url + '/dashboard'
        }

        function btnKeluar() {
            window.location.href = '/user/logout'
        }
    </script>
@endpush
