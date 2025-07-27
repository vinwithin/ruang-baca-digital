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

    <div class="wrap">
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
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav me-auto gap-4 ">
                    <li class="nav-item ">
                        <a class="nav-link text-white" href="/tentang-kami">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="/#announcement">Jenis Koleksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="/#berita">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="/daftar-publikasi">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="/#galeri">Tentang</a>
                    </li>

                </ul>

                <div class="ms-auto" id="button-login">
                    <a href="/login" class="fw-semibold">
                        Masuk <i class="fa-solid fa-circle-arrow-right"></i>
                    </a>

                </div>
            </div>
        </nav>

        <section class=" position-relative" id="hero">
            <div class="container">
                <div class="search-bar text-white shadow">
                    <i class="fa-solid fa-magnifying-glass me-2"></i>
                    <input type="text" class="form-control" placeholder="Cari dokumen..." />

                    <select class="form-select">
                        <option selected>Program Studi</option>
                        <option>Teknik Informatika</option>
                        <option>Sistem Informasi</option>
                    </select>

                    <select class="form-select"><i class="fa-solid fa-file-lines"></i>
                        <option selected>Koleksi</option>
                        <option>Skripsi</option>
                        <option>Laporan</option>
                    </select>

                    <select class="form-select">
                        <option selected>Tahun</option>
                        <option>2025</option>
                        <option>2024</option>
                    </select>

                    <button class="btn btn-light">Cari</button>
                </div>
            </div>

            <!-- Hero Title di tengah section -->
            <div class="hero-title position-absolute">
                <h1 class="text-white fw-bold" style="text-shadow: 1px 1px 6px rgba(0,0,0,0.6);">
                    SELAMAT DATANG DI RUANG BACA DIGITAL<br>
                    FAKULTAS SAINS DAN TEKNOLOGI<br>
                    UNIVERSITAS JAMBI
                </h1>
            </div>
        </section>

    </div>

    <section id="prodi">
        <h1 class="text-dark text-center mt-5">PROGRAM STUDI</h1>
        <div class="container my-5">
            <div class="d-flex overflow-auto gap-3">

                <!-- Kartu 1 -->
                <div class="position-relative flex-shrink-0 rounded-4 overflow-hidden text-white"
                    style="width: 300px; height: 180px; background-image: url('/assets/bg-prodi.png'); background-size: cover; background-position: center;">
                    <div class="position-absolute top-50 start-50 translate-middle text-center fw-bold fs-5">Sistem
                        Informasi</div>
                </div>

                <!-- Kartu 2 -->
                <div class="position-relative flex-shrink-0 rounded-4 overflow-hidden text-white"
                    style="width: 300px; height: 180px; background-image: url('/assets/bg-prodi.png'); background-size: cover; background-position: center;">
                    <div class="position-absolute top-50 start-50 translate-middle text-center fw-bold fs-5">Analisis
                        Kimia</div>
                </div>

                <!-- Kartu 3 -->
                <div class="position-relative flex-shrink-0 rounded-4 overflow-hidden text-white"
                    style="width: 300px; height: 180px; background-image: url('/assets/bg-prodi.png'); background-size: cover; background-position: center;">
                    <div class="position-absolute top-50 start-50 translate-middle text-center fw-bold fs-5">Biologi
                    </div>
                </div>

                <!-- Kartu 4 -->
                <div class="position-relative flex-shrink-0 rounded-4 overflow-hidden text-white"
                    style="width: 300px; height: 180px; background-image: url('/assets/bg-prodi.png'); background-size: cover; background-position: center;">
                    <div class="position-absolute top-50 start-50 translate-middle text-center fw-bold fs-5">Fisika
                    </div>
                </div>

                <!-- Tombol Panah -->
                <div class="d-flex align-items-center">
                    <button class="btn btn-primary rounded-circle shadow" style="width: 48px; height: 48px;">
                        <i class="bi bi-arrow-right fs-5"></i>
                    </button>
                </div>

            </div>
        </div>

    </section>
    <section class="" id="koleksi">
        <div class="wrapper">
            <h1 class="text-white text-center mb-5 pt-5">KATEGORI SELEKSI</h1>
            <div class="container">
                <div class="d-flex justify-content-center align-items-center gap-5 flex-wrap">
                    <div class="kategori-box tugas-akhir d-flex flex-column justify-content-between align-items-center">
                        <h1 class="kategori-title">Tugas Akhir</h1>
                        <img src="/assets/unja.png" alt="">
                    </div>
                    <div
                        class="kategori-box laporan-magang d-flex flex-column justify-content-between align-items-center">
                        <h1 class="kategori-title">Laporan Magang</h1>
                        <img src="/assets/unja.png" alt="">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="vh-100" id="tentang">
        <h1 class="text-dark text-center pt-5 mb-5">TENTANG RUANG BACA</h1>
        <div class="d-flex flex-row justify-content-around align-items-start gap-5">
            <div>
                <img src="/assets/tentang-img.png" alt="">
            </div>
            <div>
                <p class="">Ruang Baca Fakultas Sains dan Teknologi (FST) Universitas Jambi merupakan salah satu
                    fasilitas
                    penting yang disediakan untuk mendukung kegiatan akademik sivitas akademika, khususnya mahasiswa
                    dalam mengakses berbagai sumber referensi yang relevan dengan bidang sains dan teknologi. Ruang baca
                    ini dirancang sebagai tempat yang nyaman dan kondusif untuk belajar mandiri, membaca literatur
                    ilmiah, serta mengerjakan tugas atau penelitian. Koleksi yang tersedia mencakup buku teks, jurnal
                    ilmiah, laporan tugas akhir, serta materi referensi lainnya yang sesuai dengan program studi di
                    bawah naungan FST. Selain koleksi fisik, ruang baca FST juga mulai terintegrasi dengan layanan
                    digital, sehingga memungkinkan mahasiswa mengakses beberapa sumber bacaan dalam bentuk elektronik
                    melalui jaringan kampus. Keberadaan ruang baca ini sangat membantu mahasiswa dalam mengembangkan
                    wawasan akademik, meningkatkan kualitas penulisan ilmiah, serta menunjang proses penyusunan laporan
                    magang dan tugas akhir secara lebih efektif dan terarah.</p>
            </div>
        </div>
    </section>
    <section class="vh-100" id="berita">
        <h1 class="text-dark text-center mb-5">BERITA/INFORMASI</h1>
        <div class="container">
            <div class="row g-5">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="news-card position-relative text-white">
                        <img src="/assets/berita.png"
                            class="w-100 h-100 object-fit-cover position-absolute top-0 start-0" alt="..." />
                        <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        <div
                            class="card-content position-relative p-4 h-100 d-flex flex-column justify-content-center">
                            <h4 class="fw-bold">Perpustakaan UNJA Raih Akreditasi Unggul dari <br><span
                                    class="d-block fs-4">PERPUSNAS RI</span></h4>
                            <p class="mt-3 small">
                                Akreditasi Unggul Perpustakaan merupakan pengakuan tertinggi yang diberikan kepada
                                Perpustakaan yang telah memenuhi kriteria ketat terkait standar akademik, manajemen,
                                serta kontribusi dalam penelitian dan pengabdian kepada masyarakat.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 (copy) -->
                <div class="col-md-4">
                    <div class="news-card position-relative text-white">
                        <img src="/assets/berita.png"
                            class="w-100 h-100 object-fit-cover position-absolute top-0 start-0" alt="..." />
                        <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        <div
                            class="card-content position-relative p-4 h-100 d-flex flex-column justify-content-center">
                            <h4 class="fw-bold">Perpustakaan UNJA Raih Akreditasi Unggul dari <br><span
                                    class="d-block fs-4">PERPUSNAS RI</span></h4>
                            <p class="mt-3 small">
                                Akreditasi Unggul Perpustakaan merupakan pengakuan tertinggi yang diberikan kepada
                                Perpustakaan yang telah memenuhi kriteria ketat terkait standar akademik, manajemen,
                                serta kontribusi dalam penelitian dan pengabdian kepada masyarakat.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 with arrow -->
                <div class="col-md-4">
                    <div class="news-card position-relative text-white">
                        <img src="/assets/berita.png"
                            class="w-100 h-100 object-fit-cover position-absolute top-0 start-0" alt="..." />
                        <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        <div
                            class="card-content position-relative p-4 h-100 d-flex flex-column justify-content-center">
                            <h4 class="fw-bold">Perpustakaan UNJA Raih Akreditasi Unggul dari <br><span
                                    class="d-block fs-4">PERPUSNAS RI</span></h4>
                            <p class="mt-3 small">
                                Akreditasi Unggul Perpustakaan merupakan pengakuan tertinggi yang diberikan kepada
                                Perpustakaan yang telah memenuhi kriteria ketat terkait standar akademik, manajemen,
                                serta kontribusi dalam penelitian dan pengabdian kepada masyarakat.
                            </p>
                            <!-- Arrow Button -->
                            <div class="position-absolute end-0 bottom-50 translate-middle-y me-3">
                                <button class="btn btn-primary rounded-circle p-2 shadow">
                                    <i class="bi bi-arrow-right fs-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <footer>
        <div class="d-flex flex-row justify-content-between align-items-start">
            <div class="d-flex justify-content-center align-items-center gap-3">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <img src="/assets/logo.png" alt="Logo" style="height: 60px;">
                </a>
                <div class="d-flex flex-column">
                    <h1 class="fs-6 mb-0">Ruang Baca Digital</h1>
                    <h1 class="fs-6">Fakultas Sains dan Teknologi</h1>
                </div>
            </div>
            <div>
                <h3>Tautan</h3>
                <ul class="list-unstyled">
                    <li>
                        <a class="list-unstyled" href="">Web Unja</a>

                    </li>
                    <li>
                        <a class="list-unstyled" href="">Sistem Informasi Akademik</a>
                    </li>
                    <li>
                        <a class="list-unstyled" href="">Tugas Akhir</a>
                    </li>
                    <li>
                        <a class="list-unstyled" href="">Perpustakaan Nasional</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3>Kontak</h3>
                <ul class="list-unstyled">
                    <li>
                        <p>Ruang Baca<br>
                            Fakultas Sains dan Teknologi UNJA<br>
                            Gedung A, Lt.2</p>
                    </li>
                    <li>
                        <p>Jl. Raya Jambi - Muara Bulian<br> Km. 15Mendalo Indah, Jambi Luar Kota, <br>Jambi 36361</p>
                    </li>
                    <li>
                        <p>Phone:</p>
                    </li>
                    <li>
                        <p>Email:</p>
                    </li>
                </ul>
            </div>
            <div>
                <h3>Media Sosial</h3>
            </div>
        </div>
    </footer>

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
