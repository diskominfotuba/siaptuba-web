<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="JNUql3k5Q0B10HhKDHMUZRMQb9Z23lLwY3oLqiCAJH0" />
    <title>{{ $title ?? 'Dashboard' }}</title>

    <meta name="theme-color" content="#1E2A5E">
    <meta name="msapplication-navbutton-color" content="#1E2A5E">
    <meta name="apple-mobile-web-app-status-bar-style" content="#1E2A5E">
    <meta name="description" content="DISKOMINFO TUBA">
    <meta name="keywords" content="DISKOMINFO TUBA">
    <meta name="author" content="DISKOMINFO TUBA">
    <meta http-equiv="Copyright" content="DISKOMINFO TUBA">
    <meta name="copyright" content="DISKOMINFO TUBA">

    <link rel="stylesheet" href="{{ asset('assets/pegawai') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets/pegawai') }}/css/sw-custom.css">
    <link rel="stylesheet" href="{{ asset('css') }}/placeholder-loading.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- PWA  -->
    <link rel="apple-touch-icon" href="{{ asset('assets/icon/lc_icon_presensi.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <style>
        .app-container {
            margin: 0 auto; /* Center content */
            max-width: 768px; /* Tablet size */
            width: 100%;
        }
    </style>
    @vite('resources/css/app.css')
    @stack('css')
</head>

<body>
    <div class="app-container">
        @yield('content')
        @include('layouts.pegawai.navbar')
        @include('layouts.pegawai.footer')
    </div>
    <script src="{{ asset('assets/pegawai') }}/js/lib/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('assets/pegawai') }}/js/sweetalert.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    </script>
    {{-- @vite(['resources/js/app.js']) --}}
    <script type="text/javascript">
        async function transAjax(data) {
            html = null;
            data.headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            await $.ajax(data).done(function(res) {
                    html = res;
                })
                .fail(function() {
                    return false;
                })
            return html
        }

        function changeRefreshStatus(status) {
            if (window.AndroidInterface) {
                window.AndroidInterface.setRefreshStatus(status);
            }
        }

        changeRefreshStatus(true);
        
    </script>
     @stack('js')
    <script type="module">
        import hotwiredTurbo from 'https://cdn.skypack.dev/pin/@hotwired/turbo@v7.3.0-44BiCcz1UaBhgMf1MCRj/mode=imports,min/optimized/@hotwired/turbo.js';
        function changeStatusBarColor(color) {
            if (window.AndroidInterface) {
                window.AndroidInterface.setStatusBarColor(color);
            }
        }
        
        // Contoh penggunaan
        changeStatusBarColor('#1e2a5e');
    </script>
</body>
</html>