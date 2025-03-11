@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
                <div class="col-md mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Upload kenaikan gaji berkala</h5>
                            </div>
                            <form id="formSubmit">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="nama_domain">Pilih user</label>
                                        <div class="input-group">
                                            <select id="user_id" name="user_id" id="user_id" class="form-control">
                                                <option value="">--pilih user--</option>
                                            </select>
                                            <input type="text" id="search-input" class="form-control" placeholder="cari nama user" autofocus>
                                        </div>
                                        <small class="mt-1 d-block text-danger"id="error-user_id"></small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="error-file_berkala">Pilih file</label>
                                                <input id="file_berkala" type="file" name="file_berkala" accept=".pdf" class="form-control">
                                            <small class="mt-1 d-block text-danger"id="error-file_berkala"></small>
                                        </div>
                                    </div>
                                </div>
                                <button id="btnLoading" class="btn btn-primary d-none" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Tunggu sebentar yaah...
                                </button>
                                <button id="btnSubmit" type="submit" class="btn btn-primary"><i class='bx bx-paper-plane'></i>  Kirim</button>
                            </div>
                            </form>
                        </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md mb-4 mb-md-0">
                    <div class="card">
                        <h5 class="card-header">Data dokumen kenaikan gaji berkala</h5>
                        <div class="card-body">
                            @include('layouts._loading')
                            <div class="table-responsive text-nowrap" id="dataTable">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        var search = '';
        var search_profile = '';
        var opd = '';
        var page = 1;
        $(document).ready(function() {
            loadTable();

            $('#search-input').on('keypress', function(e) {
                if (e.which == 13) {
                    $('#user_id').html('<option value="">mencari data...</option>');
                    search_profile = $("#search-input").val();
                    getProfile();
                    return false;
                }
            });

            $('#opd').change(function() {
                filterTable();
            });
        });

        function filterTable() {
            opd = $('#opd').val();
            loadTable();
        }

        async function loadTable() {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    search: search,
                    opd: opd,
                    page: page,
                }
            }

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                $("#dataTable").html(result);
            }).catch((err) => {
                loading(false);
                console.log(err);
            })
        }

        function loadPaginate(to) {
            page = to
            filterTable()
        }

        async function getProfile()
        {
            var param = {
                url: '/bkpp/user',
                method: 'GET',
                data: {
                    load: 'table',
                    search: search_profile,
                }
            }

            await transAjax(param).then((result) => {
                let data = JSON.parse(result.metadata);
                if(data.length > 0) {
                        var html = "";
                            data.forEach(user => {
                            html += `<option value="${user.id}">${user.nama + ' (' + user.nip + ')'}</option>`
                        });
                    }else {
                        html += `<option value="">user tidak ditemukan</option>`
                    }
                    $('#user_id').html(html);
            }).catch((err) => {
                $('#user_id').html('<option value="">Internal server error!</option>')
            })
        }

        $("#formSubmit").submit(async function(e) {
            e.preventDefault();
            loading(true,'btnSubmit', 'btnLoading');

            let param = {
                url: '/bkpp/berkala/store',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
            }

            await transAjax(param).then((result) => {
                loading(false,'btnSubmit', 'btnLoading');
                swal({
                title: 'Berhasil',
                text: result.message,
                icon: 'success',
                timer: 3000,
                });
                loadTable();
                $('#user_id').html('<option value="">--pilih user--</option>');
                $('#file_berkala').val(null);
            }).catch((err) => {
                loading(false,'btnSubmit', 'btnLoading');
                swal({
                    title: "Opps!",
                    text: err.responseJSON.message,
                    icon: 'error',
                });
                if (err.responseJSON && err.responseJSON.errors) {
                let errors = err.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        let errorElement = $('#error-' + key);
                        if (errorElement.length) {
                            errorElement.html(value[0]);
                        }
                    });
                    } else {
                        loading(false,'btnSubmit', 'btnLoading');
                        swal({
                        title: 'Oppss',
                        text: err.responseJSON.message,
                        icon: 'error',
                    });
                }
            });
        });

        async function hapusBerkala(id)
        {
            const willDelete = await swal({
                title: "Apakah anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            });
            if (willDelete) {
                let param = {
                    url: '/bkpp/berkala/delete/' + id,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                }

                await transAjax(param).then((result) => {
                    loadTable();
                    swal("Dihapus!", "Data ini berhasil dihapus", "success");
                }).catch((error) => {
                    swal("Opps!", error.responseJSON.errors, "warning");
                });
            }
        }

    </script>
@endpush