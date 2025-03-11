@extends('layouts.general')
@section('content')
    <div class="container mt-3" style="padding-bottom: 20px">
        <div style="padding-top: 50px">
            <h4>Daftar wajib LHKPN yang belum menyelesaikan pengisian</h4>
            <hr>
            <div id="dataTable">

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#dataTable').html(make_skeleton());
        $(document).ready(async function() {
            var param = {
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    'load': 'table'
                }
            }

            await transAjax(param).then((result) => {
                $('#dataTable').html(result);
            });
        });

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
