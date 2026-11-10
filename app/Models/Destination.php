<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DestinationBooking;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'country',
        'city',
        'description',
        'image',
        'starting_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'starting_price' => 'decimal:2',
            'status' => 'boolean',
        ];
    }
    public function bookings()
{
    return $this->hasMany(DestinationBooking::class);
}
}