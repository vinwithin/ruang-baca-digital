<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';
    public $program_studi = 'program_studi';
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
