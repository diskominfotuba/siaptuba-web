<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kegiatan->nama_kegiatan }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }
        body {
            width: 21cm;
            height: 29.7cm;
            margin: auto;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .qr-section {
            text-align: center;
            margin-top: 2rem;
        }
        /* .qr-section img {
            width: {{ $w }}px;
            height: {{ $t }}px;
        } */
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="qr-section">
            <p><strong>DAFTAR HADIR</strong></p>
            <div class="my-4">
                <img src="{{ $qr }}" alt="QR Code">
            </div>
            <p><strong>CARA SCAN:</strong></p>
            <ol class="text-start d-inline-block">
                <li>Buka aplikasi SIAP TUBA</li>
                <li>Klik menu scanner</li>
                <li>Scan QR Code, lalu</li>
                <li>Klik tombol isi kehadiran</li>
            </ol>
        </div>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let img = document.querySelector(".qr-section img");
        img.style.width = "{{ request()->width ?? 400 }}px";
        img.style.height = "{{ request()->height ?? 400 }}px";
    });
    window.print();
    setTimeout(() => {
        window.close();
    }, 100);
</script>
</html>
