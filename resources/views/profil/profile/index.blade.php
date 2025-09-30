@extends('layout.admin.app')
@section('title', 'Pengaturan')
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
                <h4 class="fw-bold pb-4">Edit Profil</h4>

                <!-- Step Indicator -->
                <form method="POST" action="/profil/update" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="text" class="form-label">NIM</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('identifier') is-invalid @enderror"
                                id="identifier" name="identifier" value={{$data->identifier}}
                                disabled >
                        </div>
                    </div>
                    @error('identifier')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label for="name" class="form-label text-dark">Nama</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $data->name }}" disabled>

                        </div>
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ $data->email }}" placeholder="Masukkan Email" required>
                        </div>
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label for="foto_profil" class="form-label">Foto Pengguna</label>

                        <input type="file" class="form-control @error('foto_profil') is-invalid @enderror"
                            name="foto_profil" accept="image/*" style="color: #000;" id="imageInput">
                        <div class="mt-2 border p-4 d-none" id="imagePreview">
                            <p id="imageName">Foto Profil</p>
                            <div class="btn-file" onclick="inputImage()">Edit File</div>
                        </div>

                    </div>
                    @error('foto_profil')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <div class="d-flex justify-content-end align-items-center gap-2 pt-3">
                        <a href="/profil" class="btn btn-outline-info me-2">Batal <i
                                class="fa-solid fa-xmark ms-2"></i></a>
                        <button type="submit" class="btn btn-primary">Simpan <i
                                class="fa-solid fa-circle-arrow-right ms-2"></i></button>

                    </div>

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
