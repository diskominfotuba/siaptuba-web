@extends('layouts.general')
@section('content')
    <div id="appCapsule">
        <div class="section mt-2 mb-2">
            <div class="card">
                <div class="card-header">
                    Formulir pengajuan penghapusan akun
                </div>
                <div class="card-body">
                    <form id="submit">
                        <div class="form-group">
                            <label for="alasan">Alasan penghapusan</label>
                            <select name="alasan" id="alasan" class="form-control">
                                <option value="">--pilih alsan--</option>
                                <option value="pensiun">Pensiun</option>
                                <option value="mutasi">Mutasi</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                            <small class="d-block text-danger" id="error-alasan"></small>
                        </div>
                        <div class="form-group">
                            <label for="">Lampiran</label>
                            <input type="file" name="lampiran" class="form-control">
                            <small class="d-block text-danger" id="error-lampiran"></small>
                        </div>
                        <button id="loading" class="btn btn-primary btn-lg btn-block d-none" disabled>Tunggu sebentar yaa...</button>
                        <button id="submit" type="submit" class="btn btn-primary btn-lg btn-block">Kirim pengajuan hapus akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#submit').submit(async function(e) {
            e.preventDefault();
            var form = $(this)[0];
            var param = {
                url: "/user/hapus-akun",
                method: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                cache: false,
            }
            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                swal({
                    title: 'Berhasil',
                    text: result.message,
                    icon: 'success',
                    timer: 5000,
                }).then(() => {
                    window.location.href = "/user/dashboard";
                });
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
            });
        });

        function loading(state) {
            if(state) {
                $('#submit').addClass('d-none');
                $('#loading').removeClass('d-none');
            }else {
                $('#submit').removeClass('d-none');
                $('#loading').addClass('d-none');
            }
        }
    </script>
@endpush
