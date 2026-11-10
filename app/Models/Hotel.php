<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'city',
        'country',
        'address',
        'description',
        'image',
        'price_per_night',
        'rating',
        'facilities',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price_per_night' => 'decimal:2',
            'rating' => 'decimal:1',
            'facilities' => 'array',
            'status' => 'boolean',
        ];
    }
}