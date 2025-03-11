@props([
    'idModal' => '',
    'title' => '',
    'body' => '',
])
<!-- * under construction -->
<div class="modal fade dialogbox" id="{{ $idModal }}" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-icon">
                <svg width="40px" height="50px" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                    viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="32"
                        d="M256 400v64M256 208v64M256 48v32M416 208H102.63a16 16 0 01-11.32-4.69L32 144l59.31-59.31A16 16 0 01102.63 80H416a16 16 0 0116 16v96a16 16 0 01-16 16zM96 400h313.37a16 16 0 0011.32-4.69L480 336l-59.31-59.31a16 16 0 00-11.32-4.69H96a16 16 0 00-16 16v96a16 16 0 0016 16z" />
                </svg>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="devAppTitle">{{ $title }}</h5>
            </div>
            <div class="modal-body" id="devAppBody">
                {{ $body }}
            </div>
            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="#" class="btn" data-dismiss="modal">TUTUP</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * under construction -->
