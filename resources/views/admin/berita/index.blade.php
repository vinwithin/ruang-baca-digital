@extends('layout.admin.app')
@section('title', 'Kelola Informasi/Berita')
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
        <div class="card flex-fill">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a class="btn btn-primary" href="/admin/berita/unggah"><i class="fa-solid fa-plus me-2"></i>Tambah Berita</a>
                <form action="{{ route('berita.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari berita..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i> Cari
                        </button>
                        <a href="{{ route('berita.index') }}" class="btn btn-primary ms-2">Atur Ulang</a>

                    </div>
                </form>

            </div>
            @if (request('search'))
                <p class="text-muted">Hasil pencarian untuk: <strong>{{ request('search') }}</strong></p>
            @endif
            <div class="card-body">

                <div class="table-wrapper border rounded-3 overflow-scroll">

                    <table class="table align-middle overflow-hidden ">
                        <thead class="table-light text-start px-3">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th class="d-none d-md-table-cell"style="width: 20%">Pembuat</th>
                                <th class="d-none d-md-table-cell" style="width: 40%">Judul</th>

                                <th class="d-none d-md-table-cell" style="width: 20%">Thumbnails</th>
                                <th class="d-none d-md-table-cell" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $item->user->name }}
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        {{ $item->title }}
                                        <div class=" d-flex flex-column gap-2 justify-content-center align-items-start">
                                            @if ($item->created_at->eq($item->updated_at))
                                            @else
                                                <small class="text-warning fst-italic">
                                                    *Berita ini terakhir diedit pada
                                                    {{ $item->updated_at->translatedFormat('d F Y') }}
                                                </small>
                                            @endif
                                        </div>

                                    </td>

                                    <td class="d-none d-xl-table-cell"><img class="img-thumbnail"
                                            src="/storage/{{ $item->image }}" alt=""
                                            style="max-width: 80px; max-height:80px;">
                                    </td>


                                    <td class="d-none d-md-table-cell">


                                        <a href="/admin/berita/edit/{{ $item->slug }}" class="btn btn-outline-warning">
                                            <i class="fa-solid fa-pen-to-square" style="color: #FFD43B;"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $item->id }}">
                                            <i class="fa-solid fa-trash-can" style="color: #ff2600;"></i>
                                        </button>
                                        <!-- Gunakan komponen modal -->
                                        <x-confirm-modal modalId="deleteModal{{ $item->id }}"
                                            title="Konfirmasi Persetujuan"
                                            message="Apakah Anda yakin ingin menghapus berita ini?"
                                            action-url="/admin/berita/delete/{{ $item->slug }}"
                                            confirm-text="Iya, Setujui" />




                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
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
