@extends('media.layouts.app')
@section('content')
<div id="appCapsule">
    <div class="section pt-1 my-3">
        <div id="instagram-section" class="carousel slide" data-ride="carousel" style="height: 240px">
            <ol class="carousel-indicators">
                <li data-target="#instagram-section" data-slide-to="0" class="active"></li>
                <li data-target="#instagram-section" data-slide-to="1"></li>
                <li data-target="#instagram-section" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" id="media-center">
                <div class="col-12">
                    <div class="ph-item">
                        <div class="ph-picture"></div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#instagram-section" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#instagram-section" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="section mt-5">
        <div class="section-title">Riwayat kunjungan</div>
        <div class="transactions" id="riwayat-kunjungan">
            
        </div>
    </div>
</div>

<div class="modal fade action-sheet" id="showKegiatanModal" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kegiatan</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="form-group rounded">
                        <div class="input-wrapper">
                            <label for="nama_kegiatan">Nama kegiatan</label>
                            <textarea id="nama_kegiatan" type="text" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group rounded">
                        <div class="input-wrapper">
                            <label for="deskripsi_kegiatan">Deskripsi</label>
                            <textarea id="deskripsi_kegiatan" type="text" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group rounded">
                        <div class="input-wrapper">
                            <div id="tandatangan"></div>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <button type="button" class="btn btn-primary btn-block btn-lg" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="app-container form-button-group transparent">
    <a href="/media/scanner" data-turbo="false" class="btn btn-primary btn-block btn-lg">Scan QR Code</a>
</div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(async function() {
           const param = {
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    "load": 'data-riwayat-kunjungan'
                }
           }

           await transAjax(param).then((result) => {
                $('#riwayat-kunjungan').html(result);
           }).catch((err) => {
                console.log(err);
           });

            const paramInstagram = {
                url: "/media/instagram",
                method: "GET",
                data: {
                    "load": 'data-instagram'
                }
            }

            await transAjax(paramInstagram).then((result) => {
                $('#media-center').html(result);
            }).catch((err) => {
                console.log(err);
            });
        })

        function showKegiatan(data) {
            $('#nama_kegiatan').val(data.kegiatan.nama_kegiatan);
            $('#deskripsi_kegiatan').val(data.kegiatan.deskripsi_kegiatan);
            const year = new Date(data.created_at).getFullYear();
            const filename = data.tandatangan;
            const url = `{{ url('storage/ttdqrcode') }}/${year}/${filename}`;
            $('#tandatangan').html(`
            <hr>
            <div class="row">
                <div class="col d-flex align-items-center gap-1">
                    <img lazy="loading" src="${url}" alt="" class="rounded" alt="qrcode" width="25%">
                    <p class="ml-2"><small>QR Code ini berisi metadata diri dari refrensi profile Anda!</small></p>
                </div>
            </div>
            `);
        }

    </script>
@endpush