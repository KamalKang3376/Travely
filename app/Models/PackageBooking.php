<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageBooking extends Model
{
    protected $fillable = [
        'booking_reference',
        'package_id',
        'user_id',
        'package_name',
        'destination',
        'customer_name',
        'customer_email',
        'customer_phone',
        'travel_date',
        'travellers',
        'price_per_person',
        'total_amount',
        'special_request',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'travel_date' => 'date',
            'price_per_person' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'travellers' => 'integer',
        ];
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}