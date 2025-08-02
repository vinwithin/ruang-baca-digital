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
        <h3 id="koleksi-deskripsi">Skripsi/Tugas Akhir </h3>
        <div class="table-wrapper border rounded-4 overflow-hidden">
            <table class="table align-middle  overflow-hidden">
                <thead class="table-light text-start">
                    <tr>
                        <th>Judul</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Jenis Koleksi</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_skripsi as $item)
                        <tr>
                            <td style="max-width: 300px; cursor: pointer;"
                                onclick="window.location.href='/koleksi/detail/{{ $item->uuid }}'">
                                {{ $item->judul }}
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->program_studi->nama }}</td>
                            <td>
                                @php
                                    $jenisNama = $item->jenis_dokumen->nama;
                                    $badgeClass = 'bg-warning text-dark'; // default

                                    if ($jenisNama === 'Skripsi') {
                                        $badgeClass = 'bg-secondary';
                                    } elseif ($jenisNama === 'Laporan Magang') {
                                        $badgeClass = 'bg-primary';
                                    }
                                @endphp

                                <span class="badge py-2 px-4 {{ $badgeClass }}">{{ $jenisNama }}</span>
                            </td>
                            <td>
                                {{ $item->created_at->format('Y') }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        @if (isset($data_skripsi[0]) && $data_skripsi[0]->jenis_dokumen)
            <a href="/koleksi/{{ $data_skripsi[0]->jenis_dokumen->nama }}">Selengkapnya</a>
        @endif

        <h3 class="mt-5" id="koleksi-deskripsi"> Laporan Magang </h3>
        <div class="table-wrapper border rounded-4 overflow-hidden">
            <table class="table align-middle  overflow-hidden">
                <thead class="table-light text-start">
                    <tr>
                        <th>Judul</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Jenis Koleksi</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_laporan as $item)
                        <tr>
                            <td style="max-width: 300px;">
                                {{ $item->judul }}
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->program_studi->nama }}</td>
                            <td>
                                @php
                                    $jenisNama = $item->jenis_dokumen->nama;
                                    $badgeClass = 'bg-warning text-dark'; // default

                                    if ($jenisNama === 'Skripsi') {
                                        $badgeClass = 'bg-secondary';
                                    } elseif ($jenisNama === 'Laporan Magang') {
                                        $badgeClass = 'bg-primary';
                                    }
                                @endphp

                                <span class="badge py-2 px-4 {{ $badgeClass }}">{{ $jenisNama }}</span>
                            </td>
                            <td>
                                {{ $item->created_at->format('Y') }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        @if (isset($data_laporan[0]) && $data_laporan[0]->jenis_dokumen)
            <a href="/koleksi/{{ $data_laporan[0]->jenis_dokumen->nama }}">Selengkapnya</a>
        @endif

    </section>
@endsection
