<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="google-site-verification" content="JNUql3k5Q0B10HhKDHMUZRMQb9Z23lLwY3oLqiCAJH0" />
  <title>{{ $title ?? 'Login' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="#6777ef"/>
  <meta name="turbolinks-visit-control" content="reload">

  <link rel="stylesheet" href="{{ asset('assets/pegawai/css/style.css') }}">
  <!-- PWA  -->
  <meta name="theme-color" content="#6777ef">
  <link rel="apple-touch-icon" href="{{ asset('assets/icon/lc_icon_absent.png') }}">
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