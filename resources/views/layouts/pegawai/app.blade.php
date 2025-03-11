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

    <link rel="stylesheet" href="{{ asset('assets/pegawai/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/pegawai/css/sw-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/placeholder-loading.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- PWA  -->
    <link rel="apple-touch-icon" href="{{ asset('assets/icon/lc_icon_presensi.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    {{-- @vite('resources/css/app.css') --}}
    @stack('css')
    <style>

        .appHeader {
            margin: 0 auto; /* Center content */
            max-width: 768px; /* Tablet size */
            width: 100%; /* Fluid for smaller screens */
        }
        .app-container {
            margin: 0 auto; /* Center content */
            max-width: 768px; /* Tablet size */
            width: 100%; /* Fluid for smaller screens */
        }

        .appBottomMenu {
            margin: 0 auto; /* Center content */
            max-width: 768px; /* Tablet size */
            width: 100%; /* Fluid for smaller screens */
            border-top-left-radius: 15px;
            border-top-right-radius: 15px
        }
        
    </style>
</head>

<body>
    <div class="app-container">
        @yield('content')
        @include('layouts.pegawai.navbar')
        @include('layouts.pegawai.button-action')
    </div>

    <script src="{{ asset('face-recognation/face-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pegawai/js/lib/jquery-3.4.1.min.js') }}"></script>
    {{-- <script src="https://kit.fontawesome.com/0ccb04165b.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('assets/pegawai/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/pegawai/js/webcamjs/webcam.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD8y5ZQcuol7vxOkXii_wsHqYhCNL0uEM&libraries=geometry&callback&places">
    </script>
    <script type="text/javascript" src="{{ asset('assets/pegawai/js/plugins/datepicker/bootstrap-datepicker.js') }}">
    </script>
    {{-- @vite(['resources/js/app.js']) --}}
    <script type="text/javascript">
        $(document).ready(function loading() {
            sw();
        });

        function sw() {
            if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("/swv1.js").then(function(reg) {
                    console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
        }

        async function transAjax(data) {
            html = null;
            data.headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
            await $.ajax(data).done(function(res) {
                    html = res;
                })
                .fail(function() {
                    return false;
                })
            return html
        }

        function loading(btnSubmit, btnLoading, state) {
            if(state) {
                $('#' + btnSubmit).addClass('d-none');
                $('#' + btnLoading).removeClass('d-none');
            }else {
                $('#' + btnSubmit).removeClass('d-none');
                $('#' + btnLoading).addClass('d-none');
            }
        }

        function loadingsubmit(state) {
            if (state) {
                $('#loadingSubmit').removeClass('d-none');
            } else {
                $('#loadingSubmit').addClass('d-none');
                $('#x-action').removeClass('d-none');
            }
        }

        $(".datepicker").datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });

    </script>
    @stack('js')
    <script type="module">
        import hotwiredTurbo from 'https://cdn.skypack.dev/pin/@hotwired/turbo@v7.3.0-44BiCcz1UaBhgMf1MCRj/mode=imports,min/optimized/@hotwired/turbo.js';
        // Contoh penggunaan
        changeStatusBarColor('#1e2a5e');
    </script>
</body>

</html>