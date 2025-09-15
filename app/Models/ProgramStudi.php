<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';
    public $program_studi = 'program_studi';
    protected $fillable = [
        'nama',
        'logo',
        'jurusan_id'
    ];
    public function getRouteKeyName(): string
    {
        return 'nama';
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
