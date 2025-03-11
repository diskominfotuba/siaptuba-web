@foreach ($feeds as $item)
<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
    <a href="javascript:void()" onclick="showMedia('{{ $item['id'] }}')">
        <div class="card">
            <div class="card-body">
                @if ($item['media_type'] === 'IMAGE')
                    <img class="d-block w-100" lazy="loading" src="{{ $item['media_url'] ?? ''}}" alt="Image content" style="height: 230px; object-fit: cover;">
                @elseif ($item['media_type'] === 'VIDEO')
                    <video class="d-block w-100" style="height: 230px; object-fit: cover;">
                        <source src="{{ $item['media_url'] ?? '' }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                <img class="d-block w-100" lazy="loading" src="{{ $item['media_url'] ?? '' }}" alt="Image content" style="height: 230px; object-fit: cover;">
                @endif
            </div>
        </div>
    </a>
</div>
@endforeach
