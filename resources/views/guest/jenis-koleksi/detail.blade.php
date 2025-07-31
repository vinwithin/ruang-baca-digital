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
        <h3 id="koleksi-deskripsi">Daftar {{$title->nama}} terbaru di fakultas sains dan teknologi</h3>
       
    </section>
@endsection
