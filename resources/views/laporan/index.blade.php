@extends('layout.admin.app')
@section('title', 'Upload Dokumen Anda')
@section('content')
    <style>
        .form-container {
            background: white;
            padding: 40px;

            /* border-radius: 20px;
            margin: 20px auto;
            max-width: 900px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1); */
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
            background-color: #f8f9fa;
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

        .checkbox-container {
            background-color: #f8f9fa;
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
        <div class="card p-3 border rounded-3 shadow-sm">
            <div class="form-container">
                <h2 class="form-title">Input Dokumen</h2>

                <form id="inputDokumenForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="namaMahasiswa" class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="namaMahasiswa"
                                    placeholder="Masukkan Nama Anda">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="programStudi" class="form-label">Program Studi</label>
                                <select class="form-select" id="programStudi">
                                    <option value="">Pilih Program Studi</option>
                                    <option value="teknik-informatika">Teknik Informatika</option>
                                    <option value="sistem-informasi">Sistem Informasi</option>
                                    <option value="teknik-komputer">Teknik Komputer</option>
                                    <option value="manajemen">Manajemen</option>
                                    <option value="akuntansi">Akuntansi</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nimMahasiswa" class="form-label">NIM Mahasiswa</label>
                                <input type="text" class="form-control" id="nimMahasiswa"
                                    placeholder="Masukkan Nim Anda">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenisDokumen" class="form-label">Jenis Dokumen</label>
                                <select class="form-select" id="jenisDokumen">
                                    <option value="">Pilih Jenis Dokumen Anda</option>
                                    <option value="skripsi">Skripsi</option>
                                    <option value="tesis">Tesis</option>
                                    <option value="disertasi">Disertasi</option>
                                    <option value="proposal">Proposal</option>
                                    <option value="laporan">Laporan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dosenPembimbing1" class="form-label">Dosen Pembimbing 1</label>
                                <input type="text" class="form-control" id="dosenPembimbing1"
                                    placeholder="Masukkan Nama Dosen Pembimbing 1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" class="form-control" id="tahun" value="2025" min="2020"
                                    max="2030">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dosenPembimbing2" class="form-label">Dosen Pembimbing 2</label>
                                <input type="text" class="form-control" id="dosenPembimbing2"
                                    placeholder="Masukkan Nama Dosen Pembimbing 2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" placeholder="Masukkan Judul Anda">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="kataKunci" class="form-label">Kata Kunci</label>
                                <textarea class="form-control" id="kataKunci" rows="3" placeholder="Masukkan Beberapa Kata Kunci Dokumen Anda"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Unggah File</label>
                                <div class="file-upload-area" id="fileUploadArea">
                                    <div class="file-upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div class="file-upload-text">Pilih File</div>
                                    <div class="file-upload-subtext">Belum ada file yang dipilih</div>
                                    <input type="file" class="d-none" id="fileInput" accept=".pdf,.doc,.docx">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkbox-container">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="dataConfirmation">
                            <label class="form-check-label" for="dataConfirmation">
                                Saya yakin data dalam formulir ini sudah benar dan sesuai.
                            </label>
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="button" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            Kirim <i class="fas fa-paper-plane ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
