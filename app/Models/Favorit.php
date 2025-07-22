<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Favorit extends Model
{
    protected $table = 'favorit';
    public $favorit = 'favorit';
    protected $fillable = [
        'uuid',
        'user_id',
        'laporan_id',
    ];

    public function getRouteKey(): mixed
    {
        return $this->uuid;
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function laporan()
    {
        return $this->belongsTo(LaporanMahasiswa::class, 'laporan_id', 'uuid');
    }
}
