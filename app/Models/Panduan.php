<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panduan extends Model
{
    protected $table = 'panduan';
    public $panduan = 'panduan';
    protected $fillable = [
        'link'
    ];

    public function extractVideoInfo()
    {
        $url = $this->link;

        // YouTube detection
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/', $url, $matches)) {
            $this->video_id = $matches[1];
        }
        // Vimeo detection
        elseif (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
            $this->video_id = $matches[1];
        }
        // Other platforms
        else {
            $this->video_id = null;
        }
    }

    public function getEmbedUrlAttribute()
    {

        return "https://www.youtube.com/embed/{$this->video_id}";
    }
}
