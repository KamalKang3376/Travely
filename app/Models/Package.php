<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'destination',
        'category',
        'duration_days',
        'duration_nights',
        'price',
        'discount_price',
        'image',
        'description',
        'highlights',
        'inclusions',
        'exclusions',
        'max_people',
        'featured',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
            'highlights' => 'array',
            'inclusions' => 'array',
            'exclusions' => 'array',
            'featured' => 'boolean',
            'status' => 'boolean',
        ];
    }
}