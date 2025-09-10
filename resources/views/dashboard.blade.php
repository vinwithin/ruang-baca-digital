@extends('layout.admin.app')
@section('title', 'Dashboard')
@section('content')
    <style>
        .calendar-header {
            color: white;
            padding-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .month-year {
            color: #31394D;
            font-family: "Plus Jakarta Sans";
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 17px;
        }
        .bg-primary{
            background: #023E8A !important;
            border-radius: 10px;
            color: white;
        }

        .nav-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            /* background: #f8f9fa; */
            border-bottom: 1px solid #e9ecef;
        }

        .weekday {
            padding: 15px 5px;
            text-align: center;
            color: #B8C5D3;
            text-align: center;
            font-family: "Plus Jakarta Sans";
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 17px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            /* background: #e9ecef; */
            padding: 1px;
        }

        .calendar-day {
            aspect-ratio: 1;
            border-radius: 5px;
            background: #E5E9F2;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: 500;
            position: relative;
            transition: all 0.2s ease;
            min-height: 50px;
        }

        .calendar-day:hover {
            background: #f8f9fa;
            transform: scale(1.05);
        }

        .calendar-day.other-month {
            color: #adb5bd;
            background: #f8f9fa;
        }

        .calendar-day.today {
            background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
            color: white;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.4);
        }

        .calendar-day.today:hover {
            transform: scale(1.1);
        }

        .calendar-day.has-event {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            font-weight: 600;
        }

        .calendar-day.special {
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            color: white;
            font-weight: 600;
        }

        .calendar-day.has-event:hover,
        .calendar-day.special:hover {
            transform: scale(1.1);
        }

        .event-dot {
            position: absolute;
            bottom: 3px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background: #28a745;
            border-radius: 50%;
        }

        .today .event-dot {
            background: white;
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }

        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #4A90E2;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsif */
        @media (max-width: 600px) {
            .calendar-container {
                margin: 10px;
                border-radius: 15px;
            }

            .calendar-header {
                padding: 20px;
            }

            .month-year {
                font-size: 20px;
            }

            .nav-btn {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .weekday {
                padding: 12px 5px;
                font-size: 12px;
            }

            .calendar-day {
                min-height: 45px;
                font-size: 14px;
            }
        }

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
                                    {{ $data_count->where('jenis_dokumen_id', 1)->where('status', 'Disetujui')->count() }}
                                </h2>
                                <div class="text-center">
                                    Tugas Akhir/Skripsi
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card p-3 border rounded-3 shadow-sm h-100">
                                <h2 class="text-center fw-bold">
                                    {{ $data_count->where('jenis_dokumen_id', 2)->where('status', 'Disetujui')->count() }}
                                </h2>
                                <div class="text-center">
                                    Laporan Magang
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card p-3 border rounded-3 shadow-sm h-100">
                                <h2 class="text-center fw-bold">
                                    {{ $data_count->whereIn('status', ['Diproses', 'Revisi'])->count() }}
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
                        <div id="curve_chart" style="height: 340px;"></div>

                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-4 bg-primary p-3">Dokumen Paling Sering Dibaca</h5>
                                    @foreach ($data as $item)
                                        <h6 class="mb-1">{{ $item->judul }}</h6>
                                        <p class="mb-1 text-muted small">{{ $item->view_count }} Kali dilihat</p>
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
                                        @if (!$loop->last)
                                            <hr class="my-3">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3 border rounded-3 shadow-sm">
                                <h2 class="text-center  fw-bold">
                                    {{ $skripsi_count }}
                                </h2>
                                <div class="text-center">
                                    Total Skripsi dibaca
                                </div>
                            </div>
                            <div class="card p-3 border rounded-3 shadow-sm">
                                <h2 class="text-center  fw-bold">
                                    {{ $laporan_count }}
                                </h2>
                                <div class="text-center">
                                    Total Laporan Magang dibaca
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body overflow-scroll">
                            <div class="calendar-header">
                                <h6>Kalender</h6>
                                <div class="month-year" id="monthYear"></div>
                            </div>

                            <div class="weekdays">
                                <div class="weekday">S</div>
                                <div class="weekday">M</div>
                                <div class="weekday">T</div>
                                <div class="weekday">W</div>
                                <div class="weekday">T</div>
                                <div class="weekday">F</div>
                                <div class="weekday">S</div>
                            </div>

                            <div id="calendarContent">
                                <div class="calendar-grid" id="calendarGrid"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
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
                    <p><i class="fa-solid fa-wand-magic-sparkles me-2"></i>Selamat Datang di Dashboard Ruang Baca Digital
                        Fakultas Sains dan Teknologi Universitas Jambi</p>
                    <p><i class="fa-solid fa-wand-magic-sparkles me-2"></i>Anda belum pernah mengupload dokumen</p>
                    <p><i class="fa-solid fa-wand-magic-sparkles me-2"></i>Anda dapat mengupload Tugas akhir atau Laporan
                        magang
                        pada menu “Upload Dokumen”</p>
                    <p><i class="fa-solid fa-wand-magic-sparkles me-2"></i>Anda dapat mencari file Tugas akhir atau Laporan
                        magang untuk anda baca</p>

                </div>
            </div>
        @endrole
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        let currentDate = new Date();
        let events = {};

        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        function getDaysInMonth(year, month) {
            return new Date(year, month + 1, 0).getDate();
        }

        function getFirstDayOfMonth(year, month) {
            return new Date(year, month, 1).getDay();
        }

        function generateCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            const today = new Date();

            // Update month/year display
            document.getElementById('monthYear').textContent =
                `${monthNames[month]} ${year}`;

            // Get calendar info
            const daysInMonth = getDaysInMonth(year, month);
            const firstDay = getFirstDayOfMonth(year, month);
            const daysInPrevMonth = getDaysInMonth(year, month - 1);


            const calendarGrid = document.getElementById('calendarGrid');
            calendarGrid.innerHTML = '';

            // Previous month's trailing days
            for (let i = firstDay - 1; i >= 0; i--) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'calendar-day other-month';
                dayDiv.textContent = daysInPrevMonth - i;
                calendarGrid.appendChild(dayDiv);
            }

            // Current month's days
            for (let day = 1; day <= daysInMonth; day++) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'calendar-day';
                dayDiv.textContent = day;

                // Check if it's today
                if (year === today.getFullYear() &&
                    month === today.getMonth() &&
                    day === today.getDate()) {
                    dayDiv.classList.add('today');
                }

                // Check for events
                const dateKey = `${year}-${month}-${day}`;
                if (events[dateKey]) {
                    dayDiv.classList.add('has-event');
                    const eventDot = document.createElement('div');
                    eventDot.className = 'event-dot';
                    dayDiv.appendChild(eventDot);
                }

                // Add click event to toggle event
                dayDiv.addEventListener('click', () => toggleEvent(year, month, day, dayDiv));

                calendarGrid.appendChild(dayDiv);
            }

            // Next month's leading days
            const totalCells = calendarGrid.children.length;
            const remainingCells = 42 - totalCells; // 6 rows × 7 days

            for (let day = 1; day <= remainingCells; day++) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'calendar-day other-month';
                dayDiv.textContent = day;
                calendarGrid.appendChild(dayDiv);
            }
        }

        function goToToday() {
            currentDate = new Date();
            generateCalendar();
        }

        function toggleEvent(year, month, day, element) {
            const dateKey = `${year}-${month}-${day}`;

            if (events[dateKey]) {
                delete events[dateKey];
                element.classList.remove('has-event');
                const eventDot = element.querySelector('.event-dot');
                if (eventDot) eventDot.remove();
            } else {
                events[dateKey] = true;
                element.classList.add('has-event');
                const eventDot = document.createElement('div');
                eventDot.className = 'event-dot';
                element.appendChild(eventDot);
            }
        }

        function addSampleEvents() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            // Add some sample events
            events[`${year}-${month}-5`] = true;
            events[`${year}-${month}-15`] = true;
            events[`${year}-${month}-22`] = true;

            generateCalendar();
        }

        function clearEvents() {
            events = {};
            generateCalendar();
        }

        // Initialize calendar
        generateCalendar();
    </script>
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
