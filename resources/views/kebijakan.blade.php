<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="JNUql3k5Q0B10HhKDHMUZRMQb9Z23lLwY3oLqiCAJH0" />
    <title>{{ $title ?? 'Dashboard' }}</title>

    <meta name="theme-color" content="#6777ef">
    <meta name="msapplication-navbutton-color" content="#6777ef">
    <meta name="apple-mobile-web-app-status-bar-style" content="#6777ef">
    <meta name="description" content="DISKOMINFO TUBA">
    <meta name="keywords" content="DISKOMINFO TUBA">
    <meta name="author" content="DISKOMINFO TUBA">
    <meta http-equiv="Copyright" content="DISKOMINFO TUBA">
    <meta name="copyright" content="DISKOMINFO TUBA">

    <link rel="stylesheet" href="{{ asset('assets/pegawai/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/pegawai/css/sw-custom.css') }}">
</head>

<body class="bg-white">
    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            SIAP TUBA
        </div>
        <div class="right">
            <a href="javascript:;" class="headerButton" data-bs-toggle="modal" data-bs-target="#actionSheetShare">
                <ion-icon name="share-social-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section">
            <div class="section-title">1. Pendahuluan</div>
            <p class="paragraph">
                Selamat datang di Aplikasi SIAPTUBA. Kami (Dinas komunikasi dan Informatika Kabupaten Tulang Bawang)
                selaku pengembang aplikasi, menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi Anda.
                Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi
                Anda saat Anda menggunakan aplikasi ini.
            </p>

            <div class="section-title">2. Informasi yang dikumpulkan</div>
            <p class="paragraph">Kami dapat mengumpulkan informasi berikut:</p>
            <ul>
                <li class="bullet-point">Informasi pribadi seperti nama, alamat dan email</li>
                <li class="bullet-point">Data penggunaan aplikasi</li>
            </ul>

            <div class="section-title">3. Bagaimana Kami Menggunakan Informasi Anda</div>
            <p class="paragraph">Informasi yang kami kumpulkan digunakan untuk:</p>
            <ul>
                <li class="bullet-point">Menyediakan dan memelihara layanan</li>
                <li class="bullet-point">Meningkatkan aplikasi</li>
                <li class="bullet-point">Mencegah aktivitas yang melanggar hukum</li>
            </ul>

            <div class="section-title">4. Keamanan Data</div>
            <p class="paragraph">
                Kami menerapkan langkah-langkah keamanan yang tepat untuk melindungi informasi pribadi Anda dari akses
                yang tidak sah, pengubahan, pengungkapan, atau penghancuran.
            </p>

            <div class="section-title">5. Berbagi Informasi</div>
            <p class="paragraph">
                Kami tidak akan membagikan informasi pribadi Anda kepada siapapun tanpa izin Anda, kecuali jika
                diperlukan untuk memenuhi hukum atau peraturan yang berlaku.
            </p>

            <div class="section-title">6. Perubahan pada Kebijakan Privasi</div>
            <p class="paragraph">
                Kebijakan Privasi dapat berubah dari waktu ke waktu. Setiap perubahan akan di posting di halaman ini.
            </p>

            <div class="section-title">7. Hubungi Admin</div>
            <p class="paragraph">
                Jika Anda memiliki pertanyaan atau masalah tentang Kebijakan Privasi, silakan hubungi admin di: <a
                    href="mailto:siaptuba@tulangbawagkab.go.id">siaptuba@tulangbawagkab.go.id</a>
            </p>
            <div class="section-title">8. Izin Kamera</div>
            <p>
                Aplikasi ini meminta akses ke kamera perangkat Anda. Izin ini digunakan semata-mata untuk keperluan
                [misalnya, mengambil foto untuk dokumentasi presensi, memindai kode QR, atau fitur tertentu lainnya
                dalam aplikasi SIAP TUBA]. Gambar yang diambil menggunakan kamera disimpan secara lokal di perangkat
                Anda dan tidak dibagikan kepada pihak ketiga kecuali disebutkan secara eksplisit.
                Anda dapat memilih untuk menolak izin ini; namun, beberapa fitur aplikasi yang memerlukan akses kamera
                mungkin tidak dapat berfungsi dengan baik.
            </p>


            <p class="last-updated">Terakhir diperbarui: 22 April 2025</p>
</body>


<!-- Mirrored from finapp.bragherstudio.com/view3/app-blog-post.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 May 2023 08:14:19 GMT -->

</html>
