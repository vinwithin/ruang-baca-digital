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
                                    <a class="btn btn-primary" href="/informasi/dokumen/{{ $item->uuid }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @if ($item->status === 'Disetujui')
                                        <a class="btn btn-info" href="/pdf/generate/{{$item->uuid}}" target="_blank"><i
                                                class="fa-solid fa-print"></i></a>
                                    @endif
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
