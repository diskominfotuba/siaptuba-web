@extends('services.food.layouts.app')
@section('content')
    <div id="appCapsule">
        <div class="section bg-primary text-white pb-1 d-flex align-items-center">
            <svg data-icon-name="place" data-style="flat-color" icon_origin_id="21179" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg" data-name="Flat Color" id="place" class="icon flat-color" width="16"
                height="16">
                <path style="fill: rgb(225, 215, 183);"
                    d="M12,2A7,7,0,0,0,5,9c0,5.32,6,12.35,6.24,12.65a1,1,0,0,0,1.52,0C13,21.35,19,14.32,19,9A7,7,0,0,0,12,2Z"
                    id="primary"></path>
                <circle style="fill: rgb(124, 147, 195);" r="3" cy="9" cx="12" id="secondary"></circle>
            </svg>
            <span class="ml-1">Menggala, Tulang Bawang</span>
        </div>
        <div class="section wallet-card-section pt-0 mb-3">
            <div class="wallet-card p-1 mb-2">
                <div class="input-group">
                    <input type="text" class="form-control border-0" placeholder='Mengan "Nasi Goreng"'
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn">
                            <svg data-icon-name="search-alt-2" data-style="line" icon_origin_id="20595" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" id="search-alt-2" class="icon line" width="24"
                                height="24">
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M19,11a8,8,0,1,1-8-8A8,8,0,0,1,19,11Zm2,10-4.34-4.34" id="primary"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- banner --}}
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('img/banner/food-1.png') }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('img/banner/food-2.png') }}" alt="Second slide">
                    </div>
                </div>
            </div>
            {{-- end banner --}}

        </div>

        <div class="section mt-2 mb-2">
            <div class="transactions">
                <div class="row">
                    <div class="load-home" style="display:contents">
                        <a href="/user/food/list" class="col-3 mb-2 text-center">
                            <div class="item d-flex align-items-center justify-content-center">
                                <svg data-icon-name="soup" data-style="flat-color" icon_origin_id="19547"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" data-name="Flat Color"
                                    id="soup" class="icon flat-color" width="32" height="32">
                                    <path style="fill: rgb(124, 147, 195);"
                                        d="M20,9H4a1,1,0,0,0-1,1v6a3,3,0,0,0,2.35,2.93l.2.41A3,3,0,0,0,8.24,21h7.52a3,3,0,0,0,2.69-1.66l.2-.41A3,3,0,0,0,21,16V10A1,1,0,0,0,20,9Z"
                                        id="primary"></path>
                                    <path style="fill: rgb(30, 42, 94);"
                                        d="M16,7a1,1,0,0,1-1-1V4a1,1,0,0,1,2,0V6A1,1,0,0,1,16,7ZM13,6V4a1,1,0,0,0-2,0V6a1,1,0,0,0,2,0ZM9,6V4A1,1,0,0,0,7,4V6A1,1,0,0,0,9,6Zm13,4a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H21A1,1,0,0,0,22,10Z"
                                        id="secondary"></path>
                                </svg>
                            </div>
                            <span class="text-primary">Makanan</span>
                        </a>
                        <a href="/user/food/list" class="col-3 mb-2 text-center">
                            <div class="item d-flex align-items-center justify-content-center">
                                <svg data-icon-name="coffee" data-style="flat-color" icon_origin_id="19454"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" data-name="Flat Color"
                                    id="coffee" class="icon flat-color" width="32" height="32">
                                    <path style="fill: rgb(124, 147, 195);"
                                        d="M18,11H17a2,2,0,0,0-2-2H7a2,2,0,0,0-2,2v4a6,6,0,0,0,11.65,2H18a3,3,0,0,0,0-6Zm0,4H17V13h1a1,1,0,0,1,0,2Z"
                                        id="primary"></path>
                                    <path style="fill: rgb(30, 42, 94);"
                                        d="M14,6V4a1,1,0,0,1,2,0V6a1,1,0,0,1-2,0ZM11,7a1,1,0,0,0,1-1V4a1,1,0,0,0-2,0V6A1,1,0,0,0,11,7ZM7,7A1,1,0,0,0,8,6V4A1,1,0,0,0,6,4V6A1,1,0,0,0,7,7ZM21,19H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"
                                        id="secondary"></path>
                                </svg>
                            </div>
                            <span class="text-primary">Minuman</span>
                        </a>
                        <a href="/user/food/list" class="col-3 mb-2 text-center">
                            <div class="item d-flex align-items-center justify-content-center">
                                <svg data-icon-name="cookie" data-style="flat-color" icon_origin_id="19458"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" data-name="Flat Color"
                                    id="cookie" class="icon flat-color" width="32" height="32">
                                    <path style="fill: rgb(124, 147, 195);"
                                        d="M21,11a2,2,0,0,1-1.92-1.48.94.94,0,0,0-.52-.63,1,1,0,0,0-.82,0A2,2,0,0,1,15,7a1.92,1.92,0,0,1,.15-.74,1,1,0,0,0,0-.82.94.94,0,0,0-.63-.52A2,2,0,0,1,13,3a1,1,0,0,0-1-1A10,10,0,1,0,22,12,1,1,0,0,0,21,11Z"
                                        id="primary"></path>
                                    <path style="fill: rgb(30, 42, 94);"
                                        d="M10.5,9.5A1.5,1.5,0,1,1,9,8,1.5,1.5,0,0,1,10.5,9.5Zm-1,4A1.5,1.5,0,1,0,11,15,1.5,1.5,0,0,0,9.5,13.5Zm5-1A1.5,1.5,0,1,0,16,14,1.5,1.5,0,0,0,14.5,12.5Z"
                                        id="secondary"></path>
                                </svg>
                            </div>
                            <span class="text-primary">Cemilan</span>
                        </a>
                        <div class="col-3 mb-2 text-center">
                            <div class="item d-flex align-items-center justify-content-center">
                                <svg data-icon-name="maps-location-place-right" data-style="flat-color"
                                    icon_origin_id="21131" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    data-name="Flat Color" id="maps-location-place-right" class="icon flat-color"
                                    width="32" height="32">
                                    <path style="fill: rgb(124, 147, 195);"
                                        d="M9.44,16l3-8H20a2,2,0,0,1,2,2v6ZM2,18v2a2,2,0,0,0,2,2H14V18Z" id="primary">
                                    </path>
                                    <path style="fill: rgb(30, 42, 94);"
                                        d="M7.31,16H2V10A2,2,0,0,1,4,8h6.31ZM16,22h4a2,2,0,0,0,2-2V18H16ZM11,6.5c0,3.91,3.69,7.13,3.85,7.27a1,1,0,0,0,1.3,0C16.31,13.63,20,10.41,20,6.5a4.5,4.5,0,0,0-9,0Z"
                                        id="secondary"></path>
                                </svg>
                            </div>
                            <span class="text-primary">Terdekat</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="section">
            <div class="section-title mt-2">Rekomendasi Hari Ini ✨</div>
            <div class="">
                <div style="display: grid;grid-template-columns: repeat(2, 1fr);row-gap: 0px;column-gap: 14px;">

                    <a data-action="share/whatsapp/share" href="#" class="w-100 p-2 mt-2"
                        style="border: 1px solid #eee; border-radius: 16px;text-decoration: none">
                        <div style="width: 100%;aspect-ratio: 1 / 1;overflow: hidden;">
                            <img src="{{ asset('img/product/fried-rice.png') }}" class="rounded-lg w-100 h-100"
                                style="object-fit: cover" alt="">
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <svg data-icon-name="store" data-style="line" icon_origin_id="17489" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" id="store" class="icon line" width="14"
                                height="14">
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M19,13v7a1,1,0,0,1-1,1H6a1,1,0,0,1-1-1V13" id="primary"></path>
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M12,3h6.25a1,1,0,0,1,1,.73l1.58,5.55A5.22,5.22,0,0,1,21,10.75h0A2.25,2.25,0,0,1,18.75,13h0a2.25,2.25,0,0,1-2.25-2.25A2.25,2.25,0,0,1,14.25,13h0A2.25,2.25,0,0,1,12,10.75"
                                    data-name="primary" id="primary-2"></path>
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M12,3H5.75a1,1,0,0,0-1,.73L3.21,9.28A5.22,5.22,0,0,0,3,10.75H3A2.25,2.25,0,0,0,5.25,13h0A2.25,2.25,0,0,0,7.5,10.75,2.25,2.25,0,0,0,9.75,13h0A2.25,2.25,0,0,0,12,10.75"
                                    data-name="primary" id="primary-3"></path>
                            </svg>
                            <span class="text-primary ml-1" style="font-size: 12px; line-height: 10px">Kantin Desi</span>
                        </div>
                        <h4 class="mt-0 mb-1 text-primary">Nasi Goreng Ayam Suir</h4>
                        <span>Rp10.000,-</span>
                    </a>

                    <a data-action="share/whatsapp/share" href="#" class="w-100 p-2 mt-2"
                        style="border: 1px solid #eee; border-radius: 16px;text-decoration: none">
                        <div style="width: 100%;aspect-ratio: 1 / 1;overflow: hidden;">
                            <img src="{{ asset('img/product/noodle.png') }}" class="rounded-lg w-100 h-100"
                                style="object-fit: cover" alt="">
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <svg data-icon-name="store" data-style="line" icon_origin_id="17489" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" id="store" class="icon line" width="14"
                                height="14">
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M19,13v7a1,1,0,0,1-1,1H6a1,1,0,0,1-1-1V13" id="primary"></path>
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M12,3h6.25a1,1,0,0,1,1,.73l1.58,5.55A5.22,5.22,0,0,1,21,10.75h0A2.25,2.25,0,0,1,18.75,13h0a2.25,2.25,0,0,1-2.25-2.25A2.25,2.25,0,0,1,14.25,13h0A2.25,2.25,0,0,1,12,10.75"
                                    data-name="primary" id="primary-2"></path>
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M12,3H5.75a1,1,0,0,0-1,.73L3.21,9.28A5.22,5.22,0,0,0,3,10.75H3A2.25,2.25,0,0,0,5.25,13h0A2.25,2.25,0,0,0,7.5,10.75,2.25,2.25,0,0,0,9.75,13h0A2.25,2.25,0,0,0,12,10.75"
                                    data-name="primary" id="primary-3"></path>
                            </svg>
                            <span class="text-primary ml-1" style="font-size: 12px; line-height: 10px">Kantin Desi</span>
                        </div>
                        <h4 class="mt-0 mb-1 text-primary">Mie Rebus</h4>
                        <span>Rp10.000,-</span>
                    </a>

                    <a data-action="share/whatsapp/share" href="#" class="w-100 p-2 mt-2"
                        style="border: 1px solid #eee; border-radius: 16px;text-decoration: none">
                        <div style="width: 100%;aspect-ratio: 1 / 1;overflow: hidden;">
                            <img src="{{ asset('img/product/fried-noodle.png') }}" class="rounded-lg w-100 h-100"
                                style="object-fit: cover" alt="">
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <svg data-icon-name="store" data-style="line" icon_origin_id="17489" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" id="store" class="icon line" width="14"
                                height="14">
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M19,13v7a1,1,0,0,1-1,1H6a1,1,0,0,1-1-1V13" id="primary"></path>
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M12,3h6.25a1,1,0,0,1,1,.73l1.58,5.55A5.22,5.22,0,0,1,21,10.75h0A2.25,2.25,0,0,1,18.75,13h0a2.25,2.25,0,0,1-2.25-2.25A2.25,2.25,0,0,1,14.25,13h0A2.25,2.25,0,0,1,12,10.75"
                                    data-name="primary" id="primary-2"></path>
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M12,3H5.75a1,1,0,0,0-1,.73L3.21,9.28A5.22,5.22,0,0,0,3,10.75H3A2.25,2.25,0,0,0,5.25,13h0A2.25,2.25,0,0,0,7.5,10.75,2.25,2.25,0,0,0,9.75,13h0A2.25,2.25,0,0,0,12,10.75"
                                    data-name="primary" id="primary-3"></path>
                            </svg>
                            <span class="text-primary ml-1" style="font-size: 12px; line-height: 10px">Kantin Desi</span>
                        </div>
                        <h4 class="mt-0 mb-1 text-primary">Mie Goreng</h4>
                        <span>Rp10.000,-</span>
                    </a>

                    <a data-action="share/whatsapp/share" href="#" class="w-100 p-2 mt-2"
                        style="border: 1px solid #eee; border-radius: 16px;text-decoration: none">
                        <div style="width: 100%;aspect-ratio: 1 / 1;overflow: hidden;">
                            <img src="{{ asset('img/product/seafood-noodle.png') }}" class="rounded-lg w-100 h-100"
                                style="object-fit: cover" alt="">
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <svg data-icon-name="store" data-style="line" icon_origin_id="17489" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" id="store" class="icon line" width="14"
                                height="14">
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M19,13v7a1,1,0,0,1-1,1H6a1,1,0,0,1-1-1V13" id="primary"></path>
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M12,3h6.25a1,1,0,0,1,1,.73l1.58,5.55A5.22,5.22,0,0,1,21,10.75h0A2.25,2.25,0,0,1,18.75,13h0a2.25,2.25,0,0,1-2.25-2.25A2.25,2.25,0,0,1,14.25,13h0A2.25,2.25,0,0,1,12,10.75"
                                    data-name="primary" id="primary-2"></path>
                                <path
                                    style="fill: none; stroke: rgb(30, 42, 94); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;"
                                    d="M12,3H5.75a1,1,0,0,0-1,.73L3.21,9.28A5.22,5.22,0,0,0,3,10.75H3A2.25,2.25,0,0,0,5.25,13h0A2.25,2.25,0,0,0,7.5,10.75,2.25,2.25,0,0,0,9.75,13h0A2.25,2.25,0,0,0,12,10.75"
                                    data-name="primary" id="primary-3"></path>
                            </svg>
                            <span class="text-primary ml-1" style="font-size: 12px; line-height: 10px">Kantin Desi</span>
                        </div>
                        <h4 class="mt-0 mb-1 text-primary">Mie Rebus Seafood Spesial</h4>
                        <span>Rp15.000,-</span>
                    </a>

                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
@endpush
