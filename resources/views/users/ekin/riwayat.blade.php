@extends('layouts.general')
@section('content')
<div class="container mt-3" style="padding-bottom: 20px">
    <div style="padding-top: 50px">
        
    </div>
</div>
<div class="section" style="padding-bottom: 20px">
    <div class="section-heading">
        <h4>{{ $title }}</h4>
    </div>
    <div class="transactions" id="dataTable">
      
    </div>
</div>
<div class="form-button-group transparent">
    <a href="{{ route('user.ekin') }}" class="btn btn-primary btn-block btn-lg">Kembali</a>
</div>

<div class="modal fade action-sheet" id="showTask" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail tugas</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="form-group rounded">
                        <div class="input-wrapper">
                            <label for="nama_tugas">Nama tugas</label>
                            <input id="nama_tugas" type="text" class="form-control" name="nama_tugas">
                        </div>
                    </div>
                    <div class="form-group rounded">
                        <div class="input-wrapper">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" type="text" class="form-control" name="deskripsi"></textarea>
                        </div>
                    </div>
                    <div class="form-group rounded">
                        <div class="input-wrapper">
                            <label for="bukti_dukung">Bukti dukung</label>
                            <div id="bukti_dukung">
                                
                            </div>
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

@endsection
@push('js')
    <script type="text/javascript">
    $('#dataTable').html(make_skeleton());
    var page = "1"
    $(document).ready(function() {
        loadTable();
    });

    async function loadTable() {
        var param = {
            url: "{{ url()->current() }}",
            method: "GET",
            data: {
                'load': 'table',
                'page': page,
            }
        }

        await transAjax(param).then((result) => {
            $('#dataTable').html(result);
        });
    }

    $('#formTask').submit(async function(e) {
        e.preventDefault();
        loadingsubmit(true);

        var data = new FormData(this);
        var param = {
            url: '/user/ekin/store',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false
        }

        await transAjax(param).then((res) => {
            $('#createTask').modal('hide');
            swal({
                text: res.message,
                icon: 'success',
                timer: 3000,
            }).then(() => {
                loadingsubmit(false);
                window.location.href = '{{ url()->current() }}';
            });
        }).catch((err) => {
            loadingsubmit(false);
            $('#createTask').modal('hide');
            swal({
                text: err.responseJSON.message,
                icon: 'error',
                timer: 3000,
            }).then(() => {
                window.location.href = '{{ url()->current() }}';
            });
        });

        function loadingsubmit(state) {
            if (state) {
                $('#btnSubmit').addClass('d-none');
                $('#loadingTask').removeClass('d-none');
            } else {
                $('#btnSubmit').removeClass('d-none');
                $('#loadingTask').addClass('d-none');
            }
        }
    });

    async function showTask(id)
        {
            var param = {
                url: '/user/ekin/show/'+id,
                method: 'GET'
            }

            await transAjax(param).then((result) => {
                const data = JSON.parse(result.metadata);

                $('#nama_tugas').val(data.nama_tugas);
                $('#deskripsi').val(data.deskripsi);

                const fileExtension = data.bukti_dukung.split('.').pop().toLowerCase();
                const year = new Date().getFullYear();
                
                if (fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png') {
                    $('#bukti_dukung').html(`
                        <img src="{{ asset('storage/ekin') }}/${year}/${data.bukti_dukung}" width="100%" alt="bukti_dukung" class="rounded">
                    `);
                }
            });
        }

        function loadPaginate(to) {
            page = to
            loadTable();
        }

        function make_skeleton() {
        var output = '';
        for (var count = 0; count < 3; count++) {
            output += '<div class="col-12">';
            output += '<div class="ph-item">';
            output += '<div class="ph-picture"></div>';
            output += '</div>';
            output += '</div>';
        }
        return output;
    }
    </script>
@endpush