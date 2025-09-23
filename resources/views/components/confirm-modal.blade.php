<div class="modal fade " id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex flex-column align-items-center justify-content-center gap-4">
                    <i class="fa-solid fa-circle-exclamation" style="color: red; font-size:100px;"></i>

                    <p>{{ $message }}</p>
                </div>

            </div>
            <div class="modal-footer d-flex flex-row justify-content-center">
                <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Batalkan</button>
                <a href="{{ $actionUrl }}" class="btn btn-primary">
                   {{ $confirmText }}
                </a>
            </div>
        </div>
    </div>
</div>
