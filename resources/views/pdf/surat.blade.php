<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Evaluasi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
        }

        .container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
            padding: 15mm;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .header h2 {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .header h3 {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 1px;
        }

        .header .address {
            font-size: 10px;
            margin-top: 8px;
        }

        .logo {
            float: left;
            width: 60px;
            height: 60px;
            margin-right: 15px;
        }

        .logo-placeholder {
            width: 60px;
            height: 60px;
            border: 2px solid #ccc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            color: #666;
            text-align: center;
        }

        .clear {
            clear: both;
        }

        .form-section {
            margin: 20px 0;
        }

        .form-title {
            font-size: 13px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            text-decoration: underline;
        }

        .form-field {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .form-field label {
            width: 120px;
            font-weight: bold;
        }

        .form-field .colon {
            margin: 0 10px;
        }

        .form-field .value {
            flex: 1;
            border-bottom: 1px dotted #000;
            min-height: 15px;
            padding-bottom: 2px;
        }

        .evaluation-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .evaluation-table th,
        .evaluation-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        .evaluation-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .evaluation-table .no-column {
            width: 40px;
            text-align: center;
        }

        .evaluation-table .criteria-column {
            width: 150px;
        }

        .signature-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            width: 45%;
            text-align: center;
        }

        .signature-box .title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .signature-box .location {
            margin-bottom: 5px;
        }

        .signature-space {
            height: 60px;
            margin: 10px 0;
        }

        .signature-box .name {
            font-weight: bold;
            border-bottom: 1px solid #000;
            margin-bottom: 2px;
        }

        .signature-box .nip {
            font-size: 10px;
        }

        .page-break {
            page-break-after: always;
        }

        .note {
            font-style: italic;
            font-size: 10px;
            margin-top: 15px;
            text-align: justify;
        }

        @media print {
            .container {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <div class="logo">
                <div class="logo-placeholder">
                    LOGO
                </div>
            </div>

            <h1>{{ $data['header']['kementerian'] }}</h1>
            <h2>{{ $data['header']['riset'] }}</h2>
            <h2>{{ $data['header']['universitas'] }}</h2>
            <h3>{{ $data['header']['fakultas'] }}</h3>
            <h3>{{ $data['header']['jurusan'] }}</h3>
            <h3>{{ $data['header']['program_studi'] }}</h3>

            <div class="address">
                {{ $data['header']['alamat'] }}<br>
                {{ $data['header']['kode_pos'] }}<br>
                {{ $data['header']['website'] }}
            </div>

            <div class="clear"></div>
        </div>

        <!-- Form Title -->
        <div class="form-title">
            BUKTI PENYERAHAN LAPORAN MAGANG
        </div>

        <!-- Student Information -->
        <div class="form-section">
            <div class="form-field">
                <label>Nama</label>
                <span class="colon">:</span>
                <div class="value">{{ $data['form_data']['nama'] }}</div>
            </div>

            <div class="form-field">
                <label>Nomor Mahasiswa</label>
                <span class="colon">:</span>
                <div class="value">{{ $data['form_data']['nomor_mahasiswa'] }}</div>
            </div>

            <div class="form-field">
                <label>Prodi</label>
                <span class="colon">:</span>
                <div class="value">{{ $data['form_data']['prodi'] }}</div>
            </div>

            <div class="form-field">
                <label>Judul Magang</label>
                <span class="colon">:</span>
                <div class="value">{{ $data['form_data']['judul_magang'] }}</div>
            </div>
        </div>

        <!-- Evaluation Criteria -->
        <div class="form-section">
            <p><strong>Telah diterima laporan Magang saudara:</strong></p>

            <p style="margin: 10px 0;">
                Optimalisasi Publikasi dan Media Dana Komunikasi,
                Informatika dan Statistik Kota Sungai Penuh, Jambi
                dalam bentuk: Buku dan Video Edukasi untuk Media Sosial.
            </p>

            <p><strong>Sistem Informasi</strong></p>
            <p><strong>FEB/2018</strong></p>
        </div>

        <!-- Evaluation Table -->
        <table class="evaluation-table">
            <thead>
                <tr>
                    <th class="no-column">No.</th>
                    <th class="criteria-column">NAMA PENERIMA</th>
                    <th>TANDA TANGAN</th>
                    <th>Prodi</th>
                    <th>Pembimbing</th>
                    <th>Perpustakaan Edukasi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="no-column">1.</td>
                    <td>{{ $data['nama_penerna']['no_1'] ?: 'Apt. Risma' }}</td>
                    <td>{{ $data['evaluasi']['komunikasi'] }}</td>
                    <td>{{ $data['penilaian']['prodi_signature'] }}</td>
                    <td>{{ $data['penilaian']['pembimbing'] }}</td>
                    <td>{{ $data['penilaian']['perpustakaan_edukasi'] }}</td>
                </tr>
                <tr>
                    <td class="no-column">2.</td>
                    <td>{{ $data['nama_penerna']['no_2'] }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="no-column">3.</td>
                    <td>{{ $data['nama_penerna']['no_3'] ?: 'A.J - 1' }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <!-- Note -->
        <div class="note">
            {{ $data['informasi']['catatan'] }}
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">
                <!-- Left side can be empty or additional signature -->
            </div>

            <div class="signature-box">
                <div class="location">{{ $data['tanggal']['tempat'] }}, ________________</div>
                <div class="title">{{ $data['tanggal']['program_studi'] }}</div>
                <div class="title">{{ $data['tanggal']['ketua_program'] }}</div>

                <div class="signature-space"></div>

                <div class="name">{{ $data['tanggal']['nama_ketua'] }}</div>
                <div class="nip">{{ $data['tanggal']['nip'] }}</div>
            </div>
        </div>
    </div>
</body>

</html>
