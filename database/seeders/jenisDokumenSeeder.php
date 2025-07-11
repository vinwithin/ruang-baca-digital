<?php

namespace Database\Seeders;

use App\Models\JenisDokumen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class jenisDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         JenisDokumen::create([
            'nama' => 'Tesis'
        ]);
         JenisDokumen::create([
            'nama' => 'Skripsi'
        ]);
         JenisDokumen::create([
            'nama' => 'Disertasi'
        ]);
         JenisDokumen::create([
            'nama' => 'Proposal'
        ]);
         JenisDokumen::create([
            'nama' => 'Laporan'
        ]);
    }
}
