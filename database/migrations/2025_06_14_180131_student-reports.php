<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('identifier');
            $table->string('dospem1');
            $table->string('dospem2');
            $table->string('program_studi_id');
            $table->string('jenis_dokumen_id');
            $table->string('tahun');
            $table->string('judul');
            $table->string('kata-kunci');
            $table->string('qr_code')->nullable();
            $table->string('file-path');
            $table->enum('status', ['Diproses', 'Disetujui', 'Ditolak'])->default('Diproses');
            $table->string('view_count');
            $table->date('approved_at');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
