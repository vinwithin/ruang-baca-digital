<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    protected $table = 'jenis_dokumen';
    public $jenis_dokumen = 'jenis_dokumen';
    protected $fillable = [
        'nama',

    ];
    public function getRouteKeyName(): string
    {
        return 'nama';
    }
}
