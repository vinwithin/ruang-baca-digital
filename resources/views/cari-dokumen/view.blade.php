<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern PDF Viewer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .pdf-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 1000px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .pdf-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 400% 400%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 2.5em;
            font-weight: 300;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header p {
            color: #7f8c8d;
            font-size: 1.1em;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            box-shadow: 0 8px 20px rgba(240, 147, 251, 0.3);
        }

        .btn-secondary:hover {
            box-shadow: 0 12px 30px rgba(240, 147, 251, 0.4);
        }

        .canvas-container {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            min-height: 600px;
            position: relative;
        }

        #pdf-canvas {
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            max-height: 80vh;
            transition: transform 0.3s ease;
        }

        .page-info {
            text-align: center;
            color: #7f8c8d;
            font-size: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 15px 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .zoom-level {
            font-weight: 600;
            color: #2c3e50;
        }

        .loading {
            display: none;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .loading.active {
            display: flex;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .icon {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        @media (max-width: 768px) {
            .pdf-container {
                padding: 20px;
                margin: 10px;
            }

            .header h1 {
                font-size: 2em;
            }

            .controls {
                gap: 10px;
            }

            .btn {
                padding: 10px 20px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <div class="pdf-container">
        <div class="header">
            <h1>📄 PDF Viewer</h1>
            <p>Modern document viewer with enhanced controls</p>
        </div>

        <div class="controls">
            <button class="btn" id="prev-page">
                <svg class="icon" viewBox="0 0 24 24">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
                </svg>
                Previous
            </button>

            <button class="btn" id="next-page">
                <svg class="icon" viewBox="0 0 24 24">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
                </svg>
                Next
            </button>

            <button class="btn btn-secondary" id="zoom-out">
                <svg class="icon" viewBox="0 0 24 24">
                    <path
                        d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                    <path d="M7 9h5v1H7z" />
                </svg>
                Zoom Out
            </button>

            <button class="btn btn-secondary" id="zoom-reset">
                <svg class="icon" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                </svg>
                Reset
            </button>

            <button class="btn btn-secondary" id="zoom-in">
                <svg class="icon" viewBox="0 0 24 24">
                    <path
                        d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                    <path d="M12 10h-2v2H9v-2H7V9h2V7h1v2h2v1z" />
                </svg>
                Zoom In
            </button>
        </div>

        <div class="canvas-container">
            <div class="loading" id="loading">
                <div class="spinner"></div>
            </div>
            <canvas id="pdf-canvas"></canvas>
        </div>

        <div class="page-info">
            <span id="page-info">Page 1 of 1</span>
            <span class="zoom-level" id="zoom-level">150%</span>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script>
        const canvas = document.getElementById("pdf-canvas");
        const ctx = canvas.getContext("2d");
        const loading = document.getElementById("loading");
        const pageInfo = document.getElementById("page-info");
        const zoomLevel = document.getElementById("zoom-level");

        // You'll need to replace this with your actual PDF URL
        const pdfUrl = "https://mozilla.github.io/pdf.js/web/compressed.tracemonkey-pldi-09.pdf";

        const pdfjsLib = window["pdfjs-dist/build/pdf"];
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js";

        const state = {
            pdfDoc: null,
            currentPage: 1,
            zoom: 1.0,
            totalPages: 0
        };

        // Show loading
        function showLoading() {
            loading.classList.add('active');
        }

        // Hide loading
        function hideLoading() {
            loading.classList.remove('active');
        }

        // Update UI elements
        function updateUI() {
            pageInfo.textContent = `Page ${state.currentPage} of ${state.totalPages}`;
            zoomLevel.textContent = `${Math.round(state.zoom * 100)}%`;

            // Update button states
            document.getElementById("prev-page").disabled = state.currentPage <= 1;
            document.getElementById("next-page").disabled = state.currentPage >= state.totalPages;
            document.getElementById("zoom-in").disabled = state.zoom >= 5.0;
            document.getElementById("zoom-out").disabled = state.zoom <= 0.3;
            document.getElementById("zoom-reset").disabled = state.zoom === 1.0;
        }

        // Render a specific page
        function renderPage(pageNumber) {
            if (!state.pdfDoc) return;

            showLoading();

            state.pdfDoc.getPage(pageNumber).then(page => {
                const viewport = page.getViewport({
                    scale: state.zoom
                });
                canvas.width = viewport.width;
                canvas.height = viewport.height;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                page.render(renderContext).promise.then(() => {
                    hideLoading();
                    updateUI();
                    console.log(`Page ${pageNumber} rendered`);
                }).catch(err => {
                    hideLoading();
                    console.error("Error rendering page:", err);
                });
            }).catch(err => {
                hideLoading();
                console.error("Error getting page:", err);
            });
        }

        // Event listeners
        document.getElementById("prev-page").addEventListener("click", () => {
            if (state.currentPage > 1) {
                state.currentPage--;
                renderPage(state.currentPage);
            }
        });

        document.getElementById("next-page").addEventListener("click", () => {
            if (state.currentPage < state.totalPages) {
                state.currentPage++;
                renderPage(state.currentPage);
            }
        });

        document.getElementById("zoom-in").addEventListener("click", () => {
            if (state.pdfDoc) {
                state.zoom = Math.min(state.zoom * 1.2, 5.0); // Max zoom 500%
                renderPage(state.currentPage);
            }
        });

        document.getElementById("zoom-out").addEventListener("click", () => {
            if (state.pdfDoc) {
                state.zoom = Math.max(state.zoom * 0.8, 0.3); // Min zoom 30%
                renderPage(state.currentPage);
            }
        });

        document.getElementById("zoom-reset").addEventListener("click", () => {
            if (state.pdfDoc) {
                state.zoom = 1.0; // Reset to 100%
                renderPage(state.currentPage);
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            switch (e.key) {
                case 'ArrowLeft':
                    if (state.currentPage > 1) {
                        state.currentPage--;
                        renderPage(state.currentPage);
                    }
                    break;
                case 'ArrowRight':
                    if (state.currentPage < state.totalPages) {
                        state.currentPage++;
                        renderPage(state.currentPage);
                    }
                    break;
                case '+':
                case '=':
                    state.zoom = Math.min(state.zoom * 1.2, 5.0);
                    renderPage(state.currentPage);
                    break;
                case '-':
                    state.zoom = Math.max(state.zoom * 0.8, 0.3);
                    renderPage(state.currentPage);
                    break;
            }
        });

        // Load the PDF
        showLoading();
        pdfjsLib.getDocument(pdfUrl).promise.then(pdfDoc => {
            state.pdfDoc = pdfDoc;
            state.totalPages = pdfDoc.numPages;
            renderPage(state.currentPage);
            console.log("PDF loaded successfully");
        }).catch(error => {
            hideLoading();
            console.error("Error loading PDF:", error);
            alert("Error loading PDF. Please check the file path.");
        });
    </script>
</body>

</html>
