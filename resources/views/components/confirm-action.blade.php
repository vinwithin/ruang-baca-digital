<style>
    .modal {
        z-index: 2000 !important;
        /* pastikan lebih tinggi dari sidebar */
    }

    .modal-backdrop {
        z-index: 1999 !important;
    }
</style>
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-body text-center p-4">
                <h5 class="mb-4">{{ $title }}</h5>

                <div class="d-flex justify-content-center gap-3">
                    <!-- Tombol Batal -->
                    <button type="button" class="btn btn-outline-primary rounded-pill px-4" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <!-- Tombol Keluar -->
                    <a href="{{ $actionUrl }}" class="btn btn-danger rounded-pill px-4">
                        {{ $confirmText }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
