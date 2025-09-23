@extends('layout.admin.app')
@section('title', 'Unggah Berita')
@section('content')
    <div class="w-100">
        <div class="card">
            <div class="card-body">
                <h4 class="fw-bold pb-4">Tambah Pengguna</h4>

                <!-- Step Indicator -->
                <form id="submitForm" method="POST" action="{{ route('kelola-pengguna.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="text" class="form-label">NIM</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('identifier') is-invalid @enderror"
                                id="identifier" name="identifier" value="{{ old('identifier') }}" placeholder="Masukkan NIM"
                                required>
                        </div>
                    </div>
                    @error('identifier')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label for="name" class="form-label text-dark">Nama Lengkap</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Masukkan Nama" required>

                        </div>
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" placeholder="Masukkan Email" required>
                        </div>
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <!-- Password Input -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukkan Kata Sandi" required>
                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Masukkan Konfirmasi Kata Sandi" required>
                            <span class="input-group-text" id="togglePasswordConfirmation" style="cursor: pointer;">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="d-flex justify-content-end align-items-center gap-2 pt-3">
                        <a href="/admin/berita" class="btn btn-outline-info me-2">Batal <i
                                class="fa-solid fa-xmark ms-2"></i></a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#confirmModal">Simpan <i
                                class="fa-solid fa-circle-arrow-right ms-2"></i></button>

                    </div>

                </form>
            </div>
        </div>
        <div class="modal fade " id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="d-flex flex-column align-items-center justify-content-center gap-4">
                            <i class="fa-solid fa-circle-exclamation" style="color: red; font-size:100px;"></i>

                            <p>Apakah anda yakin untuk menambahkan pengguna?</p>
                        </div>

                    </div>
                    <div class="modal-footer d-flex flex-row justify-content-center">
                        <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Batalkan</button>
                        <button type="button" id="confirmSubmit" class="btn btn-primary">
                            Simpan <i class="fa-solid fa-circle-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Toggle password utama
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function() {
            // ubah type input
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // ganti icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        // Toggle password konfirmasi
        const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
        const passwordConfirmation = document.querySelector('#password_confirmation');
        togglePasswordConfirmation.addEventListener('click', function() {
            const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmation.setAttribute('type', type);

            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
    <script>
        document.getElementById('confirmSubmit').addEventListener('click', function() {
            document.getElementById('submitForm').submit();
        });
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
