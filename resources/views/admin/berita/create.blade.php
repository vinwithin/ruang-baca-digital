@extends('layout.admin.app')
@section('title', 'Unggah Berita')
@section('content')
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

                    </div>

                    <!-- Tanggal Mulai -->
                    <p>Unggah Foto</p>
                    <div class="mb-3">
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                            name="image" accept="image/png, image/jpeg, image/jpg" id="imageInput">
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
                    <a href="/admin/berita" class="btn btn-outline-info me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Kirim <i class="fa-solid fa-circle-arrow-right ms-2"></i></button>

                </form>
            </div>
        </div>
    </div>

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
@endsection
