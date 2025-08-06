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
                        <a class="nav-link text-white" href="">Beranda</a>
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
                        <a class="nav-link text-white " href="/#tentang">Tentang</a>
                    </li>

                </ul>

                <div class="ms-auto" id="button-login">
                    <a href="/login" class="fw-semibold">
                        Masuk <i class="fa-solid fa-circle-arrow-right ms-2"></i>
                    </a>

                </div>
            </div>
        </nav>

        <section class=" position-relative" id="hero">
            <div class="container">
                <form action="/hasil-pencarian" method="GET">
                    @csrf
                    <div class="search-bar text-white shadow">
                        <i class="fa-solid fa-magnifying-glass me-2"></i>
                        <input type="text" class="form-control" name="keyword" placeholder="Cari dokumen..." />
                        <i class="fa-solid fa-graduation-cap"></i>
                        <select class="form-select" name="prodi">
                            <option value="">Program Studi</option>
                            @foreach ($prodi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <i class="fa-solid fa-file-lines"></i>
                        <select class="form-select" name="koleksi">
                            <option value="">Koleksi</option>
                            @foreach ($jenis as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <i class="fa-solid fa-calendar"></i>

                        <select class="form-select" name="tahun">
                            <option value="">Tahun</option>
                            <option>2025</option>
                            <option>2024</option>
                        </select>

                        <button class="btn btn-light">Cari</button>
                    </div>
                </form>
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
        <div class="container d-flex justify-content-between align-items-center pt-5 mb-4 mt-5">
            <h1 class="text-dark ">PROGRAM STUDI</h1>
            <a href="" class="btn-more">Lihat Semuanya <i class="fa-solid fa-circle-arrow-right"></i></a>

        </div>

        <div class="container position-relative">
            <div class="arrow-icon" onclick="scrollRight('scroll-container')">
                <i class="fa-solid fa-arrow-right"></i>
            </div>


            <div class="d-flex gap-4 overflow-auto" id="scroll-container">
                @foreach ($prodi as $item)
                    <div class="card flex-shrink-0" id="card-list"
                        onclick="window.location.href='/koleksi/program-studi/{{ $item->nama }}'"
                        style="cursor: pointer; ">

                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
    <section class="" id="koleksi">
        <div class="wrapper">
            <div class="container d-flex justify-content-between align-items-center mb-5 ">
                <h1 class="text-white text-center mb-5 pt-5">KATEGORI KOLEKSI</h1>
                <a href="" class="btn-more">Lihat Semuanya <i class="fa-solid fa-circle-arrow-right"></i></a>
            </div>
            <div class="container">
                <div class="d-flex justify-content-center align-items-center gap-5 flex-wrap">
                    <div class="kategori-box tugas-akhir" id="tugas-akhir">
                        <h1 class="kategori-title">Tugas Akhir</h1>
                        <p class="kategori-subtitle d-none">Kumpulan Koleksi Tugas Akhir Mahasiswa Fakultas Sains dan
                            Teknologi Universitas Jambi</p>
                        <a class="btn-more button-koleksi d-none mb-3" href=""><i
                                class="fa-solid fa-circle-arrow-left me-2"></i>Lihat
                            Koleksi<i class="fa-solid fa-circle-arrow-right ms-2"></i></a>
                        <img src="/assets/unja.png" alt="">
                    </div>
                    <div class="kategori-box laporan-magang " id="laporan-magang">
                        <h1 class="kategori-title">Laporan Magang</h1>
                        <p class="kategori-subtitle d-none">Kumpulan Koleksi Laporan Magang Mahasiswa Fakultas Sains
                            dan
                            Teknologi Universitas Jambi</p>
                        <a class="btn-more button-koleksi d-none mb-3" href=""><i
                                class="fa-solid fa-circle-arrow-left me-2"></i>Lihat
                            Koleksi<i class="fa-solid fa-circle-arrow-right ms-2"></i></a>

                        <img src="/assets/unja.png" alt="">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="" id="tentang">
        <h1 class="text-dark text-start pt-5 mb-5">TENTANG RUANG BACA</h1>
        <div class="d-flex justify-content-between align-items-start pt-3" style="gap: 120px;">

            <div>
                <img class="image-about" src="/assets/tentang-img.png" alt="">
            </div>
            <div>
                <p class="deskripsi">Ruang Baca Fakultas Sains dan Teknologi (FST) Universitas Jambi merupakan salah
                    satu
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
                <a class="btn-deskripsi" href="/tentang-kami">Baca Selengkapnya ... <i
                        class="fa-solid fa-folder-open"></i></a>
            </div>
        </div>
    </section>
    <section id="berita">
        <div class="container d-flex justify-content-between align-items-center mb-5 pb-4">
            <h1 class="text-dark">INFORMASI/BERITA</h1>
            <a href="" class="btn-more">Lihat Semuanya <i class="fa-solid fa-circle-arrow-right"></i></a>
        </div>
        <div class="container">
            <div class="row g-5">
                <!-- Card 1 -->
                <div class="container position-relative">
                    <div class="arrow-icon" onclick="scrollRight('scroll-container2')">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    <div class="d-flex gap-2 overflow-auto" id="scroll-container2">
                        @foreach ($berita as $item)
                            <div class="col-md-4">
                                <div class="news-card position-relative text-white">
                                    <img src="/storage/{{ $item->image }}"
                                        class="object-fit-cover position-absolute top-0 start-0" alt="..." />
                                    <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                                    <div
                                        class="card-content position-relative p-4 h-100 d-flex flex-column justify-content-end align-items-center">
                                        <h4 class="fw-bold">{{ $item->title }}</h4>
                                        <p class="mt-3 small">
                                            {{ Str::limit($item->content, 100, '...') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



            </div>
        </div>

    </section>
    <footer>

        <div class="row ">
            <!-- Logo and Title Section -->
            <div class="col-lg-4 col-md-6 col-12 d-flex align-items-center justify-content-start">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <a href="#" class="navbar-brand d-flex align-items-center">
                        <img src="/assets/logo.png" alt="Logo" style="height: 60px;">
                    </a>
                    <div class="d-flex flex-column footer-title">
                        <h1 class=" mb-0">Ruang Baca Digital</h1>
                        <h2 class="">Fakultas Sains dan Teknologi</h1>
                    </div>
                </div>
            </div>

            <!-- Tautan Section -->
            <div class="col-lg-3 col-md-6 col-6 footer-links">
                <h3>Tautan</h3>
                <ul class="list-unstyled">
                    <li>
                        <a href="">Web Unja</a>
                    </li>
                    <li>
                        <a href="">Sistem Informasi Akademik</a>
                    </li>
                    <li>
                        <a href="">Tugas Akhir</a>
                    </li>
                    <li>
                        <a href="">Perpustakaan Nasional</a>
                    </li>
                </ul>
            </div>

            <!-- Kontak Section -->
            <div class="col-lg-3 col-md-6 col-6 footer-contact">
                <h3>Kontak</h3>
                <ul class="list-unstyled">
                    <li>
                        <p>Ruang Baca<br>
                            Fakultas Sains dan Teknologi UNJA<br>
                            Gedung A, Lt.2</p>
                    </li>
                    <li>
                        <p>Jl. Raya Jambi - Muara Bulian<br>
                            Km. 15 Mendalo Indah, Jambi Luar Kota,<br>
                            Jambi 36361</p>
                    </li>
                    <li>
                        <p><strong>Phone:</strong> +62 xxx xxxx xxxx</p>
                    </li>
                    <li>
                        <p><strong>Email:</strong> info@unja.ac.id</p>
                    </li>
                </ul>
            </div>

            <!-- Media Sosial Section -->
            <div class="col-lg-2 col-md-6 col-12 ms-auto footer-social">
                <h3>Media Sosial</h3>
                <ul class="list-unstyled">
                    <li>
                        <a href="#" class="d-flex align-items-center mb-2">
                            <i class="fab fa-facebook me-2"></i> Facebook
                        </a>
                    </li>
                    <li>
                        <a href="#" class="d-flex align-items-center mb-2">
                            <i class="fab fa-instagram me-2"></i> Instagram
                        </a>
                    </li>
                    <li>
                        <a href="#" class="d-flex align-items-center mb-2">
                            <i class="fab fa-twitter me-2"></i> Twitter
                        </a>
                    </li>
                    <li>
                        <a href="#" class="d-flex align-items-center mb-2">
                            <i class="fab fa-youtube me-2"></i> YouTube
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="row mt-4 pt-4">
            <div class="col-12 text-center footer-copyright">
                <p class="mb-0 ">Copyright &copy; 2025 Ruang Baca Fakultas Sains dan Teknologi Universitas Jambi.</p>
            </div>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/f10456a175.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"
        integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous">
    </script>
    <script>
        function scrollRight(containerId) {
            const container = document.getElementById(containerId);
            const scrollAmount = 200; // Adjust scroll distance as needed

            container.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }
        const tugas_akhir = document.getElementById('tugas-akhir');
        const laporan_magang = document.getElementById('laporan-magang');
        tugas_akhir.addEventListener('mouseover', function() {
            tugas_akhir.querySelector('.kategori-subtitle').classList.remove('d-none');
            tugas_akhir.querySelector('.button-koleksi').classList.remove('d-none');
        });
        tugas_akhir.addEventListener('click', function() {
            window.location.href = '/koleksi/Skripsi'; // Ganti dengan URL yang sesuai
        });
        laporan_magang.addEventListener('click', function() {
            window.location.href = '/koleksi/Laporan Magang'; // Ganti dengan URL yang sesuai
        });
        tugas_akhir.addEventListener('mouseout', function() {
            tugas_akhir.querySelector('.kategori-subtitle').classList.add('d-none');
            tugas_akhir.querySelector('.button-koleksi').classList.add('d-none');
        });
        laporan_magang.addEventListener('mouseover', function() {
            laporan_magang.querySelector('.kategori-subtitle').classList.remove('d-none');
            laporan_magang.querySelector('.button-koleksi').classList.remove('d-none');
        });
        laporan_magang.addEventListener('mouseout', function() {
            laporan_magang.querySelector('.kategori-subtitle').classList.add('d-none');
            laporan_magang.querySelector('.button-koleksi').classList.add('d-none');
        });
    </script>
</body>

</html>
