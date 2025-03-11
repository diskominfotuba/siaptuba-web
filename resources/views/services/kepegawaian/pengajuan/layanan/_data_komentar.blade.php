@forelse ($table as $key => $tb)
    @if ($tb->user_id == Auth::user()->id)
        <div class="w-100 mb-1 text-right d-flex flex-column align-items-end">
            <span>Anda</span>
            <div class="text-dark p-1 w-75 rounded" style="background-color: #ededf5">{{ $tb->komentar }}
                <h6 class="text-secondary text-right m-0 mt-1">{{ $tb->created_at }}</h6>
            </div>
        </div>
    @else
        <div class="w-100 mb-1">
            <span>{{ $tb->user->nama }}</span>
            <div class="text-dark p-1 w-75 rounded" style="background-color: #ededf5">
                {{ $tb->komentar }}
                <h6 class="text-secondary text-right m-0 mt-1">{{ $tb->created_at }}</h6>
            </div>
        </div>
    @endif
@empty
    <p class="text-center">Tidak ada komentar</p>
@endforelse
