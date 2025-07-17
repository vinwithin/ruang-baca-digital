@extends('layout.admin.app')
@section('title', 'Informasi Status Upload')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pdfjs-dist@5.3.93/web/pdf_viewer.min.css">
    <style>
        .secure-pdf-container {
            position: relative;
            width: 100%;
            height: 90vh;
            overflow: hidden;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .pdf-frame {
            width: 100%;
            height: 100%;
            border: none;
            position: relative;
            z-index: 1;
            /* HAPUS pointer-events: none untuk enable scroll */
        }

        .protection-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            z-index: 10;
            /* PENTING: pointer-events: none agar tidak menghalangi scroll */
            pointer-events: none;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 2rem;
            color: rgba(0, 0, 0, 0.1);
            pointer-events: none;
            z-index: 5;
            white-space: nowrap;
            user-select: none;
        }

        .context-menu-blocker {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 15;
            pointer-events: none;
        }

        /* Disable text selection hanya pada container, bukan iframe */
        .secure-pdf-container {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Warning message styling */
        .warning-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            border-radius: 5px;
            font-size: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        .session-info {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 12px;
            z-index: 1000;
        }
    </style>
    <div class="w-100">
        <div class="card p-5 border rounded-3 shadow-sm">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ $data->judul }}</h5>
                            <div>
                                <small class="text-muted">Oleh: {{ $data->nama }}</small>
                                <span class="badge badge-info ml-2">Read Only</span>
                                <span class="badge badge-warning ml-1">Protected</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="secure-pdf-container" id="pdfContainer">
                                <!-- Watermark -->
                                <div class="watermark">
                                    HANYA UNTUK DIBACA - {{ auth()->user()->name }}
                                </div>

                                <!-- Context menu blocker -->
                                <div class="context-menu-blocker"></div>

                                <!-- Protection overlay (tidak menghalangi scroll) -->
                                <div class="protection-overlay"></div>

                                <!-- PDF iframe -->
                                <iframe src="/dokumen/{{ $data->judul }}/stream" class="pdf-frame" id="pdfFrame"
                                    onload="initProtection()" title="Skripsi Viewer">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Session info -->
    <div class="session-info" id="sessionInfo">
        Sesi: <span id="sessionTimer">30:00</span>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@5.3.93/wasm/openjpeg_nowasm_fallback.min.js"></script>
    <script>
        let sessionWarned = false;
        let inactivityTimer;
        let blurCount = 0;
        let sessionTimeLeft = 1800; // 30 minutes in seconds
        let rightClickCount = 0;

        function initProtection() {
            console.log('PDF Protection initialized');

            // Start session timer
            startSessionTimer();

            // Disable context menu dengan counter
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
                rightClickCount++;
                showWarning('Klik kanan tidak diizinkan (' + rightClickCount + '/5)');

                if (rightClickCount >= 5) {
                    alert('Terlalu banyak percobaan klik kanan. Sesi akan berakhir.');
                    window.location.href = '/dashboard';
                }
                return false;
            });

            // Disable keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                const blockedKeys = [
                    123, // F12
                    44, // Print Screen
                    (e.ctrlKey && e.shiftKey && e.keyCode === 73), // Ctrl+Shift+I
                    (e.ctrlKey && e.keyCode === 85), // Ctrl+U
                    (e.ctrlKey && e.keyCode === 83), // Ctrl+S
                    (e.ctrlKey && e.keyCode === 80), // Ctrl+P
                    (e.ctrlKey && e.keyCode === 65), // Ctrl+A
                    (e.ctrlKey && e.keyCode === 67), // Ctrl+C
                    (e.ctrlKey && e.shiftKey && e.keyCode === 74), // Ctrl+Shift+J
                    (e.ctrlKey && e.shiftKey && e.keyCode === 67), // Ctrl+Shift+C
                ];

                if (blockedKeys.some(key => key === true) || blockedKeys.includes(e.keyCode)) {
                    e.preventDefault();
                    showWarning('Shortcut keyboard tidak diizinkan');
                    return false;
                }
            });

            // Track tab switching
            window.addEventListener('blur', function() {
                blurCount++;
                if (blurCount > 5) {
                    alert('Terlalu banyak perpindahan tab. Sesi akan berakhir.');
                    window.location.href = '/dashboard';
                } else if (blurCount === 3) {
                    showWarning('Peringatan: Hindari perpindahan tab berlebihan');
                }
            });

            // Inactivity timeout
            resetInactivityTimer();
            document.addEventListener('mousemove', resetInactivityTimer);
            document.addEventListener('keypress', resetInactivityTimer);
            document.addEventListener('click', resetInactivityTimer);
            document.addEventListener('scroll', resetInactivityTimer);

            // Monitor for screenshot attempts
            document.addEventListener('keyup', function(e) {
                if (e.keyCode === 44) { // Print Screen
                    showWarning('Screenshot tidak diizinkan');
                }
            });

            // Disable drag and drop
            document.addEventListener('dragstart', function(e) {
                e.preventDefault();
                return false;
            });

            // Disable text selection pada area tertentu
            document.addEventListener('selectstart', function(e) {
                if (e.target.closest('.secure-pdf-container')) {
                    e.preventDefault();
                    return false;
                }
            });
        }

        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(function() {
                if (!sessionWarned) {
                    sessionWarned = true;
                    showWarning('Sesi akan berakhir dalam 2 menit karena tidak ada aktivitas');
                    setTimeout(function() {
                        alert('Sesi berakhir karena tidak ada aktivitas');
                        window.location.href = '/dashboard';
                    }, 120000); // 2 minutes
                }
            }, 1800000); // 30 minutes
        }

        function showWarning(message) {
            // Remove existing warning
            const existingWarning = document.querySelector('.warning-toast');
            if (existingWarning) {
                existingWarning.remove();
            }

            // Create new warning toast
            const toast = document.createElement('div');
            toast.className = 'warning-toast';
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        function startSessionTimer() {
            const sessionTimer = document.getElementById('sessionTimer');

            const updateTimer = () => {
                const minutes = Math.floor(sessionTimeLeft / 60);
                const seconds = sessionTimeLeft % 60;
                sessionTimer.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

                if (sessionTimeLeft <= 0) {
                    alert('Sesi berakhir');
                    window.location.href = '/dashboard';
                    return;
                }

                if (sessionTimeLeft <= 300 && sessionTimeLeft % 60 === 0) { // Every minute in last 5 minutes
                    showWarning(`Sesi akan berakhir dalam ${Math.floor(sessionTimeLeft / 60)} menit`);
                }

                sessionTimeLeft--;
            };

            updateTimer(); // Initial call
            setInterval(updateTimer, 1000);
        }

        // Detect developer tools
        let devtools = {
            open: false,
            orientation: null
        };

        let threshold = 160;

        setInterval(() => {
            if (window.outerHeight - window.innerHeight > threshold ||
                window.outerWidth - window.innerWidth > threshold) {
                if (!devtools.open) {
                    devtools.open = true;
                    showWarning('Developer tools terdeteksi');
                    console.clear();
                }
            } else {
                devtools.open = false;
            }
        }, 500);

        // Clear console periodically
        setInterval(() => {
            console.clear();
        }, 1000);

        // Disable common inspection
        (function() {
            try {
                let devtools = {
                    open: false,
                    orientation: null
                };

                setInterval(() => {
                    if (window.devtools.open) {
                        window.location.href = '/dashboard';
                    }
                }, 100);
            } catch (e) {}
        })();
    </script>=

@endsection
