@extends('layout.admin.app')
@section('title', 'Informasi Status Upload')
@section('content')
    <style>
        .pdf-container {
            width: 100%;
            height: 90vh;
            position: relative;
            overflow: hidden;
        }

        .pdf-viewer {
            width: 100%;
            height: 100%;
            border: none;
            pointer-events: none;
            /* Disable right-click and selection */
        }

        .protection-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            z-index: 1000;
            pointer-events: auto;
        }

        /* Disable text selection */
        .pdf-container * {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>


    <div class="w-100">
        <div class="card p-5 border rounded-3 shadow-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>{{ $data }}</h4>
                        <small class="text-muted">Oleh: {{ $data->user }}</small>
                    </div>

                    <div class="pdf-container">
                        <div class="protection-overlay"></div>
                        <iframe src="" class="pdf-viewer" id="pdfViewer">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Disable right-click context menu
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
                return false;
            });

            // Disable common keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Disable F12, Ctrl+Shift+I, Ctrl+U, Ctrl+S, Ctrl+P, Ctrl+A, Ctrl+C
                if (e.keyCode === 123 ||
                    (e.ctrlKey && e.shiftKey && e.keyCode === 73) ||
                    (e.ctrlKey && e.keyCode === 85) ||
                    (e.ctrlKey && e.keyCode === 83) ||
                    (e.ctrlKey && e.keyCode === 80) ||
                    (e.ctrlKey && e.keyCode === 65) ||
                    (e.ctrlKey && e.keyCode === 67)) {
                    e.preventDefault();
                    return false;
                }

                // Disable Ctrl+Shift+J (Chrome DevTools)
                if (e.ctrlKey && e.shiftKey && e.keyCode === 74) {
                    e.preventDefault();
                    return false;
                }
            });

            // Disable drag and drop
            document.addEventListener('dragstart', function(e) {
                e.preventDefault();
                return false;
            });

            // Add watermark overlay
            const watermark = document.createElement('div');
            watermark.style.cssText = `
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        font-size: 3rem;
        color: rgba(0,0,0,0.1);
        pointer-events: none;
        z-index: 9999;
        white-space: nowrap;
    `;
            watermark.textContent = 'HANYA UNTUK DIBACA - {{ Auth::user()->name }}';
            document.body.appendChild(watermark);

            // Blur detection (when user switches tabs)
            let blurCount = 0;
            window.addEventListener('blur', function() {
                blurCount++;
                if (blurCount > 3) {
                    alert('Terlalu banyak perpindahan tab. Sesi akan berakhir.');
                    window.location.href = '/';
                }
            });
        });
    </script>

@endsection
