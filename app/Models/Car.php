<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'model',
        'slug',
        'category',
        'transmission',
        'fuel_type',
        'seats',
        'price_per_day',
        'image',
        'description',
        'features',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price_per_day' => 'decimal:2',
            'features' => 'array',
            'status' => 'boolean',
        ];
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(CarRentalBooking::class);
    }
}