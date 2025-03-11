@extends('layouts.general')
@section('content')
    <div class="container mt-3" style="padding-bottom: 20px">
        <div style="padding-top: 50px">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary font-weight-bold">Data pengajuan Cuti/Izin</div>
                <a class="btn btn-primary btn-sm" href="/user/apps">&lt; kembali</a>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box" style="border-top: 3px solid #1e2a5e;">
                        <div class="title">Pending</div>
                        <div class="value">{{ $total_pending }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box" style="border-top: 3px solid #1e2a5e;">
                        <div class="title">Total</div>
                        <div class="value">{{ $total_dl }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <h4>List Pengajuan</h4>
        <div class="card">
            <div class="card-body">
               <select name="status" id="filterStatus" class="form-control">
                    <option value="" id="cariData">--pilih status pengajuan--</option>
                    <option value="pending">pending</option>
                    <option value="ditolak">ditolak</option>
                    <option value="disetujui">disetujui</option>
                    <option value="">tampilkan semua</option>
               </select>
            </div>
        </div>
        <div class="transactions mt-2" id="dataTable">

        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        var status = 'pending';
        $('#dataTable').html(make_skeleton());
        $(document).ready(function() {
            loadData();

            $('#filterStatus').change(function() {
                status = $('#filterStatus').val();
                loadData();
            });
        });

        async function loadData() {
            var param = {
                method: 'GET',
                url: '{{ url()->current() }}',
                data: {
                    load: 'table',
                    status: status,
                }
            }
            await transAjax(param).then((result) => {
                $('#dataTable').html(result)

            }).catch((err) => {
                console.log('error');
            });
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
