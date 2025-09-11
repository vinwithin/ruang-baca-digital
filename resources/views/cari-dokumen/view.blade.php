<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Book Reader</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: #043471;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }

        body.fullscreen-mode {
            background: #000;
            padding: 0;
            overflow: hidden;
        }

        .book-container {
            perspective: 2000px;
            position: relative;
            transition: all 0.3s ease;
        }

        .book-container.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .book {
            position: relative;
            width: 800px;
            height: 80vh;
            transform-style: preserve-3d;
            transition: transform 0.6s ease;
        }

        .book-container.fullscreen .book {
            width: 95vw;
            height: 95vh;
            max-width: none;
        }

        .book-cover {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #3A77BF;
            border-radius: 15px 5px 5px 15px;
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.4),
                inset 0 0 20px rgba(255, 255, 255, 0.1);
            transform-origin: left center;
            transition: transform 0.8s ease;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #f4e4bc;
            text-align: center;
        }

        .book-cover.opened {
            transform: rotateY(-180deg);
        }

        .book-cover h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            font-weight: bold;
        }

        .book-cover p {
            font-size: 1.2em;
            opacity: 0.9;
            font-style: italic;
        }

        .book-pages {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #f9f7f4;
            border-radius: 5px;
            box-shadow:
                0 15px 30px rgba(0, 0, 0, 0.3),
                inset 0 0 30px rgba(139, 69, 19, 0.1);
            overflow: hidden;
        }

        .book-container.fullscreen .book-pages {
            background: #1a1a1a;
            border-radius: 8px;
        }

        .page-spread {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .page {
            flex: 1;
            padding: 0px;
            background: #f9f7f4;
            position: relative;
            border-right: 1px solid #e8e0d6;
            overflow: hidden;
            display: grid;
            place-items: center;
        }

        .book-container.fullscreen .page {
            background: #1a1a1a;
            border-right: 1px solid #333;
        }

        .page:last-child {
            border-right: none;
        }

        .page::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                linear-gradient(90deg, transparent 0%, rgba(139, 69, 19, 0.05) 50%, transparent 100%),
                repeating-linear-gradient(0deg, transparent, transparent 20px, rgba(139, 69, 19, 0.02) 21px);
            pointer-events: none;
        }

        .book-container.fullscreen .page::before {
            background:
                linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.02) 50%, transparent 100%),
                repeating-linear-gradient(0deg, transparent, transparent 20px, rgba(255, 255, 255, 0.01) 21px);
        }

        .canvas-container {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(139, 69, 19, 0.5) transparent;
            padding: 10px;
            box-sizing: border-box;
            display: grid;
            place-items: center;
        }

        .book-container.fullscreen .canvas-container {
            scrollbar-color: rgba(255, 255, 255, 0.5) transparent;
        }

        .canvas-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .canvas-container::-webkit-scrollbar-corner {
            background: rgba(139, 69, 19, 0.1);
        }

        .book-container.fullscreen .canvas-container::-webkit-scrollbar-corner {
            background: rgba(255, 255, 255, 0.1);
        }

        .canvas-container::-webkit-scrollbar-track {
            background: rgba(139, 69, 19, 0.1);
            border-radius: 4px;
        }

        .book-container.fullscreen .canvas-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .canvas-container::-webkit-scrollbar-thumb {
            background: rgba(139, 69, 19, 0.5);
            border-radius: 4px;
        }

        .book-container.fullscreen .canvas-container::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.5);
        }

        .canvas-container::-webkit-scrollbar-thumb:hover {
            background: rgba(139, 69, 19, 0.7);
        }

        .book-container.fullscreen .canvas-container::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.7);
        }

        #pdf-canvas {
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: block;
            margin: 0;
            max-width: 100%;
            max-height: 100%;
        }

        .book-container.fullscreen #pdf-canvas {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        .book-spine {
            position: absolute;
            left: -10px;
            top: 0;
            width: 20px;
            height: 100%;
            background: linear-gradient(180deg, #654321 0%, #8b4513 50%, #654321 100%);
            border-radius: 10px 0 0 10px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: -1;
        }

        .controls {
            position: absolute;
            bottom: -80px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 15px;
            z-index: 20;
        }

        .book-container.fullscreen .controls {
            bottom: 20px;
            background: rgba(26, 26, 26, 0.9);
            padding: 15px 20px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .btn {
            background: #3A77BF;
            color: #f4e4bc;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            font-family: inherit;
        }

        .book-container.fullscreen .btn {
            background: rgba(58, 119, 191, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
            background: linear-gradient(135deg, #3A77BF 0%, #3A77BF 100%);
        }

        .book-container.fullscreen .btn:hover {
            background: rgba(58, 119, 191, 1);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .btn.fullscreen-btn {
            background: #28a745;
        }

        .btn.fullscreen-btn:hover {
            background: #218838;
        }

        .book-container.fullscreen .btn.fullscreen-btn {
            background: rgba(220, 53, 69, 0.8);
        }

        .book-container.fullscreen .btn.fullscreen-btn:hover {
            background: rgba(220, 53, 69, 1);
        }

        .page-info {
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            background: #3A77BF;
            color: #f4e4bc;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .book-container.fullscreen .page-info {
            top: 20px;
            background: rgba(58, 119, 191, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .bookmark {
            position: absolute;
            top: -5px;
            right: 50px;
            width: 30px;
            height: 80px;
            background: #3A77BF;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 50% 70%, 0 85%);
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            z-index: 15;
        }

        .loading {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 25;
        }

        .loading.active {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #3A77BF;
            padding: 15px 25px;
            border-radius: 15px;
            color: #f4e4bc;
            font-weight: 600;
        }

        .book-container.fullscreen .loading.active {
            background: rgba(58, 119, 191, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .spinner {
            width: 30px;
            height: 30px;
            border: 3px solid #f4e4bc;
            border-top: 3px solid transparent;
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

        .open-book-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 15;
            background: linear-gradient(135deg, #f4e4bc 0%, #e6d7b8 100%);
            color: #8b4513;
            border: 2px solid #8b4513;
            padding: 15px 30px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .open-book-btn:hover {
            transform: translate(-50%, -50%) translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }

        .zoom-controls {
            position: absolute;
            top: -60px;
            right: 0;
            display: flex;
            gap: 10px;
            z-index: 20;
        }

        .book-container.fullscreen .zoom-controls {
            top: 20px;
            right: 20px;
            background: rgba(26, 26, 26, 0.9);
            padding: 10px;
            border-radius: 10px;
        }

        .zoom-btn {
            background: #3A77BF;
            color: #f4e4bc;
            border: none;
            padding: 8px 12px;
            border-radius: 15px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .book-container.fullscreen .zoom-btn {
            background: rgba(58, 119, 191, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .zoom-btn:hover {
            background: #3A77BF;
        }

        .book-container.fullscreen .zoom-btn:hover {
            background: rgba(58, 119, 191, 1);
        }

        /* Search Panel Styles */
        .search-panel {
            position: absolute;
            top: -70px;
            background: #3A77BF;
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            border-radius: 15px;
            display: none;
            gap: 10px;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            z-index: 30;
        }

        .book-container.fullscreen .search-panel {
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(58, 119, 191, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-input {
            flex: 1;
            padding: 10px 15px;
            border: none;
            border-radius: 20px;
            background: #f4e4bc;
            color: #3A77BF;
            font-size: 14px;
            font-weight: 500;
            outline: none;
            font-family: inherit;
        }

        .search-input::placeholder {
            color: #3A77BF;
            opacity: 0.7;
        }

        .search-controls {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .search-btn {
            background: #f4e4bc;
            color: #8b4513;
            border: none;
            padding: 8px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .search-btn:hover {
            background: #e6d7b8;
        }

        .search-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .search-info {
            color: #f4e4bc;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
        }

        .search-highlight {
            background: rgba(255, 255, 0, 0.6) !important;
            color: #000 !important;
        }

        .search-current {
            background: rgba(255, 165, 0, 0.8) !important;
            color: #000 !important;
        }

        /* Search Toggle Button */
        .search-toggle {
            position: absolute;
            top: -60px;
            left: 0;
            background: #3A77BF;
            color: #f4e4bc;
            border: none;
            padding: 8px 12px;
            border-radius: 15px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: none;
            z-index: 20;
        }

        .book-container.fullscreen .search-toggle {
            top: 20px;
            left: 20px;
            background: rgba(58, 119, 191, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-toggle:hover {
            background: #3A77BF;
        }

        .book-container.fullscreen .search-toggle:hover {
            background: rgba(58, 119, 191, 1);
        }

        /* Fullscreen Toggle Button */
        .fullscreen-toggle {
            position: absolute;
            top: -60px;
            right: 200px;
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 15px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: none;
            z-index: 20;
        }

        .book-container.fullscreen .fullscreen-toggle {
            top: 20px;
            right: 120px;
            background: rgba(220, 53, 69, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .fullscreen-toggle:hover {
            background: #218838;
        }

        .book-container.fullscreen .fullscreen-toggle:hover {
            background: rgba(220, 53, 69, 1);
        }

        @media (max-width: 768px) {
            .book {
                width: 90vw;
                height: 60vh;
            }

            .page {
                padding: 20px 15px;
            }

            .controls {
                flex-wrap: wrap;
                bottom: -100px;
            }

            .book-container.fullscreen .controls {
                bottom: 10px;
                padding: 10px 15px;
            }

            .search-panel {
                flex-direction: column;
                gap: 15px;
                top: -140px;
            }

            .book-container.fullscreen .search-panel {
                top: 60px;
                left: 10px;
                right: 10px;
                transform: none;
            }

            .search-controls {
                width: 100%;
                justify-content: space-between;
            }

            .zoom-controls {
                top: -120px;
                right: 0;
            }

            .book-container.fullscreen .zoom-controls {
                top: 10px;
                right: 10px;
            }

            .search-toggle {
                top: -120px;
                left: 0;
            }

            .book-container.fullscreen .search-toggle {
                top: 10px;
                left: 10px;
            }

            .fullscreen-toggle {
                top: -120px;
                right: 80px;
            }

            .book-container.fullscreen .fullscreen-toggle {
                top: 10px;
                right: 60px;
            }
        }

        /* Hide scrollbars in fullscreen */
        .book-container.fullscreen::-webkit-scrollbar {
            display: none;
        }

        .book-container.fullscreen {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body>
    <div class="book-container" id="book-container">
        <div class="loading" id="loading">
            <div class="spinner"></div>
            <span>Loading your book...</span>
        </div>

        <div class="page-info" id="page-info" style="display: none;">
            Page 1 of 1
        </div>

        <button class="search-toggle" id="search-toggle" style="display: none;">
            Search
        </button>

        <button class="fullscreen-toggle" id="fullscreen-toggle" style="display: none;">
            <span id="fullscreen-icon">⛶</span> <span id="fullscreen-text">Fullscreen</span>
        </button>

        <div class="search-panel" id="search-panel">
            <input type="text" class="search-input" id="search-input" placeholder="Search in document...">
            <div class="search-controls">
                <div class="search-info" id="search-info">0 results</div>
                <button class="search-btn" id="search-prev" disabled>Prev</button>
                <button class="search-btn" id="search-next" disabled>Next</button>
                <button class="search-btn" id="search-close">Close</button>
            </div>
        </div>

        <div class="zoom-controls" style="display: none;">
            <button class="zoom-btn" id="zoom-out">−</button>
            <button class="zoom-btn" id="zoom-reset">100%</button>
            <button class="zoom-btn" id="zoom-in">+</button>
        </div>

        <div class="book" id="book">
            <div class="book-spine"></div>
            <div class="bookmark"></div>

            <div class="book-cover" id="book-cover">
                <h1>Ruang Baca </h1>
                <p>Fakultas Sains dan Teknologi</p>
                <button class="open-book-btn" id="open-book">Buka Dokumen</button>
            </div>

            <div class="book-pages" id="book-pages" style="display: none;">
                <div class="page-spread">
                    <div class="page">
                        <div class="canvas-container">
                            <canvas id="pdf-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="controls" id="controls" style="display: none;">
            <button class="btn" id="prev-page">
                ← Previous Page
            </button>
            <button class="btn fullscreen-btn" id="fullscreen-btn">
                <span id="fullscreen-btn-icon">⛶</span> <span id="fullscreen-btn-text">Fullscreen</span>
            </button>
            <button class="btn" id="close-book">
                Close Book
            </button>
            <button class="btn" id="next-page">
                Next Page →
            </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script>
        const canvas = document.getElementById("pdf-canvas");
        const ctx = canvas.getContext("2d");
        const loading = document.getElementById("loading");
        const pageInfo = document.getElementById("page-info");
        const bookCover = document.getElementById("book-cover");
        const bookPages = document.getElementById("book-pages");
        const controls = document.getElementById("controls");
        const zoomControls = document.querySelector(".zoom-controls");
        const searchToggle = document.getElementById("search-toggle");
        const searchPanel = document.getElementById("search-panel");
        const searchInput = document.getElementById("search-input");
        const searchInfo = document.getElementById("search-info");
        const bookContainer = document.getElementById("book-container");
        const fullscreenToggle = document.getElementById("fullscreen-toggle");
        const fullscreenBtn = document.getElementById("fullscreen-btn");

        const highlightCanvas = document.createElement('canvas');
        const highlightCtx = highlightCanvas.getContext('2d');

        // PDF URL - replace with your PDF
        const pdfUrl = "/dokumen/{{ $data->judul }}/stream";

        const pdfjsLib = window["pdfjs-dist/build/pdf"];
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js";

        const state = {
            pdfDoc: null,
            currentPage: 1,
            zoom: 1.0,
            totalPages: 0,
            isOpen: false,
            isFullscreen: false,
            searchResults: [],
            currentSearchIndex: -1,
            searchTerm: '',
            allTextContent: []
        };

        function showLoading() {
            loading.classList.add('active');
        }

        function hideLoading() {
            loading.classList.remove('active');
        }

        function updateUI() {
            pageInfo.textContent = `Page ${state.currentPage} of ${state.totalPages}`;
            document.getElementById("zoom-reset").textContent = `${Math.round(state.zoom * 100)}%`;

            document.getElementById("prev-page").disabled = state.currentPage <= 1;
            document.getElementById("next-page").disabled = state.currentPage >= state.totalPages;
            document.getElementById("zoom-in").disabled = state.zoom >= 3.0;
            document.getElementById("zoom-out").disabled = state.zoom <= 0.5;

            // Update fullscreen buttons
            const icon = state.isFullscreen ? "❐" : "⛶";
            const text = state.isFullscreen ? "Exit" : "Fullscreen";

            document.getElementById("fullscreen-icon").textContent = icon;
            document.getElementById("fullscreen-text").textContent = text;
            document.getElementById("fullscreen-btn-icon").textContent = icon;
            document.getElementById("fullscreen-btn-text").textContent = text;
        }

        function toggleFullscreen() {
            if (!state.isFullscreen) {
                enterFullscreen();
            } else {
                exitFullscreen();
            }
        }

        function enterFullscreen() {
            state.isFullscreen = true;
            bookContainer.classList.add('fullscreen');
            document.body.classList.add('fullscreen-mode');

            // Try browser fullscreen API
            if (bookContainer.requestFullscreen) {
                bookContainer.requestFullscreen().catch(console.log);
            } else if (bookContainer.webkitRequestFullscreen) {
                bookContainer.webkitRequestFullscreen();
            } else if (bookContainer.mozRequestFullScreen) {
                bookContainer.mozRequestFullScreen();
            } else if (bookContainer.msRequestFullscreen) {
                bookContainer.msRequestFullscreen();
            }

            setTimeout(() => {
                if (state.pdfDoc) {
                    renderPage(state.currentPage);
                }
            }, 100);

            updateUI();
        }

        function exitFullscreen() {
            state.isFullscreen = false;
            bookContainer.classList.remove('fullscreen');
            document.body.classList.remove('fullscreen-mode');

            if (document.exitFullscreen) {
                document.exitFullscreen().catch(console.log);
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }

            setTimeout(() => {
                if (state.pdfDoc) {
                    renderPage(state.currentPage);
                }
            }, 100);

            updateUI();
        }

        function openBook() {
            state.isOpen = true;
            bookCover.classList.add('opened');

            setTimeout(() => {
                bookPages.style.display = 'block';
                controls.style.display = 'flex';
                pageInfo.style.display = 'block';
                zoomControls.style.display = 'flex';
                searchToggle.style.display = 'block';
                fullscreenToggle.style.display = 'block';

                if (!state.pdfDoc) {
                    loadPDF();
                } else {
                    renderPage(state.currentPage);
                }
            }, 10);
        }

        function closeBook() {
            if (state.isFullscreen) {
                exitFullscreen();
            }

            state.isOpen = false;
            bookCover.classList.remove('opened');
            bookPages.style.display = 'none';
            controls.style.display = 'none';
            pageInfo.style.display = 'none';
            zoomControls.style.display = 'none';
            searchToggle.style.display = 'none';
            fullscreenToggle.style.display = 'none';
            searchPanel.style.display = 'none';
        }

        function renderPage(pageNumber) {
            if (!state.pdfDoc) return Promise.reject('No PDF document loaded');

            showLoading();

            return state.pdfDoc.getPage(pageNumber).then(page => {
                const devicePixelRatio = window.devicePixelRatio || 1;
                let currentZoom = state.zoom;

                // Auto-fit in fullscreen mode
                if (state.isFullscreen) {
                    const containerWidth = bookContainer.clientWidth - 40;
                    const containerHeight = bookContainer.clientHeight - 120;
                    const pageViewport = page.getViewport({
                        scale: 1.0
                    });

                    const scaleX = containerWidth / pageViewport.width;
                    const scaleY = containerHeight / pageViewport.height;
                    currentZoom = Math.min(scaleX, scaleY) * state.zoom;
                }

                const scaleFactor = currentZoom * devicePixelRatio;
                const viewport = page.getViewport({
                    scale: scaleFactor
                });

                canvas.width = viewport.width;
                canvas.height = viewport.height;
                canvas.style.width = (viewport.width / devicePixelRatio) + 'px';
                canvas.style.height = (viewport.height / devicePixelRatio) + 'px';

                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.imageSmoothingEnabled = true;
                ctx.imageSmoothingQuality = 'high';

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                return page.render(renderContext).promise.then(() => {
                    hideLoading();
                    updateUI();

                    if (state.searchResults.length > 0) {
                        setTimeout(() => {
                            highlightSearchResults();
                        }, 10);
                    }
                }).catch(err => {
                    hideLoading();
                    console.error("Error rendering page:", err);
                    throw err;
                });
            }).catch(err => {
                hideLoading();
                console.error("Error getting page:", err);
                throw err;
            });
        }

        function loadPDF() {
            showLoading();

            pdfjsLib.getDocument(pdfUrl).promise.then(pdfDoc => {
                state.pdfDoc = pdfDoc;
                state.totalPages = pdfDoc.numPages;

                loadAllTextContent().then(() => {
                    renderPage(state.currentPage);
                    console.log("PDF loaded successfully");
                });
            }).catch(error => {
                hideLoading();
                console.error("Error loading PDF:", error);
                alert("Error loading PDF. Please check the file path.");
            });
        }

        async function loadAllTextContent() {
            state.allTextContent = [];

            for (let i = 1; i <= state.totalPages; i++) {
                try {
                    const page = await state.pdfDoc.getPage(i);
                    const textContent = await page.getTextContent();
                    const textItems = textContent.items.map(item => ({
                        str: item.str,
                        transform: item.transform,
                        width: item.width,
                        height: item.height,
                        fontName: item.fontName
                    }));
                    state.allTextContent[i - 1] = textItems;
                } catch (error) {
                    console.error(`Error loading text content for page ${i}:`, error);
                    state.allTextContent[i - 1] = [];
                }
            }
        }

        function getCharWidth(textItem, char) {
            return textItem.width / textItem.str.length;
        }

        function findExactMatches(text, searchTerm) {
            const matches = [];
            const lowerText = text.toLowerCase();
            const lowerSearchTerm = searchTerm.toLowerCase();

            let startIndex = 0;
            while (startIndex < lowerText.length) {
                const foundIndex = lowerText.indexOf(lowerSearchTerm, startIndex);
                if (foundIndex === -1) break;

                matches.push({
                    start: foundIndex,
                    end: foundIndex + searchTerm.length
                });
                startIndex = foundIndex + 1;
            }

            return matches;
        }

        function performSearch(searchTerm) {
            if (!searchTerm || !state.allTextContent.length) {
                state.searchResults = [];
                state.currentSearchIndex = -1;
                updateSearchUI();
                renderPage(state.currentPage);
                return;
            }

            state.searchTerm = searchTerm.toLowerCase();
            state.searchResults = [];

            state.allTextContent.forEach((pageContent, pageIndex) => {
                pageContent.forEach((textItem, itemIndex) => {
                    const matches = findExactMatches(textItem.str, searchTerm);

                    matches.forEach(match => {
                        const charWidth = getCharWidth(textItem, 'W');

                        state.searchResults.push({
                            pageNumber: pageIndex + 1,
                            itemIndex: itemIndex,
                            text: textItem.str,
                            matchText: textItem.str.substring(match.start, match.end),
                            transform: textItem.transform,
                            width: textItem.width,
                            height: textItem.height,
                            fontName: textItem.fontName,
                            matchStart: match.start,
                            matchEnd: match.end,
                            matchWidth: charWidth * (match.end - match.start),
                            matchX: textItem.transform[4] + (charWidth * match.start)
                        });
                    });
                });
            });

            state.currentSearchIndex = state.searchResults.length > 0 ? 0 : -1;
            updateSearchUI();

            if (state.searchResults.length > 0) {
                navigateToSearchResult(0);
            }
        }

        function navigateToSearchResult(index) {
            if (index < 0 || index >= state.searchResults.length) return;

            state.currentSearchIndex = index;
            const result = state.searchResults[index];

            if (state.currentPage !== result.pageNumber) {
                state.currentPage = result.pageNumber;
                renderPage(state.currentPage).then(() => {
                    highlightSearchResults();
                });
            } else {
                clearHighlights();
                setTimeout(() => {
                    highlightSearchResults();
                }, 50);
            }

            updateSearchUI();
        }

        function highlightSearchResults() {
            if (!state.searchResults.length || !state.pdfDoc) return;

            const currentPageResults = state.searchResults.filter(
                result => result.pageNumber === state.currentPage
            );

            if (currentPageResults.length === 0) return;

            state.pdfDoc.getPage(state.currentPage).then(page => {
                const devicePixelRatio = window.devicePixelRatio || 1;
                let currentZoom = state.zoom;

                if (state.isFullscreen) {
                    const containerWidth = bookContainer.clientWidth - 40;
                    const containerHeight = bookContainer.clientHeight - 120;
                    const pageViewport = page.getViewport({
                        scale: 1.0
                    });

                    const scaleX = containerWidth / pageViewport.width;
                    const scaleY = containerHeight / pageViewport.height;
                    currentZoom = Math.min(scaleX, scaleY) * state.zoom;
                }

                const scaleFactor = currentZoom * devicePixelRatio;
                const viewport = page.getViewport({
                    scale: scaleFactor
                });

                const tempCanvas = document.createElement('canvas');
                const tempCtx = tempCanvas.getContext('2d');

                ctx.save();

                currentPageResults.forEach((result, index) => {
                    const globalIndex = state.searchResults.indexOf(result);
                    const transform = result.transform;

                    const fontSize = Math.abs(transform[3]) * scaleFactor;
                    tempCtx.font = `${fontSize}px serif`;

                    const textBeforeMatch = result.text.substring(0, result.matchStart);
                    const textBeforeWidth = tempCtx.measureText(textBeforeMatch).width;

                    const matchTextWidth = tempCtx.measureText(result.matchText).width;

                    const baseX = transform[4] * scaleFactor;
                    const baseY = viewport.height - (transform[5] * scaleFactor);

                    const highlightX = baseX + textBeforeWidth;
                    const highlightY = baseY - (fontSize * 0.8);
                    const highlightWidth = matchTextWidth;
                    const highlightHeight = fontSize;

                    ctx.globalCompositeOperation = 'multiply';
                    ctx.globalAlpha = 0.3;

                    const isCurrentResult = globalIndex === state.currentSearchIndex;
                    ctx.fillStyle = isCurrentResult ? '#FFA500' : '#FFFF00';

                    ctx.fillRect(highlightX, highlightY, highlightWidth, highlightHeight);
                });

                ctx.restore();
            });
        }

        function clearHighlights() {
            if (state.pdfDoc && state.currentPage) {
                renderPage(state.currentPage);
            }
        }

        function updateSearchUI() {
            const totalResults = state.searchResults.length;
            const currentResult = state.currentSearchIndex + 1;

            if (totalResults === 0) {
                searchInfo.textContent = state.searchTerm ? 'No results found' : '0 results';
            } else {
                searchInfo.textContent = `${currentResult} of ${totalResults} results`;
            }

            document.getElementById("search-prev").disabled = state.currentSearchIndex <= 0;
            document.getElementById("search-next").disabled = state.currentSearchIndex >= totalResults - 1;
        }

        function toggleSearchPanel() {
            const isVisible = searchPanel.style.display === 'flex';

            if (isVisible) {
                searchPanel.style.display = 'none';
                state.searchResults = [];
                state.currentSearchIndex = -1;
                renderPage(state.currentPage);
            } else {
                searchPanel.style.display = 'flex';
                searchInput.focus();
            }
        }

        // Event Listeners
        document.getElementById("open-book").addEventListener("click", openBook);
        document.getElementById("close-book").addEventListener("click", closeBook);

        // Fullscreen event listeners
        fullscreenToggle.addEventListener("click", toggleFullscreen);
        fullscreenBtn.addEventListener("click", toggleFullscreen);

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
                state.zoom = Math.min(state.zoom * 1.2, 3.0);
                renderPage(state.currentPage);
            }
        });

        document.getElementById("zoom-out").addEventListener("click", () => {
            if (state.pdfDoc) {
                state.zoom = Math.max(state.zoom * 0.8, 0.5);
                renderPage(state.currentPage);
            }
        });

        document.getElementById("zoom-reset").addEventListener("click", () => {
            if (state.pdfDoc) {
                state.zoom = 1.0;
                renderPage(state.currentPage);
            }
        });

        // Search Event Listeners
        searchToggle.addEventListener("click", toggleSearchPanel);
        document.getElementById("search-close").addEventListener("click", toggleSearchPanel);

        searchInput.addEventListener("input", (e) => {
            const searchTerm = e.target.value.trim();
            if (searchTerm.length >= 2) {
                performSearch(searchTerm);
            } else if (searchTerm.length === 0) {
                performSearch('');
            }
        });

        searchInput.addEventListener("keydown", (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (state.searchResults.length > 0) {
                    const nextIndex = (state.currentSearchIndex + 1) % state.searchResults.length;
                    navigateToSearchResult(nextIndex);
                }
            } else if (e.key === 'Escape') {
                toggleSearchPanel();
            }
        });

        document.getElementById("search-prev").addEventListener("click", () => {
            if (state.currentSearchIndex > 0) {
                navigateToSearchResult(state.currentSearchIndex - 1);
            }
        });

        document.getElementById("search-next").addEventListener("click", () => {
            if (state.currentSearchIndex < state.searchResults.length - 1) {
                navigateToSearchResult(state.currentSearchIndex + 1);
            }
        });

        // Listen for fullscreen change events
        document.addEventListener('fullscreenchange', handleFullscreenChange);
        document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
        document.addEventListener('mozfullscreenchange', handleFullscreenChange);
        document.addEventListener('MSFullscreenChange', handleFullscreenChange);

        function handleFullscreenChange() {
            const isInFullscreen = !!(document.fullscreenElement || document.webkitFullscreenElement ||
                document.mozFullScreenElement || document.msFullscreenElement);

            if (!isInFullscreen && state.isFullscreen) {
                exitFullscreen();
            }
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (!state.isOpen) return;

            if (document.activeElement === searchInput) return;

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
                    state.zoom = Math.min(state.zoom * 1.2, 3.0);
                    renderPage(state.currentPage);
                    break;
                case '-':
                    state.zoom = Math.max(state.zoom * 0.8, 0.5);
                    renderPage(state.currentPage);
                    break;
                case 'Escape':
                    if (searchPanel.style.display === 'flex') {
                        toggleSearchPanel();
                    } else if (state.isFullscreen) {
                        exitFullscreen();
                    } else {
                        closeBook();
                    }
                    break;
                case 'f':
                case 'F':
                    if (e.ctrlKey || e.metaKey) {
                        e.preventDefault();
                        toggleSearchPanel();
                    }
                    break;
                case 'F11':
                    e.preventDefault();
                    toggleFullscreen();
                    break;
            }
        });

        // Handle window resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            if (!state.isOpen || !state.pdfDoc) return;

            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                renderPage(state.currentPage);
            }, 150);
        });
    </script>
</body>

</html>
