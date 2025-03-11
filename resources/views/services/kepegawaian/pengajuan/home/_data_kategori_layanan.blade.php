@forelse ($table as $key => $tb)
    <div class="card mb-1">
        <div class="card-header" id="heading{{ $tb->slug }}">
            <h5 class="mb-0">
                <button class="btn btn-link text-uppercase" data-toggle="collapse" data-target="#{{ $tb->slug }}"
                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $tb->slug }}">
                    {{ $tb->nama_kategori }}
                </button>
            </h5>
        </div>

        <div id="{{ $tb->slug }}" class="collapse {{ $loop->first ? 'show' : '' }}"
            aria-labelledby="heading{{ $tb->slug }}" data-parent="#accordion">
            <div class="card-body">
                <ol>

                    @forelse ($tb->layanan as $layanan)
                        <a href="{{ route('services.kepegawaian.layanan.create', $layanan->id) }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <li>
                                    {{ $layanan->nama_layanan }}
                                </li>
                                <span class="badge bg-primary"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                        viewBox="0 0 512 512">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="48"
                                            d="M268 112l144 144-144 144M392 256H100" />
                                    </svg></span>
                            </div>
                        </a>
                        <hr>
                    @empty
                        <span>
                            Layanan tidak tersedia
                        </span>
                    @endforelse

                </ol>
            </div>
        </div>
    </div>
@empty
    <div class="card mb-2">
        <div class="card-body">
            Data tidak ditemukan
        </div>
    </div>
@endforelse
