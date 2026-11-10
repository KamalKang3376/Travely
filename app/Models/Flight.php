<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flight extends Model
{
    protected $fillable = [
        'airline',
        'flight_number',
        'departure_city',
        'arrival_city',
        'departure_airport',
        'arrival_airport',
        'departure_time',
        'arrival_time',
        'price',
        'total_seats',
        'available_seats',
        'travel_class',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'departure_time' => 'datetime',
            'arrival_time' => 'datetime',
            'price' => 'decimal:2',
            'status' => 'boolean',
        ];
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(FlightBooking::class);
    }
}
