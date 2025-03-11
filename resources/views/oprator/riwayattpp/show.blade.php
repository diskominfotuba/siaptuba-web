@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Basic Alerts -->
                <div class="col-md mb-md-0">
                    <div class="card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-header">Data Diri Pegawai</h5>
                            <div>
                                <a href="#" id="btn-print" class="btn btn-primary me-3">Print</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-12 col-md-6">
                                  <label for="nameWithTitle" class="form-label">Nama</label>
                                  <input
                                    name="nama"
                                    type="text"
                                    id="name"
                                    class="form-control"
                                    value="{{ $user->nama }}"
                                  />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label for="nameWithTitle" class="form-label">NIP</label>
                                  <input
                                    name="nip"
                                    type="text"
                                    id="nip"
                                    class="form-control"
                                    value="{{ $user->nip }}"
                                  />
                                </div>
                              </div>
                              <div class="row g-2 mt-1">
                                <div class="col-12 col-md-6">
                                  <label for="nameWithTitle" class="form-label">Jabatan</label>
                                  <input
                                    name="jabatan"
                                    type="text"
                                    id="jabatan"
                                    class="form-control"
                                    value="{{ $user->jabatan }}"
                                  />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label for="nameWithTitle" class="form-label">Organisasi</label>
                                  <input
                                    name="opd_id"
                                    type="text"
                                    id="organisasi"
                                    class="form-control"
                                    value="{{ $user->opd->nama_opd }}"
                                  />
                                </div>
                              </div>
                              <div class="row g-2 mt-1">
                                <div class="col-12 col-md-6">
                                  <label for="nameWithTitle" class="form-label">Unit Organisasi</label>
                                  <input
                                    name="unit_organisasi"
                                    type="text"
                                    id="unit_organisasi"
                                    class="form-control"
                                    value="{{ $user->unit_organisasi }}"
                                  />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label for="nameWithTitle" class="form-label">No Tlp/WhatsApp</label>
                                  <input
                                    name="no_hp"
                                    type="text"
                                    id="no_hp"
                                    class="form-control"
                                    value="{{ $user->no_hp }}"
                                  />
                                </div>
                              </div>
                              <div class="row g-2 mt-1">
                                <div class="col-12 col-md-6">
                                  <label for="email" class="form-label">Email</label>
                                  <input
                                    name="email"
                                    type="email"
                                    id="email"
                                    class="form-control"
                                    value="{{ $user->email }}"
                                  />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label for="nominal" class="form-label">Tambahan Penghasilan Pegawai (TPP)</label>
                                  <div class="input-group mb-2">
                                    <input type="text" name="tpp" value="{{ formatRp($user->tpp) }}" class="form-control" id="nominal" placeholder="Masukan nominal" onkeyup="formatRupiah(this)">
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-header">Riwayat Pengurangan TPP</h5>
                            <h5 class="card-header">
                                <select name="bulan"  id="bulan" class="form-control" onchange="this.value">
                                    <option value="">--pilih bulan--</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </h5>
                        </div>
                        <div class="card-body">
                            @include('layouts._loading')
                            <div class="table-responsive text-nowrap" id="dataTable">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-backdrop fade"></div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        var bulan = '';
        var page = 1;
        $(document).ready(function() {
            loadTable();

            $('#bulan').change(function() {
                filterTable();
            });

        });

        function filterTable() {
            search = $('#search').val();
            bulan = $('#bulan').val();
            console.log(bulan);
            loadTable();
        }

        async function loadTable() {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    bulan: bulan,
                    page: page,
                }
            }

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                $('#dataTable').html(result);
            }).catch((err) => {
                loading(false);
                console.log(err);
            })
        }

        function loadPaginate(to) {
            page = to
            filterTable()
        }

        //print data riwayat tpp
        $("#btn-print").click(function() {
            window.location.href = "/oprator/riwayattpp/print?user_id={{ $user->id }}&bulan="+bulan
        });
    </script>
@endpush
