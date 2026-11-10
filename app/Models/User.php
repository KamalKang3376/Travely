<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\DestinationBooking;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function destinationBookings()
{
    return $this->hasMany(DestinationBooking::class);
}
public function hotelBookings()
{
    return $this->hasMany(\App\Models\HotelBooking::class);
}
public function flightBookings()
{
    return $this->hasMany(\App\Models\FlightBooking::class);
}
public function carRentalBookings()
{
    return $this->hasMany(CarRentalBooking::class);
}
}