<?php

namespace App\Services;

use App\Models\LaporanMahasiswa;

class SearchService
{
    public function filterLaporan(array $filters)
    {
        $query = LaporanMahasiswa::query();

        if (!empty($filters['keyword'])) {
            $query->where('judul', 'like', '%' . $filters['keyword'] . '%');
        }

        if (!empty($filters['prodi'])) {
            $query->where('program_studi_id', $filters['prodi']);
        }

        if (!empty($filters['koleksi'])) {
            $query->where('jenis_dokumen_id', $filters['koleksi']);
        }

        if (!empty($filters['tahun'])) {
            $query->whereYear('created_at', $filters['tahun']);
        }

        return $query->latest()->get();
    }
}
