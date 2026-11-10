
@extends('layouts.app')

@section('title', 'Flight Booking Confirmation | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/flight-booking.css') }}">
@endpush

@section('content')

<section class="booking-confirmation-section py-5">
    <div class="container">

        <div class="confirmation-card">

            <div class="confirmation-icon">
                <i class="fa-solid fa-check"></i>
            </div>

            <h2>Booking Submitted Successfully!</h2>

            <p class="text-muted">
                Your flight booking request has been received.
                Please keep your booking reference for future use.
            </p>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="confirmation-reference">
                <span>Booking Reference</span>
                <h3>{{ $booking->booking_reference }}</h3>
            </div>

            <div class="text-start confirmation-details">

                <h5 class="fw-bold mb-3">Booking Details</h5>

                <div class="confirmation-row">
                    <span>Airline</span>
                    <strong>{{ $booking->flight->airline }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Flight Number</span>
                    <strong>{{ $booking->flight->flight_number }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Route</span>
                    <strong>
                        {{ $booking->flight->departure_city }}
                        <i class="fa-solid fa-arrow-right mx-1"></i>
                        {{ $booking->flight->arrival_city }}
                    </strong>
                </div>

                <div class="confirmation-row">
                    <span>Departure</span>
                    <strong>
                        {{ $booking->flight->departure_time->format('d M Y, h:i A') }}
                    </strong>
                </div>

                <div class="confirmation-row">
                    <span>Passenger Name</span>
                    <strong>{{ $booking->customer_name }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Email</span>
                    <strong>{{ $booking->customer_email }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Passengers</span>
                    <strong>{{ $booking->passengers }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Price Per Passenger</span>
                    <strong>₹{{ number_format($booking->price_per_seat, 2) }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Booking Status</span>
                    <span class="badge bg-warning text-dark">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

                <div class="confirmation-total">
                    <span>Total Amount</span>
                    <h3>₹{{ number_format($booking->total_price, 2) }}</h3>
                </div>

            </div>

            <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
                <a href="{{ route('dashboard') }}" class="btn booking-submit-btn">
                    My Dashboard
                </a>

                <a href="{{ route('flights.index') }}" class="btn btn-outline-secondary">
                    Explore More Flights
                </a>
            </div>

            <p class="small text-muted mt-4 mb-0">
                Note: This is a booking request. No online payment has been processed.
            </p>

        </div>

    </div>
</section>

@endsection
