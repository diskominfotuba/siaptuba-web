<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ragah Tuah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/services/ragahtuah/') }}/css/main.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/services/ragahtuah/') }}/img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
</head>

<body>

    <div class="container">
        @yield('content')
    </div>

    <audio id="backgroundMusic" src="{{ asset('assets/services/ragahtuah/') }}/sound/backsound.mp3" autoplay
        loop></audio>
    <audio id="soundClick" src="{{ asset('assets/services/ragahtuah/') }}/sound/sound_clicked.mp3"></audio>

    {{-- <script type="module">
        import hotwiredTurbo from 'https://cdn.skypack.dev/pin/@hotwired/turbo@v7.3.0-44BiCcz1UaBhgMf1MCRj/mode=imports,min/optimized/@hotwired/turbo.js';
    </script> --}}
    <script src="{{ asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/pegawai') }}/js/sweetalert.min.js"></script>
    <script>
        function changeStatusBarColor(color) {
            if (window.AndroidInterface) {
                window.AndroidInterface.setStatusBarColor(color);
            }
        }
        changeStatusBarColor('#747af6');

        function changeRefreshStatus(status) {
            if (window.AndroidInterface) {
                window.AndroidInterface.setRefreshStatus(status);
            }
        }
        changeRefreshStatus(false);

        window.addEventListener('DOMContentLoaded', (event) => {
            // backsound
            const audioElement = document.getElementById('backgroundMusic');
            audioElement.loop = true;

            // Cek localStorage untuk status audio
            const audioStatus = localStorage.getItem('audioStatus');
            if (audioStatus === 'false') {
                audioElement.pause();
                document.querySelector('#btnSound').src =
                    "{{ asset('assets/services/ragahtuah/') }}/img/btn_sound_clicked.svg"; // Ganti icon sesuai dengan status
            } else {
                const playAudio = () => {
                    audioElement.play().catch((error) => {
                        console.error('Error attempting to play audio:', error);
                    });
                };
                document.addEventListener('click', playAudio, {
                    once: true
                });
                document.addEventListener('touchstart', playAudio, {
                    once: true
                });
            }
        });

        // fungsi click sound button click
        function btnSound(imgElement, firstSrc, secondSrc) {
            const audioElement = document.getElementById('backgroundMusic');
            if (imgElement.src.includes(firstSrc)) {
                audioElement.pause();
                imgElement.src = secondSrc;
                localStorage.setItem('audioStatus', 'false'); // Simpan status audio
            } else {
                audioElement.play();
                imgElement.src = firstSrc;
                localStorage.setItem('audioStatus', 'true'); // Simpan status audio
            }
        }

        // fungsi click button click akan ganti assets
        function btnClick() {
            // Cek status audio dari localStorage
            const audioStatus = localStorage.getItem('audioStatus');
            const soundClick = document.getElementById('soundClick');
            soundClick.play().catch((error) => {
                console.error('Error playing sound:', error);
            });
        }

        // Fungsi untuk mengganti asset saat tombol ditekan
        function btnPressed(imgElement, firstSrc, secondSrc) {
            if (imgElement.src.includes(firstSrc)) {
                imgElement.src = secondSrc;
            }
        }

        // Fungsi untuk mengembalikan asset saat tombol dilepas
        function btnReleased(imgElement, firstSrc, secondSrc) {
            imgElement.src = firstSrc;

            // Cek status audio dari localStorage
            const audioStatus = localStorage.getItem('audioStatus');
            const soundClick = document.getElementById('soundClick');
            soundClick.play().catch((error) => {
                console.error('Error playing sound:', error);
            });
        }
    </script>
    @stack('js')
</body>

</html>
