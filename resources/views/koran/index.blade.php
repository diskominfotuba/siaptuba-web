@extends('layouts.general')
@section('content')
    <div class="container mt-3" style="padding-bottom: 10px">
        <div style="padding-top: 50px">
            <h4>{{ $title }}</h4>
            <hr>
        </div>
    </div>
    <div class="section tab-content mt-2 mb-2">
        <div class="row">
            <div class="col-6 mb-2">
                <div class="blog-card">
                    <img lazy="loading" src="{{ asset('img/koran/koran1.jpg') }}" alt="image" class="imaged w-100">
                    <div class="text text-center">
                        <p class="font-weight-bold">Media contoh 1</p>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary btn-block">Baca</a>
                </div>
            </div>
            <div class="col-6 mb-2">
                <div class="blog-card">
                    <img lazy="loading" src="{{ asset('img/koran/koran2.jpg') }}" alt="image" class="imaged w-100">
                    <div class="text text-center">
                        <p class="font-weight-bold">Media contoh 2</p>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary btn-block">Baca</a>
                </div>
            </div>
            <div class="col-6 mb-2">
                <div class="blog-card">
                    <img lazy="loading" src="{{ asset('img/koran/koran2.jpg') }}" alt="image" class="imaged w-100">
                    <div class="text text-center">
                        <p class="font-weight-bold">Media contoh 3</p>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary btn-block">Baca</a>
                </div>
            </div>
            <div class="col-6 mb-2">
                <div class="blog-card">
                    <div class="img-container" data-src="{{ asset('img/koran/koran1.jpg') }}">
                        <div class="carousel-item">
                            <a href="{{ asset('img/koran/koran1.jpg') }}" data-lg-size="false">
                                <img src="{{ asset('img/koran/koran1.jpg') }}" class="d-block w-100" alt="Halaman ke">
                            </a>
                        </div>
                    </div>

                    {{-- <img lazy="loading" src="{{ asset('img/koran/koran1.jpg') }}" alt="image" class="imaged w-100">
                    <div class="text text-center">
                        <p class="font-weight-bold">Media contoh 4</p>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary btn-block">Baca</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('js/lightgallery.js') }}"></script>
<script type="text/javascript">
    var $lg = $('#showPaper');
    $lg.lightGallery({
    download : false,
    thumbnail : false,
    share : false,
    autoplayControls : false,
    controls : true
    });
</script>
@endpush
