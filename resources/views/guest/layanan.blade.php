@extends('layout.index')
@section('content')
    <link rel="stylesheet" href="/css/layanan.css">
    <section id="layanan" class="">
        <h2 class="title text-center mb-5 mt-4">Layanan</h2>
        <div class="d-flex justify-content-between align-items-start mb-3 pb-5 gap-5">
            <div class="d-flex flex-column gap-3">
                <h2 class="text-start" id="subtitle" style="font-weight: 600">Selamat datang di Ruang Baca Digital FST Universitas Jambi!</h2>
                <p>Kami hadir untuk memudahkan Anda dalam mencari referensi akademik seperti skripsi dan laporan magang
                    secara online. Dengan sistem yang terintegrasi, semua koleksi tersusun rapi, mudah dicari, dan bisa
                    diakses kapan saja serta di mana saja. Selain itu, Anda juga bisa langsung mengunggah dokumen secara
                    daring tanpa harus datang ke ruang baca fisik.</p>
                <p>
                    Layanan yang tersedia antara lain:
                </p>
                <ul>
                    <li>
                        <strong>Akses Koleksi Digital</strong> - nikmati kemudahan membaca skripsi dan laporan magang secara
                        online.
                    </li>
                    <li>
                        <strong> Pencarian Cepat</strong> - temukan dokumen berdasarkan judul, penulis, tahun, atau kata
                        kunci.
                    </li>
                    <li>
                        <strong> Upload Dokumen Online</strong> - serahkan skripsi atau laporan magang langsung melalui
                        sistem.
                    </li>
                    <li>
                        <strong>Manajemen Dokumen</strong> - pengelola akan memvalidasi dokumen Anda dan memberikan
                        notifikasi status.
                    </li>
                    <li>
                        <strong>Informasi Terbaru</strong> - update koleksi baru dan pengumuman akademik penting.
                    </li>
                    <li>
                        <strong> Panduan Penggunaan</strong> - petunjuk lengkap agar layanan mudah dipahami dan digunakan.
                    </li>
                </ul>
            </div>

            <img class="img-layanan" src="/assets/layanan.png" alt="Gambar Perpustakaan" srcset="">

        </div>

    </section>
@endsection
