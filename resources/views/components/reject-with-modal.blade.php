@props([
    'id',
    'title' => 'Modal Title',
    'action' => '#',
    'method' => 'POST',
    'buttonText' => 'Kirim',
    'buttonClass' => 'btn-success',
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ $action }}">
            @csrf
            @method($method)
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
