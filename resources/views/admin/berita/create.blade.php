@extends('layout.admin.app')
@section('title', 'Kelola Informasi/Berita')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/scrapooo/quill-resize-module@1.0.2/dist/quill-resize-module.js"></script>
    <style>
        .btn-file {
            min-width: 100%;
            height: 40px;
            cursor: pointer;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(58, 119, 191, 1)
        }

        .d-none {
            display: none !important;
        }
    </style>
    <div class="w-100">
        <div class="card">
            <div class="card-body">
                <h4 class="fw-bold">Input Berita</h4>

                <!-- Step Indicator -->
                <form method="POST" action="{{ route('berita.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" required>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div id="editor">

                        </div>
                    </div>

                    <textarea class="form-control" id="hiddenContent" placeholder="Enter the Description" rows="5" name="content"
                        style="display: none"></textarea>


                    {{-- <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control @error('content') is-invalid @enderror" placeholder="Leave a comment here"
                                id="floatingTextarea2" style="height: 100px" name="content"></textarea>
                            <label for="floatingTextarea2">Deskripsi</label>
                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div> --}}

                    <!-- Tanggal Mulai -->
                    <p>Unggah Thumbnail</p>
                    <div class="mb-3">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                            accept="image/png, image/jpeg, image/jpg" id="imageInput">
                        <label class="form-label" for="image"></label>
                        <div class="mt-2 border p-4 d-none" id="imagePreview">
                            <p id="imageName">Skripsi</p>
                            <div class="btn-file" onclick="inputImage()">Edit File</div>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Tanggal Berakhir -->
                    <div class="d-flex justify-content-end align-items-center gap-2 pt-3">

                        <a href="/admin/berita" class="btn btn-outline-info me-2">Batal <i
                                class="fa-solid fa-xmark ms-2"></i></a>
                        <button type="submit" class="btn btn-primary">Simpan <i
                                class="fa-solid fa-circle-arrow-right ms-2"></i></button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- <script src="/cdn.quilljs.com/1.2.2/quill.min.js"></script> --}}
    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const imageName = document.getElementById('imageName');

        imageInput.addEventListener('change', function() {
            if (imageInput.files.length > 0) {
                imagePreview.classList.remove('d-none')
                console.log(imageInput.files[0].name);
                imageName.textContent = imageInput.files[0].name;
            }
        })

        function inputImage() {
            document.getElementById('imageInput').click();
        }
    </script>
    <script>
        // new Quill.register('modules/imageResize', window.ImageResize);
        // Inisialisasi Quill
        Quill.register('modules/imageResize', QuillResizeModule);
        const quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                imageResize: {
                    displaySize: true
                },
                toolbar: {
                    container: [
                        [{
                            header: [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                        [{
                            'align': []
                        }],
                        ['image', 'code-block']
                    ],
                    handlers: {
                        image: imageHandler
                    }
                }
            }
        });

        // Handler untuk upload gambar
        function imageHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/png, image/jpg, image/jpeg');
            input.click();

            input.onchange = () => {
                const file = input.files[0];

                // Validasi ukuran file (opsional)
                if (file.size > 2024000) { // 5MB
                    var modal = new bootstrap.Modal(document.getElementById('fileSizeModal'));
                    modal.show();
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = () => {
                    const range = quill.getSelection(true);
                    quill.insertEmbed(range.index, 'image', reader.result);
                    quill.setSelection(range.index + 1);

                    // Update textarea setiap kali ada perubahan
                    updateTextarea();
                };

                reader.readAsDataURL(file);
            };
        }

        // Fungsi untuk update textarea
        function updateTextarea() {
            const content = quill.root.innerHTML;
            document.getElementById('hiddenContent').value = content;
        }

        // Update textarea setiap kali konten berubah
        quill.on('text-change', function() {
            updateTextarea();
        });

        // Handler untuk form submission
        document.getElementById('editorForm').onsubmit = function(e) {
            // Pastikan textarea terupdate dengan konten terbaru
            updateTextarea();

            // Log konten untuk debugging (opsional)
            console.log('Submitting content:', document.getElementById('hiddenContent').value);

            // Form akan submit secara normal ke backend
            return true;
        };

        function validateFileSize(input) {
            const file = input.files[0];
            if (file) {
                const maxSize = 2024000; // 2MB in bytes
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                    input.value = ''; // Clear the input
                }
            }
        }
    </script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
            });
        @endif
    </script>
@endsection
