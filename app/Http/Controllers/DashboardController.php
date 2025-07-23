<?php

namespace App\Http\Controllers;

use App\Models\LaporanMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'start_month' => 'required|date_format:Y-m',
            'end_month' => 'required|date_format:Y-m|after_or_equal:start_month',
        ]);

        // Konversi ke format tanggal awal & akhir
        $startDate = Carbon::parse($request->start_month)->startOfMonth();
        $endDate = Carbon::parse($request->end_month)->endOfMonth();

        // Query data ajuan laporan per bulan
        $laporanPerBulan = DB::table('laporan_mahasiswa')
            ->selectRaw("DATE_FORMAT(created_at, '%M %Y') as bulan, COUNT(*) as total")
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // dd($laporanPerBulan);
        return view('dashboard', [
            'chartData' => $laporanPerBulan,
            'data' => LaporanMahasiswa::orderBy('view_count', 'desc')->take(5)->get(),
        ]);
    }
}
