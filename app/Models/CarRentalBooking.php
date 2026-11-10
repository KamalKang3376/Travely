<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarRentalBooking extends Model
{
    protected $fillable = [
        'booking_reference',
        'user_id',
        'car_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'pickup_datetime',
        'return_datetime',
        'pickup_location',
        'dropoff_location',
        'rental_days',
        'price_per_day',
        'total_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'pickup_datetime' => 'datetime',
            'return_datetime' => 'datetime',
            'price_per_day' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}