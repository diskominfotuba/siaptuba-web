@props([
    'idModal' => '',
    'title' => 'No Title!',
    'idBody' => 'No Content!',
    'btnClose' => 'Tutup',
    'url'   => '#',
    'btnNext' => 'Buka'
])
<div class="modal fade dialogbox" id="{{ $idModal }}" data-bs-backdrop="static" tabindex="-1"
role="dialog">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-icon">
            <svg width="50px" height="50px" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                viewBox="0 0 512 512">
                <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z"
                    fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                <path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z"
                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="32" />
                <path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" />
            </svg>
        </div>
        <div class="modal-header">
            <h5 class="modal-title">{{ $title }}</h5>
        </div>
        <div class="modal-body" id="{{ $idBody }}">
            ...
        </div>
        <div class="modal-footer">
            <div class="btn-inline">
                <a href="#" class="btn" data-dismiss="modal">{{ $btnClose }}</a>
            </div>
        </div>
    </div>
</div>
</div>