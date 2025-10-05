<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Bukti Penyerahan Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .header-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            height: 200px;
            border-radius: 0 0 50% 50% / 0 0 30px 30px;
        }
        .container{
            min-height: 100vh;
        }
        .main-card {
            margin-top: -100px;
            border-radius: 20px;
        }

        .info-row {
            border-bottom: 1px solid #e9ecef;
            padding: 12px 0;
        }

        .info-label {
            color: #6c757d;
            font-weight: 500;
            min-width: 150px;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Header gradient -->
    <div class="header-gradient"></div>

    <!-- Main content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg main-card">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="text-center fw-bold mb-5">Halaman Validasi Bukti Penyerahan {{$data->jenis_dokumen->nama}}</h3>

                        @if ($valid)
                            <!-- Informasi Validasi -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3 pb-2 border-bottom">Informasi Validasi</h5>
                                <div class="table-responsive rounded-4 border overflow-hidden">
                                    <table class="table table-bordered mb-0" style="width:100%;">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%;">Status Validasi</td>
                                                <td style="width:50%;">
                                                    {{ $data->status === 'Disetujui' ? 'Valid (Disetujui)' : 'Dokumen belum disetujui' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:50%;">Tanggal Validasi</td>
                                                <td style="width:50%;">
                                                    {{ \Carbon\Carbon::parse($data->approved_at)->format('d F Y') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Data Mahasiswa -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3 pb-2 border-bottom">Data Mahasiswa</h5>
                                <div class="table-responsive rounded-4 border overflow-hidden">
                                    <table class="table table-bordered mb-0" style="width:100%;">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%;">Nama</td>
                                                <td style="width:50%;">{{ $data->nama }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:50%;">NIM</td>
                                                <td style="width:50%;">{{ $data->identifier }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:50%;">Program Studi</td>
                                                <td style="width:50%;">{{ $data->program_studi->nama }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:50%;">Judul</td>
                                                <td style="width:50%;">{{ $data->judul }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Data Validator -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3 pb-2 border-bottom">Data Validator</h5>
                                <div class="table-responsive rounded-4 border overflow-hidden">
                                    <table class="table table-bordered mb-0" style="width:100%;">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%;">Nama</td>
                                                <td style="width:50%;">{{ $data->admin->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:50%;">NIP</td>
                                                <td style="width:50%;">{{ $data->admin->identifier }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width:50%;"></td>
                                                <td style="width:50%;">Validator Ruang Baca Fakultas Sains dan Teknologi
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Footer note -->
                            <div class="p-3 border-start border border-primary" role="alert">
                                <small>
                                    Halaman ini diterbitkan secara otomatis oleh Sistem Informasi Ruang Baca Fakultas
                                    Sains dan Teknologi Universitas Jambi.
                                    Data sesuai dengan dokumen cetak yang telah divalidasi.
                                </small>
                            </div>
                        @else
                            <!-- Status Tidak Valid -->
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="bi bi-x-circle-fill text-danger" style="font-size: 80px;"></i>
                                </div>
                                <h3 class="text-danger fw-bold mb-3">TIDAK VALID</h3>
                                <p class="text-muted mb-4">{{ $message }}</p>

                                <div class="alert alert-danger border-start border-5 border-danger" role="alert">
                                    <small>
                                        <i class="bi bi-exclamation-triangle"></i>
                                        Kode validasi tidak ditemukan dalam sistem atau laporan belum disetujui.
                                        Silakan hubungi administrasi untuk informasi lebih lanjut.
                                    </small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
