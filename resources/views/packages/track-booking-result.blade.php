
@extends('layouts.app')

@section('title', 'Booking Details | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/package-booking.css') }}">
@endpush

@section('content')

<div class="track-booking-page">
    <div class="track-booking-result-card">

        <div class="track-result-header">
            <div class="track-booking-icon">
                @switch($bookingType)
                    @case('flight')
                        <i class="fa-solid fa-plane"></i>
                        @break
                    @case('hotel')
                        <i class="fa-solid fa-hotel"></i>
                        @break
                    @case('destination')
                        <i class="fa-solid fa-map-location-dot"></i>
                        @break
                    @case('car')
                        <i class="fa-solid fa-car"></i>
                        @break
                    @default
                        <i class="fa-solid fa-ticket"></i>
                @endswitch
            </div>

            <h2>Your Booking Details</h2>
            <p>Here is the latest information about your travel booking.</p>
            <span class="booking-type-label">
                {{ ucfirst($bookingType) }} Booking
            </span>
        </div>

        <div class="track-result-reference">
            <span>Booking Reference</span>
            <strong>{{ $booking->booking_reference }}</strong>
        </div>

        <div class="track-result-status">
            <span>Booking Status</span>
            <span class="booking-status {{ $booking->status }}">
                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
            </span>
        </div>

        <div class="track-result-details">

            <div>
                <span>Customer Name</span>
                <strong>{{ $booking->customer_name }}</strong>
            </div>

            <div>
                <span>Email Address</span>
                <strong>{{ $booking->customer_email }}</strong>
            </div>

            <div>
                <span>Phone Number</span>
                <strong>{{ $booking->customer_phone }}</strong>
            </div>

            @if($bookingType === 'package')

                <div>
                    <span>Package</span>
                    <strong>{{ $booking->package_name }}</strong>
                </div>

                <div>
                    <span>Destination</span>
                    <strong>{{ $booking->destination }}</strong>
                </div>

                <div>
                    <span>Travel Date</span>
                    <strong>{{ $booking->travel_date?->format('d M, Y') }}</strong>
                </div>

                <div>
                    <span>Travellers</span>
                    <strong>{{ $booking->travellers }}</strong>
                </div>

                <div>
                    <span>Price Per Person</span>
                    <strong>₹{{ number_format($booking->price_per_person, 2) }}</strong>
                </div>

                <div class="track-result-total">
                    <span>Total Amount</span>
                    <strong>₹{{ number_format($booking->total_amount, 2) }}</strong>
                </div>

            @elseif($bookingType === 'flight')

                <div>
                    <span>Flight</span>
                    <strong>{{ $booking->flight?->airline ?? 'Flight' }}</strong>
                </div>

                <div>
                    <span>Passengers</span>
                    <strong>{{ $booking->passengers }}</strong>
                </div>

                <div>
                    <span>Price Per Seat</span>
                    <strong>₹{{ number_format($booking->price_per_seat, 2) }}</strong>
                </div>

                <div class="track-result-total">
                    <span>Total Amount</span>
                    <strong>₹{{ number_format($booking->total_price, 2) }}</strong>
                </div>

            @elseif($bookingType === 'hotel')

                <div>
                    <span>Hotel</span>
                    <strong>{{ $booking->hotel?->name ?? 'Hotel' }}</strong>
                </div>

                <div>
                    <span>Check In</span>
                    <strong>{{ $booking->check_in?->format('d M, Y') }}</strong>
                </div>

                <div>
                    <span>Check Out</span>
                    <strong>{{ $booking->check_out?->format('d M, Y') }}</strong>
                </div>

                <div>
                    <span>Guests</span>
                    <strong>{{ $booking->guests }}</strong>
                </div>

                <div>
                    <span>Rooms</span>
                    <strong>{{ $booking->rooms }}</strong>
                </div>

                <div>
                    <span>Price Per Night</span>
                    <strong>₹{{ number_format($booking->price_per_night, 2) }}</strong>
                </div>

                <div class="track-result-total">
                    <span>Total Amount</span>
                    <strong>₹{{ number_format($booking->total_price, 2) }}</strong>
                </div>

            @elseif($bookingType === 'destination')

                <div>
                    <span>Destination</span>
                    <strong>{{ $booking->destination?->name ?? 'Destination' }}</strong>
                </div>

                <div>
                    <span>Start Date</span>
                    <strong>{{ $booking->start_date?->format('d M, Y') }}</strong>
                </div>

                <div>
                    <span>End Date</span>
                    <strong>{{ $booking->end_date?->format('d M, Y') }}</strong>
                </div>

                <div>
                    <span>Travellers</span>
                    <strong>{{ $booking->travellers }}</strong>
                </div>

                <div>
                    <span>Price Per Person</span>
                    <strong>₹{{ number_format($booking->price_per_person, 2) }}</strong>
                </div>

                <div class="track-result-total">
                    <span>Total Amount</span>
                    <strong>₹{{ number_format($booking->total_price, 2) }}</strong>
                </div>

            @elseif($bookingType === 'car')

                <div>
                    <span>Car</span>
                    <strong>{{ $booking->car?->name ?? 'Rental Car' }}</strong>
                </div>

                <div>
                    <span>Pickup Date</span>
                    <strong>{{ $booking->pickup_datetime?->format('d M, Y h:i A') }}</strong>
                </div>

                <div>
                    <span>Return Date</span>
                    <strong>{{ $booking->return_datetime?->format('d M, Y h:i A') }}</strong>
                </div>

                <div>
                    <span>Pickup Location</span>
                    <strong>{{ $booking->pickup_location }}</strong>
                </div>

                <div>
                    <span>Drop-off Location</span>
                    <strong>{{ $booking->dropoff_location }}</strong>
                </div>

                <div>
                    <span>Rental Days</span>
                    <strong>{{ $booking->rental_days }}</strong>
                </div>

                <div>
                    <span>Price Per Day</span>
                    <strong>₹{{ number_format($booking->price_per_day, 2) }}</strong>
                </div>

                <div class="track-result-total">
                    <span>Total Amount</span>
                    <strong>₹{{ number_format($booking->total_price, 2) }}</strong>
                </div>

            @endif

        </div>

        <a href="{{ route('packages.track-booking') }}"
           class="track-again-btn">
            Track Another Booking
        </a>

    </div>
</div>

@endsection
