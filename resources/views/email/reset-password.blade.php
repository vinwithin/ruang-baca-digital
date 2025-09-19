<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - RUANG BACA FST</title>
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
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
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

        .reset-box {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border: 2px solid #fecaca;
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .reset-box::before {
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

        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            text-decoration: none;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1em;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.3);
            position: relative;
            z-index: 2;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .reset-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(220, 38, 38, 0.4);
        }

        .reset-code {
            background: #fef2f2;
            border: 2px dashed #fca5a5;
            border-radius: 10px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
            font-family: 'Courier New', monospace;
            font-size: 1.5em;
            font-weight: bold;
            color: #991b1b;
            letter-spacing: 3px;
        }

        .info-text {
            color: #6b7280;
            font-size: 0.95em;
            line-height: 1.6;
            margin: 20px 0;
        }

        .security-notice {
            background: #fff7ed;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 10px 10px 0;
        }

        .security-notice h4 {
            color: #92400e;
            margin: 0 0 10px 0;
            font-size: 1.1em;
        }

        .security-notice p {
            color: #78350f;
            margin: 0;
            font-size: 0.95em;
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
            color: #dc2626;
        }

        .divider {
            height: 3px;
            background: linear-gradient(90deg, #dc2626, #b91c1c, #991b1b, #7f1d1d);
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

            .reset-button {
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
                <h1>🔐 RUANG BACA</h1>
                <p>Fakultas Sains dan Teknologi</p>
            </div>
        </div>

        <div class="content">
            <div class="welcome-text">
                <strong>Permintaan Reset Password</strong>
            </div>

            <p style="color: #6b7280; margin-bottom: 30px;">
                Kami menerima permintaan untuk mengatur ulang password akun RUANG BACA FST Anda.
                Jika Anda yang melakukan permintaan ini, silakan klik tombol di bawah untuk melanjutkan proses reset
                password.
            </p>

            <div class="reset-box">
                <p style="margin-bottom: 20px; color: #374151; font-weight: 600;">Klik tombol di bawah untuk
                    reset password Anda:</p>

                <a href="{{ $resetUrl }}" class="reset-button">
                    Reset Password Saya
                </a>


            </div>

            <div class="security-notice">
                <h4>⚠️ Pemberitahuan Keamanan</h4>
                <p>Jika Anda <strong>tidak</strong> meminta reset password, mohon abaikan email ini dan password Anda
                    akan tetap aman. Disarankan untuk segera menghubungi tim support jika Anda merasa akun Anda dalam
                    bahaya.</p>
            </div>


            <p style="margin-top: 30px; padding: 20px; background: #f0f9ff; border-radius: 10px; color: #0c4a6e;">
                <strong>📞 Butuh Bantuan?</strong><br>
                Jika Anda mengalami kesulitan atau memiliki pertanyaan, jangan ragu untuk menghubungi tim support kami
                di
                <strong>support@ruangbaca.fst.ac.id</strong> atau melalui WhatsApp di <strong>+62 xxx-xxxx-xxxx</strong>
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
