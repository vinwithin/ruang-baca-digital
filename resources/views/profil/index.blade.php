@extends('layout.admin.app')
@section('title', 'Pengaturan')
@section('content')
    <style>
        h3 {
            font-family: "Plus Jakarta Sans";
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: 20px;
        }

        dt {
            font-family: "Plus Jakarta Sans";
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 20px;
        }

        dd {
            font-family: "Plus Jakarta Sans";
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
        }

        dd a {
            font-size: 10px !important;
        }

        /* Modal Backdrop */
        .modal-backdrop {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
        }

        /* Modal Content */
        .change-password-modal .modal-dialog {
            max-width: 550px;
            margin: 5rem auto;
        }

        .change-password-modal .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            background: #f8f9fa;
            padding: 0;
            overflow: hidden;
        }

        .change-password-modal .modal-header {
            background: #f8f9fa;
            border-bottom: none;
            padding: 2rem 2rem 1rem 2rem;
            text-align: center;
        }

        .change-password-modal .modal-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
            margin: 0;
            width: 100%;
        }

        .change-password-modal .btn-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: transparent;
            border: none;
            font-size: 1.2rem;
            color: #666;
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }

        .change-password-modal .btn-close:hover {
            opacity: 1;
        }

        .change-password-modal .modal-body {
            padding: 0 2rem 2rem 2rem;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
            font-size: 0.95rem;
        }

        .password-input-container {
            position: relative;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 0.8rem 3rem 0.8rem 1rem;
            font-size: 0.95rem;
            background: #fff;
            transition: all 0.3s ease;
            color: #333;
        }

        .form-control::placeholder {
            color: #bbb;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: #1e5bb8;
            box-shadow: 0 0 0 3px rgba(30, 91, 184, 0.1);
            outline: none;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 1rem;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: #666;
        }

        /* Checkbox Styling */
        .form-check {
            margin: 1.5rem 0;
        }

        .form-check-input {
            width: 1.2rem;
            height: 1.2rem;
            border: 2px solid #ddd;
            border-radius: 4px;
            margin-top: 0.2rem;
        }

        .form-check-input:checked {
            background-color: #1e5bb8;
            border-color: #1e5bb8;
        }

        .form-check-label {
            margin-left: 0.5rem;
            font-size: 0.95rem;
            color: #555;
            cursor: pointer;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #1e5bb8, #2d74d4);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.9rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #1a4d9d, #2560b8);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(30, 91, 184, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Demo Button */
        .demo-btn {
            background: linear-gradient(135deg, #1e5bb8, #2d74d4);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(30, 91, 184, 0.3);
        }

        .demo-btn:hover {
            background: linear-gradient(135deg, #1a4d9d, #2560b8);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 91, 184, 0.4);
        }

        .demo-btn i {
            margin-left: 0.5rem;
        }

        /* Animation */
        .change-password-modal .modal-content {
            animation: slideInUp 0.3s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 576px) {
            .change-password-modal .modal-dialog {
                margin: 2rem 1rem;
            }

            .change-password-modal .modal-header,
            .change-password-modal .modal-body {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }
    </style>
    <div class="w-100 ">
        <div class="card p-5">
            <div class="row">
                <div class="col-md-2">
                    <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : asset('img/avatars/avatar-2.jpg') }}" class=mb-2" alt="Foto Profil"
                        style="width: 150px; height:150px; border-radius: 50% !important; border: 1px solid black;">
                    <!-- Tombol Ganti Foto -->
                </div>
                <div class="col-md-9">
                    <dl class="row">
                        <h3>{{ $data->name }}</h3>
                        @foreach ($data->getRoleNames() as $role)
                            <p class="text-muted">{{ Str::ucfirst($role) }}</p>
                        @endforeach

                        <hr>
                        <dt class="col-7 mb-3">
                            Nama Pengguna/NIM </dt>

                        <dd class="col-5 mb-3">: {{ $data->identifier }}</dd>

                        <dt class="col-7 mb-3">
                            Kata Sandi </dt>

                        <dd class="col-5 mb-3">: ***********</dd>
                        <dt class="col-7 mb-3"></dt>
                        <dd class="col-5 mb-3 d-flex flex-row gap-3">
                            <a href="/profil/edit" class="btn btn-outline-primary px-4 d-inline-flex align-items-center">
                                Edit Profil
                                <i class="fa-solid fa-pen-to-square ms-2"></i>
                            </a>

                            <a href="profil/password/edit" class="btn btn-primary px-4 d-inline-flex align-items-center">
                                Ganti Kata Sandi
                                <i class="fa-solid fa-lock ms-2"></i>
                            </a>

                        </dd>

                        <div class="modal fade change-password-modal" id="changePasswordModal" tabindex="-1"
                            aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="changePasswordModalLabel">Ganti Kata Sandi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="changePasswordForm">
                                            <div class="form-group">
                                                <label for="oldPassword">Masukkan Kata Sandi Lama</label>
                                                <div class="password-input-container">
                                                    <input type="password" class="form-control" id="oldPassword"
                                                        placeholder="Masukkan kata sandi lama" required>
                                                    <button type="button" class="password-toggle"
                                                        onclick="togglePassword('oldPassword')">
                                                        <i class="fas fa-eye" id="oldPassword-icon"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="newPassword">Masukkan Kata Sandi Baru</label>
                                                <div class="password-input-container">
                                                    <input type="password" class="form-control" id="newPassword"
                                                        placeholder="Masukkan kata sandi baru" required>
                                                    <button type="button" class="password-toggle"
                                                        onclick="togglePassword('newPassword')">
                                                        <i class="fas fa-eye" id="newPassword-icon"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="confirmChange">
                                                <label class="form-check-label" for="confirmChange">
                                                    Yakin ganti sandi?
                                                </label>
                                            </div>

                                            <button type="submit" class="btn-submit" id="submitBtn" disabled>
                                                Simpan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </dl>

                </div>
            </div>
        </div>

    </div>


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
