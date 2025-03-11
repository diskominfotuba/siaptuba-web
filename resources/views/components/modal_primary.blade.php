@props([
    'idModal' => '',
    'title' => 'No Title!',
    'idBody' => 'No Content!',
    'btnClose' => 'Tutup',
    'url'   => '#',
    'btnNext' => 'Buka'
])
<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ $title }}</h3>
            </div>
            <div class="modal-body" id="{{ $idBody }}">
                <div class="text-center">
                    <div class="spinner-border" role="status"></div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                @if ($url !== '')
                <a href="{{ $url }}" class="btn btn-primary mx-1 w-100">{{ $btnNext }}</a>
                @endif
                <button type="button" class="btn btn-warning mx-1 w-100" data-dismiss="modal">{{ $btnClose }}</button>
            </div>
        </div>
    </div>
</div>