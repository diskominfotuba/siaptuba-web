<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="theme-color" content="#1E2A5E">
  <title>{{ $title ?? 'SIAP TUBA' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="turbolinks-visit-control" content="reload">

  <meta itemprop="name" content="SIAP TUBA" />
  <meta itemprop="description" content="Sistem Administrasi Pegawai Kabupaten Tulang Bawang" />
  <meta itemprop="image" content="{{ asset('assets/icon/lc_icon_presensi.png') }}" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="@" />
  <meta name="twitter:title" content="SIAP TUBA" />
  <meta name="twitter:description" content="Sistem Administrasi Pegawai Kabupaten Tulang Bawang" />
  <meta name="twitter:creator" content="@" />
  
  <meta name="twitter:image" content="{{ asset('assets/icon/lc_icon_presensi.png') }}" />
  
  <meta name="twitter:image:src" content="{{ asset('assets/icon/lc_icon_presensi.png') }}" />
  <meta property="og:title" content="SIAP TUBA" />
  <meta property="og:type" content="Sistem Administrasi Pegawai Kabupaten Tulang Bawang" />
  <meta property="og:url" content="{{ url()->current() }}" />
  <meta property="og:image" content="{{ asset('assets/icon/lc_icon_presensi.png') }}" />
  <meta property="og:description" content="Sistem Administrasi Pegawai Kabupaten Tulang Bawang" />
  <meta property="og:site_name" content="SIAP TUBA" />

  <!-- Favicon Icon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('icon.png') }}">

  <link rel="stylesheet" href="{{ asset('assets/pegawai/css/style.css') }}">
  <!-- PWA  -->
   <link rel="apple-touch-icon" href="{{ asset('assets/icon/lc_icon_presensi.png') }}">
   <link rel="manifest" href="{{ asset('/manifest.json') }}">
</head>

<style>
    .app-container {
        margin: 0 auto; 
        max-width: 768px; 
        width: 100%;
    }
</style>
<body>
  <div id="app" class="app-container">
    @yield('content')
  </div>
</body>
<script src="{{ asset('assets/pegawai/js/lib/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }

    //fungsi untuk menampilkan dan menutup password
    $('#showPassword').on('change', function() {
        var passwordField = $('#password');
        var passwordFieldType = passwordField.attr('type');
        if ($(this).is(':checked')) {
            passwordField.attr('type', 'text'); // Show password
        } else {
            passwordField.attr('type', 'password'); // Hide password
        }
    });

    //digunakan untuk menampilkan animasi loading ketika tombol login ditekan
    $('#btn_login').click(function() {
    let email = $('#email').val().trim();
    let password = $('#password').val().trim();

    if (email === '' || password === '') {
        return;
    }

        $('#btn_login').addClass('d-none'); // Nonaktifkan tombol
        $('#btn_loading').removeClass('d-none');
    });

</script>
@stack('js')
</html>