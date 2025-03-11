@forelse ($komentar as $item)
<label for="">{{ $item->user->nama }}</label>
<textarea class="form-control mb-3" readonly rows="3">{{ $item->komentar }}</textarea>
@empty
    <p>Belum ada tanggapan</p>
@endforelse
