<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Tgl</th>
            <th>Nama</th>
            <th>OPD</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($table as $key => $tb)
        <tr>
            <td>{{ $table->firstItem() + $key }}</td>
            <td>{{  date('d-m-Y', strtotime($tb->created_at)) }}</td>
            <td><a href="/admin/pegawai/show/{{ $tb->user->id }}">{{ $tb->user->nama }}</a></td>
            <td>{{ $tb->opd->nama_opd }}</td>
            <td><a href="#" onclick="showPresensi(`{{ route('photo-presensi', ['year' => \Carbon\Carbon::parse($tb->created_at)->format('Y'), 'filename' => $tb->photo_masuk]) }}`, 1, `{{ $tb->user->nama }}`, `{{ \Carbon\Carbon::parse($tb->created_at)->isoFormat('dddd, D MMMM YYYY') }}`,`{{ $tb->jam_masuk }}`,`{{ $tb->lat_long_masuk }}`)" data-bs-toggle="modal"  data-bs-target="#modal-show" data-waktu="masuk">{{ $tb->jam_masuk }}</a></td>
            @if ($tb->photo_pulang)
            <td><a href="#" onclick="showPresensi(`{{ route('photo-presensi', ['year' => \Carbon\Carbon::parse($tb->created_at)->format('Y'), 'filename' => $tb->photo_pulang]) }}`, 1, `{{ $tb->user->nama }}`, `{{ \Carbon\Carbon::parse($tb->created_at)->isoFormat('dddd, D MMMM YYYY') }}`,`{{ $tb->jam_pulang }}`,`{{ $tb->lat_long_pulang }}`)" data-bs-toggle="modal"  data-bs-target="#modal-show" data-waktu="pulang">{{ $tb->jam_pulang }}</a></td>
            @else
            <td>Tdk/Blm Absen</td>
            @endif
            @if ($tb->status == 'Tepat waktu')
            <td class="text-success">{{ $tb->status }}</td>
            @elseif($tb->status == 'DL' || $tb->status == 'Apel')
            <td class="text-warning">{{ $tb->status }}</td>
            @else
            <td class="text-danger">{{ $tb->status }}</td>
            @endif
        </tr>
        @empty
        <div class="col text-center">
            <div class="empty-img">
                <svg  style="width: 96px; height: 96px" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12.983 8.978c3.955 -.182 7.017 -1.446 7.017 -2.978c0 -1.657 -3.582 -3 -8 -3c-1.661 0 -3.204 .19 -4.483 .515m-2.783 1.228c-.471 .382 -.734 .808 -.734 1.257c0 1.22 1.944 2.271 4.734 2.74"></path>
                    <path d="M4 6v6c0 1.657 3.582 3 8 3c.986 0 1.93 -.067 2.802 -.19m3.187 -.82c1.251 -.53 2.011 -1.228 2.011 -1.99v-6"></path>
                    <path d="M4 12v6c0 1.657 3.582 3 8 3c3.217 0 5.991 -.712 7.261 -1.74m.739 -3.26v-4"></path>
                    <line x1="3" y1="3" x2="21" y2="21"></line>
                </svg>
            </div>
            <p class="empty-title">Tidak ada data ditemukan!</p>
        </div>
        @endforelse
    </tbody>
</table>
{{ $table->links('vendor.pagination.sneat') }}