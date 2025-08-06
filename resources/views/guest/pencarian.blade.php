@extends('layout.index')
@section('content')
    <link rel="stylesheet" href="pencarian.css">
    <style>
        .table-wrapper {
            border: 5px solid #dee2e6;
            border-radius: 0.75rem;
            /* rounded-3 */
            overflow: hidden;
        }

        .table td,
        .table th {
            border: none !important;
        }
    </style>
    <section id="pencarian" class="">
        <div class="container">
            <div class="search-bar text-white shadow">
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
                    @foreach (range(date('Y'), 2020) as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-light">Cari</button>
            </div>
            <div class="table-wrapper border rounded-3 overflow-hidden">

                <table class="table align-middle  overflow-hidden">
                    <thead class="table-light text-start">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Ajuan</th>
                            <th>Judul</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Jenis Koleksi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>


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

                                    <span class="badge {{ $badgeClass }}">{{ $jenisNama }}</span>
                                </td>
                                <td>
                                    @php
                                        $badgeClass = 'bg-secondary'; // default

                                        if ($item->status === 'Diproses') {
                                            $badgeClass = 'bg-warning';
                                        } elseif ($item->status === 'Disetujui') {
                                            $badgeClass = 'bg-success';
                                        } elseif ($item->status === 'Revisi') {
                                            $badgeClass = 'bg-danger';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}"
                                        @if ($item->status === 'Revisi') data-bs-toggle="modal" 
                                            data-bs-target="#modalRevisi-{{ $item->id }}"
                                            style="cursor: pointer" @endif>
                                        {{ $item->status }}
                                        @if ($item->status === 'Revisi')
                                            <i class="fa-solid fa-circle-info"></i>
                                        @endif
                                    </span>

                                    <div class="modal fade" id="modalRevisi-{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="modalRevisiLabel-{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalRevisiLabel-{{ $item->id }}">
                                                        Catatan Revisi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $item->komentar ?? 'Tidak ada catatan revisi.' }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="/admin/dokumen/{{ $item->id }}">Lihat
                                        Detail</a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
