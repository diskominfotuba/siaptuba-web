@extends('layouts.general')
@section('content')
<div id="appCapsule">
    <div class="section">
        <div class="splash-page mt-5 mb-5">
            <div class="mb-3">
                <canvas class="img-fluid rounded" id="qr-canvas"></canvas>
                <span id="outputData"></span>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        startCamera()
    });
        const video = document.createElement("video");
        const canvasElement = document.getElementById("qr-canvas");
        const canvas = canvasElement.getContext("2d");

        let scanning = false;
        qrcode.callback = (res) => {
            console.log(res);
            
            if (res) {
                scanning = false;
                window.location.href = res

                video.srcObject.getTracks().forEach(track => {
                  track.stop();
                });
              }
            };

        function startCamera() {
        navigator.mediaDevices
            .getUserMedia({ video: { facingMode: "environment" } })
            .then(function(stream) {
                scanning = true;
                $('#qr-canvas').show()
                video.setAttribute("playsinline", true); 
                video.srcObject = stream;
                video.play();
                tick();
                scan();
          });
        }

        function tick() {
        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

        scanning && requestAnimationFrame(tick);
        }

        function scan() {
            try {
                qrcode.decode();
            } catch (e) {
                setTimeout(scan, 300);
            }
        }
    </script>
@endpush