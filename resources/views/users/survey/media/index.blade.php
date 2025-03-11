@extends('layouts.general')
@section('content')
    <div id="appCapsule">
        <div class="section">
            <h2 class="mt-2">Survei Media Yang Dibaca Pegawai Pemerintah Daerah Kabupaten Tulang Bawang (Survei Kedua)</h2>
            <form action="{{ route('user.surveymedia.store') }}" method="POST">
                @csrf
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Status Kepegawaian Anda</label>
                            <select class="form-control" name="status_pegawai" id="">
                                <option value="pns">PNS</option>
                                <option value="non_pns">NON PNS</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Surat Kabar <b>Harian</b> yang pernah anda baca: (boleh pilih lebih dari satu)</label>
                            <div class="checkbox-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="BONGKAR POST"
                                        id="media1">
                                    <label class="form-check-label" for="media1">BONGKAR POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="BULETIN LAMPUNG"
                                        id="media2">
                                    <label class="form-check-label" for="media2">BULETIN LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="CAKRA LAMPUNG"
                                        id="media3">
                                    <label class="form-check-label" for="media3">CAKRA LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="DAILY LAMPUNG"
                                        id="media4">
                                    <label class="form-check-label" for="media4">DAILY LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="EKSPOST LAMPUNG"
                                        id="media5">
                                    <label class="form-check-label" for="media5">EKSPOST LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="FAJAR SUMATERA"
                                        id="media6">
                                    <label class="form-check-label" for="media6">FAJAR SUMATERA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="FORUM RAKYAT"
                                        id="media7">
                                    <label class="form-check-label" for="media7">FORUM RAKYAT</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="GERBANG SUMATERA 88" id="media8">
                                    <label class="form-check-label" for="media8">GERBANG SUMATERA 88</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="HALUAN BERITA LAMPUNG" id="media9">
                                    <label class="form-check-label" for="media9">HALUAN BERITA LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="HALUAN LAMPUNG"
                                        id="media10">
                                    <label class="form-check-label" for="media10">HALUAN LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="HARIAN ANALIS"
                                        id="media11">
                                    <label class="form-check-label" for="media11">HARIAN ANALIS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="HARIAN CENTRAL" id="media12">
                                    <label class="form-check-label" for="media12">HARIAN CENTRAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="HARIAN DETIK"
                                        id="media13">
                                    <label class="form-check-label" for="media13">HARIAN DETIK</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="HARIAN ELITE LAMPUNG" id="media14">
                                    <label class="form-check-label" for="media14">HARIAN ELITE LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="HARIAN INFO"
                                        id="media15">
                                    <label class="form-check-label" for="media15">HARIAN INFO</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="HARIAN INISIATOR" id="media16">
                                    <label class="form-check-label" for="media16">HARIAN INISIATOR</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="HARIAN KANDIDAT" id="media17">
                                    <label class="form-check-label" for="media17">HARIAN KANDIDAT</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="HARIAN KORIDOR" id="media18">
                                    <label class="form-check-label" for="media18">HARIAN KORIDOR</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="HARIAN KREDIBELL" id="media19">
                                    <label class="form-check-label" for="media19">HARIAN KREDIBELL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="HARIAN LAMPUNG ONE / HARIAN BERITA LAMPUNG" id="media20">
                                    <label class="form-check-label" for="media20">HARIAN LAMPUNG ONE / HARIAN BERITA
                                        LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="HARIAN MOMENTUM" id="media21">
                                    <label class="form-check-label" for="media21">HARIAN MOMENTUM</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="HARIAN PILAR"
                                        id="media22">
                                    <label class="form-check-label" for="media22">HARIAN PILAR</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="HARIAN SENJA"
                                        id="media23">
                                    <label class="form-check-label" for="media23">HARIAN SENJA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="HEADLINE LAMPUNG" id="media24">
                                    <label class="form-check-label" for="media24">HEADLINE LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="INFO NUSANTARA" id="media25">
                                    <label class="form-check-label" for="media25">INFO NUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="KINNI ID"
                                        id="media26">
                                    <label class="form-check-label" for="media26">KINNI ID</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="KORAN EDITOR"
                                        id="media27">
                                    <label class="form-check-label" for="media27">KORAN EDITOR</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="KUPAS TUNTAS"
                                        id="media28">
                                    <label class="form-check-label" for="media28">KUPAS TUNTAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="LAMPUNG CORNER" id="media29">
                                    <label class="form-check-label" for="media29">LAMPUNG CORNER</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="LAMPUNG MEDIA"
                                        id="media30">
                                    <label class="form-check-label" for="media30">LAMPUNG MEDIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="LAMPUNG NEWS PAPER" id="media31">
                                    <label class="form-check-label" for="media31">LAMPUNG NEWS PAPER</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="LAMPUNG POST"
                                        id="media32">
                                    <label class="form-check-label" for="media32">LAMPUNG POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="LAMPUNG RAYA NEWS" id="media33">
                                    <label class="form-check-label" for="media33">LAMPUNG RAYA NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="LENSA MEDIA / BANDAR LAMPUNG NEWS" id="media34">
                                    <label class="form-check-label" for="media34">LENSA MEDIA / BANDAR LAMPUNG
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="MEDIA HISTORI"
                                        id="media35">
                                    <label class="form-check-label" for="media35">MEDIA HISTORI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="MEDIA RAKATA"
                                        id="media36">
                                    <label class="form-check-label" for="media36">MEDIA RAKATA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="MEDINAS LAMPUNG" id="media37">
                                    <label class="form-check-label" for="media37">MEDINAS LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="POJOK KOTA"
                                        id="media38">
                                    <label class="form-check-label" for="media38">POJOK KOTA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="PROKONTRA"
                                        id="media39">
                                    <label class="form-check-label" for="media39">PROKONTRA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="RADAR LAMPUNG"
                                        id="media40">
                                    <label class="form-check-label" for="media40">RADAR LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="RADAR TUBA"
                                        id="media41">
                                    <label class="form-check-label" for="media41">RADAR TUBA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="RILIS ID LAMPUNG" id="media42">
                                    <label class="form-check-label" for="media42">RILIS ID LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="RUBRIK LAMPUNG / RAKYAT LAMPUNG" id="media43">
                                    <label class="form-check-label" for="media43">RUBRIK LAMPUNG / RAKYAT LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="SIGNAL MERAH"
                                        id="media44">
                                    <label class="form-check-label" for="media44">SIGNAL MERAH</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="SIR LAMPUNG"
                                        id="media45">
                                    <label class="form-check-label" for="media45">SIR LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]"
                                        value="TRIBUN LAMPUNG" id="media46">
                                    <label class="form-check-label" for="media46">TRIBUN LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="media[]" value="ZONA LAMPUNG"
                                        id="media47">
                                    <label class="form-check-label" for="media47">ZONA LAMPUNG</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Surat Kabar <b>Mingguan</b> yang pernah Anda baca: (boleh pilih lebih dari satu)</label>
                            <div class="checkbox-group">
                                <!-- Surat Kabar Mingguan -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="ABADI" id="media-abadi">
                                    <label class="form-check-label" for="media-abadi">ABADI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="AGSI POST" id="media-agsi-post">
                                    <label class="form-check-label" for="media-agsi-post">AGSI POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="AKTUALITAS" id="media-aktualitas">
                                    <label class="form-check-label" for="media-aktualitas">AKTUALITAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="ALTERI POST" id="media-alteri-post">
                                    <label class="form-check-label" for="media-alteri-post">ALTERI POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="AMPERA NEWS" id="media-ampera-news">
                                    <label class="form-check-label" for="media-ampera-news">AMPERA NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="ANALISIS" id="media-analisis">
                                    <label class="form-check-label" for="media-analisis">ANALISIS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="ARAH NASIONAL" id="media-arah-nasional">
                                    <label class="form-check-label" for="media-arah-nasional">ARAH NASIONAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BAHANA POST" id="media-bahana-post">
                                    <label class="form-check-label" for="media-bahana-post">BAHANA POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BALAM NEWS" id="media-balam-news">
                                    <label class="form-check-label" for="media-balam-news">BALAM NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BANTEN NET" id="media-banten-net">
                                    <label class="form-check-label" for="media-banten-net">BANTEN NET</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BERANTAS KRIMINAL" id="media-berantas-kriminal">
                                    <label class="form-check-label" for="media-berantas-kriminal">BERANTAS
                                        KRIMINAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BERITA AKTUAL" id="media-berita-aktual">
                                    <label class="form-check-label" for="media-berita-aktual">BERITA AKTUAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BERITA BAGUS" id="media-berita-bagus">
                                    <label class="form-check-label" for="media-berita-bagus">BERITA BAGUS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BERITA KHARISMA" id="media-berita-kharisma">
                                    <label class="form-check-label" for="media-berita-kharisma">BERITA KHARISMA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BERITA KORUPSI" id="media-berita-korupsi">
                                    <label class="form-check-label" for="media-berita-korupsi">BERITA KORUPSI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BERITA NASIONAL" id="media-berita-nasional">
                                    <label class="form-check-label" for="media-berita-nasional">BERITA NASIONAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BERJAYA 1" id="media-berjaya-1">
                                    <label class="form-check-label" for="media-berjaya-1">BERJAYA 1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BIDIK NASIONAL" id="media-bidik-nasional">
                                    <label class="form-check-label" for="media-bidik-nasional">BIDIK NASIONAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BRANTAS KRIMINAL" id="media-brantas-kriminal">
                                    <label class="form-check-label" for="media-brantas-kriminal">BRANTAS KRIMINAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BRAWIJAYA POST" id="media-brawijaya-post">
                                    <label class="form-check-label" for="media-brawijaya-post">BRAWIJAYA POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="BUSER" id="media-buser">
                                    <label class="form-check-label" for="media-buser">BUSER</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="CAHAYA MEDIA" id="media-cahaya-media">
                                    <label class="form-check-label" for="media-cahaya-media">CAHAYA MEDIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="CAHAYA SUMATERA / KARYA NASIONAL" id="media-cahaya-sumatera">
                                    <label class="form-check-label" for="media-cahaya-sumatera">CAHAYA SUMATERA / KARYA
                                        NASIONAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="CAKRAWALA" id="media-cakrawala">
                                    <label class="form-check-label" for="media-cakrawala">CAKRAWALA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="DAULAT LAMPUNG" id="media-daulat-lampung">
                                    <label class="form-check-label" for="media-daulat-lampung">DAULAT LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="DELIK FOKUS" id="media-delik-fokus">
                                    <label class="form-check-label" for="media-delik-fokus">DELIK FOKUS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="DEMOKRASI NEWS" id="media-demokrasi-news">
                                    <label class="form-check-label" for="media-demokrasi-news">DEMOKRASI NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="DERITA LAMPUNG" id="media-derita-lampung">
                                    <label class="form-check-label" for="media-derita-lampung">DERITA LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="DERITA RAKYAT" id="media-derita-rakyat">
                                    <label class="form-check-label" for="media-derita-rakyat">DERITA RAKYAT</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="DETIK LAMPUNG" id="media-detik-lampung">
                                    <label class="form-check-label" for="media-detik-lampung">DETIK LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="DINAMIKA AKTUAL" id="media-dinamika-aktual">
                                    <label class="form-check-label" for="media-dinamika-aktual">DINAMIKA AKTUAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="DIRGANTARA TUBA" id="media-dirgantara-tuba">
                                    <label class="form-check-label" for="media-dirgantara-tuba">DIRGANTARA TUBA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="DIVA TV" id="media-diva-tv">
                                    <label class="form-check-label" for="media-diva-tv">DIVA TV</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="DJOERAGAN TERKINI" id="media-djoeragan-terkini">
                                    <label class="form-check-label" for="media-djoeragan-terkini">DJOERAGAN
                                        TERKINI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="DUTA LAMPUNG / PEWARTA SENUSANTARA" id="media-duta-lampung">
                                    <label class="form-check-label" for="media-duta-lampung">DUTA LAMPUNG / PEWARTA
                                        SENUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="ECHA NEWS" id="media-echa-news">
                                    <label class="form-check-label" for="media-echa-news">ECHA NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="EDUKASI RAKYAT" id="media-edukasi-rakyat">
                                    <label class="form-check-label" for="media-edukasi-rakyat">EDUKASI RAKYAT</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="FAKTUAL" id="media-faktual">
                                    <label class="form-check-label" for="media-faktual">FAKTUAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="FAKTUAL BERITA LAMPUNG" id="media-faktual-berita-lampung">
                                    <label class="form-check-label" for="media-faktual-berita-lampung">FAKTUAL BERITA
                                        LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="FIGUR NEWS" id="media-figur-news">
                                    <label class="form-check-label" for="media-figur-news">FIGUR NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="FOKUS LAMPUNG" id="media-fokus-lampung">
                                    <label class="form-check-label" for="media-fokus-lampung">FOKUS LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="FOR RAKYAT" id="media-for-rakyat">
                                    <label class="form-check-label" for="media-for-rakyat">FOR RAKYAT</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GARDA SURYA" id="media-garda-surya">
                                    <label class="form-check-label" for="media-garda-surya">GARDA SURYA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GARUDA NEWS INDONESIA" id="media-garuda-news-indonesia">
                                    <label class="form-check-label" for="media-garuda-news-indonesia">GARUDA NEWS
                                        INDONESIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GARUDA NUSANTARA" id="media-garuda-nusantara">
                                    <label class="form-check-label" for="media-garuda-nusantara">GARUDA NUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GARUDA POST" id="media-garuda-post">
                                    <label class="form-check-label" for="media-garuda-post">GARUDA POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GAUNG DEMOKRASI" id="media-gaung-demokrasi">
                                    <label class="form-check-label" for="media-gaung-demokrasi">GAUNG DEMOKRASI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GEMA INDONESIA" id="media-gema-indonesia">
                                    <label class="form-check-label" for="media-gema-indonesia">GEMA INDONESIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GEMA LAMPUNG" id="media-gema-lampung">
                                    <label class="form-check-label" for="media-gema-lampung">GEMA LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GEMA NUSANTARA NEWS" id="media-gema-nusantara-news">
                                    <label class="form-check-label" for="media-gema-nusantara-news">GEMA NUSANTARA
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GEMANTARA NEWS" id="media-gemantara-news">
                                    <label class="form-check-label" for="media-gemantara-news">GEMANTARA NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GENTA LAMPUNG" id="media-genta-lampung">
                                    <label class="form-check-label" for="media-genta-lampung">GENTA LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GERBANG 1 NEWS" id="media-gerbang-1-news">
                                    <label class="form-check-label" for="media-gerbang-1-news">GERBANG 1 NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GERBANG BANTEN" id="media-gerbang-banten">
                                    <label class="form-check-label" for="media-gerbang-banten">GERBANG BANTEN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GERBANG BERITA" id="media-gerbang-berita">
                                    <label class="form-check-label" for="media-gerbang-berita">GERBANG BERITA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GERBANG LAMPUNG RAYA" id="media-gerbang-lampung-raya">
                                    <label class="form-check-label" for="media-gerbang-lampung-raya">GERBANG LAMPUNG
                                        RAYA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GERBANG TIMUR">
                                    <label class="form-check-label">GERBANG TIMUR</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GLOBAL LAMPUNG NEWS">
                                    <label class="form-check-label">GLOBAL LAMPUNG NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="GLOBAL POST">
                                    <label class="form-check-label">GLOBAL POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HALUAN BANTEN">
                                    <label class="form-check-label">HALUAN BANTEN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HALUAN INDONESIA">
                                    <label class="form-check-label">HALUAN INDONESIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HANDAL LAMPUNG" id="media-handallampung">
                                    <label class="form-check-label" for="media-handallampung">HANDAL LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HARIAN DIKSI" id="media-hariandiksi">
                                    <label class="form-check-label" for="media-hariandiksi">HARIAN DIKSI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HARIAN EKSPRES" id="media-harianekspres">
                                    <label class="form-check-label" for="media-harianekspres">HARIAN EKSPRES</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HARIAN GLOBAL NUSANTARA" id="media-harianglobalnusantara">
                                    <label class="form-check-label" for="media-harianglobalnusantara">HARIAN GLOBAL
                                        NUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HARIAN KOREKSI" id="media-hariankoreksi">
                                    <label class="form-check-label" for="media-hariankoreksi">HARIAN KOREKSI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HARIAN OTONOMI" id="media-harianotonomi">
                                    <label class="form-check-label" for="media-harianotonomi">HARIAN OTONOMI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HARIAN POST" id="media-harianpost">
                                    <label class="form-check-label" for="media-harianpost">HARIAN POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HARIAN PUBLIK LAMPUNG" id="media-harianpubliklampung">
                                    <label class="form-check-label" for="media-harianpubliklampung">HARIAN PUBLIK
                                        LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HARIAN REVIEW INDONESIA" id="media-harianreviewindonesia">
                                    <label class="form-check-label" for="media-harianreviewindonesia">HARIAN REVIEW
                                        INDONESIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="HARIAN SINERGI" id="media-hariansinergi">
                                    <label class="form-check-label" for="media-hariansinergi">HARIAN SINERGI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="INDEPENDENT POST" id="media-independentpost">
                                    <label class="form-check-label" for="media-independentpost">INDEPENDENT POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="INDO NEWS" id="media-indonews">
                                    <label class="form-check-label" for="media-indonews">INDO NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="INDONESIA JAYA" id="media-indonesiajaya">
                                    <label class="form-check-label" for="media-indonesiajaya">INDONESIA JAYA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="INDONESIA RI" id="media-indonesiari">
                                    <label class="form-check-label" for="media-indonesiari">INDONESIA RI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="INISIAL ID" id="media-inisialid">
                                    <label class="form-check-label" for="media-inisialid">INISIAL ID</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="INKLUSIF NEWS" id="media-inklusivews">
                                    <label class="form-check-label" for="media-inklusivews">INKLUSIF NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="INSPIRASI PENDIDIKAN" id="media-inspirasi pendidikan">
                                    <label class="form-check-label" for="media-inspirasi pendidikan">INSPIRASI
                                        PENDIDIKAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="INTAI LAMPUNG" id="media-intailampung">
                                    <label class="form-check-label" for="media-intailampung">INTAI LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="INTI TRUST LAMPUNG" id="media-intitrustlampung">
                                    <label class="form-check-label" for="media-intitrustlampung">INTI TRUST
                                        LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="JAVA NEWS" id="media-javaews">
                                    <label class="form-check-label" for="media-javaews">JAVA NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="JAWAPERS" id="media-jawapers">
                                    <label class="form-check-label" for="media-jawapers">JAWAPERS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="JENDELA LAMPUNG" id="media-jendelalampung">
                                    <label class="form-check-label" for="media-jendelalampung">JENDELA LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="JUANG POST" id="media-juangpost">
                                    <label class="form-check-label" for="media-juangpost">JUANG POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="JURNAL MEDIA" id="media-jurnalmedia">
                                    <label class="form-check-label" for="media-jurnalmedia">JURNAL MEDIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="JURNAL MEDIA INDONESIA" id="media-jurnalmediindonesia">
                                    <label class="form-check-label" for="media-jurnalmediindonesia">JURNAL MEDIA
                                        INDONESIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="JURNAL MEDIA SUKSES" id="media-jurnalmediasukses">
                                    <label class="form-check-label" for="media-jurnalmediasukses">JURNAL MEDIA
                                        SUKSES</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="JURNAL POLISI" id="media-jurnalpolisi">
                                    <label class="form-check-label" for="media-jurnalpolisi">JURNAL POLISI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="KABAR NUSANTARA" id="media-kabarnusantara">
                                    <label class="form-check-label" for="media-kabarnusantara">KABAR NUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="KARYA LAMPUNG" id="media-karyalampung">
                                    <label class="form-check-label" for="media-karyalampung">KARYA LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="KOMPAS HARIAN" id="media-kompasharian">
                                    <label class="form-check-label" for="media-kompasharian">KOMPAS HARIAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="KOMPAS INSPIRASI" id="media-kompasinspirasi">
                                    <label class="form-check-label" for="media-kompasinspirasi">KOMPAS INSPIRASI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="KORAN PEMBASMI KORUPSI" id="media-koranpembasmikorupsi">
                                    <label class="form-check-label" for="media-koranpembasmikorupsi">KORAN PEMBASMI
                                        KORUPSI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="KORAN PEMBERANTAS KORUPSI" id="media-koranpemberantaskorupsi">
                                    <label class="form-check-label" for="media-koranpemberantaskorupsi">KORAN
                                        PEMBERANTAS
                                        KORUPSI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="KORAN PEMBERITAAN KORUPSI" id="media-koranpemberitaankorupsi">
                                    <label class="form-check-label" for="media-koranpemberitaankorupsi">KORAN
                                        PEMBERITAAN
                                        KORUPSI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="KORAN PENGAWAS KORUPSI" id="media-koranpengawaskorupsi">
                                    <label class="form-check-label" for="media-koranpengawaskorupsi">KORAN PENGAWAS
                                        KORUPSI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="KORAN PENYIDIK KORUPSI" id="media-koranpenyidikkorupsi">
                                    <label class="form-check-label" for="media-koranpenyidikkorupsi">KORAN PENYIDIK
                                        KORUPSI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="KPK" id="media-kpk">
                                    <label class="form-check-label" for="media-kpk">KPK</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LAMPUNG CENDEKIA" id="media-lampungcendekia">
                                    <label class="form-check-label" for="media-lampungcendekia">LAMPUNG CENDEKIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LAMPUNG CITY" id="media-lampungcity">
                                    <label class="form-check-label" for="media-lampungcity">LAMPUNG CITY</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LAMPUNG EKSPRES" id="media-lampungekspres">
                                    <label class="form-check-label" for="media-lampungekspres">LAMPUNG EKSPRES</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LAMPUNG MONITOR" id="media-lampungmonitor">
                                    <label class="form-check-label" for="media-lampungmonitor">LAMPUNG MONITOR</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LAMPUNG NET" id="media-lampungnet">
                                    <label class="form-check-label" for="media-lampungnet">LAMPUNG NET</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LAMPUNG PAGI" id="media-lampungpagi">
                                    <label class="form-check-label" for="media-lampungpagi">LAMPUNG PAGI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LAMPUNG PRIME" id="media-lampungprime">
                                    <label class="form-check-label" for="media-lampungprime">LAMPUNG PRIME</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LCTV" id="media-lctv">
                                    <label class="form-check-label" for="media-lctv">LCTV</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LEGISLATOR" id="media-legislator">
                                    <label class="form-check-label" for="media-legislator">LEGISLATOR</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LENSA PENDIDIKAN" id="media-lensapendidikan">
                                    <label class="form-check-label" for="media-lensapendidikan">LENSA PENDIDIKAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LENSA PERISTIWA" id="media-lensaperistiwa">
                                    <label class="form-check-label" for="media-lensaperistiwa">LENSA PERISTIWA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LENTERA 7" id="media-lentera7">
                                    <label class="form-check-label" for="media-lentera7">LENTERA 7</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LENTERA INDONESIA" id="media-lenterainonesia">
                                    <label class="form-check-label" for="media-lenterainonesia">LENTERA
                                        INDONESIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LEXSPECIALIST" id="media-lexspecialist">
                                    <label class="form-check-label" for="media-lexspecialist">LEXSPECIALIST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LIBAS NEWS" id="media-libasnews">
                                    <label class="form-check-label" for="media-libasnews">LIBAS NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LINTAS CAKRA NEWS" id="media-lintascakranews">
                                    <label class="form-check-label" for="media-lintascakranews">LINTAS CAKRA
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LINTAS DAERAH" id="media-lintasdaerah">
                                    <label class="form-check-label" for="media-lintasdaerah">LINTAS DAERAH</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LINTAS DINAMIKA NEWS" id="media-lintasdinamikanews">
                                    <label class="form-check-label" for="media-lintasdinamikanews">LINTAS DINAMIKA
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LINTAS HUKUM INDONESIA" id="media-lintashukumindonesia">
                                    <label class="form-check-label" for="media-lintashukumindonesia">LINTAS HUKUM
                                        INDONESIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LINTAS INDONESIA" id="media-lintasindonesia">
                                    <label class="form-check-label" for="media-lintasindonesia">LINTAS INDONESIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LINTAS JURNAL" id="media-lintass">
                                    <label class="form-check-label" for="media-lintass">LINTAS JURNAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LINTAS NASIONAL" id="media-lintasnasional">
                                    <label class="form-check-label" for="media-lintasnasional">LINTAS NASIONAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LINTAS PUBLIK INDONESIA" id="media-lintaspublikindonesia">
                                    <label class="form-check-label" for="media-lintaspublikindonesia">LINTAS PUBLIK
                                        INDONESIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="LIPUTAN 86" id="media-liputan86">
                                    <label class="form-check-label" for="media-liputan86">LIPUTAN 86</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MATA POST" id="media-matapost">
                                    <label class="form-check-label" for="media-matapost">MATA POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MATAHARI POST" id="media-matahariPost">
                                    <label class="form-check-label" for="media-matahariPost">MATAHARI POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA 9" id="media-media9">
                                    <label class="form-check-label" for="media-media9">MEDIA 9</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA BERIMBANG" id="media-mediaberimbang">
                                    <label class="form-check-label" for="media-mediaberimbang">MEDIA BERIMBANG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA DINAMIKA" id="media-mediadinamika">
                                    <label class="form-check-label" for="media-mediadinamika">MEDIA DINAMIKA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA JAWAPES" id="media-mediajawapes">
                                    <label class="form-check-label" for="media-mediajawapes">MEDIA JAWAPES</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA JITU" id="media-mediajitu">
                                    <label class="form-check-label" for="media-mediajitu">MEDIA JITU</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA MERDEKA" id="media-mediamerdeka">
                                    <label class="form-check-label" for="media-mediamerdeka">MEDIA MERDEKA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA NASIONAL" id="media-medianasional">
                                    <label class="form-check-label" for="media-medianasional">MEDIA NASIONAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA NASIONAL NEWS" id="media-medianasionalnews">
                                    <label class="form-check-label" for="media-medianasionalnews">MEDIA NASIONAL
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA NUANSA LAMPUNG" id="media-medianuansalampung">
                                    <label class="form-check-label" for="media-medianuansalampung">MEDIA NUANSA
                                        LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA NUSA" id="media-medianusa">
                                    <label class="form-check-label" for="media-medianusa">MEDIA NUSA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA NUSANTARA" id="media-medianusantara">
                                    <label class="form-check-label" for="media-medianusantara">MEDIA NUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA PENDIDIKAN" id="media-mediapendidikan">
                                    <label class="form-check-label" for="media-mediapendidikan">MEDIA PENDIDIKAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA PRIGSEWU" id="media-mediaprigsewu">
                                    <label class="form-check-label" for="media-mediaprigsewu">MEDIA PRIGSEWU</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA PUBLIKASI" id="media-mediapublikasi">
                                    <label class="form-check-label" for="media-mediapublikasi">MEDIA PUBLIKASI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA RAKYAT" id="media-mediarakyat">
                                    <label class="form-check-label" for="media-mediarakyat">MEDIA RAKYAT</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA REVOLUSI NUSANTARA" id="media-mediarevolusinusantara">
                                    <label class="form-check-label" for="media-mediarevolusinusantara">MEDIA REVOLUSI
                                        NUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEDIA SEMBILAN" id="media-mediasembilan">
                                    <label class="form-check-label" for="media-mediasembilan">MEDIA SEMBILAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MEGA MEDIA" id="media-megamedia">
                                    <label class="form-check-label" for="media-megamedia">MEGA MEDIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MELAYU POST" id="media-melayupost">
                                    <label class="form-check-label" for="media-melayupost">MELAYU POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MENGGALA POST" id="media-menggalapost">
                                    <label class="form-check-label" for="media-menggalapost">MENGGALA POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MERCUSUAR" id="media-mercusu">
                                    <label class="form-check-label" for="media-mercusu">MERCUSUAR</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MERCUSUAR JAYA" id="media-mercusuajraya">
                                    <label class="form-check-label" for="media-mercusuajraya">MERCUSUAR JAYA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MERCUSUAR POST" id="media-mercusuapost">
                                    <label class="form-check-label" for="media-mercusuapost">MERCUSUAR POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MERPATI LAMPUNG" id="media-merpatilampung">
                                    <label class="form-check-label" for="media-merpatilampung">MERPATI LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MERPATI NUSANTARA" id="media-merpatinusantara">
                                    <label class="form-check-label" for="media-merpatinusantara">MERPATI
                                        NUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="METRO DEADLINE" id="media-metrodeadline">
                                    <label class="form-check-label" for="media-metrodeadline">METRO DEADLINE</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="METROPOLITAN" id="media-metropolitan">
                                    <label class="form-check-label" for="media-metropolitan">METROPOLITAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MITRA NASIOANAL" id="media-mitra-nasional">
                                    <label class="form-check-label" for="media-mitra-nasional">MITRA NASIOANAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MITRA POST" id="media-mitra-post">
                                    <label class="form-check-label" for="media-mitra-post">MITRA POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MAJALAH BERKIBAR" id="media-majalah-berkibar">
                                    <label class="form-check-label" for="media-majalah-berkibar">MAJALAH
                                        BERKIBAR</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MODUS INVESTIGASI" id="media-modus-investigasi">
                                    <label class="form-check-label" for="media-modus-investigasi">MODUS
                                        INVESTIGASI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MONEV" id="media-monev">
                                    <label class="form-check-label" for="media-monev">MONEV</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MONITOR LAMPUNG" id="media-monitor-lampung">
                                    <label class="form-check-label" for="media-monitor-lampung">MONITOR LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MUKTI PENA" id="media-mukti-pena">
                                    <label class="form-check-label" for="media-mukti-pena">MUKTI PENA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="NARASI PUBLIK" id="media-narasi-publik">
                                    <label class="form-check-label" for="media-narasi-publik">NARASI PUBLIK</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="NASIONALIS" id="media-nasionalis">
                                    <label class="form-check-label" for="media-nasionalis">NASIONALIS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="NEW PAPER" id="media-new-paper">
                                    <label class="form-check-label" for="media-new-paper">NEW PAPER</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="NEWS PUBLIK" id="media-news-publik">
                                    <label class="form-check-label" for="media-news-publik">NEWS PUBLIK</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="NUSANTARA KITA" id="media-nusantara-kita">
                                    <label class="form-check-label" for="media-nusantara-kita">NUSANTARA KITA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="PALAPA NUSANTARA" id="media-palapa-nusantara">
                                    <label class="form-check-label" for="media-palapa-nusantara">PALAPA
                                        NUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="PANCARAN POST" id="media-pancaran-post">
                                    <label class="form-check-label" for="media-pancaran-post">PANCARAN POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="PELITA NUSANTARA" id="media-pelita-nusantara">
                                    <label class="form-check-label" for="media-pelita-nusantara">PELITA
                                        NUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="PENA BERITA NUSANTARA" id="media-pena-berita-nusantara">
                                    <label class="form-check-label" for="media-pena-berita-nusantara">PENA BERITA
                                        NUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="PENA LAMPUNG" id="media-pena-lampung">
                                    <label class="form-check-label" for="media-pena-lampung">PENA LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="PESONA ALAM" id="media-pesona-alam">
                                    <label class="form-check-label" for="media-pesona-alam">PESONA ALAM</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="PESONA LAMPUNG" id="media-pesona-lampung">
                                    <label class="form-check-label" for="media-pesona-lampung">PESONA LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="PIKIRAN CENDEKIA" id="media-pikiran-cendekia">
                                    <label class="form-check-label" for="media-pikiran-cendekia">PIKIRAN
                                        CENDEKIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="PILAR POST" id="media-pilar-post">
                                    <label class="form-check-label" for="media-pilar-post">PILAR POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="POJOK DESA" id="media-pojok-desa">
                                    <label class="form-check-label" for="media-pojok-desa">POJOK DESA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="POROS DAILY" id="media-poros-daily">
                                    <label class="form-check-label" for="media-poros-daily">POROS DAILY</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="POTENSI" id="media-potensi">
                                    <label class="form-check-label" for="media-potensi">POTENSI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="RAKYAT MEDIA" id="media-rakyat-media">
                                    <label class="form-check-label" for="media-rakyat-media">RAKYAT MEDIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="RAKYAT NEWS" id="media-rakyat-news">
                                    <label class="form-check-label" for="media-rakyat-news">RAKYAT NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="RAKYAT OPOSISI" id="media-rakyat-oposisi">
                                    <label class="form-check-label" for="media-rakyat-oposisi">RAKYAT OPOSISI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="RAKYAT POST NEWS" id="media-rakyat-post-news">
                                    <label class="form-check-label" for="media-rakyat-post-news">RAKYAT POST
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="RAKYAT SIMPATI" id="media-rakyat-simpati">
                                    <label class="form-check-label" for="media-rakyat-simpati">RAKYAT SIMPATI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SAHABAT PENA" id="media-sahabat-pena">
                                    <label class="form-check-label" for="media-sahabat-pena">SAHABAT PENA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SATELIT LAMPUNG" id="media-satelit-lampung">
                                    <label class="form-check-label" for="media-satelit-lampung">SATELIT LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SELIDIK" id="media-selidik">
                                    <label class="form-check-label" for="media-selidik">SELIDIK</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SENATOR NUSANTARA" id="media-senator-nusantara">
                                    <label class="form-check-label" for="media-senator-nusantara">SENATOR
                                        NUSANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SEPUTAR KOTA" id="media-seputar-kota">
                                    <label class="form-check-label" for="media-seputar-kota">SEPUTAR KOTA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SERANGKAI NEWS" id="media-serangkai-news">
                                    <label class="form-check-label" for="media-serangkai-news">SERANGKAI NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SERGAP" id="media-sergap">
                                    <label class="form-check-label" for="media-sergap">SERGAP</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SIDAK POST" id="media-sidak-post">
                                    <label class="form-check-label" for="media-sidak-post">SIDAK POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SIGAP TERKINI" id="media-sigap-terkini">
                                    <label class="form-check-label" for="media-sigap-terkini">SIGAP TERKINI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SIGERINDO" id="media-sigerindo">
                                    <label class="form-check-label" for="media-sigerindo">SIGERINDO</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SIGNAL LAMPUNG" id="media-signal-lampung">
                                    <label class="form-check-label" for="media-signal-lampung">SIGNAL LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SILSILAH" id="media-silsilah">
                                    <label class="form-check-label" for="media-silsilah">SILSILAH</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SINAR BANGSA NEWS" id="media-sinar-bangsa-news">
                                    <label class="form-check-label" for="media-sinar-bangsa-news">SINAR BANGSA
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SINAR LAMPUNG" id="media-sinar-lampung">
                                    <label class="form-check-label" for="media-sinar-lampung">SINAR LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SINAR PENDIDIKAN" id="media-sinar-pendidikan">
                                    <label class="form-check-label" for="media-sinar-pendidikan">SINAR
                                        PENDIDIKAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SINAR POST" id="media-sinar-post">
                                    <label class="form-check-label" for="media-sinar-post">SINAR POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SKH KEADILAN" id="media-skh-keadilan">
                                    <label class="form-check-label" for="media-skh-keadilan">SKH KEADILAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SKU SIDIK LAMPUNG" id="media-sku-sidik-lampung">
                                    <label class="form-check-label" for="media-sku-sidik-lampung">SKU SIDIK
                                        LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUARA INSPIRASI NEWS" id="media-suara-inspirasi-news">
                                    <label class="form-check-label" for="media-suara-inspirasi-news">SUARA INSPIRASI
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUARA INTELEKTUAL" id="media-suara-intelektual">
                                    <label class="form-check-label" for="media-suara-intelektual">SUARA
                                        INTELEKTUAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUARA INVESTIGASI NEWS" id="media-suara-investigasi-news">
                                    <label class="form-check-label" for="media-suara-investigasi-news">SUARA INVESTIGASI
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUARA KARYA" id="media-suara-karya">
                                    <label class="form-check-label" for="media-suara-karya">SUARA KARYA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUARA KEADILAN" id="media-suara-keadilan">
                                    <label class="form-check-label" for="media-suara-keadilan">SUARA KEADILAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUARA NASIONAL" id="media-suara-nasional">
                                    <label class="form-check-label" for="media-suara-nasional">SUARA NASIONAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUARA PATRIOT" id="media-suara-patriot">
                                    <label class="form-check-label" for="media-suara-patriot">SUARA PATRIOT</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUARA PEDIA" id="media-suara-pedia">
                                    <label class="form-check-label" for="media-suara-pedia">SUARA PEDIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUARA PENDIDIKAN" id="media-suara-pendidikan">
                                    <label class="form-check-label" for="media-suara-pendidikan">SUARA
                                        PENDIDIKAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUARA TRANS" id="media-suara-trans">
                                    <label class="form-check-label" for="media-suara-trans">SUARA TRANS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUARA UTAMA NEWS" id="media-suara-utama-news">
                                    <label class="form-check-label" for="media-suara-utama-news">SUARA UTAMA
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SULUH NEWS" id="media-suluh-news">
                                    <label class="form-check-label" for="media-suluh-news">SULUH NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SUMATERA POST" id="media-sumatera-post">
                                    <label class="form-check-label" for="media-sumatera-post">SUMATERA POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SURYA BANGKIT" id="media-surya-bangkit">
                                    <label class="form-check-label" for="media-surya-bangkit">SURYA BANGKIT</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SWARA KARYA" id="media-swara-karya">
                                    <label class="form-check-label" for="media-swara-karya">SWARA KARYA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="SWARA PENDIDIKAN" id="media-swara-pendidikan">
                                    <label class="form-check-label" for="media-swara-pendidikan">SWARA
                                        PENDIDIKAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TABIR NEWS" id="media-tabir-news">
                                    <label class="form-check-label" for="media-tabir-news">TABIR NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TABLOID BUSER KRIMINAL" id="media-tabloid-buser-kriminal">
                                    <label class="form-check-label" for="media-tabloid-buser-kriminal">TABLOID BUSER
                                        KRIMINAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TABLOID GAPURA NEWS" id="media-tabloid-gapura-news">
                                    <label class="form-check-label" for="media-tabloid-gapura-news">TABLOID GAPURA
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TABLOID MITRAPOL" id="media-tabloid-mitrapol">
                                    <label class="form-check-label" for="media-tabloid-mitrapol">TABLOID
                                        MITRAPOL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TABLOID WASPADA" id="media-tabloid-waspada">
                                    <label class="form-check-label" for="media-tabloid-waspada">TABLOID WASPADA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TARGET KASUS NEWS" id="media-target-kasus-news">
                                    <label class="form-check-label" for="media-target-kasus-news">TARGET KASUS
                                        NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TEKAD" id="media-tekad">
                                    <label class="form-check-label" for="media-tekad">TEKAD</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TELISIK MEDIA" id="media-telisik-media">
                                    <label class="form-check-label" for="media-telisik-media">TELISIK MEDIA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TINTA INFORMASI" id="media-tinta-informasi">
                                    <label class="form-check-label" for="media-tinta-informasi">TINTA INFORMASI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TIPIKOR" id="media-tipikor">
                                    <label class="form-check-label" for="media-tipikor">TIPIKOR</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TIPIKOR INVESTIGASI" id="media-tipikor-investigasi">
                                    <label class="form-check-label" for="media-tipikor-investigasi">TIPIKOR
                                        INVESTIGASI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TIRAS POST" id="media-tiras-post">
                                    <label class="form-check-label" for="media-tiras-post">TIRAS POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TRANS LAMPUNG" id="media-trans-lampung">
                                    <label class="form-check-label" for="media-trans-lampung">TRANS LAMPUNG</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TRANS NEWS EDUCATION" id="media-trans-news-education">
                                    <label class="form-check-label" for="media-trans-news-education">TRANS NEWS
                                        EDUCATION</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TRIBUN TIPIKOR" id="media-tribun-tipikor">
                                    <label class="form-check-label" for="media-tribun-tipikor">TRIBUN TIPIKOR</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="TUNTAS INVESTIGASI" id="media-tuntas-investigasi">
                                    <label class="form-check-label" for="media-tuntas-investigasi">TUNTAS
                                        INVESTIGASI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="VIGUR NEWS" id="media-vigur-news">
                                    <label class="form-check-label" for="media-vigur-news">VIGUR NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="VISIONER" id="media-visioner">
                                    <label class="form-check-label" for="media-visioner">VISIONER</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="VISUAL" id="media-visual">
                                    <label class="form-check-label" for="media-visual">VISUAL</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="WAHANA REFORMASI" id="media-wahana-reformasi">
                                    <label class="form-check-label" for="media-wahana-reformasi">WAHANA
                                        REFORMASI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="WANTARA" id="media-wantara">
                                    <label class="form-check-label" for="media-wantara">WANTARA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="WARTA NEWS" id="media-warta-news">
                                    <label class="form-check-label" for="media-warta-news">WARTA NEWS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="WARTA PEMBAHARUAN" id="media-warta-pembaharuan">
                                    <label class="form-check-label" for="media-warta-pembaharuan">WARTA
                                        PEMBAHARUAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="WARTA POLINDO" id="media-warta-polindo">
                                    <label class="form-check-label" for="media-warta-polindo">WARTA POLINDO</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="WARTA POST" id="media-warta-post">
                                    <label class="form-check-label" for="media-warta-post">WARTA POST</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="WARTA POST ANDALAS" id="media-warta-post-andalas">
                                    <label class="form-check-label" for="media-warta-post-andalas">WARTA POST
                                        ANDALAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="WARTA POST GROUP" id="media-warta-post-group">
                                    <label class="form-check-label" for="media-warta-post-group">WARTA POST
                                        GROUP</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="WARTA POST INDO GROUP" id="media-warta-post-indo-group">
                                    <label class="form-check-label" for="media-warta-post-indo-group">WARTA POST INDO
                                        GROUP</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="WARTA REFORMASI" id="media-warta-reformasi">
                                    <label class="form-check-label" for="media-warta-reformasi">WARTA REFORMASI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="WAWASAN" id="media-wawasan">
                                    <label class="form-check-label" for="media-wawasan">WAWASAN</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mediaMingguan[]"
                                        value="MITRA NASIONAL" id="media-mitra-nasional">
                                    <label class="form-check-label" for="media-mitra-nasional">MITRA NASIONAL</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Apakah dari 1 Januari 2024 sampai 31 Agustus 2024, Anda pernah membaca surat kabar /
                                koran cetak sebagaimana daftar media di atas ?</label>
                            <select class="form-control" name="pernah_membaca" id="">
                                <option value="tidak">TIDAK</option>
                                <option value="ya">YA</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Saya lebih memilih untuk membaca:</label>
                            <select class="form-control" name="preferensi_membaca" id="">
                                <option value="digital">Surat Kabar/Koran Ditigal</option>
                                <option value="cetak">Surat Kabar/Koran Cetak</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Apakah surat kabar masih menjadi sumber berita utama dalam mendapatkan informasi?</label>
                            <select class="form-control" name="sumber_berita" id="">
                                <option value="tidak">TIDAK</option>
                                <option value="ya">YA</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Apakah Anda setuju, bila Pemerintah Kabupaten Tulang Bawang menyediakan tempat membaca
                                surat kabar / koran digital secara gratis?</label>
                            <select class="form-control" name="koran_digital" id="">
                                <option value="setuju">SETUJU</option>
                                <option value="tidak">TIDAK</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    @include('layouts.pegawai._loading_submit')
                    <button type="submit" id="btn_login" class="btn btn-primary btn-block btn-lg">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
