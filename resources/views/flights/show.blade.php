
@extends('layouts.app')

@section('title', $flight->airline . ' | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/flights.css') }}">
@endpush

@section('content')

<section class="flight-details-section py-5">
    <div class="container">

        <a href="{{ route('flights.index') }}" class="flight-back-link">
            <i class="fa-solid fa-arrow-left me-2"></i>Back to Flights
        </a>

        <div class="flight-details-card mt-4">

            @if($flight->image)
                <img src="{{ asset('storage/' . $flight->image) }}"
                     class="flight-details-image" alt="{{ $flight->airline }}">
            @endif

            <div class="p-4 p-lg-5">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                    <div>
                        <span class="flight-tag">FLIGHT DETAILS</span>
                        <h2 class="fw-bold mt-2">{{ $flight->airline }}</h2>
                        <p class="text-muted mb-0">
                            Flight Number: {{ $flight->flight_number }}
                        </p>
                    </div>

                    <span class="flight-class">{{ $flight->travel_class }}</span>
                </div>

                <div class="row g-4">
                    <div class="col-md-5">
                        <div class="flight-detail-box">
                            <small>Departure</small>
                            <h3>{{ $flight->departure_city }}</h3>
                            <p>{{ $flight->departure_airport ?? 'Airport details unavailable' }}</p>
                            <h5>{{ $flight->departure_time->format('d M Y, h:i A') }}</h5>
                        </div>
                    </div>

                    <div class="col-md-2 text-center align-self-center">
                        <i class="fa-solid fa-plane flight-big-icon"></i>
                    </div>

                    <div class="col-md-5">
                        <div class="flight-detail-box">
                            <small>Arrival</small>
                            <h3>{{ $flight->arrival_city }}</h3>
                            <p>{{ $flight->arrival_airport ?? 'Airport details unavailable' }}</p>
                            <h5>{{ $flight->arrival_time->format('d M Y, h:i A') }}</h5>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row g-3">
                    <div class="col-md-4">
                        <small class="text-muted">Ticket Price</small>
                        <h4 class="flight-price">₹{{ number_format($flight->price, 2) }}</h4>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Available Seats</small>
                        <h4>{{ $flight->available_seats }}</h4>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Travel Class</small>
                        <h4>{{ $flight->travel_class }}</h4>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
    <a href="{{ route('flights.index') }}" class="btn btn-outline-secondary">
        Back to Flights
    </a>

    @auth
        @if($flight->available_seats > 0)
            <a href="{{ route('flight-bookings.create', $flight->id) }}"
               class="btn flight-view-btn">
                <i class="fa-solid fa-ticket me-2"></i>Book Now
            </a>
        @else
            <button class="btn btn-secondary" disabled>
                Sold Out
            </button>
        @endif
    @else
        <a href="{{ route('login') }}" class="btn flight-view-btn">
            Login to Book
        </a>
    @endauth
</div>

            </div>
        </div>

    </div>
</section>

@endsection
