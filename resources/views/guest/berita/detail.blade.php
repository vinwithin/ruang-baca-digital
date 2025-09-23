@extends('layout.index')
@section('content')
    <link rel="stylesheet" href="/css/berita.css">
    <style>
        #berita h2 {
            color: #043471;
            font-family: "Plus Jakarta Sans";
            font-size: 25px;
            font-weight: 500;
            line-height: 24px;
        }

        #berita p {
            color: #000;
            text-align: justify;
            font-family: "Plus Jakarta Sans";
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: 24px;
        }

        img {
            display: block;
            margin: auto;
            max-width: 85%;
            max-height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
    </style>
    <section id="berita">
        <h2 class="text-center fw-bold mb-5 mt-4">{{ $data->title }}</h2>

        <div class="clearfix">
            {{-- <img src="/storage/{{ $data->image }}" alt="Gambar {{ $data->title }}"
                class="rounded shadow-sm me-4 mb-3 float-md-start" style="width: 400px; height: 300px; object-fit: cover;"> --}}


            <p class="text-justify" style="text-align: justify">
                {!! $data->content !!}
            </p>
        </div>
    </section>
@endsection
