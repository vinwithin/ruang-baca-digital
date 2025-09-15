<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    public $jurusan = 'jurusan';
    protected $fillable = [
        'nama',
        'fakultas_id'
    ];
    public function getRouteKeyName(): string
    {
        return 'nama';
    }
    public function fakultas()
    {
        return $this->hasMany(Fakultas::class);
    }
}
