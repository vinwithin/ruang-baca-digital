const canvas = document.getElementById("pdf-canvas");
const pdfUrl = "/dokumen/{{ urlencode($data->judul) }}/stream"; // pastikan URL aman
const pdfjsLib = window["pdfjs-dist/build/pdf"];

pdfjsLib.GlobalWorkerOptions.workerSrc =
    "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js";

// Load the PDF
pdfjsLib
    .getDocument(pdfUrl)
    .promise.then(function (pdfDoc) {
        return pdfDoc.getPage(1); // Get the first page
    })
    .then(function (page) {
        const scale = 1.5;
        const viewport = page.getViewport({ scale: scale });

        // Set canvas dimensions
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        const ctx = canvas.getContext("2d");
        const renderContext = {
            canvasContext: ctx,
            viewport: viewport,
        };

        page.render(renderContext);
    })
    .catch(function (error) {
        console.error("Error loading or rendering PDF:", error);
    });
