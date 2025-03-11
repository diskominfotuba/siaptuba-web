@extends('layouts.printpage')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <h3 class="text-center mb-3">Riwayat Pengurangan Tambahan Penghasilan Pegawai (TPP) <br> Kabupaten Tulang Bawang</h3>
            <div class="row">
                <!-- Basic Alerts -->
                <div class="col-md mb-md-0">
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
                    <div class="mt-3">
                      <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Riwayat Pengurangan TPP</h5>
                        </div>
                        @include('layouts._loading')
                        <div class="table-responsive text-nowrap" id="dataTable">

                        </div>
                    </div>
            </div>
        </div>
        <div class="content-backdrop fade"></div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            loadTable();
        });

        async function loadTable() {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    user_id: "{{ $user->id }}",
                    bulan: '{{ request()->bulan }}',
                }
            }

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                $('#dataTable').html(result);
            }).catch((err) => {
                loading(false);
                console.log(err);
            });

            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                window.print();
            }).catch((err) => {
                loading(false);
                console.log(err);
            });
        }
    </script>
@endpush
