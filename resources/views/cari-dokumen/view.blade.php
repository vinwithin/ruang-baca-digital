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

                    // Highlight search results on current page if any
                    if (state.searchResults.length > 0) {
                        highlightSearchResults();
                    }
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
                        height: item.height
                    }));
                    state.allTextContent[i - 1] = textItems;
                } catch (error) {
                    console.error(`Error loading text content for page ${i}:`, error);
                    state.allTextContent[i - 1] = [];
                }
            }
        }

        function performSearch(searchTerm) {
            if (!searchTerm || !state.allTextContent.length) {
                state.searchResults = [];
                state.currentSearchIndex = -1;
                updateSearchUI();
                return;
            }

            state.searchTerm = searchTerm.toLowerCase();
            state.searchResults = [];

            // Search through all pages
            state.allTextContent.forEach((pageContent, pageIndex) => {
                pageContent.forEach((textItem, itemIndex) => {
                    const text = textItem.str.toLowerCase();
                    if (text.includes(state.searchTerm)) {
                        state.searchResults.push({
                            pageNumber: pageIndex + 1,
                            itemIndex: itemIndex,
                            text: textItem.str,
                            transform: textItem.transform,
                            width: textItem.width,
                            height: textItem.height
                        });
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

            if (state.currentPage !== result.pageNumber) {
                state.currentPage = result.pageNumber;
                renderPage(state.currentPage);
            } else {
                highlightSearchResults();
            }

            updateSearchUI();
        }

        function highlightSearchResults() {
            if (!state.searchResults.length || !state.pdfDoc) return;

            // Clear previous highlights
            ctx.save();

            // Get current page results
            const currentPageResults = state.searchResults.filter(
                result => result.pageNumber === state.currentPage
            );

            if (currentPageResults.length === 0) return;

            state.pdfDoc.getPage(state.currentPage).then(page => {
                const viewport = page.getViewport({
                    scale: state.zoom
                });

                currentPageResults.forEach((result, index) => {
                    const globalIndex = state.searchResults.indexOf(result);
                    const transform = result.transform;

                    // Calculate position and size
                    const x = transform[4] * state.zoom;
                    const y = viewport.height - (transform[5] * state.zoom) - (result.height * state.zoom);
                    const width = result.width * state.zoom;
                    const height = result.height * state.zoom;

                    // Highlight color
                    const isCurrentResult = globalIndex === state.currentSearchIndex;
                    ctx.fillStyle = isCurrentResult ? 'rgba(255, 165, 0, 0.2)' : 'rgba(255, 255, 0, 0.20)';

                    ctx.fillRect(x, y, width, height);
                });

                ctx.restore();
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
