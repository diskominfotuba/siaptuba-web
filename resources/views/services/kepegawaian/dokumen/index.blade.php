@extends('layouts.general')
@section('content')
    <div class="container mt-3" style="padding-bottom: 20px">
        <div style="padding-top: 50px">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary font-weight-bold">{{ $title }}</div>
                <a class="btn btn-primary btn-sm" href="/kepegawaian">&lt; kembali</a>
            </div>

            <div class="transactions my-3">
                <div class="card" style="border-top: 3px solid #1e2a5e;">
                    <div class="card-header">Filter dokumen</div>
                    <div class="card-body">
                        <select name="filter" id="filter" class="form-control">
                            <option value="">--pilih jenis dokumen--</option>
                            <option value="berkala">Dokumen berkala</option>
                        </select>
                    </div>
                </div>
            </div>
            
            
            <div class="transactions">
                <div class="card" style="margin-bottom: 70px">
                    <div class="card-header">List dokumen</div>
                    <div class="card-body">
                        <div id="datadokumen"></div>
                    </div>
                </div>

            </div>
        </div>
        <div class="form-button-group  transparent">
            <button type="button" data-toggle="modal" data-target="#uploadDokumen" class="btn btn-primary btn-block btn-lg">Upload dokumen</button>
        </div>
    </div>

    {{-- modal upload dokumen --}}
    <div class="modal fade action-sheet" id="uploadDokumen" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold">Upload dokumen</h3>
                </div>
                <div class="modal-body mt-1">
                    <div class="action-sheet-contents">
                        <form id="uploadFile">
                        <div class="section mb-3">
                            <div class="alert alert-danger mb-2" role="alert">
                                <h4 class="alert-heading">Penting!</h4>
                                <p>Hanya menerima file format PDF dengan ukuran file maksimal 1MB</p>
                            </div>
                            <div class="form-group">
                                <label for="dokumen">Nama dokumen</label>
                                <input type="text" name="nama_file" class="form-control" placeholder="Nama file" id="name">
                                <small class="d-block text-danger" id="error-nama_file"></small>
                            </div>
                            <div class="form-group">
                                <label for="dokumen">Pilih dokumen</label>
                                <input type="file" class="form-control" id="file" name="file" accept="application/pdf">
                                <small class="d-block text-danger"id="error-file"></small>
                            </div>
                            <button id="btn_loading" class="btn btn-primary btn-lg btn-block d-none mt-2" disabled type="button">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Tunggu sebentar yah...
                            </button>
                            <button id="btn_submit" type="submit" class="btn-submit btn btn-primary btn-block btn-lg mt-2">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script type="text/javascript">
    var kategoriDokumen = '';
    $(document).ready(function() {
        getDokumen();

        $('#filter').change(function() {
            kategoriDokumen = $(this).val();
            getDokumen();
        }) 
    });

    $("#uploadFile").submit(async function(e) {
        e.preventDefault();
        loading(true);

        var form = $(this)[0];
        var data = new FormData(form);
        var param = {
            url: '/kepegawaian/upload_file/store',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
        }

        await transAjax(param).then((res) => {
            $('#uploadDokumen').modal('hide');
            loading(false);
            swal({
                title: 'Success',
                text: res.message,
                icon: 'success',
                timer: 3000,
            });
            getDokumen();
        }).catch((err) => {
            loading(false);
            if (err.responseJSON && err.responseJSON.errors) {
                let errors = err.responseJSON.errors;
                $.each(errors, function(key, value) {
                    let errorElement = $('#error-' + key);
                    if (errorElement.length) {
                        errorElement.html(value[0]);
                    }
                });
            } else {
                loading(false);
                swal({
                    text: "Internal Server Error!",
                    icon: 'error',
                });
            }
            loading(false);
        });
    });

    async function getDokumen() {
        let param = {
            url: '{{ url()->current() }}',
            method: 'GET',
            data: {
                'load': 'dokumen',
                'kategori_dokumen': kategoriDokumen
            }
        }

        await transAjax(param).then((res) => {
            $('#datadokumen').html(res);
        }).catch((err) => {
            console.log(err);
        });
    }

    async function hapusFile(id) {
        const willDelete = await swal({
            title: "Apakah anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        });
        if (willDelete) {
            let param = {
                url: '/kepegawaian/file/delete/' + id,
                method: "POST",
                processData: false,
                contentType: false,
                cache: false,
            }

            await transAjax(param).then((result) => {
                getDokumen();
                swal("Dihapus!", "Data ini berhasil dihapus", "success");
            }).catch((error) => {
                swal("Opps!", error.responseJSON.errors, "warning");
            });
        }
    }

    function loading(state) {
        if (state) {
            $('#btn_submit').addClass('d-none');
            $('#btn_loading').removeClass('d-none');
        } else {
            $('#btn_submit').removeClass('d-none');
            $('#btn_loading').addClass('d-none');
        }
    }
</script>
@endpush
