<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LaporanMahasiswa extends Model
{
    protected $table = 'laporan';
    public $laporan = 'laporan';
    protected $fillable = [
        'uuid',
        'user_id',
        'nama',
        'identifier',
        'dospem1',
        'dospem2',
        'program_studi_id',
        'jenis_dokumen_id',
        'tahun',
        'judul',
        'kata_kunci',
        'file',
        'status',
        'komentar',
        'view_count',
    ];
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
    public function dosen1()
    {
        return $this->belongsTo(User::class, 'dospem1', 'id');
    }
    public function dosen2()
    {
        return $this->belongsTo(User::class, 'dospem2', 'id');
    }
   
    public function program_studi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
    public function jenis_dokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_dokumen_id');
    }
    public function favorit()
    {
        return $this->hasMany(Favorit::class);
    }
}
