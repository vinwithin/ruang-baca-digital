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
            background: linear-gradient(145deg, #2c1810 0%, #4a3728 50%, #6b4e37 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
        }

        .book-container {
            perspective: 2000px;
            position: relative;
        }

        .book {
            position: relative;
            width: 800px;
            height: 80vh;
            transform-style: preserve-3d;
            transition: transform 0.6s ease;
        }

        .book-cover {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #8b4513 0%, #a0522d 50%, #cd853f 100%);
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

        .page-spread {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .page {
            flex: 1;
            padding: 0px;
            /* Dikurangi dari 40px 30px */
            background: #f9f7f4;
            position: relative;
            border-right: 1px solid #e8e0d6;
            overflow: hidden;
            /* BARU - mencegah overflow dari page */
            display: grid;
            place-items: center;
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

        .canvas-container {
            width: 100%;
            height: 100%;
            position: relative;
            /* DIUBAH dari relative ke absolute */
            top: 0;
            /* BARU */
            left: 0;
            /* BARU */
            overflow: auto;

            scrollbar-width: thin;
            scrollbar-color: rgba(139, 69, 19, 0.5) transparent;
            padding: 10px;
            /* BARU - untuk spacing */
            box-sizing: border-box;
            /* BARU - menghitung padding dalam ukuran */
            display: grid;
            place-items: center;
        }


        .canvas-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .canvas-container::-webkit-scrollbar-corner {
            background: rgba(139, 69, 19, 0.1);
        }

        .canvas-container::-webkit-scrollbar-track {
            background: rgba(139, 69, 19, 0.1);
            border-radius: 4px;
        }

        .canvas-container::-webkit-scrollbar-thumb {
            background: rgba(139, 69, 19, 0.5);
            border-radius: 4px;
        }

        .canvas-container::-webkit-scrollbar-thumb:hover {
            background: rgba(139, 69, 19, 0.7);
        }

        #pdf-canvas {
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: block;
            margin: 0;
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

        .btn {
            background: linear-gradient(135deg, #8b4513 0%, #a0522d 100%);
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

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
            background: linear-gradient(135deg, #a0522d 0%, #cd853f 100%);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .page-info {
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(139, 69, 19, 0.9);
            color: #f4e4bc;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .bookmark {
            position: absolute;
            top: -5px;
            right: 50px;
            width: 30px;
            height: 80px;
            background: linear-gradient(135deg, #dc143c 0%, #b22222 100%);
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
            background: rgba(139, 69, 19, 0.9);
            padding: 15px 25px;
            border-radius: 15px;
            color: #f4e4bc;
            font-weight: 600;
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

        .zoom-btn {
            background: rgba(139, 69, 19, 0.9);
            color: #f4e4bc;
            border: none;
            padding: 8px 12px;
            border-radius: 15px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .zoom-btn:hover {
            background: rgba(160, 82, 45, 0.9);
        }

        /* Search Panel Styles */
        .search-panel {
            position: absolute;
            top: -70px;
            /* left: 0;
            right: 0; */
            background: rgba(139, 69, 19, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            border-radius: 15px;
            display: none;
            gap: 10px;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            z-index: 30;
        }

        .search-input {
            flex: 1;
            padding: 10px 15px;
            border: none;
            border-radius: 20px;
            background: #f4e4bc;
            color: #8b4513;
            font-size: 14px;
            font-weight: 500;
            outline: none;
            font-family: inherit;
        }

        .search-input::placeholder {
            color: #a0522d;
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
            background: rgba(139, 69, 19, 0.9);
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

        .search-toggle:hover {
            background: rgba(160, 82, 45, 0.9);
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

            .search-panel {
                flex-direction: column;
                gap: 15px;
                top: -140px;
            }

            .search-controls {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>

<body>
    <div class="book-container">
        <div class="loading" id="loading">
            <div class="spinner"></div>
            <span>Loading your book...</span>
        </div>

        <div class="page-info" id="page-info" style="display: none;">
            Page 1 of 1
        </div>

        <button class="search-toggle" id="search-toggle" style="display: none;">
            🔍 Search
        </button>

        <div class="search-panel" id="search-panel">
            <input type="text" class="search-input" id="search-input" placeholder="Search in document...">
            <div class="search-controls">
                <div class="search-info" id="search-info">0 results</div>
                <button class="search-btn" id="search-prev" disabled>↑ Prev</button>
                <button class="search-btn" id="search-next" disabled>Next ↓</button>
                <button class="search-btn" id="search-close">✕ Close</button>
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
                <h1>📖 Ruang Baca </h1>
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
            <button class="btn" id="close-book">
                Close Book
            </button>
            <button class="btn" id="next-page">
                Next Page →
            </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    {{-- <script>
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

        // Create a separate overlay canvas for highlights
        const highlightCanvas = document.createElement('canvas');
        const highlightCtx = highlightCanvas.getContext('2d');

        // Position overlay canvas on top of main canvas
        highlightCanvas.style.position = 'absolute';
        highlightCanvas.style.top = '0';
        highlightCanvas.style.left = '0';
        highlightCanvas.style.pointerEvents = 'none';
        highlightCanvas.style.zIndex = '10';

        // Ensure canvas has crisp rendering and proper container behavior
        canvas.style.imageRendering = 'pixelated';
        canvas.style.imageRendering = '-moz-crisp-edges';
        canvas.style.imageRendering = 'crisp-edges';
        canvas.style.display = 'block';
        canvas.style.margin = '0 auto';
        canvas.style.position = 'relative';

        // Ensure the parent container can accommodate the canvas
        if (canvas.parentElement) {
            canvas.parentElement.style.overflow = 'auto';
            canvas.parentElement.style.display = 'flex';
            canvas.parentElement.style.flexDirection = 'column';
            canvas.parentElement.style.alignItems = 'center';
            canvas.parentElement.style.justifyContent = 'center';
            canvas.parentElement.style.minHeight = '100%';
            canvas.parentElement.style.position = 'relative';

            // Insert highlight canvas after main canvas
            canvas.parentElement.insertBefore(highlightCanvas, canvas.nextSibling);
        }

        // PDF URL - replace with your PDF
        const pdfUrl = "/dokumen/{{ $data->judul }}/stream";

        const pdfjsLib = window["pdfjs-dist/build/pdf"];
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js";

        const state = {
            pdfDoc: null,
            currentPage: 1,
            zoom: 1.2, // Start with slightly larger zoom by default
            totalPages: 0,
            isOpen: false,
            searchResults: [],
            currentSearchIndex: -1,
            searchTerm: '',
            allTextContent: [] // Store text content for all pages
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

                if (!state.pdfDoc) {
                    loadPDF();
                } else {
                    renderPage(state.currentPage);
                }
            }, 10);
        }

        function closeBook() {
            state.isOpen = false;
            bookCover.classList.remove('opened');
            bookPages.style.display = 'none';
            controls.style.display = 'none';
            pageInfo.style.display = 'none';
            zoomControls.style.display = 'none';
            searchToggle.style.display = 'none';
            searchPanel.style.display = 'none';
        }

        function renderPage(pageNumber) {
            if (!state.pdfDoc) return;

            showLoading();

            state.pdfDoc.getPage(pageNumber).then(page => {
                const devicePixelRatio = window.devicePixelRatio || 1;

                const viewport = page.getViewport({
                    scale: state.zoom
                });

                // Set main canvas dimensions
                canvas.width = viewport.width * devicePixelRatio;
                canvas.height = viewport.height * devicePixelRatio;
                canvas.style.width = viewport.width + 'px';
                canvas.style.height = viewport.height + 'px';

                // Set highlight canvas to EXACTLY same dimensions
                highlightCanvas.width = viewport.width * devicePixelRatio;
                highlightCanvas.height = viewport.height * devicePixelRatio;
                highlightCanvas.style.width = viewport.width + 'px';
                highlightCanvas.style.height = viewport.height + 'px';

                // Position highlight canvas exactly over main canvas
                const canvasRect = canvas.getBoundingClientRect();
                const parentRect = canvas.parentElement.getBoundingClientRect();
                highlightCanvas.style.left = (canvasRect.left - parentRect.left) + 'px';
                highlightCanvas.style.top = (canvasRect.top - parentRect.top) + 'px';

                // Scale contexts - IMPORTANT: scale highlight context to match
                ctx.scale(devicePixelRatio, devicePixelRatio);
                highlightCtx.scale(devicePixelRatio, devicePixelRatio);

                // Clear both canvases
                ctx.clearRect(0, 0, viewport.width, viewport.height);
                highlightCtx.clearRect(0, 0, viewport.width, viewport.height);

                // Enable high quality rendering
                ctx.imageSmoothingEnabled = true;
                ctx.imageSmoothingQuality = 'high';

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                page.render(renderContext).promise.then(() => {
                    hideLoading();
                    updateUI();

                    // Highlight search results dengan delay untuk memastikan render selesai
                    setTimeout(() => {
                        if (state.searchResults.length > 0) {
                            highlightSearchResults();
                        }
                    }, 100);
                }).catch(err => {
                    hideLoading();
                    console.error("Error rendering page:", err);
                });
            }).catch(err => {
                hideLoading();
                console.error("Error getting page:", err);
            });
        }

        function loadPDF() {
            showLoading();

            // Configure PDF.js for better quality rendering
            const loadingTask = pdfjsLib.getDocument({
                url: pdfUrl,
                // Enable text content extraction for better quality
                useSystemFonts: true,
                // Disable font face loading for better performance
                disableFontFace: false,
                // Enable worker for better performance
                useWorkerFetch: true
            });

            loadingTask.promise.then(pdfDoc => {
                state.pdfDoc = pdfDoc;
                state.totalPages = pdfDoc.numPages;

                // Load text content for all pages for search functionality
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

                    // Store complete text items with all properties
                    const textItems = textContent.items.map(item => ({
                        str: item.str,
                        transform: [...item.transform], // Copy array
                        width: item.width,
                        height: item.height,
                        fontName: item.fontName,
                        dir: item.dir,
                        hasEOL: item.hasEOL
                    }));

                    state.allTextContent[i - 1] = textItems;
                } catch (error) {
                    console.error(`Error loading text content for page ${i}:`, error);
                    state.allTextContent[i - 1] = [];
                }
            }
        }


        // Fungsi untuk menghitung lebar karakter berdasarkan font
        function getCharWidth(textItem, char) {
            // Estimasi sederhana berdasarkan lebar total dibagi panjang string
            return textItem.width / textItem.str.length;
        }

        // Fungsi untuk mencari posisi exact match dalam string
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
                clearHighlights();
                return;
            }

            state.searchTerm = searchTerm;
            state.searchResults = [];

            // Search through all pages with improved text matching
            state.allTextContent.forEach((pageContent, pageIndex) => {
                pageContent.forEach((textItem, itemIndex) => {
                    // Normalize text for better matching (preserve original for highlighting)
                    const normalizedText = textItem.str.toLowerCase();
                    const normalizedSearchTerm = searchTerm.toLowerCase();

                    let startIndex = 0;
                    while (startIndex < normalizedText.length) {
                        const foundIndex = normalizedText.indexOf(normalizedSearchTerm, startIndex);
                        if (foundIndex === -1) break;

                        state.searchResults.push({
                            pageNumber: pageIndex + 1,
                            itemIndex: itemIndex,
                            text: textItem.str,
                            matchText: textItem.str.substring(foundIndex, foundIndex + searchTerm
                                .length),
                            transform: textItem.transform,
                            width: textItem.width,
                            height: textItem.height,
                            fontName: textItem.fontName,
                            matchStart: foundIndex,
                            matchEnd: foundIndex + searchTerm.length,
                            // Store original text item for precise positioning
                            originalTextItem: textItem
                        });

                        startIndex = foundIndex + 1;
                    }
                });
            });

            state.currentSearchIndex = state.searchResults.length > 0 ? 0 : -1;
            updateSearchUI();

            // Navigate to first result
            if (state.searchResults.length > 0) {
                navigateToSearchResult(0);
            }
        }



        function navigateToSearchResult(index) {
            if (index < 0 || index >= state.searchResults.length) return;

            state.currentSearchIndex = index;
            const result = state.searchResults[index];

            // Clear highlights first - PENTING!
            clearHighlights();

            if (state.currentPage !== result.pageNumber) {
                // Jika beda halaman, render ulang
                state.currentPage = result.pageNumber;
                renderPage(state.currentPage);
            } else {
                // Jika sama halaman, langsung update highlight
                // Tambahkan small delay untuk memastikan clearHighlights selesai
                setTimeout(() => {
                    highlightSearchResults();
                }, 50);
            }

            updateSearchUI();
        }

        function highlightSearchResults() {
            if (!state.searchResults.length || !state.pdfDoc) return;

            // Clear dengan method yang lebih thorough
            clearHighlights();

            // Get current page results
            const currentPageResults = state.searchResults.filter(
                result => result.pageNumber === state.currentPage
            );

            if (currentPageResults.length === 0) return;

            state.pdfDoc.getPage(state.currentPage).then(page => {
                page.getTextContent().then(textContent => {
                    const viewport = page.getViewport({
                        scale: state.zoom
                    });

                    // Sort results by position untuk consistent highlighting
                    currentPageResults.sort((a, b) => {
                        const aItem = textContent.items[a.itemIndex];
                        const bItem = textContent.items[b.itemIndex];
                        if (!aItem || !bItem) return 0;

                        // Sort by Y position first, then X position
                        const yDiff = bItem.transform[5] - aItem.transform[
                            5]; // Y coordinate (inverted)
                        if (Math.abs(yDiff) > 1) return yDiff;
                        return aItem.transform[4] - bItem.transform[4]; // X coordinate
                    });

                    currentPageResults.forEach((result, index) => {
                        const globalIndex = state.searchResults.indexOf(result);
                        const textItem = textContent.items[result.itemIndex];

                        if (!textItem) return;

                        // Dapatkan transformation matrix
                        const transform = textItem.transform;
                        const [a, b, c, d, e, f] = transform;

                        // Hitung font size yang sebenarnya
                        const fontHeight = Math.abs(d);
                        const fontSize = fontHeight * state.zoom;

                        // Setup context untuk measurement
                        highlightCtx.save();
                        highlightCtx.font = `${fontSize}px ${getFontFamily(textItem.fontName)}`;
                        highlightCtx.textBaseline = 'alphabetic';

                        // Hitung posisi base dari transformation matrix
                        const baseX = e * state.zoom;
                        const baseY = viewport.height - (f * state.zoom);

                        // Ukur text sebelum match
                        const beforeText = result.text.substring(0, result.matchStart);
                        const beforeWidth = highlightCtx.measureText(beforeText).width;

                        // Ukur match text
                        const matchWidth = highlightCtx.measureText(result.matchText).width;

                        // Hitung posisi highlight yang tepat
                        const highlightX = baseX + beforeWidth;
                        const highlightY = baseY - fontSize * 0.8;
                        const highlightWidth = matchWidth;
                        const highlightHeight = fontSize * 1.0;

                        // Tentukan apakah ini current result
                        const isCurrentResult = globalIndex === state.currentSearchIndex;

                        if (isCurrentResult) {
                            // Current result - highlight yang lebih mencolok
                            highlightCtx.fillStyle = 'rgba(255, 140, 0, 0.8)';
                            highlightCtx.fillRect(highlightX - 2, highlightY - 2, highlightWidth +
                                4, highlightHeight + 4);

                            // Border tebal untuk current result
                            highlightCtx.strokeStyle = 'rgba(255, 100, 0, 1)';
                            highlightCtx.lineWidth = 2;
                            highlightCtx.strokeRect(highlightX - 2, highlightY - 2, highlightWidth +
                                4, highlightHeight + 4);
                        } else {
                            // Other results - highlight yang lebih subtle
                            highlightCtx.fillStyle = 'rgba(255, 255, 0, 0.4)';
                            highlightCtx.fillRect(highlightX, highlightY, highlightWidth,
                                highlightHeight);
                        }

                        highlightCtx.restore();

                        // Debug untuk current result
                        if (isCurrentResult) {
                            console.log(`Current result "${result.matchText}" highlighted at:`, {
                                globalIndex: globalIndex,
                                currentSearchIndex: state.currentSearchIndex,
                                position: {
                                    x: highlightX,
                                    y: highlightY
                                },
                                size: {
                                    width: highlightWidth,
                                    height: highlightHeight
                                },
                                pageNumber: result.pageNumber,
                                currentPage: state.currentPage
                            });
                        }
                    });
                }).catch(error => {
                    console.error('Error getting text content for highlighting:', error);
                });
            }).catch(error => {
                console.error('Error getting page for highlighting:', error);
            });
        }



        function getFontFamily(pdfFontName) {
            if (!pdfFontName) return 'serif';

            const fontName = pdfFontName.toLowerCase();

            // Map common PDF fonts to web-safe fonts
            if (fontName.includes('arial') || fontName.includes('helvetica')) {
                return 'Arial, sans-serif';
            } else if (fontName.includes('times') || fontName.includes('roman')) {
                return 'Times, serif';
            } else if (fontName.includes('courier')) {
                return 'Courier, monospace';
            } else if (fontName.includes('sans')) {
                return 'sans-serif';
            } else if (fontName.includes('mono')) {
                return 'monospace';
            }

            return 'serif'; // Default fallback
        }


        function clearHighlights() {
            // Save current transform
            highlightCtx.save();

            // Reset transform to identity matrix
            highlightCtx.setTransform(1, 0, 0, 1, 0, 0);

            // Clear entire canvas
            highlightCtx.clearRect(0, 0, highlightCanvas.width, highlightCanvas.height);

            // Restore transform
            highlightCtx.restore();
        }

        function setupSearchNavigation() {
            document.getElementById("search-prev").addEventListener("click", () => {
                if (state.currentSearchIndex > 0) {
                    console.log(`Navigating from ${state.currentSearchIndex} to ${state.currentSearchIndex - 1}`);
                    navigateToSearchResult(state.currentSearchIndex - 1);
                }
            });

            document.getElementById("search-next").addEventListener("click", () => {
                if (state.currentSearchIndex < state.searchResults.length - 1) {
                    console.log(`Navigating from ${state.currentSearchIndex} to ${state.currentSearchIndex + 1}`);
                    navigateToSearchResult(state.currentSearchIndex + 1);
                }
            });
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
                // Clear search results and highlights when closing
                state.searchResults = [];
                state.currentSearchIndex = -1;
                clearHighlights(); // Clear highlights using separate canvas
            } else {
                searchPanel.style.display = 'flex';
                searchInput.focus();
            }
        }

        // Event Listeners
        document.getElementById("open-book").addEventListener("click", openBook);
        document.getElementById("close-book").addEventListener("click", closeBook);

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

        document.getElementById("search-close").addEventListener("click", () => {
            toggleSearchPanel();
        });

        searchInput.addEventListener("input", (e) => {
            const searchTerm = e.target.value.trim();
            if (searchTerm.length >= 2) { // Reduced from 3 to 2 for better responsiveness
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

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (!state.isOpen) return;

            // Don't handle shortcuts when search input is focused
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
            }
        });

        // Handle window resize to re-fit PDF pages
        let resizeTimeout;
        window.addEventListener('resize', () => {
            if (!state.isOpen || !state.pdfDoc) return;

            // Debounce resize events
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                // Re-render current page
                renderPage(state.currentPage);
            }, 150);
        });
    </script> --}}
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
            searchResults: [],
            currentSearchIndex: -1,
            searchTerm: '',
            allTextContent: [] // Store text content for all pages
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

                if (!state.pdfDoc) {
                    loadPDF();
                } else {
                    renderPage(state.currentPage);
                }
            }, 10);
        }

        function closeBook() {
            state.isOpen = false;
            bookCover.classList.remove('opened');
            bookPages.style.display = 'none';
            controls.style.display = 'none';
            pageInfo.style.display = 'none';
            zoomControls.style.display = 'none';
            searchToggle.style.display = 'none';
            searchPanel.style.display = 'none';
        }

        function renderPage(pageNumber) {
            if (!state.pdfDoc) return Promise.reject('No PDF document loaded');

            showLoading();

            return state.pdfDoc.getPage(pageNumber).then(page => {
                const devicePixelRatio = window.devicePixelRatio || 1;

                // Scale for crisp rendering on high DPI displays
                const scaleFactor = state.zoom * devicePixelRatio;

                const viewport = page.getViewport({
                    scale: scaleFactor
                });

                // Set actual canvas size in memory (scaled up for high DPI)
                canvas.width = viewport.width;
                canvas.height = viewport.height;

                // Set display size (CSS pixels)
                canvas.style.width = (viewport.width / devicePixelRatio) + 'px';
                canvas.style.height = (viewport.height / devicePixelRatio) + 'px';

                // Clear canvas completely
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                // Enable image smoothing for better quality
                ctx.imageSmoothingEnabled = true;
                ctx.imageSmoothingQuality = 'high';

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                return page.render(renderContext).promise.then(() => {
                    hideLoading();
                    updateUI();

                    // Only highlight search results after page rendering is complete
                    if (state.searchResults.length > 0) {
                        // Add a small delay to ensure rendering is completely finished
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

                // Load text content for all pages for search functionality
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

        // Fungsi untuk menghitung lebar karakter berdasarkan font
        function getCharWidth(textItem, char) {
            // Estimasi sederhana berdasarkan lebar total dibagi panjang string
            return textItem.width / textItem.str.length;
        }

        // Fungsi untuk mencari posisi exact match dalam string
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
                renderPage(state.currentPage); // Re-render to clear highlights
                return;
            }

            state.searchTerm = searchTerm.toLowerCase();
            state.searchResults = [];

            // Search through all pages
            state.allTextContent.forEach((pageContent, pageIndex) => {
                pageContent.forEach((textItem, itemIndex) => {
                    const matches = findExactMatches(textItem.str, searchTerm);

                    matches.forEach(match => {
                        const charWidth = getCharWidth(textItem, 'W'); // Estimasi lebar karakter

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

            // Navigate to first result
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
                // Render page first, then highlight after rendering is complete
                renderPage(state.currentPage).then(() => {
                    highlightSearchResults();
                });
            } else {
                // Clear existing highlights before adding new ones
                clearHighlights();
                // Add slight delay to ensure page is fully rendered before highlighting
                setTimeout(() => {
                    highlightSearchResults();
                }, 50);
            }

            updateSearchUI();
        }

        function highlightSearchResults() {
            if (!state.searchResults.length || !state.pdfDoc) return;

            // Get current page results
            const currentPageResults = state.searchResults.filter(
                result => result.pageNumber === state.currentPage
            );

            if (currentPageResults.length === 0) return;

            state.pdfDoc.getPage(state.currentPage).then(page => {
                // Use same scaling factor as renderPage for consistency
                const devicePixelRatio = window.devicePixelRatio || 1;
                const scaleFactor = state.zoom * devicePixelRatio;

                const viewport = page.getViewport({
                    scale: scaleFactor
                });

                // Create a temporary canvas for text measurement (more accurate)
                const tempCanvas = document.createElement('canvas');
                const tempCtx = tempCanvas.getContext('2d');

                // Save current canvas state
                ctx.save();

                currentPageResults.forEach((result, index) => {
                    const globalIndex = state.searchResults.indexOf(result);
                    const transform = result.transform;

                    // Set font for accurate measurement (scaled for device pixel ratio)
                    const fontSize = Math.abs(transform[3]) * scaleFactor;
                    tempCtx.font = `${fontSize}px serif`;

                    // Measure text before the match
                    const textBeforeMatch = result.text.substring(0, result.matchStart);
                    const textBeforeWidth = tempCtx.measureText(textBeforeMatch).width;

                    // Measure the actual match text
                    const matchTextWidth = tempCtx.measureText(result.matchText).width;

                    // Calculate precise position (already scaled by viewport)
                    const baseX = transform[4] * scaleFactor;
                    const baseY = viewport.height - (transform[5] * scaleFactor);

                    const highlightX = baseX + textBeforeWidth;
                    const highlightY = baseY - (fontSize * 0.8);
                    const highlightWidth = matchTextWidth;
                    const highlightHeight = fontSize;

                    // Set blend mode to overlay for proper highlighting
                    ctx.globalCompositeOperation = 'multiply';
                    ctx.globalAlpha = 0.3; // Set transparency

                    // Highlight color
                    const isCurrentResult = globalIndex === state.currentSearchIndex;
                    ctx.fillStyle = isCurrentResult ? '#FFA500' :
                        '#FFFF00'; // Orange for current, yellow for others

                    // Draw highlight rectangle
                    ctx.fillRect(highlightX, highlightY, highlightWidth, highlightHeight);
                });

                // Restore canvas state
                ctx.restore();
            });
        }

        function clearHighlights() {
            // Re-render the current page to remove all highlights
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
                // Clear search results when closing
                state.searchResults = [];
                state.currentSearchIndex = -1;
                renderPage(state.currentPage); // Re-render to remove highlights
            } else {
                searchPanel.style.display = 'flex';
                searchInput.focus();
            }
        }

        // Event Listeners
        document.getElementById("open-book").addEventListener("click", openBook);
        document.getElementById("close-book").addEventListener("click", closeBook);

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

        document.getElementById("search-close").addEventListener("click", () => {
            toggleSearchPanel();
        });

        searchInput.addEventListener("input", (e) => {
            const searchTerm = e.target.value.trim();
            if (searchTerm.length >= 2) { // Reduced from 3 to 2 for better responsiveness
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

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (!state.isOpen) return;

            // Don't handle shortcuts when search input is focused
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
            }
        });
    </script>
</body>

</html>
