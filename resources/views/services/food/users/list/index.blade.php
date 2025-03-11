@extends('services.food.layouts.list.app')
@section('content')
    <div id="appCapsule">
        <div class="section">
            <div class="p-2 pt-1 mt-3" style="border: 1px solid #eee; border-radius: 16px">
                <div class="border-bottom py-2">
                    <a data-action="share/whatsapp/share" href="#">
                        <div class="d-flex">
                            <img class="mr-1" src="{{ asset('img/product/fried-rice.png') }}" alt="" height="100px"
                                width="100px" style="border-radius: 16px">
                            <div>
                                <div class="d-flex align-items-center">
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
                                    <span class="text-primary ml-1" style="font-size: 12px">Kantin Desi</span>
                                </div>
                                <h4 class="pb-0 text-primary">Nasi Goreng Ayam Suir</h4>
                                <span>Rp10.000,-</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="border-bottom py-2">
                    <a data-action="share/whatsapp/share" href="#">
                        <div class="d-flex">
                            <img class="mr-1" src="{{ asset('img/product/fried-rice.png') }}" alt=""
                                height="100px" width="100px" style="border-radius: 16px">
                            <div>
                                <div class="d-flex align-items-center">
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
                                    <span class="text-primary ml-1" style="font-size: 12px">Kantin Eva</span>
                                </div>
                                <h4 class="pb-0 text-primary">Nasi Goreng Sosis Spesial</h4>
                                <span>Rp10.000,-</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
