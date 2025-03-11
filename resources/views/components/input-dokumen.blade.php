@props([
    'name' => '',
    'inputLayananId' => '',
    'dokumenId' => '',
    'namaDokumen' => '',
    'file' => '',
    'status' => '',
])

@if ($dokumenId !== '' && $namaDokumen !== '')
    @if ($status == 'ditolak bkpp' || $status == 'ditolak operator')
        <a href="javascript:void(0)" onclick="modalDokumen('{{ $name }}')"
            class="add-file-button btn btn-primary btn-sm d-none justify-content-center align-items-center">
            <span>Tambahkan File</span>
        </a>
    @endif

    <div class="file-input-container border p-1 rounded d-flex w-100 justify-content-between align-items-center">
        <input type="text" name="{{ $name }}" value="{{ $dokumenId }}" class="form-control d-none"
            id="{{ $name }}" />
        <input name="{{ $name . '_input_layanan_id' }}" class="form-control d-none" value="{{ $inputLayananId }}"
            hidden />
        <a id="{{ $name . '_name' }}"
            href="{{ route('pdfviewer', ['dir' => 'dokumen_kepegawaian', 'filename' => $file]) }}">{{ $namaDokumen }}</a>
        @if ($status == 'ditolak bkpp' || $status == 'ditolak operator')
            <button type="button" class="btn btn-sm btn-secondary" onclick="removeFile('{{ $name }}')">
                &times;
            </button>
        @endif
    </div>
    <small class="mt-1 d-block text-danger" id="{{ 'error-' . $name }}"></small>
@else
    <a href="javascript:void(0)" onclick="modalDokumen('{{ $name }}')"
        class="add-file-button btn btn-primary btn-sm d-flex justify-content-center align-items-center">
        <span>Tambahkan File</span>
    </a>

    <div class="file-input-container border p-1 rounded w-100 d-none justify-content-between align-items-center">
        <input type="text" name="{{ $name }}" class="form-control d-none" id="{{ $name }}" />
        <input name="{{ $name . '_input_layanan_id' }}" class="form-control d-none" value="{{ $inputLayananId }}"
            hidden />
        <a href="" id="{{ $name . '_name' }}"></a>
        <button type="button" class="btn btn-sm btn-secondary" onclick="removeFile('{{ $name }}')">
            &times;
        </button>
    </div>
    <small class="mt-1 d-block text-danger" id="{{ 'error-' . $name }}"></small>
@endif
