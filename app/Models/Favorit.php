<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    protected $table = 'favorit';
    public $favorit = 'favorit';
    protected $fillable = [
        'user_id',
        'laporan_id',
    ];
    public function laporan()
    {
        return $this->belongsTo(LaporanMahasiswa::class, 'laporan_id');
    }
}
