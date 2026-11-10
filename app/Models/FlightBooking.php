<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlightBooking extends Model
{
    protected $fillable = [
        'booking_reference',
        'user_id',
        'flight_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'passengers',
        'price_per_seat',
        'total_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'passengers' => 'integer',
            'price_per_seat' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
