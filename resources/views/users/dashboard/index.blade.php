@extends('layouts.pegawai.app')
@push('css')
    <style>
        #lhkpn-container {
            max-height: 210px;
            overflow-y: scroll;
            scrollbar-width: none;
        }

        #lhkpn-container::-webkit-scrollbar {
            display: none;
        }

        .icon-ragahtuah {
            animation: rotateAnimation 2s infinite ease-in-out;
        }

        @keyframes rotateAnimation {
            0% {
                transform: rotate(8deg);
            }

            25% {
                transform: rotate(-8deg);
            }

            50% {
                transform: rotate(8deg);
            }

            75% {
                transform: rotate(-8deg);
            }

            100% {
                transform: rotate(8deg);
            }
        }

        #modalProses {
            max-height: 255px;
            overflow-y: scroll;
            scrollbar-width: none;
        }

        /* hilangkan indikator scroll bar */
        #modalProses::-webkit-scrollbar {
            display: none;
        }
    </style>
@endpush
@section('content')
    <div id="appCapsule">
        <div class="section wallet-card-section pt-1 mb-3">
            <div class="wallet-card">
                <div class="wallet-footer">
                    <div class="item">
                        <a href="{{ route('user.dokumen') }}">
                            <div class="icon-wrapper" style="background: #1E2A5E">
                                <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M64 192v-72a40 40 0 0140-40h75.89a40 40 0 0122.19 6.72l27.84 18.56a40 40 0 0022.19 6.72H408a40 40 0 0140 40v40"
                                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="32" />
                                    <path
                                        d="M479.9 226.55L463.68 392a40 40 0 01-39.93 40H88.25a40 40 0 01-39.93-40L32.1 226.55A32 32 0 0164 192h384.1a32 32 0 0131.8 34.55z"
                                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="32" />
                                </svg>
                            </div>
                            <strong>Dokumen</strong>
                        </a>
                    </div>

                    <div class="item">
                        <a href="/user/izin">
                            <div class="icon-wrapper" style="background: #1E2A5E">
                                <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                    viewBox="0 0 512 512">
                                    <rect fill="none" stroke="#fff" stroke-linejoin="round" stroke-width="32" x="48"
                                        y="80" width="416" height="384" rx="48" />
                                    <circle fill="#fff" cx="296" cy="232" r="24" />
                                    <circle fill="#fff" cx="376" cy="232" r="24" />
                                    <circle fill="#fff" cx="296" cy="312" r="24" />
                                    <circle fill="#fff" cx="376" cy="312" r="24" />
                                    <circle fill="#fff" cx="136" cy="312" r="24" />
                                    <circle fill="#fff" cx="216" cy="312" r="24" />
                                    <circle fill="#fff" cx="136" cy="392" r="24" />
                                    <circle fill="#fff" cx="216" cy="392" r="24" />
                                    <circle fill="#fff" cx="296" cy="392" r="24" />
                                    <path fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"
                                        stroke-linecap="round" d="M128 48v32M384 48v32" />
                                    <path fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"
                                        d="M464 160H48" />
                                </svg>
                            </div>
                            <strong>Cuti</strong>
                        </a>
                    </div>

                    <div class="item">
                        <a href="{{ route('baznas.home') }}">
                            <div class="icon-wrapper" style="background: #1E2A5E">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.8157 0.14841C11.0753 0.249622 10.4734 0.563912 9.92468 1.14455C8.73677 2.39106 8.74742 4.33539 9.95131 5.53928C10.6119 6.20515 11.3363 6.50879 12.2685 6.50879C13.2221 6.50879 13.9465 6.19983 14.5964 5.50732C14.9799 5.10247 15.3102 4.48987 15.4168 3.99447C15.5126 3.53635 15.454 2.64142 15.3049 2.25256C14.7562 0.824933 13.302 -0.0540139 11.8157 0.14841Z"
                                        fill="white" />
                                    <path
                                        d="M22.0287 1.53679C21.8689 2.7247 21.7091 3.05497 21.1657 3.32665C20.8994 3.45982 20.3134 3.58234 19.7008 3.63561L19.248 3.67823L19.8074 3.74748C21.5653 3.96588 21.8742 4.26419 22.0553 5.91554L22.1193 6.50684L22.2152 5.81433C22.3483 4.81819 22.5028 4.41334 22.8491 4.147C23.0888 3.96055 23.6854 3.8114 24.5484 3.73149L24.9479 3.68888L24.0689 3.55038C22.8597 3.35328 22.6253 3.22011 22.4176 2.62349C22.327 2.35714 22.1885 1.56875 22.1406 1.02008C22.1299 0.929519 22.082 1.16391 22.0287 1.53679Z"
                                        fill="white" />
                                    <path
                                        d="M14.6404 7.43028C13.9213 7.54214 13.053 7.87774 12.467 8.26661L12.174 8.46371L11.6254 8.17072C10.6559 7.65934 9.65971 7.45691 8.59965 7.55812C7.28922 7.68064 6.15991 8.22399 5.26498 9.16154C4.75892 9.6889 4.50856 10.0511 4.19959 10.7117C3.84269 11.4841 3.77344 11.8144 3.77344 12.7732C3.77344 13.4178 3.79475 13.6788 3.87465 13.9718C4.19427 15.1544 4.94004 16.2837 6.02141 17.2052C7.25726 18.26 10.1764 20.2469 12.3072 21.4828L12.4777 21.584L12.8665 21.323C13.8094 20.705 15.0453 19.8314 16.0787 19.059C18.5238 17.2265 19.4933 16.2783 20.1485 15.0585C20.9635 13.5509 21.0008 11.8516 20.2657 10.3867C19.5732 9.01238 18.3746 8.02157 16.8777 7.5741C16.4729 7.45691 16.2758 7.43028 15.5993 7.41962C15.1624 7.40897 14.731 7.4143 14.6404 7.43028ZM16.3184 8.43174C17.9058 8.76734 19.1843 9.93394 19.685 11.5054C19.8502 12.0381 19.8715 12.9011 19.733 13.4817C19.5146 14.3979 19.0245 15.2289 18.2361 16.0226C17.3092 16.9602 15.4394 18.4091 13.0903 20.0125L12.4457 20.4547L11.5987 19.938C9.40402 18.5902 7.27857 17.0827 6.4156 16.257C5.79235 15.6657 5.45675 15.2183 5.13181 14.5577C4.80687 13.8865 4.70033 13.4444 4.70033 12.7732C4.70033 12.1073 4.80687 11.6652 5.13181 10.9887C5.57395 10.0724 6.22916 9.40658 7.12941 8.95911C7.82724 8.61819 8.32265 8.50099 9.10038 8.50099C10.0912 8.50099 10.8423 8.74071 11.7585 9.35863C11.9769 9.50779 12.174 9.63031 12.19 9.63031C12.206 9.63031 12.4404 9.4705 12.7121 9.27873C12.9784 9.08696 13.2714 8.88986 13.3566 8.84725C13.623 8.70875 14.2036 8.50099 14.5339 8.43174C14.9707 8.33586 15.8603 8.33586 16.3184 8.43174Z"
                                        fill="white" />
                                    <path d="M8.75391 11.921V12.4004H12.1632H15.5724V11.921V11.4415H12.1632H8.75391V11.921Z"
                                        fill="white" />
                                    <path
                                        d="M2.87236 20.192C2.78181 20.8099 2.67527 21.2574 2.56873 21.4225C2.40892 21.6835 1.99875 21.8593 1.37017 21.9445C0.901394 22.0085 0.864106 22.0191 1.05588 22.0511C2.16388 22.2375 2.44088 22.3547 2.62733 22.717C2.72321 22.9087 2.88835 23.6652 2.899 23.9954C2.90433 24.07 2.93629 23.9208 2.97358 23.6652C3.06946 22.9886 3.14937 22.7542 3.35712 22.5092C3.56487 22.2642 3.80991 22.1789 4.54503 22.083C4.79539 22.0458 5.00314 22.0138 5.00847 22.0085C5.0138 22.0031 4.79007 21.9659 4.51306 21.9286C3.30917 21.7688 3.14937 21.6089 2.9789 20.4264L2.90965 19.9256L2.87236 20.192Z"
                                        fill="white" />
                                </svg>
                            </div>
                            <strong>Baznas</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="javascript:void(0)" id="scanner">
                            <div class="icon-wrapper" style="background: #1E2A5E">
                                <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                    viewBox="0 0 512 512">
                                    <rect x="336" y="336" fill="#fff" width="80" height="80" rx="8"
                                        ry="8" />
                                    <rect x="272" y="272" fill="#fff" width="64" height="64" rx="8"
                                        ry="8" />
                                    <rect x="416" y="416" fill="#fff" width="64" height="64" rx="8"
                                        ry="8" />
                                    <rect x="432" y="272" fill="#fff" width="48" height="48" rx="8"
                                        ry="8" />
                                    <rect x="272" y="432" fill="#fff" width="48" height="48" rx="8"
                                        ry="8" />
                                    <rect x="336" y="96" fill="#fff" width="80" height="80" rx="8"
                                        ry="8" />
                                    <rect x="288" y="48" width="176" height="176" rx="16" ry="16"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32" />
                                    <rect x="96" y="96" fill="#fff"width="80" height="80" rx="8"
                                        ry="8" />
                                    <rect x="48" y="48" width="176" height="176" rx="16" ry="16"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32" />
                                    <rect x="96" y="336" fill="#fff" width="80" height="80" rx="8"
                                        ry="8" />
                                    <rect x="48" y="288" width="176" height="176" rx="16" ry="16"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32" />
                                </svg>
                            </div>
                            <strong>Scanner</strong>
                        </a>
                    </div>
                </div>
                <div class="wallet-footer">
                    <div class="item">
                        <a href="#" id="ragahTuah">
                            <div class="icon-wrapper" style="background: #1E2A5E">
                                {{-- <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M32 160v296a8 8 0 008 8h136V160a16 16 0 00-16-16H48a16 16 0 00-16 16zM320 48H192a16 16 0 00-16 16v400h160V64a16 16 0 00-16-16zM464 208H352a16 16 0 00-16 16v240h136a8 8 0 008-8V224a16 16 0 00-16-16z"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32" />
                                </svg> --}}
                                <img class="icon-ragahtuah" src="{{ asset('assets/icon/gim_ragah_tuah.png') }}"
                                    alt="" width="40px">
                            </div>
                            <strong>Gim Ragah Tuah</strong>
                        </a>
                    </div>
                    <div class="item"><a href="{{ route('user.kepegawaian') }}">
                            <div class="icon-wrapper" style="background: #1E2A5E">
                                <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" style="fill: #ffff;transform: ;msFilter:;">
                                    <path
                                        d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z">
                                    </path>
                                </svg>
                            </div>
                            <strong>Layanan Kepegawaian</strong>
                        </a>
                    </div>
                    <div class="item"><a href="{{ route('user.ekin') }}">
                            <div class="icon-wrapper" style="background: #1E2A5E">
                                <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M32 160v296a8 8 0 008 8h136V160a16 16 0 00-16-16H48a16 16 0 00-16 16zM320 48H192a16 16 0 00-16 16v400h160V64a16 16 0 00-16-16zM464 208H352a16 16 0 00-16 16v240h136a8 8 0 008-8V224a16 16 0 00-16-16z"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32" />
                                </svg>
                            </div>
                            <strong>Tugas <br>Harian</strong>
                        </a></div>
                    <div class="item">
                        <a href="{{ route('user.apps') }}">
                            <div class="icon-wrapper" style="background: #1E2A5E">
                                <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                    viewBox="0 0 512 512">
                                    <rect x="48" y="48" width="176" height="176" rx="20" ry="20"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32" />
                                    <rect x="288" y="48" width="176" height="176" rx="20" ry="20"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32" />
                                    <rect x="48" y="288" width="176" height="176" rx="20" ry="20"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32" />
                                    <rect x="288" y="288" width="176" height="176" rx="20" ry="20"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32" />
                                </svg>
                            </div>
                            <strong>Lainnya</strong>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card mt-3 shadow-sm text-white border-0 position-relative h-50">
                <div class="position-absolute w-100 h-100"
                    style="background: linear-gradient(rgba(30, 42, 94, 0.85), rgba(30, 42, 94, 0.85)), url('{{ asset('assets/img/ramadhan.jpg') }}') center/cover no-repeat; border-radius: 10px;">
                </div>

                <div class="card-body text-center position-relative" style="z-index: 1; padding: 12px;">
                    <h6 class="card-title font-weight-bold text-white" style="font-size: 1.2rem;">
                        Jadwal Imsak & Maghrib
                        <div class="small" style="font-size: 0.9rem;">
                            {{ \Carbon\Carbon::parse(now())->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</div>
                    </h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                style="fill: #fff;transform: ;msFilter:;">
                                <path
                                    d="M20.742 13.045a8.088 8.088 0 0 1-2.077.271c-2.135 0-4.14-.83-5.646-2.336a8.025 8.025 0 0 1-2.064-7.723A1 1 0 0 0 9.73 2.034a10.014 10.014 0 0 0-4.489 2.582c-3.898 3.898-3.898 10.243 0 14.143a9.937 9.937 0 0 0 7.072 2.93 9.93 9.93 0 0 0 7.07-2.929 10.007 10.007 0 0 0 2.583-4.491 1.001 1.001 0 0 0-1.224-1.224zm-2.772 4.301a7.947 7.947 0 0 1-5.656 2.343 7.953 7.953 0 0 1-5.658-2.344c-3.118-3.119-3.118-8.195 0-11.314a7.923 7.923 0 0 1 2.06-1.483 10.027 10.027 0 0 0 2.89 7.848 9.972 9.972 0 0 0 7.848 2.891 8.036 8.036 0 0 1-1.484 2.059z">
                                </path>
                            </svg>
                            <p class="mb-0 font-weight-bold small">Imsak</p>
                            <span class="badge badge-warning p-1 imsak">-</span>
                        </div>
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                style="fill: #fff;transform: ;msFilter:;">
                                <path
                                    d="m21.707 11.293-2-2L19 8.586V6a1 1 0 0 0-1-1h-2.586l-.707-.707-2-2a.999.999 0 0 0-1.414 0l-2 2L8.586 5H6a1 1 0 0 0-1 1v2.586l-.707.707-2 2a.999.999 0 0 0 0 1.414l2 2 .707.707V18a1 1 0 0 0 1 1h2.586l.707.707 2 2a.997.997 0 0 0 1.414 0l2-2 .707-.707H18a1 1 0 0 0 1-1v-2.586l.707-.707 2-2a.999.999 0 0 0 0-1.414zm-4.414 3-.293.293V17h-2.414l-.293.293-1 1L12 19.586l-1.293-1.293-1-1L9.414 17H7v-2.414l-.293-.293-1-1L4.414 12l1.293-1.293 1-1L7 9.414V7h2.414l.293-.293 1-1L12 4.414l1.293 1.293 1 1 .293.293H17v2.414l.293.293 1 1L19.586 12l-1.293 1.293-1 1z">
                                </path>
                                <path d="M12 8v8c2.206 0 4-1.794 4-4s-1.794-4-4-4z"></path>
                            </svg>
                            <p class="mb-0 font-weight-bold small">Maghrib</p>
                            <span class="badge badge-success p-1 maghrib">-</span>
                        </div>
                    </div>
                </div>
            </div>


            {{-- dwontime --}}
            {{-- <div class="alert alert-danger mt-2" role="alert">
                <h4 class="alert-heading">Gangguan layanan!</h4>
                <p>Telah terjadi downtime pada: <strong>10-02-2025, 13:07</strong>. <span class="fw-bold">Presensi menjadi mode auto save.</span></p>
                <hr>
                <p class="mb-0"><strong>Catatan:</strong> Tidak akan ada pengurangan TPP selama server downtime.</p>
            </div> --}}

            {{-- LHKPN --}}
            <div class="card mt-2">
                <div class="card-header d-flex align-items-center">
                    <span>Daftar wajib LHKPN yang perlu melakukan perbaikan</span>
                    <span class="badge badge-primary ml-auto">
                        <a href="{{ route('user.lhkpn') }}" class="text-white"><svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24"
                                style="fill: #fff;transform: ;msFilter:;">
                                <path
                                    d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z">
                                </path>
                            </svg></a>
                    </span>
                </div>
                <div class="card-body" id="lhkpn-container">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Unit Organisasi</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lhkpn as $key => $item)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $item->td_2 }}</td>
                                        <td>{{ $item->td_1 }}</td>
                                        <td>{{ $item->td_3 }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="empty text-center">
                                                <div class="empty-img">
                                                    <svg style="width: 96px; height: 50px"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-database-off" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M12.983 8.978c3.955 -.182 7.017 -1.446 7.017 -2.978c0 -1.657 -3.582 -3 -8 -3c-1.661 0 -3.204 .19 -4.483 .515m-2.783 1.228c-.471 .382 -.734 .808 -.734 1.257c0 1.22 1.944 2.271 4.734 2.74">
                                                        </path>
                                                        <path
                                                            d="M4 6v6c0 1.657 3.582 3 8 3c.986 0 1.93 -.067 2.802 -.19m3.187 -.82c1.251 -.53 2.011 -1.228 2.011 -1.99v-6">
                                                        </path>
                                                        <path
                                                            d="M4 12v6c0 1.657 3.582 3 8 3c3.217 0 5.991 -.712 7.261 -1.74m.739 -3.26v-4">
                                                        </path>
                                                        <line x1="3" y1="3" x2="21"
                                                            y2="21"></line>
                                                    </svg>
                                                </div>
                                                <p class="empty-title">Data kosong</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Akhir dari LHKPN --}}

            @if (isset($jam_ganti))
                <div class="transactions mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-danger">
                                <div class="card-body text-center">
                                    Anda mempunyai kewajiban mengganti jam kerja selama {{ $jam_ganti }} menit!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="transactions mt-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3>Estimasi TPP Anda: {{ formatRp($tpp_akhir) }}</h3>
                                <div class="badge  bg-primary"><a href="javacsript:void(0)" data-toggle="modal"
                                        data-target="#modalTPP" class="text-white">Rumus perhitungan</a></div>
                                <div class="badge  bg-primary"><a href="javacsript:void(0)" onclick="riwayatTpp()"
                                        data-toggle="modal" data-target="#riwayatTpp" class="text-white">Riwayat
                                        pengurangan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-title mt-1">Media center</div>
            <div id="instagram-section" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#instagram-section" data-slide-to="0" class="active"></li>
                    <li data-target="#instagram-section" data-slide-to="1"></li>
                    <li data-target="#instagram-section" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" id="feed-informasi">
                    <div class="col-12">
                        <div class="ph-item">
                            <div class="ph-picture"></div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#instagram-section" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#instagram-section" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="section mt-3">
            <div class="section-title mb-1">Presensi bulan
                <select id="getBulan" class="select select-change text-primary" name="bulan" required>
                    <option value="01" {{ date('m') == '01' ? 'selected' : '' }}>Januari</option>
                    <option value="02" {{ date('m') == '02' ? 'selected' : '' }}>Februari</option>
                    <option value="03" {{ date('m') == '03' ? 'selected' : '' }}>Maret</option>
                    <option value="04" {{ date('m') == '04' ? 'selected' : '' }}>April</option>
                    <option value="05" {{ date('m') == '05' ? 'selected' : '' }}>Mei</option>
                    <option value="06" {{ date('m') == '06' ? 'selected' : '' }}>Juni</option>
                    <option value="07" {{ date('m') == '07' ? 'selected' : '' }}>Juli</option>
                    <option value="08" {{ date('m') == '08' ? 'selected' : '' }}>Agustus</option>
                    <option value="09" {{ date('m') == '09' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ date('m') == '10' ? 'selected' : '' }}>Oktober</option>
                    <option value="12" {{ date('m') == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ date('m') == '12' ? 'selected' : '' }}>Desember</option>
                </select><span class="text-primary">{{ date('Y') }}</span>
            </div>
        </div>
        <div class="section mt-2 mb-2" id="presensi-section">
            <div class="transactions">
                <div class="row">
                    <div class="load-home" style="display:contents">
                        <div class="col-6 col-md-3 mb-2">
                            <a href="javascript:void(0)" class="item">
                                <div class="detail">
                                    <div class="icon-block text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" viewBox="0 0 512 512">
                                            <path fill="#6777ef"
                                                d="M392 80H232a56.06 56.06 0 00-56 56v104h153.37l-52.68-52.69a16 16 0 0122.62-22.62l80 80a16 16 0 010 22.62l-80 80a16 16 0 01-22.62-22.62L329.37 272H176v104c0 32.05 33.79 56 64 56h152a56.06 56.06 0 0056-56V136a56.06 56.06 0 00-56-56zM80 240a16 16 0 000 32h96v-32z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <strong>Hadir</strong>
                                        <p>{{ $hadir }} Hari</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3 mb-2">
                            <a href="javascript:void(0)" class="item">
                                <div class="detail">
                                    <div class="icon-block text-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" viewBox="0 0 512 512">
                                            <path fill="#FFB400"
                                                d="M414.39 97.61A224 224 0 1097.61 414.39 224 224 0 10414.39 97.61zM184 208a24 24 0 11-24 24 23.94 23.94 0 0124-24zm-23.67 149.83c12-40.3 50.2-69.83 95.62-69.83s83.62 29.53 95.71 69.83a8 8 0 01-7.82 10.17H168.15a8 8 0 01-7.82-10.17zM328 256a24 24 0 1124-24 23.94 23.94 0 01-24 24z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <strong>Cuti</strong>
                                        <p>{{ $cuti }} Hari</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-3">
                            <a href="javascript:void(0)" class="item">
                                <div class="detail">
                                    <div class="icon-block text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" viewBox="0 0 512 512">
                                            <path fill="#FF396F"
                                                d="M153.59 110.46A21.41 21.41 0 00152.48 79 62.67 62.67 0 00112 64l-3.27.09h-.48C74.4 66.15 48 95.55 48.07 131c0 19 8 29.06 14.32 37.11a20.61 20.61 0 0014.7 7.8c.26 0 .7.05 2 .05a19.06 19.06 0 0013.75-5.89zM403.79 64.11l-3.27-.1H400a62.67 62.67 0 00-40.52 15 21.41 21.41 0 00-1.11 31.44l60.77 59.65a19.06 19.06 0 0013.79 5.9c1.28 0 1.72 0 2-.05a20.61 20.61 0 0014.69-7.8c6.36-8.05 14.28-18.08 14.32-37.11.06-35.49-26.34-64.89-60.15-66.93z" />
                                            <path fill="#FF396F"
                                                d="M256.07 96c-97 0-176 78.95-176 176a175.23 175.23 0 0040.81 112.56l-36.12 36.13a16 16 0 1022.63 22.62l36.12-36.12a175.63 175.63 0 00225.12 0l36.13 36.12a16 16 0 1022.63-22.62l-36.13-36.13A175.17 175.17 0 00432.07 272c0-97-78.95-176-176-176zm16 176a16 16 0 01-16 16h-80a16 16 0 010-32h64v-96a16 16 0 0132 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <strong>Terlambat</strong>
                                        <p>{{ $terlambat }} hari</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="javascript:void(0)" class="item">
                                <div class="detail">
                                    <div class="icon-block text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" viewBox="0 0 512 512">
                                            <path
                                                d="M320 176v-40a40 40 0 00-40-40H88a40 40 0 00-40 40v240a40 40 0 0040 40h192a40 40 0 0040-40v-40M384 176l80 80-80 80M191 256h273"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="32" />
                                        </svg>
                                    </div>
                                    <div>
                                        <strong>DL</strong>
                                        <p>{{ $dl }} Hari</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-title mt-2">1 Minggu terakhir</div>
            <div class="transactions" id="dataTable">

            </div>
        </div>
        {{-- modal --}}
        <div class="modal fade modalbox" id="modal-show" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">...</h5>
                        <a href="javascript:;" data-dismiss="modal">Close</a>
                    </div>
                    <div class="modal-body">
                        <div class="form-group basic">
                            <div class="input-wrapper text-center">
                                <img id="photoAbsen" class="img-fluid rounded" src="" alt="">
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label">Nama</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ auth()->user()->nama }}" readonly><i class="clear-input"><ion-icon
                                        name="close-circle" role="img" class="md hydrated"
                                        aria-label="close circle"></ion-icon></i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label datepicker">Tanggal</label>
                                <input name="tanggal" type="text" class="form-control" value="" readonly><i
                                    class="clear-input"><ion-icon name="close-circle" role="img" class="md hydrated"
                                        aria-label="close circle"></ion-icon></i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label">Waktu Presensi</label>
                                <input name="jam_masuk" type="text" class="form-control" value="" readonly><i
                                    class="clear-input"><ion-icon name="close-circle" role="img" class="md hydrated"
                                        aria-label="close circle"></ion-icon></i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label">Keterangan</label>
                                <input name="status" type="text" class="form-control" value="" readonly><i
                                    class="clear-input"><ion-icon name="close-circle" role="img" class="md hydrated"
                                        aria-label="close circle"></ion-icon></i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label">Lokasi Saat Presensi</label>
                                <input name="latlong" type="text" class="form-control" value="" readonly><i
                                    class="clear-input"><ion-icon name="close-circle" role="img" class="md hydrated"
                                        aria-label="close circle"></ion-icon></i>
                            </div>
                            <div id="map" style="height: 390px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DialogIconedInfo -->
        <div class="modal fade dialogbox" id="DialogIconedInfo" data-bs-backdrop="static" tabindex="-1"
            role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-icon">
                        <svg width="50px" height="50px" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                            viewBox="0 0 512 512">
                            <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z"
                                fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                            <path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                            <path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" />
                        </svg>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleProses">Penyesuaian jam kerja selama Ramdhan</h5>
                    </div>
                    <div class="modal-body" id="modalProses">
                        <ul class="list-group">
                            <li class="list-group-item">Jam mulai masuk: <br> <span
                                    class="font-weight-bold">06:00:00</span></li>
                            <li class="list-group-item">Batas jam masuk normal: <br> <span
                                    class="font-weight-bold">08:00:00</span></li>
                            <li class="list-group-item">Batas jam masuk toleransi: <br> <span
                                    class="font-weight-bold">08:30:00</span></li>
                            <li class="list-group-item">Jam mulai pulang: <br> <span
                                    class="font-weight-bold">14:00:00</span></li>
                            <li class="list-group-item">Jam pulang normal: <br> <span
                                    class="font-weight-bold">15:00:00</span></li>
                            <li class="list-group-item">Jam pulang hari jumat: <br> <span
                                    class="font-weight-bold">15:30:00</span></li>
                            <li class="list-group-item">Batas jam pulang: <br> <span
                                    class="font-weight-bold">18:00:00</span></li>
                        </ul>
                        <p>Catatan: Jam masuk toleransi harus diganti pada saat jam pulang</p>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn" data-dismiss="modal">TUTUP</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal -->
        <x-modal_devapp idModal="gimRagamTuah" title="Coming soon"
            body="Aplikasi ini sedang dalam tahap pengembangan"></x-modal_devapp>
        <x-modal_primary idModal="riwayatTpp" idBody="dataRiwayatTpp" title="Riwayat Pengurangan TPP"
            url="{{ route('user.tpp') }}" btnNext="Riwayat"></x-modal_primary>
        <!-- end modal-->

        @include('components._modal_rumus_tpp')

        {{-- modal selfi --}}
        @include('layouts.modal._modal')
    </div>

    <!-- Modal feed-->
    <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail postingan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="showMediafeed">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="col-12">
                                <div class="ph-item">
                                    <div class="ph-picture"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#dataTable').html(make_skeleton());
        var bulan = '';
        $(document).ready(function() {
            // loadData();
            // loadFeed();

            let jamKerja = localStorage.getItem('jamKerja');
            if (!jamKerja) {
                changeRefreshStatus(false)
                $('#DialogIconedInfo').modal('show');
                localStorage.setItem('jamKerja', 'true');
            }

            getJadwalSholat();

            //get feed instagram
            let feedObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        getInstagram();
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            let presensiObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        getPresensi();
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            let feedSection = document.getElementById("instagram-section");
            let presensiSection = document.getElementById("presensi-section");

            if (feedSection) feedObserver.observe(feedSection);
            if (presensiSection) presensiObserver.observe(presensiSection);

            $('#getBulan').change(function() {
                filterData();
            });

            const tableContainer = document.getElementById("lhkpn-container");

            // Fungsi untuk scroll otomatis
            function autoScroll() {
                // Jika scroll sudah mencapai batas bawah, kembali ke atas
                if (tableContainer.scrollTop + tableContainer.clientHeight >= tableContainer.scrollHeight) {
                    tableContainer.scrollTop = 0;
                } else {
                    // Scroll sedikit demi sedikit
                    tableContainer.scrollTop += 20; // Ubah angka ini untuk kecepatan scroll
                }
            }

            // Jalankan scroll setiap 1 detik
            setInterval(autoScroll, 1000);
        });

        async function getInstagram() {
            console.log('get instagram');
            var param = {
                url: "/api/instagram-kominfo",
                method: "GET",
                data: {
                    feed: "feed"
                }
            }

            await transAjax(param).then((result) => {
                $('#feed-informasi').html(result);
            }).catch((err) => {
               return alert('Internal server error!');
            });
        }

        async function getPresensi() {
            console.log('get presensi');
            var param = {
                method: 'GET',
                url: '{{ url()->current() }}',
                data: {
                    load: 'table',
                    bulan: bulan,
                }
            }
            await transAjax(param).then((result) => {
                $('#dataTable').html(result)

            }).catch((err) => {
                return alert('Internal server error!');
            });
        }

        async function showMedia(id) {
            $('#mediaModal').modal('show');

            $('#showMediafeed').html(
                `<div class="col-md-6">
                <div class="col-12">
                    <div class="ph-item">
                        <div class="ph-picture"></div>
                    </div>
                </div>
            </div>`);

            var param = {
                url: "/api/instagram-kominfo/show/" + id,
                method: "GET",
                data: {
                    load: "feed",
                }
            }

            await transAjax(param).then((result) => {
                $('#showMediafeed').html(result);
            }).catch((err) => {
                return alert('Internal server error!');
            });
        }

        function filterData() {
            bulan = $('#getBulan').val();
            loadData();
        }


        function make_skeleton() {
            var output = '';
            for (var count = 0; count < 3; count++) {
                output += '<div class="col-12">';
                output += '<div class="ph-item">';
                output += '<div class="ph-picture"></div>';
                output += '</div>';
                output += '</div>';
            }
            return output;
        }

        //ambil riwayat tpp ketika tombol riwayat pengurangan di klik
        async function riwayatTpp() {
            var param = {
                url: "/user/tpp/riwayat",
                method: "GET",
                data: {
                    "load": "table"
                }
            }

            await transAjax(param).then((result) => {
                $("#dataRiwayatTpp").html(result);
            }).catch((error) => {
                $("#dataRiwayatTpp").html("Internal Server Error!");
            });
        }
        //akhir dari ambil riwayat tpp ketika tombol riwayat pengurangan di klik

        async function getJadwalSholat() {
            var param = {
                method: 'GET',
                url: '/api/v2/jadwal-sholat',
                data: {
                    load: 'jadwal-sholat',
                }
            }
            await transAjax(param).then((result) => {
                let jadwal = result.data.jadwal;
                $('.imsak').html('Jam ' + jadwal.imsak);
                $('.maghrib').html('Jam ' + jadwal.maghrib);
            }).catch((err) => {
                return alert('Internal server error!');
            });
        }
    </script>
@endpush
