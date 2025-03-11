@extends('layouts.general')
@section('content')
<div id="appCapsule">
    <div class="section tab-content mt-2 mb-2">
        <div class="row">
            <div class="col-6 mb-2">
                <div class="blog-card">
                    <img lazy="loading" src="{{ route('drive', ['filename' => 'pj_bupati_kab_tulang_bawang.jpg']) }}" alt="image" class="imaged w-100">
                    <div class="text">
                        <h4 class="title">Ferli Yuledi, SP., MM., MT.jpg</h4>
                    </div>
                    <a href="{{ route('drive.download', ['filename' => 'pj_bupati_kab_tulang_bawang.jpg']) }}" download="pj_bupati_kab_tulang_bawang.jpg" class="btn btn-sm btn-primary btn-block">Unduh</a>
                </div>
            </div>
            <div class="col-6 mb-2">
                <div class="blog-card">
                    <img lazy="loading" src="{{ route('drive', ['filename' => 'pj_ketua_tp_pkk_kab_tulangbawang.jpg']) }}" alt="image" class="imaged w-100">
                    <div class="text">
                        <h4 class="title">Ny. Dr. FEBY LEVARINA FERLI, Sp.PK., M.Kes., MH</h4>
                    </div>
                    <a href="{{ route('drive.download', ['filename' => 'pj_ketua_tp_pkk_kab_tulangbawang.jpg']) }}" download="pj_ketua_tp_pkk_kab_tulangbawang.jpg" class="btn btn-sm btn-primary btn-block">Unduh</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
