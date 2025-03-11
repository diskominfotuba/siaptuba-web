<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/pegawai') }}/css/style.css">
    <title>PDF Viewer</title>
    <style>
        #pdf-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            max-width: 100%;
        }

        canvas {
            width: 100%;
            height: auto;
        }

        .controls {
            margin: 10px;
        }

        #loader-pdf {
            position: fixed;
            right: 0;
            bottom: 0;
            z-index: 99999;
            background: var(--bg-danger);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader {
            display: none;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="app-container appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('user.dashboard') }}">
                <div class="headerButton">
                    <img src="{{ route('photo-profile', ['filename' => auth()->user()->photo]) }}" alt="image"
                        class="imaged w32 mr-1">
                    <span class="" style="line-height: 1"><span style="font-size: 11px">Tabik pun,</span><br>
                        {{ auth()->user()->nama }}</span>
                </div>
            </a>
        </div>
        <div class="right">
            <a href="#" class="headerButton">
                <svg width="22px" height="22px" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                    viewBox="0 0 512 512">
                    <path
                        d="M427.68 351.43C402 320 383.87 304 383.87 217.35 383.87 138 343.35 109.73 310 96c-4.43-1.82-8.6-6-9.95-10.55C294.2 65.54 277.8 48 256 48s-38.21 17.55-44 37.47c-1.35 4.6-5.52 8.71-9.95 10.53-33.39 13.75-73.87 41.92-73.87 121.35C128.13 304 110 320 84.32 351.43 73.68 364.45 83 384 101.61 384h308.88c18.51 0 27.77-19.61 17.19-32.57zM320 384v16a64 64 0 01-128 0v-16"
                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="32" />
                </svg>
                <span class="badge badge-danger">4</span>
            </a>
        </div>
    </div>
    <div class="app-container">
        <div id="appCapsule">
            <div class="section">
                <div class="splash-page mt-5 mb-5">
                    <div id="pdf-container">
                        <div class="loader" id="loader-pdf"></div>
                        <canvas id="pdf-render"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-button-group transparent">
            <div class="row">
                <div class="col-6">
                    <a href="{{ url()->previous() }}" data-turbo="false"
                        class="btn btn-primary btn-lg btn-block">Kembali</a>
                </div>
                <div class="col-6">
                    <button class="btn btn-warning btn-lg btn-block" onclick="downloadPDF()">Unduh</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        const url = "{{ route('stream', ['filename' =>  $dir . $filename]) }}"; // Ganti dengan path PDF yang benar
        const pdfjsLib = window['pdfjsLib'];

        let pdfDoc = null,
            pageNum = 1,
            canvas = document.getElementById('pdf-render'),
            ctx = canvas.getContext('2d');
        loader = document.getElementById('loader-pdf');

        const renderPage = num => {
            pdfDoc.getPage(num).then(page => {
                let viewport = page.getViewport({
                    scale: 1.5
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                let renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                page.render(renderContext);
                loader.style.display = "none";
            });
        };

        pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
            pdfDoc = pdfDoc_;
            renderPage(pageNum);
        });

        function downloadPDF() {
            // Buat elemen <a> untuk mendownload file
            let link = document.createElement('a');
            link.href = url; // Gunakan URL PDF yang sudah ada
            link.download = 'Dokumen.pdf'; // Nama file saat diunduh
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>

</html>
