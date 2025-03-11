@extends('layouts.general')
@section('content')
    <div class="container mt-3" style="padding-bottom: 20px">
        <div style="padding-top: 50px">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary font-weight-bold">Semua layanan</div>
                <a class="btn btn-primary btn-sm" href="/user/dashboard">&lt; kembali</a>
            </div>
            <hr>
        </div>
        <div class="wallet-card">
            <div class="wallet-footer">
                <div class="item">
                    <a href="/user/izin">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                <rect fill="none" stroke="#fff" stroke-linejoin="round" stroke-width="32" x="48" y="80"
                                    width="416" height="384" rx="48" />
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
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalPersetujuan">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="24" height="24"
                                viewBox="0 0 512 512">
                                <path
                                    d="M218.1 167.17c0 13 0 25.6 4.1 37.4-43.1 50.6-156.9 184.3-167.5 194.5a20.17 20.17 0 00-6.7 15c0 8.5 5.2 16.7 9.6 21.3 6.6 6.9 34.8 33 40 28 15.4-15 18.5-19 24.8-25.2 9.5-9.3-1-28.3 2.3-36s6.8-9.2 12.5-10.4 15.8 2.9 23.7 3c8.3.1 12.8-3.4 19-9.2 5-4.6 8.6-8.9 8.7-15.6.2-9-12.8-20.9-3.1-30.4s23.7 6.2 34 5 22.8-15.5 24.1-21.6-11.7-21.8-9.7-30.7c.7-3 6.8-10 11.4-11s25 6.9 29.6 5.9c5.6-1.2 12.1-7.1 17.4-10.4 15.5 6.7 29.6 9.4 47.7 9.4 68.5 0 124-53.4 124-119.2S408.5 48 340 48s-121.9 53.37-121.9 119.17zM400 144a32 32 0 11-32-32 32 32 0 0132 32z"
                                    fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            </svg>
                        </div><strong>Persetujuan</strong>
                    </a>
                </div>

                <div class="item">
                    <a href="/user/scan">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
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
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                                <rect x="96" y="96" fill="#fff"width="80" height="80" rx="8"
                                    ry="8" />
                                <rect x="48" y="48" width="176" height="176" rx="16" ry="16"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                                <rect x="96" y="336" fill="#fff" width="80" height="80" rx="8"
                                    ry="8" />
                                <rect x="48" y="288" width="176" height="176" rx="16" ry="16"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                            </svg>
                        </div>
                        <strong>Scanner</strong>
                    </a>
                </div>

            </div>
            <div class="wallet-footer">
                @if (count(auth()->user()->opd->shift) > 0)
                    <div class="item"><a href="/user/shift">
                            <div class="icon-wrapper bg-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" style="fill: rgb(243, 237, 237);transform: ;msFilter:;">
                                    <path
                                        d="M19.924 10.383a1 1 0 0 0-.217-1.09l-5-5-1.414 1.414L16.586 9H4v2h15a1 1 0 0 0 .924-.617zM4.076 13.617a1 1 0 0 0 .217 1.09l5 5 1.414-1.414L7.414 15H20v-2H5a.999.999 0 0 0-.924.617z">
                                    </path>
                                </svg>
                            </div>
                            <strong>Shift</strong>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <h4 class="mt-3">Layanan pegawai</h4>
        <div class="wallet-card">
            <div class="wallet-footer">
                <div class="item">
                    <a href="{{ route('user.ekin') }}">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <path
                                    d="M32 160v296a8 8 0 008 8h136V160a16 16 0 00-16-16H48a16 16 0 00-16 16zM320 48H192a16 16 0 00-16 16v400h160V64a16 16 0 00-16-16zM464 208H352a16 16 0 00-16 16v240h136a8 8 0 008-8V224a16 16 0 00-16-16z"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                            </svg>
                        </div>
                        <strong>Tugas Harian</strong>
                    </a>
                </div>
                <div class="item">
                    <a href="javacsript:void(0)" data-toggle="modal" data-target="#underConstruction">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <path
                                    d="M408 64H104a56.16 56.16 0 00-56 56v192a56.16 56.16 0 0056 56h40v80l93.72-78.14a8 8 0 015.13-1.86H408a56.16 56.16 0 0056-56V120a56.16 56.16 0 00-56-56z"
                                    fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            </svg>
                        </div>
                        <strong>WBS</strong>
                    </a>
                </div>
                <div class="item">
                    @if (auth()->user()->opd_id == 19)
                        <a href="/user/ekin">
                            <div class="icon-wrapper" style="background: #1E2A5E">
                                <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M336 64h32a48 48 0 0148 48v320a48 48 0 01-48 48H144a48 48 0 01-48-48V112a48 48 0 0148-48h32"
                                        fill="none" stroke="currentColor" stroke-linejoin="round"
                                        stroke-width="32" />
                                    <rect x="176" y="32" width="160" height="64" rx="26.13" ry="26.13"
                                        fill="none" stroke="currentColor" stroke-linejoin="round"
                                        stroke-width="32" />
                                </svg>
                            </div>
                            <strong>Sekelik</strong>
                        </a>
                    @else
                        <a href="javacsript:void(0)" data-toggle="modal" data-target="#underConstruction">
                            <div class="icon-wrapper" style="background: #1E2A5E">
                                <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z"
                                        fill="none" stroke="currentColor" stroke-linejoin="round"
                                        stroke-width="32" />
                                    <path d="M256 56v120a32 32 0 0032 32h120" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                </svg>
                            </div>
                            <strong>Sibete</strong>
                        </a>
                    @endif
                </div>
                <div class="item">
                    <a href="https://sikeptemen.tulangbawangkab.go.id/main">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <rect x="48" y="96" width="416" height="304" rx="32.14" ry="32.14"
                                    fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                    stroke-width="32" d="M16 416h480" />
                            </svg>
                        </div><strong>Simakpai</strong>
                    </a>
                </div>
            </div>
            <div class="wallet-footer">
                <div class="item">
                    <a href="{{ route('user.kegiatan') }}">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <rect x="48" y="80" width="416" height="384" rx="48" fill="none"
                                    stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="32"
                                    d="M128 48v32M384 48v32M464 160H48M304 260l43.42-32H352v168M191.87 306.63c9.11 0 25.79-4.28 36.72-15.47a37.9 37.9 0 0011.13-27.26c0-26.12-22.59-39.9-47.89-39.9-21.4 0-33.52 11.61-37.85 18.93M149 374.16c4.88 8.27 19.71 25.84 43.88 25.84 28.59 0 52.12-15.94 52.12-43.82 0-12.62-3.66-24-11.58-32.07-12.36-12.64-31.25-17.48-41.55-17.48" />
                            </svg>
                        </div><strong>Kegiatan</strong>
                    </a>
                </div>
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
                        </div><strong>Dokumen</strong>
                    </a>
                </div>
                <div class="item">
                    <a href="{{ route('user.kepegawaian') }}">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" style="fill: #ffff;transform: ;msFilter:;">
                                <path
                                    d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z">
                                </path>
                            </svg>
                        </div><strong>Kepegawaian</strong>
                    </a>
                </div>
                <div class="item">
                    <a href="javacsript:void(0)" data-toggle="modal" data-target="#underConstruction">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <ellipse cx="256" cy="128" rx="192" ry="80" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                    stroke-width="32" />
                                <path
                                    d="M448 214c0 44.18-86 80-192 80S64 258.18 64 214M448 300c0 44.18-86 80-192 80S64 344.18 64 300"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                    stroke-width="32" />
                                <path d="M64 127.24v257.52C64 428.52 150 464 256 464s192-35.48 192-79.24V127.24"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                    stroke-width="32" />
                            </svg>
                        </div><strong>Portal</strong>
                    </a>
                </div>
            </div>
        </div>

        <h4 class="mt-3">Lainnya</h4>
        <div class="wallet-card">
            <div class="wallet-footer">
                <div class="item">
                    <a href="{{ route('food') }}">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <path
                                    d="M322 416c0 35.35-20.65 64-56 64H134c-35.35 0-56-28.65-56-64M336 336c17.67 0 32 17.91 32 40h0c0 22.09-14.33 40-32 40H64c-17.67 0-32-17.91-32-40h0c0-22.09 14.33-40 32-40"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                    stroke-width="32" />
                                <path
                                    d="M344 336H179.31a8 8 0 00-5.65 2.34l-26.83 26.83a4 4 0 01-5.66 0l-26.83-26.83a8 8 0 00-5.65-2.34H56a24 24 0 01-24-24h0a24 24 0 0124-24h288a24 24 0 0124 24h0a24 24 0 01-24 24zM64 276v-.22c0-55 45-83.78 100-83.78h72c55 0 100 29 100 84v-.22M241 112l7.44 63.97"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                    stroke-width="32" />
                                <path d="M256 480h139.31a32 32 0 0031.91-29.61L463 112" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                    stroke-width="32" />
                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="32" d="M368 112l16-64 47-16" />
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                    stroke-width="32" d="M224 112h256" />
                            </svg>
                        </div>
                        <strong>Pesan makan</strong>
                    </a>
                </div>
                <div class="item">
                    <a href="{{ route('user.otp') }}">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="24" height="24"
                                viewBox="0 0 512 512">
                                <path
                                    d="M218.1 167.17c0 13 0 25.6 4.1 37.4-43.1 50.6-156.9 184.3-167.5 194.5a20.17 20.17 0 00-6.7 15c0 8.5 5.2 16.7 9.6 21.3 6.6 6.9 34.8 33 40 28 15.4-15 18.5-19 24.8-25.2 9.5-9.3-1-28.3 2.3-36s6.8-9.2 12.5-10.4 15.8 2.9 23.7 3c8.3.1 12.8-3.4 19-9.2 5-4.6 8.6-8.9 8.7-15.6.2-9-12.8-20.9-3.1-30.4s23.7 6.2 34 5 22.8-15.5 24.1-21.6-11.7-21.8-9.7-30.7c.7-3 6.8-10 11.4-11s25 6.9 29.6 5.9c5.6-1.2 12.1-7.1 17.4-10.4 15.5 6.7 29.6 9.4 47.7 9.4 68.5 0 124-53.4 124-119.2S408.5 48 340 48s-121.9 53.37-121.9 119.17zM400 144a32 32 0 11-32-32 32 32 0 0132 32z"
                                    fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            </svg>
                        </div>
                        <strong>OTP</strong>
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
                {{-- <div class="item">
                <a href="javacsript:void(0)" data-toggle="modal" data-target="#underConstruction">
                    <div class="icon-wrapper" style="background: #1E2A5E">
                        <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                            viewBox="0 0 512 512">
                            <path
                                d="M259.92 262.91L216.4 149.77a9 9 0 00-16.8 0l-43.52 113.14a9 9 0 01-5.17 5.17L37.77 311.6a9 9 0 000 16.8l113.14 43.52a9 9 0 015.17 5.17l43.52 113.14a9 9 0 0016.8 0l43.52-113.14a9 9 0 015.17-5.17l113.14-43.52a9 9 0 000-16.8l-113.14-43.52a9 9 0 01-5.17-5.17zM108 68L88 16 68 68 16 88l52 20 20 52 20-52 52-20-52-20zM426.67 117.33L400 48l-26.67 69.33L304 144l69.33 26.67L400 240l26.67-69.33L496 144l-69.33-26.67z"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                        </svg>
                    </div>
                    <strong>Gemini AI</strong>
                </a>
            </div> --}}
                <div class="item">
                    <a href="{{ route('user.drive') }}">
                        <div class="icon-wrapper" style="background: #1E2A5E">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                viewBox="0 0 512 512">
                                <path
                                    d="M432 112V96a48.14 48.14 0 00-48-48H64a48.14 48.14 0 00-48 48v256a48.14 48.14 0 0048 48h16"
                                    fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                                <rect x="96" y="128" width="400" height="336" rx="45.99" ry="45.99"
                                    fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                                <ellipse cx="372.92" cy="219.64" rx="30.77" ry="30.55" fill="none"
                                    stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                <path
                                    d="M342.15 372.17L255 285.78a30.93 30.93 0 00-42.18-1.21L96 387.64M265.23 464l118.59-117.73a31 31 0 0141.46-1.87L496 402.91"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                            </svg>
                        </div>
                        <strong>DOKPIM</strong>
                    </a>
                </div>
            </div>
        </div>

        {{-- Modal Persetujuan --}}
        <div class="modal fade action-sheet" id="modalPersetujuan" data-bs-backdrop="static" tabindex="-1"
            role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Persetujuan</h5>
                    </div>
                    <div class="modal-body mt-1 pb-2">
                        <div class="container action-sheet-contents">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('user.approval.dl') }}">Dinas Luar (DL)</a>
                                <span class="badge bg-primary">{{ $dl_pending }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('user.approval.cuti') }}">Cuti</a>
                                <span class="badge bg-primary">{{ $izin_pending }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Persetujuan --}}
        <!-- * under construction -->
        @include('components._modal_commingsoon')
        @include('components._modal_progress')
        {{-- @include('components._modal_layanan_bkpp') --}}
        <!-- * under construction -->
    @endsection
