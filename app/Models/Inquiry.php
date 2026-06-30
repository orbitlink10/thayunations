<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = ['branding_service_id', 'name', 'email', 'phone', 'company', 'message', 'status'];

    public function brandingService()
    {
        return $this->belongsTo(BrandingService::class);
    }
}
