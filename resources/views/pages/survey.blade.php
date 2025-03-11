@extends('layouts.general')
@section('content')
    <div id="appCapsule">
        <div>
            <iframe id="googleForm" src="https://docs.google.com/forms/d/e/1FAIpQLSfN6E8n3sSr5EftpLzmP0QIEESPMmqaBlpz-UelbYedOvU6Yw/viewform?embedded=true" width="100%" height="11941" frameborder="0" marginheight="0" marginwidth="0">Memuat…</iframe>
        </div>
    </div>
    <script>
        document.getElementById('googleForm').addEventListener('load', function() {
            const iframe = document.getElementById('googleForm');
            
            iframe.contentWindow.addEventListener('click', function(event) {
                if (event.target.tagName === 'SPAN' && event.target.textContent === 'Submit') {
                    setTimeout(() => {
                        window.location.href = '{{ url("/dashboard") }}';
                    }, 3000); // Mengarahkan setelah 3 detik
                }
            });
        });
    </script>
@endsection
