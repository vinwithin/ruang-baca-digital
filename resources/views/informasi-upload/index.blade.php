@extends('layout.admin.app')
@section('title', 'Informasi Status Upload')
@section('content')
    <style>
        .table-wrapper {
            border: 5px solid #dee2e6;
            border-radius: 2rem;
            /* rounded-3 */
            overflow: hidden;
        }
    </style>
    <div class="w-100 ">
        <div class="card p-5 border rounded-4 shadow-sm">

            <h3 class="fw-bold mb-4">File yang anda input</h3>
            <div class="table-wrapper border rounded-3 overflow-scroll">

                <table class="table align-middle  overflow-hidden">
                    <thead class="table-light text-start">
                        <tr>
                            <th>Judul</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Jenis Koleksi</th>
                            <th>Status</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td style="max-width: 300px;">
                                    {{ $item->judul }}
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->program_studi->nama }}</td>
                                <td>
                                    @php
                                        $jenisNama = $item->jenis_dokumen->nama;
                                        $badgeClass = 'bg-info'; // default

                                        if ($jenisNama === 'Skripsi') {
                                            $badgeClass = 'bg-secondary';
                                        } elseif ($jenisNama === 'Laporan Magang') {
                                            $badgeClass = 'bg-info';
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
                                            $badgeClass = 'bg-success-subtle ';
                                        } elseif ($item->status === 'Revisi') {
                                            $badgeClass = 'bg-secondary-subtle';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ $item->status }}
                                    </span>




                                </td>
                                <td>
                                    <a class="btn btn-primary" href="/informasi/dokumen/{{ $item->uuid }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @if ($item->status === 'Disetujui')
                                        <a class="btn btn-outline-success" href="/pdf/generate/{{ $item->uuid }}"
                                            target="_blank"><i class="fa-solid fa-print"></i></a>
                                    @elseif($item->status === 'Revisi')
                                        <a href="/informasi/dokumen/edit/{{ $item->uuid }}"
                                            class="btn btn-outline-warning">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <div class="custom-pagination">
                    {{ $data->onEachSide(1)->links() }}
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
