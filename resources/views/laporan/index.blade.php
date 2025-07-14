@extends('layout.admin.app')
@section('title', 'Upload Dokumen Anda')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .form-container {
            background: white;
            padding: 40px;
        }

        .form-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .form-label {
            color: #555;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background-color: white;
        }

        .form-control::placeholder {
            color: #adb5bd;
            font-style: italic;
        }

        .file-upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: #667eea;
            background-color: #f0f2ff;
        }

        .file-upload-area.dragover {
            border-color: #667eea;
            background-color: #e8ecff;
        }

        .file-upload-icon {
            font-size: 48px;
            color: #667eea;
            margin-bottom: 15px;
        }

        .file-upload-text {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .file-upload-subtext {
            color: #adb5bd;
            font-size: 12px;
        }

        .btn-file {
            min-width: 680px;
            height: 40px;
            cursor: pointer;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(58, 119, 191, 1)
        }

        .checkbox-container {
            border-radius: 10px;
            padding: 20px;
            margin: 25px 0;
        }

        .form-check-input {
            transform: scale(1.2);
            margin-right: 10px;
        }

        .form-check-label {
            color: #495057;
            font-size: 14px;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .button-group {
            text-align: right;
            margin-top: 30px;
        }

        .button-group .btn {
            margin-left: 15px;
        }

        .row {
            margin-bottom: 20px;
        }

        .file-selected {
            background-color: #e8f5e8;
            border-color: #28a745;
            color: #155724;
        }

        .file-name {
            font-weight: 500;
            color: #28a745;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 10px;
                padding: 20px;
            }

            .button-group {
                text-align: center;
            }

            .button-group .btn {
                margin: 5px;
                width: 120px;
            }
        }
    </style>
    <div class="w-100 ">
        <div class="card p-3 border rounded-5 shadow-sm">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="form-container">
                <h2 class="form-title">Input Dokumen</h2>

                <form id="inputDokumenForm" method="POST" action="{{ route('unggah-dokumen') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="namaMahasiswa" class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="namaMahasiswa" name="nama"
                                    placeholder="Masukkan Nama Anda" value="{{ auth()->user()->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="programStudi" class="form-label">Program Studi</label>
                                <select class="form-select" id="programStudi" name="program_studi_id">
                                    <option value="">Pilih Program Studi</option>
                                    @foreach ($prodi as $item)
                                        <option value="{{ $item->id }}"
                                            {{ auth()->user()->program_studi_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nimMahasiswa" class="form-label">NIM Mahasiswa</label>
                                <input type="text" class="form-control" id="nimMahasiswa" name="identifier"
                                    placeholder="Masukkan Nim Anda" value="{{ auth()->user()->identifier }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenisDokumen" class="form-label">Jenis Dokumen</label>
                                <select class="form-select" id="jenisDokumen" name="jenis_dokumen_id">
                                    <option value="">Pilih Jenis Dokumen Anda</option>
                                    @foreach ($jenis_dokumen as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dospem1" class="form-label">Dosen Pembimbing 1</label>
                                <select class="dospem form-select" id="dospem1" name="dospem1">
                                    <option value="">Pilih Pembimbing Anda</option>
                                    @foreach ($dospem as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun" class="dospem form-label">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" value="2025"
                                    min="2020" max="2030">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dospem2" class="form-label">Dosen Pembimbing 2</label>
                                <select class="dospem form-select" id="dospem2" name="dospem2">
                                    <option value="">Pilih Pembimbing Anda</option>
                                    @foreach ($dospem as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    placeholder="Masukkan Judul Anda">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Unggah File</label>

                                <input type="file" class="form-control" id="fileInput" name="file"
                                    accept=".pdf,.doc,.docx">
                                <div class="mt-2 border p-4 d-none" id="filePreview">
                                    <p id="fileName">Skripsi</p>
                                    <div class="btn-file" onclick="inputFile()">
                                        Edit File
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kataKunci" class="form-label">Kata Kunci</label>
                                <textarea class="form-control" id="kataKunci" name="kata_kunci"
                                    placeholder="Masukkan Beberapa Kata Kunci Dokumen Anda"></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex justify-content-between mt-0">
                        <div class="checkbox-container">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="dataConfirmation"
                                    name="dataConfirmation">
                                <label class="form-check-label fw-bold" for="dataConfirmation">
                                    Saya yakin data dalam formulir ini sudah benar dan sesuai.
                                </label>
                            </div>
                        </div>

                        <div class="button-group">
                            {{-- <button type="button" class="btn btn-secondary">Batal</button> --}}
                            <button type="submit" class="btn btn-primary">
                                Kirim
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.dospem').select2();
        });
    </script>
    <script>
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');

        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                filePreview.classList.remove('d-none')
                fileName.textContent = fileInput.files[0].name;
            }
        })

        function inputFile() {
            document.getElementById('fileInput').click();
        }
    </script>
@endsection
