<div class="modal fade action-sheet" id="modalBkpp" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Layanan Kepegawaian</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="card mb-2">
                        <a href="{{ route('user.pangkat.reguler') }}">
                            <div class="card-body">
                                1. Kenaikan Pangkat Reguler/Staf/Pelaksana
                            </div>
                        </a>
                    </div>
                    <div class="card mb-2">
                        <a href="{{ route('user.pangkat.fungsional') }}" data-target="#underConstruction">
                            <div class="card-body">
                                2. Kenaikan Pangkat Fungsional
                            </div>
                        </a>
                    </div>
                    <div class="card mb-2">
                        <a href="{{ route('user.pangkat.struktural') }}">
                            <div class="card-body">
                                3. Kenaikan Pangkat Struktural
                            </div>
                        </a>
                    </div>
                    <div class="card mb-2">
                        <a href="{{ route('user.kariskarsu') }}">
                            <div class="card-body">
                                4. Karis/Karsu
                            </div>
                        </a>
                    </div>
                    <div class="card mb-2">
                        <a href="{{ route('user.pencantumangelar') }}">
                            <div class="card-body">
                                5. Pencantuman Gelar
                            </div>
                        </a>
                    </div>
                    <div class="card mb-2">
                        <a href="{{ route('user.penyesuaianijazah') }}">
                            <div class="card-body">
                                6. Penyesuaian Ijazah
                            </div>
                        </a>
                    </div>
                    <div class="card mb-2">
                        <a href="{{ route('user.mutasimasuk') }}">
                            <div class="card-body">
                                7. Mutasi Masuk
                            </div>
                        </a>
                    </div>
                    <div class="card mb-2">
                        <a href="{{ route('user.mutasikeluar') }}">
                            <div class="card-body">
                                8. Mutasi Keluar
                            </div>
                        </a>
                    </div>
                    <div class="card mb-2">
                        <a href="{{ route('user.mutasidalam') }}">
                            <div class="card-body">
                                9. Mutasi Dalam/Internal
                            </div>
                        </a>
                    </div>
                    <div class="form-group basic">
                        <button type="button" class="btn btn-primary btn-block btn-lg"
                            data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function hideModalBkpp() {
        $('#modalBkpp').modal('hide');
    }
</script>
