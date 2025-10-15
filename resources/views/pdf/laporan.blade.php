<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Penyerahan {{ strtoupper($data['title']['nama']) }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            /* padding: 40px 0; */
            font-family: 'Times New Roman', Times, serif;
        }

        .document-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding-top: 0 !important;
            padding-left: 4rem !important;
            /* padding: 2rem 4rem 4rem 6rem !important; */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header-section {
            display: flex;
            align-items: center;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 30px;
            gap: 10px;
        }


        .header-content {
            flex: 1;
            /* otomatis ambil sisa ruang */
            text-align: center;
        }


        .header-title {
            font-weight: bold;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .header-subtitle {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .header-address {
            font-size: 11px;
            line-height: 1.5;
            margin-bottom: 0;
        }

        .document-title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin: 30px 0 40px;
            text-decoration: underline;
        }

        .intro-text {
            text-align: justify;
            margin-bottom: 30px;
            line-height: 1.8;
            font-size: 14px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 30px;
        }

        .info-table td {
            padding: 8px 10px;
            vertical-align: top;
            font-size: 14px;
        }

        .info-table .label-cell {
            width: 140px;
        }

        .info-table .colon-cell {
            width: 20px;
        }

        .info-table .value-cell {
            border-bottom: 1px solid #999;
            min-height: 25px;
        }

        .closing-text {
            text-align: justify;
            margin-bottom: 50px;
            line-height: 1.8;
            font-size: 14px;
        }

        .signature-section {
            margin-top: 50px;
            text-align: right;
            padding-right: 50px;
        }

        .signature-location {
            margin-bottom: 10px;
            font-size: 14px;
        }

        .signature-title {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .signature-org {
            margin-bottom: 100px;
            font-size: 14px;
        }

        .signature-name {
            font-weight: bold;
            margin-bottom: 5px;
            text-decoration: underline;
            font-size: 14px;
        }

        .signature-nip {
            margin-bottom: 0;
            font-size: 14px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .document-container {
                box-shadow: none;
                padding: 30px 40px;
            }
        }

        @media (max-width: 768px) {
            .document-container {
                padding: 30px 20px;
            }

            .header-section {
                flex-direction: column;
                text-align: center;
            }

            .header-section img {
                width: 60px;
                height: 60px;
            }

            .signature-section {
                padding-right: 0;
            }
        }
    </style>
</head>

<body>
    <div class="document-container">
        <!-- Header Kop Surat -->
        <table style="width: 100%; border-bottom: 3px solid #000;">
            <tr>
                <td style="width: 5%; text-align: end;">
                    <img src="{{ public_path('assets/unjapdf.png') }}" alt="Logo Universitas Jambi"
                        style="width: 100px; height: auto;">
                </td>
                <td style="width: 95%; text-align: center;">
                    <div style="">
                        <span style="font-size: 18px; font-weight: bold; line-height: 1.6; color: #2F40E0;">
                            KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,<br>
                            RISET, DAN TEKNOLOGI<br>
                        </span>
                        <span style="color: #E0741A; font-size:16px;">UNIVERSITAS JAMBI</span><br>
                        <span style="color: #E0741A; font-size:16px; font-weight: bold;">FAKULTAS SAINS DAN
                            TEKNOLOGI</span><br>
                        <span style="color: #E0741A; font-size:16px; font-weight: bold;">JURUSAN
                            {{ $data['header']['jurusan'] }}</span><br>
                        <span style="color: #E0741A; font-size:16px; font-weight: bold;">PROGRAM STUDI
                            {{ strtoupper($data['header']['program_studi']) }}</span>
                    </div>
                    <div style="font-size: 12px; margin-top: 5px; line-height: 1.5; color: #2F40E0;">
                        Jalan Raya Jambi - Ma. Bulian, KM.15, Mendalo Indah, Jambi. Kode Pos 36361<br>
                        email: <a href="mailto:fst@unja.ac.id"
                            style="color: #2F40E0; text-decoration: underline;">fst@unja.ac.id</a>,
                        Laman: <a href="http://fst.unja.ac.id"
                            style="color: #2F40E0; text-decoration: underline;">http://fst.unja.ac.id</a>
                    </div>
                </td>
            </tr>
        </table>


        <!-- Judul Dokumen -->
        <h1 class="document-title">BUKTI PENYERAHAN {{ strtoupper($data['title']['nama']) }} </h1>

        <!-- Paragraf Pembuka -->
        <p class="intro-text">
            Ruang Baca Fakultas Sains dan Teknologi dengan ini menyatakan bahwa:
        </p>

        <!-- Tabel Informasi Mahasiswa -->
        <table class="info-table">
            <tr>
                <td class="label-cell">Nama</td>
                <td class="colon-cell">:</td>
                <td class="value-cell">{{ $data['form_data']['nama'] }}</td>
            </tr>
            <tr>
                <td class="label-cell">NIM</td>
                <td class="colon-cell">:</td>
                <td class="value-cell">{{ $data['form_data']['nomor_mahasiswa'] }}</td>
            </tr>
            <tr>
                <td class="label-cell">Program Studi</td>
                <td class="colon-cell">:</td>
                <td class="value-cell">{{ $data['form_data']['prodi'] }}</td>
            </tr>
            <tr>
                <td class="label-cell">Judul</td>
                <td class="colon-cell">:</td>
                <td class="value-cell">{{ $data['form_data']['judul'] }}</td>
            </tr>
        </table>

        <!-- Paragraf Penutup -->
        <p class="closing-text">
            Telah menyelesaikan kewajibannya untuk pengumpulan dokumen {{ $data['title']['nama'] }} di Ruang
            Baca Fakultas Sains dan
            Teknologi.
        </p>

        <!-- Bagian Tanda Tangan -->
        <table style="width: 100%; margin-top: 40px; border-collapse: collapse;">
            <tr>
                <!-- Kolom kiri kosong (biar posisi tanda tangan ke kanan) -->
                <td style="width: 45%;"></td>

                <!-- Kolom kanan: isi tanda tangan -->
                <td style="width: 40%; text-align: left; vertical-align: top;">
                    @php
                        use Carbon\Carbon;
                        Carbon::setLocale('id');
                        $tanggalFormat = Carbon::parse($data['signature']['tanggal'])->translatedFormat('j F Y');
                    @endphp

                    <p style="margin: 0 0 0 0;">Jambi, {{ $tanggalFormat }}</p>

                    <p style="margin: 0 0 0 0;">Validator</p>
                    <p style="margin: 0 15px 10px 0;">Ruang Baca Fakultas Sains dan Teknologi.</p>

                    <!-- QR Code -->
                    <img src="{{ public_path('storage/' . $data['signature']['qr_code']) }}" alt="QR Code Verifikasi"
                        style="width: 100px; height: 100px; margin: 10px 0;">


                    <!-- Nama dan NIP -->
                    <p style="margin: 10px 0 0 0;">{{ $data['signature']['validator'] }}</p>
                    <p style="margin: 0;">NIP. {{ $data['signature']['nip'] }}</p>
                </td>
            </tr>
        </table>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
