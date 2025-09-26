<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun - RUANG BACA FST</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            opacity: 0.1;
        }

        .logo {
            position: relative;
            z-index: 2;
        }

        .logo h1 {
            margin: 0;
            font-size: 2.5em;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .logo p {
            margin: 10px 0 0 0;
            font-size: 1.1em;
            opacity: 0.9;
            font-weight: 300;
        }

        .content {
            padding: 40px 30px;
            background: white;
        }

        .welcome-text {
            font-size: 1.3em;
            color: #374151;
            margin-bottom: 30px;
            text-align: center;
        }

        .verification-box {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .verification-box::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) rotate(45deg);
            }
        }

        .verify-button {
            display: inline-block;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            text-decoration: none;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1em;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
            position: relative;
            z-index: 2;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .verify-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(79, 70, 229, 0.4);
        }

        .verification-code {
            background: #f1f5f9;
            border: 2px dashed #cbd5e1;
            border-radius: 10px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
            font-family: 'Courier New', monospace;
            font-size: 1.5em;
            font-weight: bold;
            color: #1e293b;
            letter-spacing: 3px;
        }

        .info-text {
            color: #6b7280;
            font-size: 0.95em;
            line-height: 1.6;
            margin: 20px 0;
        }

        .footer {
            background: #f8fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .footer p {
            color: #6b7280;
            font-size: 0.9em;
            margin: 5px 0;
        }

        .social-links {
            margin: 20px 0;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #6b7280;
            font-size: 1.2em;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #4f46e5;
        }

        .divider {
            height: 3px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed, #ec4899, #f59e0b);
            margin: 30px 0;
            border-radius: 2px;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 20px;
                border-radius: 15px;
            }

            .header,
            .content,
            .footer {
                padding: 25px 20px;
            }

            .logo h1 {
                font-size: 2em;
            }

            .verify-button {
                padding: 15px 30px;
                font-size: 1em;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">
                <h1>📚 RUANG BACA</h1>
                <p>Fakultas Sains dan Teknologi</p>
            </div>
        </div>

        <div class="content">
            <div class="welcome-text">
                <strong>Selamat datang di RUANG BACA FST!</strong>
            </div>

            <p>Halo <strong>{{ $user->name }}</strong>,</p>

            <p>Terima kasih telah mendaftar di platform RUANG BACA Fakultas Sains dan Teknologi. Untuk menyelesaikan
                proses pendaftaran dan mengaktifkan akun Anda, silakan verifikasi alamat email ini.</p>

            <div class="verification-box">
                <p style="margin-bottom: 20px; color: #374151; font-weight: 600;">Klik tombol di bawah untuk
                    memverifikasi akun Anda:</p>

                <a href="{{ $verificationUrl }}" class="verify-button">
                    Verifikasi Akun Saya
                </a>

            </div>

            <div class="divider"></div>

            <div class="info-text">
                <p><strong>Informasi Penting:</strong></p>
                <ul style="text-align: left; color: #6b7280;">
                    <li>Jika Anda tidak mendaftar untuk akun ini, abaikan email ini</li>
                    <li>Untuk keamanan, jangan bagikan kode verifikasi kepada siapapun</li>
                </ul>
            </div>

            <p>Setelah verifikasi berhasil, Anda dapat menikmati berbagai fitur RUANG BACA seperti:</p>
            <ul style="color: #374151; line-height: 1.8;">
                <li>📖 Akses koleksi buku digital lengkap</li>
                <li>🔍 Pencarian buku dan jurnal akademik</li>
                <li>💾 Bookmark dan catatan pribadi</li>
                <li>👥 Diskusi dengan sesama mahasiswa FST</li>
                <li>📊 Tracking progres belajar</li>
            </ul>

            <p style="margin-top: 30px;">
                <strong>Detail Akun:</strong><br>
                Email: {{ $user->email }}<br>
                NIM/Identifier: {{ $user->identifier }}<br>
                Program Studi: {{ $user->program_studi ?? 'Fakultas Sains dan Teknologi' }}<br>
                Tanggal Registrasi: {{ $user->created_at->format('d F Y, H:i') }} WIB
            </p>
        </div>

        <div class="footer">
            <p><strong>Tim RUANG BACA</strong><br>
                Fakultas Sains dan Teknologi</p>

            <p style="font-size: 0.8em; color: #9ca3af; margin-top: 20px;">
                Email ini dikirim secara otomatis. Mohon tidak membalas email ini.<br>
                © {{ date('Y') }} RUANG BACA FST. Semua hak dilindungi.
            </p>
        </div>
    </div>
</body>

</html>
