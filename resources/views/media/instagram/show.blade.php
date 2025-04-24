<div class="col-12 col-md-12 mb-3">
    @if ($media['media_type'] === 'IMAGE')
    <img src="{{ $media['media_url'] }}" alt="{{ $media['id'] }}" width="100%">
    @elseif ($media['media_type'] === 'VIDEO')
        <video class="d-block w-100" controls width="100%">
            <source src="{{ $media['media_url'] }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @else
    <img src="{{ $media['media_url'] }}" alt="{{ $media['id'] }}" width="100%">
    @endif
</div>
<a href="https://www.instagram.com/mediacenterpemkabtulangbawang" target="_blank">
    <div class="profile d-flex align-items-center mb-1">
            <img lazy="loading" src="{{ asset('assets/icon/lc_icon_presensi.png') }}" alt="" class="me-2 rounded-circle" width="50px">
            <p class="mb-0">MEDIA CENTER PEMKAB TUBA</p>
        </div>
    </a>
<div class="col-12 col-md-12 d-flex flex-column justify-content-between" style="max-height: 250px; overflow-y: auto;">
    <div>
        <p>{{ $media['caption'] ?? '' }}</p>
    </div>
</div>
