@extends('layout.admin.app')
@section('title', 'Informasi Status Upload')
@section('content')
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
    <div class="w-100 ">
        <div class="card p-5 border rounded-3 shadow-sm">
            <h3 class="fw-bold mb-4">Daftar dokumen bacaan favorit anda</h3>
            <div class="table-wrapper border rounded-3 overflow-hidden">

                <table class="table align-middle rounded-2 overflow-hidden">
                    <thead class="table-light text-start">
                        <tr>
                            <th style="width: 2%;"></th>
                            <th>Judul</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Jenis Koleksi</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                {{-- {{dd($item->laporan)}} --}}
                                <td><i class="fa-solid fa-star"></i></td>
                                <td style="max-width: 300px;">
                                    {{ $item->laporan->judul }}
                                </td>
                                <td>{{ $item->laporan->nama }}</td>
                                <td>{{ $item->laporan->program_studi->nama }}</td>
                                <td>
                                    <span
                                        class="badge bg-warning text-dark">{{ $item->laporan->jenis_dokumen->nama }}</span>
                                </td>
                                <td>
                                    {{ $item->laporan->tahun }}
                                </td>
                                <td>
                                    <a href="/bookmark/hapus/{{ $item->laporan->uuid }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Hapus
                                    </a>
                                    <a href="/dokumen/{{ $item->laporan->judul }}" class="btn btn-sm btn-primary">
                                        Baca <i class="bi bi-book"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
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
