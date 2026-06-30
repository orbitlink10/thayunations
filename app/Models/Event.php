<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'event_date', 'venue', 'city',
        'ticket_price', 'tickets_available', 'poster_image', 'is_published',
    ];

    protected function casts(): array
    {
        return ['event_date' => 'datetime', 'ticket_price' => 'decimal:2', 'is_published' => 'boolean'];
    }

    public function ticketOrders()
    {
        return $this->hasMany(TicketOrder::class);
    }
}
