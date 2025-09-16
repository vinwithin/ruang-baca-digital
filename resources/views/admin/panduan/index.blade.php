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
            <div class="card-header p-2 bg-primary d-flex justify-content-between align-items-center">
                <div>
                    <i class="fa-solid fa-wand-sparkles me-2"></i> Video Panduan
                </div>
                @role('admin')
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#panduan">
                        <i class="fa-solid fa-pen-to-square" style="color: #ffc107; font-weight:bold;"></i>
                    </button>

                    <div class="modal fade" id="panduan" tabindex="-1" aria-labelledby="panduanLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" action="/admin/panduan/{{ $data->id }}/update">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="panduanLabel">Edit Video Panduan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="link" class="form-label text-dark fw-semibold">Link Video</label>
                                            <input type="url" class="form-control" id="link" name="link"
                                                placeholder="https://youtube.com/..." required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">
                                            Simpan <i class="fa-solid fa-circle-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endrole

            </div>
            <div class="card-body">
                <div class="ratio ratio-16x9 rounded-4 overflow-hidden">
                    <iframe src="{{ $data->link }}" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>

            </div>
        </div>
        @role('admin')
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
            @elserole('mahasiswa')
            <div class="card">
                <div class="card-header p-2 bg-primary ">
                    <i class="fa-solid fa-wand-sparkles me-2"></i> Keterangan Panduan
                </div>
                <div class="d-flex align-items-start p-3">
                    <i class="fa-solid fa-wand-magic-sparkles me-3 fs-4 text-primary"></i>
                    <div>
                        <h5 class="mb-1 fw-bold">Upload Dokumen</h5>
                        <p class="mb-0 text-muted">
                            Pengguna dapat mengunggah dokumen melalui menu "Upload Dokumen Anda". Caranya dengan mengisi data
                            pada formulir yang tersedia secara benar dan sesuai, kemudian mengirimkannya untuk diproses.
                        </p>
                    </div>
                </div>
                <div class="d-flex align-items-start p-3">
                    <i class="fa-solid fa-wand-magic-sparkles me-3 fs-4 text-primary"></i>
                    <div>
                        <h5 class="mb-1 fw-bold">Informasi Status Upload</h5>
                        <p class="mb-0 text-muted">
                            Status dokumen yang telah diunggah dapat dilihat melalui menu "Informasi Status Upload". Pada menu
                            ini, status dokumen akan ditampilkan dalam tiga kondisi: Diproses, Disetujui, atau Direvisi.
                        <ul>
                            <li>
                                Jika status Disetujui, pengguna dapat melihat detail dokumen dan mengklik tombol "Cetak Surat".

                            </li>
                            <li>
                                Jika status Direvisi, pengguna dapat memperbaiki data atau dokumen melalui formulir yang
                                tersedia,
                                kemudian mengirimkannya kembali untuk diperiksa ulang oleh petugas.
                            </li>
                        </ul>

                        </p>
                    </div>
                </div>
                <div class="d-flex align-items-start p-3">
                    <i class="fa-solid fa-wand-magic-sparkles me-3 fs-4 text-primary"></i>
                    <div>
                        <h5 class="mb-1 fw-bold">Cari Dokumen Bacaan</h5>
                        <p class="mb-0 text-muted">
                            Untuk mencari dokumen, pengguna dapat menggunakan menu "Cari Dokumen Bacaan". Menu ini menyediakan
                            fitur filter pencarian serta menampilkan koleksi terbaru. Pengguna dapat melihat detail dengan
                            mengklik "Detail Dokumen". Dokumen yang tersedia dapat dibaca langsung dan juga disimpan ke dalam
                            daftar favorite untuk diakses kembali dengan mudah.
                        </p>
                    </div>
                </div>


            </div>
        @endrole
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
