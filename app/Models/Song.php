<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'release_date', 'cover_image',
        'youtube_url', 'apple_music_url', 'spotify_url', 'is_featured', 'is_published',
    ];

    protected function casts(): array
    {
        return ['release_date' => 'date', 'is_featured' => 'boolean', 'is_published' => 'boolean'];
    }
}
