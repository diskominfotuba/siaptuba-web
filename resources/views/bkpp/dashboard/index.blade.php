@extends('layouts.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>Overview data</h4>
        <div class="row" id="dataTable">
        </div>
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Statistik pengajuan 1 bulan terakhir</h5>
                <div class="card-body" id="chart">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            loadTable();
        });

        async function loadTable() {
            let param = {
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    load: 'table'
                }
            }

            await transAjax(param).then((result) => {
                $("#dataTable").html(result);
            });
        }
    </script>

    {{-- Chart --}}
    <script type="text/javascript">
        //chart
        var options = {
            series: [{
                data: @json($jumlahPengajuan),
            }],
            chart: {
                type: 'bar',
                height: 450
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    horizontal: true,
                }
            },
            colors: ['#696cff'],
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories:  @json($namaLayanan),
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush
