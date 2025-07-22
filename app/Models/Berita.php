<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Berita extends Model
{
    use Sluggable;
    protected $table = 'berita';
    public $berita = 'berita';
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'content',
        'excerpt',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
