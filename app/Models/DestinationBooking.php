<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationBooking extends Model
{
    protected $fillable = [
        'booking_reference',
        'user_id',
        'destination_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'start_date',
        'end_date',
        'travellers',
        'price_per_person',
        'total_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'price_per_person' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
