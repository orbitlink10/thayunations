<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketOrder extends Model
{
    protected $fillable = [
        'event_id', 'customer_name', 'email', 'phone', 'quantity',
        'unit_price', 'total_amount', 'payment_reference', 'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
