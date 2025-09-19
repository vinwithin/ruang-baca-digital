<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/auth/email-verification.css">
    <link rel="stylesheet" href="/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Email Verification</title>
</head>

<body>
    <div class="wrapper  d-flex flex-column  align-items-center">

        <div class="container d-flex flex-column justify-content-center align-items-center mt-5 pt-5 gap-5">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1>
                    RUANG BACA DIGITAL
                </h1>
                <h1>
                    FAKULTAS SAINS DAN TEKNOLOGI
                </h1>
            </div>

            <div class="card shadow-lg p-5" style="border-radius: 20px; padding-bottom:8rem;">

                <div class="card-body">
                    <div class="status-icon text-center">📧</div>
                    <h2>Verifikasi Alamat Email Anda</h2>

                    <div class="user-info">
                        <p>Halo <strong>{{ Auth::user()->name }}</strong>,</p>
                        <p class="email-display">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="info-box">
                        <p>Terima kasih telah mendaftar di <strong>RUANG BACA FST</strong>! Untuk mengaktifkan akun
                            Anda
                            dan
                            mengakses semua fitur, silakan verifikasi alamat email Anda.</p>

                        <div class="email-sent-info">
                            <div class="info-icon">📤</div>
                            <div>
                                <strong>Email verifikasi telah dikirim!</strong>
                                <p>Periksa kotak masuk email Anda dan klik link verifikasi yang kami kirimkan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <form method="POST" action="{{ route('verification.send') }}" class="resend-form">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <span class="btn-icon">🔄</span>
                                Kirim Ulang Email
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay-img">
            <img class="vektor-atas" src="/assets/vektor-login.svg" alt="">
            <img class="vektor-bawah" src="/assets/vektor-login1.svg" alt="">
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/f10456a175.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js"></script>
</body>

</html>
