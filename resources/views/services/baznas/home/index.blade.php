@extends('layouts.general')
@push('css')
    <style>
        .action-sheet-contents {
            max-height: 500px;
            overflow-y: auto;
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
    <div class="container mt-3">
        <div style="padding-top: 50px">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary font-weight-bold">Selamat datang di Baznas</div>
                <a class="btn btn-primary btn-sm" href="/user/apps">&lt; kembali</a>
            </div>
            <hr>
        </div>
    </div>
    <div class="container">
        <div class="row mt-2">
            <div class="col-6">
                {{-- <a href="/user/presensi"> --}}
                <div class="stat-box" style="border-top: 3px solid #1e2a5e;">
                    <div class="title">Pending</div>
                    <div class="value">2</div>
                </div>
                {{-- </a> --}}
            </div>
            <div class="col-6">
                {{-- <a href="/user/presensi"> --}}
                <div class="stat-box" style="border-top: 3px solid #1e2a5e;">
                    <div class="title">Riwayat</div>
                    <div class="value">12</div>
                </div>
                {{-- </a> --}}
            </div>
        </div>
    </div>

    <div class="section mt-2 mb-2">
        <div class="transactions">
            <div class="row">
                <div class="load-home" style="display:contents">
                    <a href="javascript:void(0)" class="col-3 mb-2 text-center" data-kategori="Zakat Penghasilan"
                        onclick="modalForm(this)">
                        <div class="item d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                id="Health-Care-2--Streamline-Flex" height="24" width="24">
                                <g id="health-care-2--health-medical-hospital-heart-care-symbol">
                                    <path id="Union" fill="#7c93c3" fill-rule="evenodd"
                                        d="M8.837142857142856 9.96342857142857c1.188 0.45085714285714285 2.297142857142857 1.3131428571428572 3.162857142857143 2.1359999999999997 0.8674285714285714 -0.8228571428571427 1.9765714285714284 -1.685142857142857 3.162857142857143 -2.1359999999999997 0.6702857142857143 -0.25371428571428567 1.3834285714285715 -0.384 2.0982857142857143 -0.2897142857142857 0.7234285714285713 0.096 1.4228571428571428 0.41828571428571426 2.0605714285714285 1.0251428571428571 1.0765714285714285 1.0217142857142856 1.3474285714285714 2.3057142857142856 1.1074285714285714 3.613714285714286 -0.23485714285714288 1.2891428571428571 -0.9617142857142857 2.609142857142857 -1.8908571428571428 3.798857142857143a16.594285714285714 16.594285714285714 0 0 1 -3.238285714285714 3.12c-1.1314285714285715 0.8228571428571427 -2.2937142857142856 1.4228571428571428 -3.2297142857142855 1.5771428571428572a0.4217142857142857 0.4217142857142857 0 0 1 -0.13885714285714285 0c-0.9377142857142857 -0.15428571428571428 -2.0982857142857143 -0.7542857142857142 -3.2314285714285713 -1.5771428571428572a16.594285714285714 16.594285714285714 0 0 1 -3.236571428571428 -3.12c-0.9291428571428572 -1.1897142857142855 -1.6577142857142855 -2.5097142857142853 -1.8925714285714286 -3.798857142857143 -0.24000000000000002 -1.308 0.03257142857142857 -2.592 1.1091428571428572 -3.613714285714286 0.6377142857142857 -0.6068571428571428 1.3371428571428572 -0.9291428571428572 2.0588571428571427 -1.0251428571428571 0.7165714285714285 -0.09428571428571428 1.4297142857142855 0.03428571428571429 2.0982857142857143 0.2914285714285714Z"
                                        clip-rule="evenodd" stroke-width="1.7143"></path>
                                    <path id="Union_2" fill="#1e2a5e" fill-rule="evenodd"
                                        d="M12 0.8039999999999999c-1.1177142857142857 0 -2.1119999999999997 0.3154285714285714 -2.8251428571428567 1.0302857142857142 -0.7148571428571427 0.7148571428571427 -1.0319999999999998 1.709142857142857 -1.0319999999999998 2.826857142857143s0.3171428571428571 2.1119999999999997 1.0319999999999998 2.8251428571428567c0.7131428571428571 0.7148571428571427 1.7074285714285713 1.0319999999999998 2.8251428571428567 1.0319999999999998 1.1177142857142857 0 2.1119999999999997 -0.3171428571428571 2.826857142857143 -1.0319999999999998 0.7148571428571427 -0.7131428571428571 1.0302857142857142 -1.7074285714285713 1.0302857142857142 -2.8251428571428567 0 -1.1177142857142857 -0.3154285714285714 -2.1119999999999997 -1.0302857142857142 -2.826857142857143C14.111999999999998 1.1194285714285714 13.117714285714285 0.8039999999999999 12 0.8039999999999999Z"
                                        clip-rule="evenodd" stroke-width="1.7143"></path>
                                </g>
                            </svg>
                        </div>
                        <span class="text-primary">Zakat Penghasilan</span>
                    </a>
                    <a href="javascript:void(0)" class="col-3 mb-2 text-center" data-kategori="Zakat Maal"
                        onclick="modalForm(this)">
                        <div class="item d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                id="Coin-Share--Streamline-Flex" height="24" width="24">
                                <g id="coin-share--payment-cash-money-finance-receive-give-coin-hand">
                                    <path id="Union" fill="#1e2a5e" fill-rule="evenodd"
                                        d="M17.707885714285712 0C15.812382857142858 0 14.210485714285713 0.5357622857142856 13.083291428571428 1.6629565714285712c-1.1271942857142856 1.1271977142857141 -1.662942857142857 2.729094857142857 -1.662942857142857 4.624597714285714s0.5357485714285715 3.497382857142857 1.662942857142857 4.6245771428571425 2.7290914285714285 1.66296 4.624594285714285 1.66296c1.895485714285714 0 3.4973142857142854 -0.5357657142857142 4.6246285714285715 -1.66296 1.127142857142857 -1.1271942857142856 1.6628571428571428 -2.729074285714286 1.6628571428571428 -4.6245771428571425s-0.5357142857142857 -3.4974 -1.6628571428571428 -4.624597714285714C21.205199999999998 0.5357622857142856 19.60337142857143 0 17.707885714285712 0Z"
                                        clip-rule="evenodd" stroke-width="1.7143"></path>
                                    <path id="Subtract" fill="#7c93c3" fill-rule="evenodd"
                                        d="m15.455742857142857 17.298514285714283 4.6204285714285716 -1.09656c1.2202285714285714 -0.2895942857142857 2.448857142857143 0.44562857142857143 2.770457142857143 1.6578171428571429 0.2988 1.1257714285714284 -0.2861142857142857 2.2981714285714285 -1.3652571428571427 2.736685714285714l-6.033771428571428 2.451428571428571c-2.9350457142857143 1.1926285714285714 -6.205525714285714 1.2671999999999999 -9.191948571428572 0.21l-5.684571428571428 -2.0125714285714285C0.228792 21.124114285714285 0 20.80045714285714 0 20.437199999999997V11.438262857142856c0 -0.4503428571428571 0.34851257142857145 -0.8238857142857143 0.7977805714285714 -0.8550857142857142l1.8753222857142857 -0.13018285714285713c0.9121542857142856 -0.06332571428571428 1.8285599999999997 0.019645714285714284 2.714502857142857 0.24575999999999998l3.9444514285714285 1.0067485714285713c1.020342857142857 0.26041714285714285 1.669542857142857 1.2609085714285715 1.4916514285714284 2.2988399999999998 -0.18922285714285714 1.104102857142857 -1.2406457142857141 1.843457142857143 -2.3436857142857144 1.648062857142857l-0.07223999999999998 -0.012788571428571427 -2.089902857142857 -0.40956c-0.5035371428571428 -0.09867428571428571 -0.9920742857142856 0.22837714285714286 -1.09272 0.73152 -0.10064571428571428 0.5031599999999999 0.22450285714285712 0.9929657142857142 0.7272514285714285 1.0955828571428572l4.7196685714285715 0.96324c0.6798514285714286 0.13868571428571427 1.3820914285714285 0.12394285714285715 2.055445714285714 -0.04354285714285714l2.728217142857143 -0.6783428571428571Z"
                                        clip-rule="evenodd" stroke-width="1.7143"></path>
                                    <path id="Vector 5 (Stroke)" fill="#7c93c3" fill-rule="evenodd"
                                        d="M17.707885714285712 3.9506914285714285c0.7100571428571428 0 1.2857142857142856 0.5756228571428571 1.2857142857142856 1.2857142857142856l0 2.1019714285714284c0 0.7100742857142858 -0.5756571428571428 1.2857142857142856 -1.2857142857142856 1.2857142857142856 -0.7100914285714285 0 -1.2857314285714285 -0.5756399999999999 -1.2857314285714285 -1.2857142857142856l0 -2.1019714285714284c0 -0.7100914285714285 0.5756399999999999 -1.2857142857142856 1.2857314285714285 -1.2857142857142856Z"
                                        clip-rule="evenodd" stroke-width="1.7143"></path>
                                </g>
                            </svg>
                        </div>
                        <span class="text-primary">Zakat Maal</span>
                    </a>
                    <a href="javascript:void(0)" class="col-3 mb-2 text-center" data-kategori="Zakat Fitrah"
                        onclick="modalForm(this)">
                        <div class="item d-flex align-items-center justify-content-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1222_14277)">
                                    <path
                                        d="M11.9998 23.9998C18.4623 23.9998 23.0784 21.7102 23.0784 16.6141C23.0784 11.0748 20.3086 8.26802 14.7694 5.49837L17.1653 1.75433C17.2594 1.57368 17.3061 1.37207 17.3006 1.16848C17.2953 0.964881 17.2382 0.765996 17.1348 0.590542C17.0314 0.41509 16.885 0.268843 16.7094 0.16557C16.5339 0.0622959 16.335 0.00539272 16.1314 0.000216796H8.3025C8.08532 -0.00391111 7.8711 0.0509772 7.68267 0.15903C7.49424 0.267082 7.33866 0.424248 7.23253 0.613769C7.1264 0.803289 7.07369 1.01806 7.08003 1.23518C7.08636 1.45231 7.1515 1.66364 7.2685 1.84665L9.23012 5.49837C3.69082 8.30494 0.921173 11.1117 0.921173 16.651C0.921173 21.7102 5.53726 23.9998 11.9998 23.9998Z"
                                        fill="#7C93C3" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.1044 6.66186C9.96445 8.94274 14.0473 8.94022 16.9047 6.65432C16.2501 6.26615 15.5434 5.88567 14.7846 5.50592C13.059 6.46839 10.9407 6.46841 9.2151 5.50594C8.45996 5.88889 7.75639 6.27188 7.1044 6.66186Z"
                                        fill="#1E2A5E" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1222_14277">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <span class="text-primary">Zakat Fitrah</span>
                    </a>
                    <a href="javascript:void(0)" class="col-3 mb-2 text-center" data-kategori="Infaq / Sedekah"
                        onclick="modalForm(this)">
                        <div class="item d-flex align-items-center justify-content-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_4402_64)">
                                    <path
                                        d="M23.6398 9.44386C23.6398 14.3635 19.6517 18.3516 14.7321 18.3516C9.81247 18.3516 5.82434 14.3635 5.82434 9.44386C5.82434 4.52426 9.81247 0.536133 14.7321 0.536133C19.6517 0.536133 23.6398 4.52426 23.6398 9.44386Z"
                                        fill="#7C93C3" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.3788 20.3725C15.8416 20.4529 15.2917 20.4944 14.7321 20.4944C8.62907 20.4944 3.68154 15.5469 3.68154 9.44387C3.68154 8.90332 3.72035 8.37184 3.79535 7.85205C1.86801 9.48601 0.644714 11.925 0.644714 14.6496C0.644714 19.5692 4.63285 23.5573 9.55245 23.5573C12.2932 23.5573 14.7448 22.3196 16.3788 20.3725Z"
                                        fill="#1E2A5E" />
                                    <path
                                        d="M10.56 12.09C10.2667 12.09 10.04 12.01 9.88 11.85C9.72 11.6833 9.64 11.4533 9.64 11.16V5.88C9.64 5.58 9.72 5.35 9.88 5.19C10.0467 5.03 10.2767 4.95 10.57 4.95H13.03C13.83 4.95 14.4467 5.14667 14.88 5.54C15.32 5.92667 15.54 6.46667 15.54 7.16C15.54 7.60667 15.44 7.99667 15.24 8.33C15.0467 8.65667 14.7633 8.91 14.39 9.09C14.0233 9.26333 13.57 9.35 13.03 9.35L13.11 9.17H13.59C13.8767 9.17 14.13 9.24 14.35 9.38C14.57 9.51333 14.7533 9.72 14.9 10L15.4 10.9C15.5067 11.0933 15.5567 11.2833 15.55 11.47C15.5433 11.65 15.47 11.8 15.33 11.92C15.1967 12.0333 15 12.09 14.74 12.09C14.48 12.09 14.2667 12.0367 14.1 11.93C13.94 11.8233 13.7967 11.6567 13.67 11.43L12.76 9.76C12.68 9.61333 12.5767 9.51333 12.45 9.46C12.33 9.4 12.19 9.37 12.03 9.37H11.48V11.16C11.48 11.4533 11.4033 11.6833 11.25 11.85C11.0967 12.01 10.8667 12.09 10.56 12.09ZM11.48 8.07H12.7C13.0533 8.07 13.3233 8 13.51 7.86C13.6967 7.72 13.79 7.50333 13.79 7.21C13.79 6.93 13.6967 6.72 13.51 6.58C13.3233 6.43333 13.0533 6.36 12.7 6.36H11.48V8.07ZM16.3605 13.89C16.0805 13.89 15.8639 13.8133 15.7105 13.66C15.5572 13.5067 15.4805 13.2833 15.4805 12.99V7.88C15.4805 7.59333 15.5539 7.37333 15.7005 7.22C15.8539 7.06667 16.0705 6.99 16.3505 6.99C16.6372 6.99 16.8539 7.06667 17.0005 7.22C17.1539 7.37333 17.2305 7.59333 17.2305 7.88V8.46L17.1205 7.97C17.2139 7.67 17.4072 7.43 17.7005 7.25C18.0005 7.06333 18.3405 6.97 18.7205 6.97C19.1472 6.97 19.5205 7.07333 19.8405 7.28C20.1672 7.48667 20.4205 7.78 20.6005 8.16C20.7805 8.54 20.8705 9 20.8705 9.54C20.8705 10.0667 20.7805 10.5233 20.6005 10.91C20.4205 11.2967 20.1672 11.5933 19.8405 11.8C19.5205 12.0067 19.1472 12.11 18.7205 12.11C18.3539 12.11 18.0239 12.0233 17.7305 11.85C17.4372 11.6767 17.2405 11.45 17.1405 11.17H17.2605V12.99C17.2605 13.2833 17.1805 13.5067 17.0205 13.66C16.8672 13.8133 16.6472 13.89 16.3605 13.89ZM18.1605 10.8C18.3405 10.8 18.4972 10.7567 18.6305 10.67C18.7705 10.5767 18.8805 10.44 18.9605 10.26C19.0405 10.0733 19.0805 9.83333 19.0805 9.54C19.0805 9.09333 18.9939 8.77333 18.8205 8.58C18.6472 8.38 18.4272 8.28 18.1605 8.28C17.9805 8.28 17.8205 8.32333 17.6805 8.41C17.5405 8.49667 17.4305 8.63333 17.3505 8.82C17.2705 9 17.2305 9.24 17.2305 9.54C17.2305 9.98 17.3172 10.3 17.4905 10.5C17.6639 10.7 17.8872 10.8 18.1605 10.8Z"
                                        fill="#1E2A5E" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_4402_64">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <span class="text-primary">Infaq / Sedekah</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-container section">
        <div class="card mb-3">
            <div class="card-header">
                <div>Filter</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <select name="month" class="form-control" id="month">
                            <option value="">-- status --</option>
                            <option value="pending">pending</option>
                            <option value="ditolak">ditolak</option>
                            <option value="diterima">diterima</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <select name="paginate" class="form-control" id="paginate">
                            <option value="10">-- halaman --</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Datatable menampilkan data --}}
        <div class="transactions" id="dataTable" style="margin-bottom: 85px">

            {{-- Start Forelse --}}
            <a href="javascript:void()" onclick="detailRiwayat(this)" class="item detail-riwayat">
                <div class="detail">
                    <img src="{{ asset('img/baznas/default.png') }}" width="40" height="40" alt="img"
                        class="object-fit-cover image-block imaged w48">
                    <div>
                        <strong name="kategori">Zakat Fitrah</strong>
                        <p name="tanggal">20-02-2025 10:09:58</p>
                    </div>
                </div>
                <div class="badge bg-warning">
                    pending
                </div>
            </a>

            <a href="javascript:void()" onclick="detailRiwayat(this)" class="item detail-riwayat">
                <div class="detail">
                    <img src="{{ asset('img/baznas/default.png') }}" width="40" height="40" alt="img"
                        class="object-fit-cover image-block imaged w48">
                    <div>
                        <strong name="kategori">Infaq / Sedekah</strong>
                        <p name="tanggal">20-02-2025 10:09:58</p>
                    </div>
                </div>
                <div class="badge bg-success">
                    diterima
                </div>
            </a>

            {{-- Else jika tidak ada data --}}
            {{-- <div class="mt-2 text-center">
                <div class="card">
                    <div class="card-body pt-3 pb-3">
                        <div class="empty">
                            <div class="empty-img">
                                <svg style="width: 96px; height: 96px" xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-database-off" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M12.983 8.978c3.955 -.182 7.017 -1.446 7.017 -2.978c0 -1.657 -3.582 -3 -8 -3c-1.661 0 -3.204 .19 -4.483 .515m-2.783 1.228c-.471 .382 -.734 .808 -.734 1.257c0 1.22 1.944 2.271 4.734 2.74">
                                    </path>
                                    <path
                                        d="M4 6v6c0 1.657 3.582 3 8 3c.986 0 1.93 -.067 2.802 -.19m3.187 -.82c1.251 -.53 2.011 -1.228 2.011 -1.99v-6">
                                    </path>
                                    <path d="M4 12v6c0 1.657 3.582 3 8 3c3.217 0 5.991 -.712 7.261 -1.74m.739 -3.26v-4">
                                    </path>
                                    <line x1="3" y1="3" x2="21" y2="21"></line>
                                </svg>
                            </div>
                            <p class="empty-title">Tidak ada data yang tersedia</p>
                            <div class="empty-action">
                                <button class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh"
                                        width="18" height="18" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                    </svg>
                                    Refresh
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- End of Else jika tidak ada data --}}

            {{-- Pagination --}}
            {{-- <div class="container mt-2">
                <div class="row justify-content-center">
                    <div>Showing {{ $table->firstItem() }} to {{ $table->lastItem() }} of {{ $table->total() }}entries
                    </div>
                    {{ $table->links('vendor.pagination.index') }}
                </div>
            </div> --}}
            {{-- End of Pagination --}}

        </div>
    </div>

    <div class="app-container section mt-3">
        <div class="app-container form-button-group transparent d-flex justify-content-end z-3">
            <div class="d-flex flex-column">
                <button class="mb-2 btn border-0 py-4 px-2 bg-primary rounded" data-toggle="modal"
                    data-target="#modalAtm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        id="Atm-Fill--Streamline-Sharp-Fill-Material" height="24" width="24">
                        <path fill="#ffffff"
                            d="M10.225 15v-4.8h-2V9h5.2v1.2h-2V15h-1.2ZM2 15V9h5.175v6h-1.2v-1.925H3.2V15H2Zm1.2 -3.125h2.775V10.2H3.2v1.675ZM14.65 15V9H22v6h-1.2v-4.8h-1.875v3.75h-1.2v-3.75H15.85V15h-1.2Z"
                            stroke-width="0.5"></path>
                    </svg>
                </button>

                <button class="btn border-0 p-2 bg-primary rounded" data-toggle="modal" data-target="#modalQr">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        id="Qr-Code--Streamline-Core" height="24" width="24">
                        <g id="qr-code--codes-tags-code-qr">
                            <path id="Union" fill="#fff" fill-rule="evenodd"
                                d="M3.0445714285714285 0.13028571428571428a2.914285714285714 2.914285714285714 0 0 0 -2.914285714285714 2.914285714285714v2.4428571428571426a1.2857142857142856 1.2857142857142856 0 1 0 2.571428571428571 0V3.0445714285714285a0.34285714285714286 0.34285714285714286 0 0 1 0.34285714285714286 -0.34285714285714286h2.4428571428571426a1.2857142857142856 1.2857142857142856 0 1 0 0 -2.571428571428571H3.0445714285714285Zm15.467999999999998 0a1.2857142857142856 1.2857142857142856 0 0 0 0 2.571428571428571h2.4428571428571426a0.34285714285714286 0.34285714285714286 0 0 1 0.34285714285714286 0.34285714285714286v2.4428571428571426a1.2857142857142856 1.2857142857142856 0 0 0 2.571428571428571 0V3.0445714285714285a2.914285714285714 2.914285714285714 0 0 0 -2.914285714285714 -2.914285714285714h-2.4428571428571426ZM1.416 17.228571428571428a1.2857142857142856 1.2857142857142856 0 0 1 1.2857142857142856 1.2857142857142856v2.4428571428571426a0.34285714285714286 0.34285714285714286 0 0 0 0.34285714285714286 0.34285714285714286h2.4428571428571426a1.2857142857142856 1.2857142857142856 0 0 1 0 2.571428571428571H3.0445714285714285a2.914285714285714 2.914285714285714 0 0 1 -2.914285714285714 -2.914285714285714V18.514285714285716a1.2857142857142856 1.2857142857142856 0 0 1 1.2857142857142856 -1.2857142857142856Zm22.453714285714288 1.2857142857142856a1.2857142857142856 1.2857142857142856 0 0 0 -2.571428571428571 0v2.4428571428571426a0.34285714285714286 0.34285714285714286 0 0 1 -0.34285714285714286 0.34285714285714286h-2.4428571428571426a1.2857142857142856 1.2857142857142856 0 0 0 0 2.571428571428571h2.4428571428571426a2.914285714285714 2.914285714285714 0 0 0 2.914285714285714 -2.914285714285714V18.514285714285716Z"
                                clip-rule="evenodd" stroke-width="1.7143"></path>
                            <path id="Union_2" fill="#fff" fill-rule="evenodd"
                                d="M6.850285714285714 4.707428571428571c-1.1828571428571426 0 -2.142857142857143 0.9600000000000001 -2.142857142857143 2.142857142857143v3.5537142857142854c0 1.1828571428571426 0.9600000000000001 2.142857142857143 2.142857142857143 2.142857142857143h3.5537142857142854c1.1828571428571426 0 2.142857142857143 -0.9600000000000001 2.142857142857143 -2.142857142857143V6.850285714285714c0 -1.1828571428571426 -0.9600000000000001 -2.142857142857143 -2.142857142857143 -2.142857142857143H6.850285714285714Zm0.42857142857142855 5.268V7.278857142857143h2.696571428571428v2.696571428571428H7.278857142857143Zm0 5.7788571428571425a1.2857142857142856 1.2857142857142856 0 1 0 -2.571428571428571 0v2.2525714285714287c0 0.7097142857142856 0.576 1.2857142857142856 1.2857142857142856 1.2857142857142856H8.245714285714284a1.2857142857142856 1.2857142857142856 0 0 0 0 -2.571428571428571h-0.9668571428571427V15.754285714285713Zm2.5028571428571427 0a1.2857142857142856 1.2857142857142856 0 0 1 1.2857142857142856 -1.2857142857142856H12a1.2857142857142856 1.2857142857142856 0 0 1 1.2857142857142856 1.2857142857142856v2.2525714285714287a1.2857142857142856 1.2857142857142856 0 0 1 -2.571428571428571 0v-1.0148571428571427a1.2857142857142856 1.2857142857142856 0 0 1 -0.9325714285714286 -1.2377142857142855ZM17.04 5.993142857142857a1.2857142857142856 1.2857142857142856 0 0 0 -2.571428571428571 0V8.245714285714284c0 0.7097142857142856 0.576 1.2857142857142856 1.2857142857142856 1.2857142857142856h2.2525714285714287a1.2857142857142856 1.2857142857142856 0 0 0 0 -2.571428571428571l-0.9668571428571427 0v-0.9668571428571427ZM14.468571428571426 12a1.2857142857142856 1.2857142857142856 0 0 1 1.2857142857142856 -1.2857142857142856h2.2525714285714287a1.2857142857142856 1.2857142857142856 0 0 1 1.2857142857142856 1.2857142857142856v1.0954285714285714a1.2857142857142856 1.2857142857142856 0 0 1 -2.5577142857142854 0.19028571428571428H15.754285714285713A1.2857142857142856 1.2857142857142856 0 0 1 14.468571428571426 12Zm2.571428571428571 3.754285714285714a1.2857142857142856 1.2857142857142856 0 0 0 -2.571428571428571 0v2.2525714285714287c0 0.7097142857142856 0.576 1.2857142857142856 1.2857142857142856 1.2857142857142856h2.2525714285714287a1.2857142857142856 1.2857142857142856 0 0 0 0 -2.571428571428571H17.04V15.754285714285713Z"
                                clip-rule="evenodd" stroke-width="1.7143"></path>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Modal Detail Riwayat --}}
    <div class="modal fade action-sheet" id="detailRiwayat" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Riwayat</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">

                        <div class="form-group rounded">
                            <div class="input-wrapper">
                                <label for="kategori">Kategori</label>
                                <input id="kategori" type="text" class="form-control" disabled name="kategori">
                            </div>
                        </div>

                        <div class="form-group rounded">
                            <div class="input-wrapper">
                                <label for="tanggal">Tanggal</label>
                                <input id="tanggal" type="text" class="form-control" disabled name="tanggal">
                            </div>
                        </div>

                        <div class="form-group rounded">
                            <div class="input-wrapper">
                                <label for="nominal">Nominal</label>
                                <input id="nominal" type="text" class="form-control" disabled name="nominal">
                            </div>
                        </div>

                        <div class="form-group rounded">
                            <div class="input-wrapper">
                                <label for="bukti_dukung">Bukti dukung</label>
                                <div id="bukti_dukung">

                                </div>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary btn-block btn-lg"
                                        data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Informasi Pembayaran ATM --}}
    <div class="modal fade" id="modalAtm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Informasi Pembayaran</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Bank</td>
                                <td>:</td>
                                <td>Bank BRI</td>
                            </tr>
                            <tr>
                                <td>No. Rekening</td>
                                <td>:</td>
                                <td>1234567890</td>
                            </tr>
                            <tr>
                                <td>Atas Nama</td>
                                <td>:</td>
                                <td>PT. Zakat</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal QR Code --}}
    <div class="modal fade" id="modalQr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Informasi QR Code</h4>
                </div>
                <div class="modal-body">
                    <img class="w-100" src="{{ asset('img/baznas/qris-baznas.jpeg') }}" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Form Zakat/Infaq --}}
    <div class="modal fade action-sheet" id="modalForm" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Bukti Pembayaran</h5>
                </div>
                <div class="modal-body mt-1">
                    <div class="container action-sheet-contents">
                        <form id="formTask">
                            @csrf
                            <div class="form-group rounded">
                                <div class="input-wrapper">
                                    <label for="kategori">Kategori</label>
                                    <input disabled type="text" class="form-control" name="kategori" required>
                                </div>
                            </div>
                            <div class="form-group rounded">
                                <div class="input-wrapper">
                                    <label for="nominal">Nominal</label>
                                    <input type="text" class="form-control" name="nominal" required>
                                </div>
                            </div>
                            <div class="form-group rounded">
                                <label for="bukti_dukung">Bukti dukung</label>
                                <span id="webCameResult"></span>
                                <input type="hidden" name="base64" id="base64" value="">
                                <div class="webcam-capture d-none">
                                    <img id="imgPrev" src="" alt="" width="100%">
                                </div>
                                <div class="row" id="containerFile">
                                    <div class="col-6">
                                        <div class="input-wrapper">
                                            <div class="custom-file-button">
                                                <input type="file" name="bukti_dukung" id="fileInput"
                                                    onchange="previewImg()" style="display: none;">
                                                <label for="fileInput" class="btn btn-outline-primary btn-block">pilih
                                                    file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" onclick="openCamera()" id="openKamera"
                                            class="btn btn-outline-primary btn-block">buka kamera</button>
                                    </div>
                                </div>
                                <p><small>Hanya menerima file jpg,jpeg,png</small></p>
                            </div>
                            <div class="form-group basic">
                                <button id="loadingTask" class="btn btn-primary btn-lg btn-block d-none mb-2"
                                    type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span> Tunggu sebentar yah...
                                </button>
                            </div>
                            <button id="btnCapture" type="button"
                                class="btn btn-primary btn-block btn-lg mb-2 d-none">Ambil photo</button>
                            <button id="btnSubmit" type="submit"
                                class="btn btn-primary btn-block btn-lg mb-2">Konfirmasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/pegawai') }}/js/webcamjs/webcam.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#createTask').on('show.bs.modal', function() {
                changeRefreshStatus(false);
            });

            $('#createTask').on('hidden.bs.modal', function() {
                Webcam.reset();
                changeRefreshStatus(true);
            });

            $('#showTask').on('show.bs.modal', function() {
                changeRefreshStatus(false);
            });

            $('#showTask').on('hidden.bs.modal', function() {
                changeRefreshStatus(true);
            });
        });

        function openCamera() {
            $('.webcam-capture').removeClass('d-none');
            $('#openKamera').attr('disabled', 'disabled');
            $('#webCameResult').html('');
            Webcam.set({
                width: 490,
                height: 450,
                image_format: 'jpeg',
                jpeg_quality: 75,
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

            Webcam.attach('.webcam-capture');
            $('#btnCapture').removeClass('d-none');
            $('#btnSubmit').addClass('d-none');
        }

        $('#btnCapture').click(function() {
            // shutter.play();
            Webcam.snap(function(data_uri) {
                $('#webCameResult').html(
                    `<img class="x-img-fluid" id="imageprev" style="border-radius: 15px; object-fit: cover;" src="${data_uri}"/>`
                );
                Webcam.reset();
                $('#openKamera').removeAttr('disabled', 'disabled');
                $('#openKamera').html('photo ulang');
                $('#base64').attr('value', data_uri);
                $('#btnCapture').addClass('d-none');
                $('#btnSubmit').removeClass('d-none');
            });
            changeRefreshStatus(false);
        });

        $('#fileInput').click(function() {
            $('#openKamera').removeAttr('disabled');
            Webcam.reset();
            $('.webcam-capture').append('<img id="imgPrev" src="" alt="" width="100%">');
        });

        function previewImg() {
            $('.webcam-capture').removeClass('d-none');
            const imgPreview = document.querySelector('#imgPrev');
            const image = document.querySelector('#fileInput');
            const blob = URL.createObjectURL(image.files[0]);
            imgPreview.src = blob;
            changeRefreshStatus(false);
        }

        function modalForm(element) {
            var kategori = element.getAttribute('data-kategori');
            document.querySelector('#modalForm input[name="kategori"]').value = kategori;
            $('#modalForm').modal('show');
        }

        function detailRiwayat(element) {
            let kategori = element.querySelector('[name="kategori"]').textContent;
            let tanggal = element.querySelector('[name="tanggal"]').textContent;

            document.querySelector('#detailRiwayat input[name="kategori"]').value = kategori;
            document.querySelector('#detailRiwayat input[name="tanggal"]').value = tanggal;
            $('#detailRiwayat').modal('show');
        }
    </script>
@endpush
