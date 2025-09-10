@extends('layout.admin.app')
@section('title', 'Kelola Dokumen')
@section('content')
    <style>
        .bg-primary {
            background: #023E8A !important;
            border-radius: 10px !important;
            color: white;
        }
    </style>

    <div class="w-100">
        <div class="card">
            <div class="card-header p-2 bg-primary ">
                <i class="fa-solid fa-wand-sparkles me-2"></i> Video Panduan
            </div>
            <div class="card-body">
                <div class="ratio ratio-16x9 rounded-4 overflow-hidden">
                    <iframe src="https://www.youtube.com/embed/VIDEO_ID" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-header p-2 bg-primary ">
                <i class="fa-solid fa-wand-sparkles me-2"></i> Keterangan Panduan
            </div>
            <div class="d-flex align-items-start p-3">
                <i class="fa-solid fa-wand-magic-sparkles me-3 fs-4 text-primary"></i>
                <div>
                    <h5 class="mb-1 fw-bold">Dashboard</h5>
                    <p class="mb-0 text-muted">
                        Halaman ini menampilkan data serta statistik dokumen yang tersedia pada Ruang Baca FST.
                        Informasi yang ditampilkan dapat berupa jumlah dokumen, kategori, maupun data terkait aktivitas
                        pengguna.
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-start p-3">
                <i class="fa-solid fa-wand-magic-sparkles me-3 fs-4 text-primary"></i>
                <div>
                    <h5 class="mb-1 fw-bold">Kelola Ajuan</h5>
                    <p class="mb-0 text-muted">
                        Pada halaman ini ditampilkan daftar ajuan dokumen dari mahasiswa. Setiap ajuan dilengkapi dengan
                        detail dokumen, serta terdapat opsi bagi petugas untuk menerima atau mengirimkan revisi apabila
                        ditemukan kekurangan atau kesalahan pada dokumen yang diajukan.
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-start p-3">
                <i class="fa-solid fa-wand-magic-sparkles me-3 fs-4 text-primary"></i>
                <div>
                    <h5 class="mb-1 fw-bold">Kelola Dokumen</h5>
                    <p class="mb-0 text-muted">
                        Halaman ini menampilkan daftar dokumen yang telah diinput oleh petugas. Melalui menu ini, petugas
                        dapat menambahkan dokumen baru, melakukan pengeditan, maupun menghapus dokumen dari daftar yang
                        tersedia.
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-start p-3">
                <i class="fa-solid fa-wand-magic-sparkles me-3 fs-4 text-primary"></i>
                <div>
                    <h5 class="mb-1 fw-bold">Kelola Berita/Informasi</h5>
                    <p class="mb-0 text-muted">
                        Halaman ini berfungsi untuk menampilkan daftar berita atau informasi yang telah diinput oleh
                        petugas. Fitur yang tersedia memungkinkan petugas menambahkan berita atau informasi baru, melakukan
                        pengeditan, maupun menghapus berita atau informasi yang sudah ada.
                    </p>
                </div>
            </div>

        </div>
    </div>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
            });
        @endif
    </script>
@endsection
