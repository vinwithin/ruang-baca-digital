@extends('layout.admin.app')
@section('title', 'Dashboard')
@section('content')
    <style>
        /* .row {
                                        margin-top: -100px;
                                    } */

        .minimal-select {
            appearance: none;
            background: transparent;
            border: none;
            font-weight: 600;
            color: #2c2f36;
            padding-right: 18px;
            position: relative;
        }

        h2 {
            font-family: "Plus Jakarta Sans";
            font-size: 60px;
            font-style: normal;
            font-weight: 400;
            line-height: 74px;
            /* 123.333% */
        }

        .minimal-select:focus {
            outline: none;
            box-shadow: none;
        }

        .select-wrapper {
            position: relative;
            display: inline-block;
        }

        .select-wrapper::after {
            content: "";
            position: absolute;
            right: 6px;
            top: 50%;
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #6c757d;
            transform: translateY(-50%);
            pointer-events: none;
        }
    </style>

    <div class="w-full">
        @role('admin')
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-3 border rounded-3 shadow-sm h-100">
                                <h2 class="text-center  fw-bold">
                                    {{ $data->where('jenis_dokumen_id', 2)->where('status', 'Disetujui')->count() }}
                                </h2>
                                <div class="text-center">
                                    Tugas Akhir/Skripsi
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card p-3 border rounded-3 shadow-sm h-100">
                                <h2 class="text-center fw-bold">
                                    {{ $data->where('jenis_dokumen_id', 5)->where('status', 'Disetujui')->count() }}
                                </h2>
                                <div class="text-center">
                                    Laporan Magang
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card p-3 border rounded-3 shadow-sm h-100">
                                <h2 class="text-center fw-bold">
                                    {{ $data->whereIn('status', ['Diproses', 'Revisi'])->count() }}
                                </h2>
                                <div class="text-center">
                                    Ajuan Mahasiswa
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm mt-2">
                        <div class="d-flex justify-content-between align-items-center card-header">
                            <h5 class="mb-3">Total Ajuan</h5>
                            @php
                                $months = [
                                    '01' => 'Januari',
                                    '02' => 'Februari',
                                    '03' => 'Maret',
                                    '04' => 'April',
                                    '05' => 'Mei',
                                    '06' => 'Juni',
                                    '07' => 'Juli',
                                    '08' => 'Agustus',
                                    '09' => 'September',
                                    '10' => 'Oktober',
                                    '11' => 'November',
                                    '12' => 'Desember',
                                ];

                                $currentYear = now()->year;
                                $years = range($currentYear - 5, $currentYear + 1); // Bisa disesuaikan
                            @endphp

                            <form method="GET" action="/dashboard"
                                class="d-flex flex-wrap align-items-center gap-2 fs-6 text-muted">
                                <span class="text-secondary">from</span>

                                <div class="select-wrapper">
                                    <select name="start_month" class="minimal-select" required>
                                        @foreach ($months as $num => $name)
                                            <option value="{{ $num }}"
                                                {{ request('start_month') == $num ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="select-wrapper">
                                    <select name="start_year" class="minimal-select" required>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}"
                                                {{ request('start_year') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <span class="text-secondary">to</span>

                                <div class="select-wrapper">
                                    <select name="end_month" class="minimal-select" required>
                                        @foreach ($months as $num => $name)
                                            <option value="{{ $num }}"
                                                {{ request('end_month') == $num ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="select-wrapper">
                                    <select name="end_year" class="minimal-select" required>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}"
                                                {{ request('end_year') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary ms-2">Filter</button>
                            </form>
                        </div>
                        <div id="curve_chart" style="height: 300px;"></div>

                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-4">Dokumen Paling Sering Dibaca</h5>
                            @foreach ($data as $item)
                                <h6 class="mb-1">{{ $item->judul }}</h6>
                                <p class="mb-1 text-muted small">{{ $item->view_count }} Kali dilihat</p>
                                <span class="badge bg-warning text-dark">{{ $item->jenis_dokumen->nama }}</span>
                                @if (!$loop->last)
                                    <hr class="my-3">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Kalender</h6>
                                <span class="text-muted">Juni, 2025</span>
                            </div>
                            {{-- Kalender statis, bisa diganti library --}}
                            <table class="table table-bordered text-center small mb-0">
                                <thead>
                                    <tr>
                                        <th>S</th>
                                        <th>M</th>
                                        <th>T</th>
                                        <th>W</th>
                                        <th>T</th>
                                        <th>F</th>
                                        <th>S</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Buat baris tanggal manual atau pakai JS --}}
                                    <tr>
                                        <td>29</td>
                                        <td>30</td>
                                        <td class="bg-primary text-white">1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>7</td>
                                        <td>8</td>
                                        <td>9</td>
                                        <td>10</td>
                                        <td>11</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>14</td>
                                        <td class="bg-success text-white">15</td>
                                        <td>16</td>
                                        <td>17</td>
                                        <td>18</td>
                                        <td>19</td>
                                    </tr>
                                    {{-- Lanjutkan sesuai kebutuhan --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="mb-2">Program Studi</h6>
                            <ul class="list-group list-group-flush">
                                @foreach ($prodi as $item)
                                    <li class="list-group-item">{{ $item->nama }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @elserole('mahasiswa')
            <div class="card">
                <div class="d-flex flex-column g-2 align-items-start p-3">
                    <p><i class="fa-solid fa-wand-magic-sparkles me-2"></i>Selamat Datang di Dashboard Ruang Baca Digital Fakultas Sains dan Teknologi Universitas Jambi</p>
                    <p><i class="fa-solid fa-wand-magic-sparkles me-2"></i>Anda belum pernah mengupload dokumen</p>
                    <p><i class="fa-solid fa-wand-magic-sparkles me-2"></i>Anda dapat mengupload Tugas akhir atau Laporan magang pada menu “Upload Dokumen”</p>
                    <p><i class="fa-solid fa-wand-magic-sparkles me-2"></i>Anda dapat mencari file Tugas akhir atau Laporan magang untuk anda baca</p>

                </div>
            </div>
        @endrole
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Bulan', 'Jumlah Ajuan'],
                @if ($chartData->count() > 0)
                    @foreach ($chartData as $row)
                        ['{{ $row->bulan }}', {{ $row->total }}],
                    @endforeach
                @else
                    ['No Data', 0]
                @endif
            ]);

            var options = {
                title: 'Total Ajuan per Bulan',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },

            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            chart.draw(data, options);
        }
    </script>
@endsection
