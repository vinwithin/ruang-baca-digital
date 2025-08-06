@extends('layout.index')
@section('content')
    <section id="koleksi" class="">
        <form action="/hasil-pencarian" method="GET">
            @csrf
            <div class="search-bar text-dark shadow mb-5">
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
                    @foreach (range(date('Y'), 2020) as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-primary">Cari</button>
            </div>
        </form>

        <h1 id="koleksi-title" class="text-center mb-5">{{ $title->nama }}</h1>
        <h3 id="koleksi-deskripsi">Daftar {{ $title->nama }} terbaru di fakultas sains dan teknologi</h3>
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
                    @foreach ($data as $item)
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
    </section>
@endsection
