@extends('layout.admin.app')
@section('title', 'Kelola Pengguna')
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
    <div class="w-100">
        <div class="card">
            <div class="card-header pb-0 d-flex flex-column justify-content-start align-items-start">
                <h5 class="fw-bold">Kelola Pengguna</h5>



            </div>
            <div class="card-header d-flex justify-content-between align-items-center">
                <a class="btn btn-primary" href="/admin/kelola-pengguna/create"><i class="fa-solid fa-plus me-2"></i>Tambah
                    Pengguna</a>
                <form action="{{ route('kelola-pengguna.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari kegiatan..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i> Cari
                        </button>
                        <a href="{{ route('kelola-pengguna.index') }}" class="btn btn-primary ms-2">Atur Ulang</a>

                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-wrapper border rounded-3 overflow-scroll">
                    {{-- {{dd($data)}} --}}
                    <table class="table align-middle  overflow-hidden">
                        <thead class="table-light text-start">
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $item->identifier }}</td>


                                    <td style="max-width: 300px;">
                                        {{ $item->name }}
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @php
                                            $status = $item->status;
                                            $badgeClass = 'bg-info'; // default

                                            if ($status === 'Aktif') {
                                                $badgeClass = 'bg-aktif';
                                            } elseif ($status === 'Tidak aktif') {
                                                $badgeClass = 'bg-nonaktif';
                                            }
                                        @endphp

                                        <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                    </td>
                                    {{-- <td>
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
                                        <span class="badge {{ $badgeClass }}"
                                            @if ($item->status === 'Revisi') data-bs-toggle="modal" 
                                            data-bs-target="#modalRevisi-{{ $item->id }}"
                                            style="cursor: pointer" @endif>
                                            {{ $item->status }}
                                            @if ($item->status === 'Revisi')
                                                <i class="fa-solid fa-circle-info ms-2"></i>
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
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Oke</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <a class="btn btn-outline-warning" href="/admin/kelola-pengguna/{{ $item->id }}/edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        @if ($item->status === 'Aktif')
                                            <button class="btn btn-nonaktif" data-bs-toggle="modal"
                                                data-bs-target="#nonactiveModal"><i class="fa-solid fa-power-off"
                                                    style="color: white"></i></button>
                                            <x-confirm-modal modal-id="nonactiveModal" title="Kirim Revisi"
                                                action-url="/admin/kelola-pengguna/{{ $item->id }}/nonactive"
                                                message="Apakah anda yakin untuk menonaktifkan akun?"
                                                confirm-text="Yakin" />
                                        @else
                                            <button class="btn btn-aktif" data-bs-toggle="modal"
                                                data-bs-target="#activeModal"><i class="fa-solid fa-power-off"
                                                    style="color: red"></i></button>
                                            <x-confirm-modal modal-id="activeModal" title="Kirim Revisi"
                                                action-url="/admin/kelola-pengguna/{{ $item->id }}/active"
                                                message="Apakah anda yakin untuk mengaktifkan akun?"
                                                confirm-text="Yakin" />
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center align-items-center py-4">
                    {{ $data->links() }}

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
