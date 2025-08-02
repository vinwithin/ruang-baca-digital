@extends('layout.index')
@section('content')
    <section id="koleksi" class="">
        <div class="search-bar text-dark shadow mb-5">
            <i class="fa-solid fa-magnifying-glass me-2"></i>
            <input type="text" class="form-control" placeholder="Cari dokumen..." />
            <i class="fa-solid fa-graduation-cap"></i>
            <select class="form-select">
                <option value="">Program Studi</option>
                @foreach ($prodi as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            <i class="fa-solid fa-file-lines"></i>
            <select class="form-select">
                <option value="">Koleksi</option>
                @foreach ($jenis as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            <i class="fa-solid fa-calendar"></i>

            <select class="form-select">
                <option selected>Tahun</option>
                <option>2025</option>
                <option>2024</option>
            </select>

            <button class="btn btn-primary">Cari</button>
        </div>
        <h1 id="koleksi-title" class="text-center mb-5">{{ $title->nama }}</h1>
        <h3 id="koleksi-deskripsi">Daftar {{ $title->nama }} terbaru di fakultas sains dan teknologi</h3>
        <div class="w-100">
            <div class="card p-5 border rounded-3 shadow-sm">
                <div class="container-fluid mt-2 clearfix">
                    <h4 class="fw-bold text-center mb-4">
                        {{ $data->judul }}
                    </h4>

                    <div class="table-responsive rounded-4 border mb-5">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-semibold">Penulis</td>
                                    <td>{{ $data->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Kontributor/Dosen Pembimbing</td>
                                    <td>{{ $data->dosen1->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Jenis Koleksi</td>
                                    <td><span class="badge text-bg-warning">{{ $data->jenis_dokumen->nama }}</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Tahun</td>
                                    <td>{{ $data->tahun }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Program Studi</td>
                                    <td>{{ $data->program_studi->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Kata Kunci</td>
                                    <td>{{ $data->kata_kunci }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Petugas Input/Edit</td>
                                    <td>Nama Admin</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Tanggal Input</td>
                                    <td>{{ $data->created_at->format('d/m/Y') }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row g-2 mt-5">
                        <div class="col-12 col-md-6">
                            @if (!$favorit)
                                <a href="/bookmark/tambah/{{ $data->uuid }}" class="btn btn-outline-primary w-100">
                                    Simpan ke favorit <i class="fa-solid fa-star"></i>
                                </a>
                            @else
                                <a href="/bookmark/hapus/{{ $data->uuid }}" class="btn btn-outline-primary w-100">
                                    Hapus ke favorit <i class="fa-solid fa-star"></i>
                                </a>
                            @endif
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="/dokumen/{{ $data->judul }}" class="btn btn-primary w-100">
                                Baca Dokumen <i class="bi bi-book"></i>
                            </a>
                        </div>
                    </div>



                    <div class="mt-4">
                        <a href="/search/dokumen" class="btn btn-primary">
                            <i class="fa-solid fa-circle-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
