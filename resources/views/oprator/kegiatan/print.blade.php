@extends('layouts.printpage')
@section('content')
<style>
    .kop {
    padding: 1.5rem 1.5rem;
    margin-bottom: 0;
    background-color: transparent;
    border-bottom: 0 solid #d9dee3;
    text-align: center;
    }
    .kop h3 {
        font-weight: 600
    }
    .details {
        padding: 1.5rem 1.5rem;
    }
</style>

<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y">
        <div class="row">
            <!-- Basic Alerts -->
            <div class="container">
              {{-- <div class="card"> --}}
                <div class="kop font-wight-bold">
                    <h3>DAFTAR HADIR</h3>
                    <h3 class="text-uppercase">{{ $kegiatan->nama_kegiatan }}</h3>
                    <h3>KABUPATEN TULANG BAWANG TAHUN {{ date('Y') }}</h3>
                </div>
                <div class="details">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <p><strong>Pada Hari/Tanggal</strong></p>
                            <p><strong>Waktu</strong></p>
                            <p><strong>Tempat</strong></p>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <p>: {{ Carbon\Carbon::parse($kegiatan->tanggal_mulai)->translatedFormat('l, d F Y') }}</p>
                            <p>: {{ Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('H:i') }} WIB</p>
                            <p>: {{ $kegiatan->deskripsi_kegiatan }}</p>
                        </div>
                    </div>
                </div>
                  <div class="card-body">
                    <div class="table text-wrap">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama</th>
                                    @if ($opd == 'Y')
                                    <th>OPD</th>
                                    @endif
                                    <th>Jabatan</th>
                                    <th>TTD</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($table as $key => $tb)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $tb->user->nama }}</td>
                                    @if ($opd == 'Y')
                                    <td>{{ $tb->user->opd->nama_opd ?? '-' }}</td>
                                    @endif
                                    <td>{{ $tb->user->jabatan }}</td>
                                    <td>
                                        <img src="{{ route('ttdqrcode', ['filename' => $tb->tandatangan, 'year' => date('Y')]) }}" alt="Tanda Tangan QRCode" width="50px">
                                    </td>
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
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.print()  
        });
    </script>
@endpush

