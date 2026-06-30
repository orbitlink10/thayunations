<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandingService extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'icon', 'starting_price', 'is_published'];

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
}
