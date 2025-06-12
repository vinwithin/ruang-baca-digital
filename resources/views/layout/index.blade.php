<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <div class="wrapper">
        <nav class="navbar navbar-expand-lg" id="navigasi">
            <div class="d-flex justify-content-center align-items-center gap-3">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <img src="/assets/logo.png" alt="Logo" style="height: 60px;">
                </a>
                <div class="d-flex flex-column">
                    <h1 class="fs-6 mb-0">Ruang Baca Digital</h1>
                    <h1 class="fs-6">Fakultas Sains dan Teknologi</h1>
                </div>
            </div>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto gap-4">
                    <li class="nav-item">
                        <a class="nav-link " href="/tentang-kami">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/#announcement">Jenis Koleksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/#berita">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/daftar-publikasi">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/#galeri">Tentang</a>
                    </li>

                </ul>

                <div class="ms-auto" id="button-login">
                    <a href="/login" class="fw-semibold">
                        Masuk <i class="fa-solid fa-arrow-right me-2"></i>
                    </a>

                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"
        integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous">
    </script>
</body>

</html>
