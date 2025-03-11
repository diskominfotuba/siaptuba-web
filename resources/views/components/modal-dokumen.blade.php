<div class="modal fade" id="modalDokumen" tabindex="-1" aria-labelledby="TppModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="TppModalLabel">Dokumen</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dokumenForm">
                    <div class="form-group mt-2">
                        <input type="text" class="form-control" name="search_file" id="searchFile"
                            placeholder="Cari nama file...">
                    </div>
                </form>
                <div id="dataDokumen"></div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            loadData();
        });

        function loadData() {
            $.ajax({
                url: "{{ route('services.kepegawaian.dokumen') }}",
                type: "GET",
                success: function(response) {
                    $('#dataDokumen').html(response);
                }
            });
        }

        function pilihFile(id) {
            var inputFieldId = $('#modalDokumen').data('inputFieldId');
            var fileName = $(`tr[data-id="${id}"] .namaFile`).text();
            var urlFile = $(`tr[data-id="${id}"] .namaFile a`).attr("href");

            $(`#${inputFieldId}`).val(id);
            $(`#${inputFieldId}_name`).text(fileName);
            $(`#${inputFieldId}_name`).attr("href", urlFile);

            $(`#${inputFieldId}`).closest('.file-input-container').addClass('d-flex').removeClass('d-none');
            $(`#${inputFieldId}`).closest('.file-input-container').siblings('.add-file-button').addClass('d-none')
                .removeClass('d-flex');
        }

        $('#searchFile').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#dataDokumen tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
@endpush
