
@extends('layouts.app')

@section('title', 'Flight Booking Details | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/my-flight-bookings.css') }}">
@endpush

@section('content')

<section class="my-flight-bookings py-5">
    <div class="container">

        <div class="booking-heading mb-4">
            <h1 class="fw-bold">Flight Booking Details</h1>
            <p class="text-muted">Your reservation information.</p>
        </div>

        <div class="booking-detail-card">

            <div class="d-flex justify-content-between flex-wrap gap-3 mb-4">
                <div>
                    <small class="text-muted">Booking Reference</small>
                    <h4 class="fw-bold">{{ $booking->booking_reference }}</h4>
                </div>

                <span class="booking-status status-{{ $booking->status }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>

            <hr>

            <h5 class="fw-bold mb-3">Flight Information</h5>

            <div class="row g-4">
                <div class="col-md-6">
                    <small class="text-muted">Airline</small>
                    <p>{{ $booking->flight->airline ?? 'Flight unavailable' }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Flight Number</small>
                    <p>{{ $booking->flight->flight_number ?? '-' }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Departure</small>
                    <p>{{ $booking->flight->departure_city ?? '-' }}</p>
                    <small>{{ $booking->flight?->departure_time?->format('d M Y, h:i A') ?? '-' }}</small>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Arrival</small>
                    <p>{{ $booking->flight->arrival_city ?? '-' }}</p>
                    <small>{{ $booking->flight?->arrival_time?->format('d M Y, h:i A') ?? '-' }}</small>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Departure Airport</small>
                    <p>{{ $booking->flight->departure_airport ?? '-' }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Arrival Airport</small>
                    <p>{{ $booking->flight->arrival_airport ?? '-' }}</p>
                </div>
            </div>

            <hr>

            <h5 class="fw-bold mb-3">Passenger Information</h5>

            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted">Name</small>
                    <p>{{ $booking->customer_name }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Email</small>
                    <p>{{ $booking->customer_email }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Phone</small>
                    <p>{{ $booking->customer_phone }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Passengers</small>
                    <p>{{ $booking->passengers }}</p>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div>
                    <small class="text-muted">Price Per Seat</small>
                    <h5>₹{{ number_format($booking->price_per_seat, 2) }}</h5>
                </div>

                <div>
                    <small class="text-muted">Total Price</small>
                    <h4 class="fw-bold text-success">
                        ₹{{ number_format($booking->total_price, 2) }}
                    </h4>
                </div>
            </div>

            @if(in_array($booking->status, ['pending', 'confirmed']))
                <form action="{{ route('my-flight-bookings.cancel', $booking->booking_reference) }}"
                      method="POST"
                      class="mt-4"
                      onsubmit="return confirm('Are you sure you want to cancel this flight booking?')">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-xmark me-2"></i>Cancel Booking
                    </button>
                </form>
            @endif

            <a href="{{ route('my-flight-bookings') }}"
               class="btn btn-outline-secondary mt-3">
                Back to My Flight Bookings
            </a>

        </div>
    </div>
</section>

@endsection
