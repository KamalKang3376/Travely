@extends('layouts.app')

@section('title', 'My Package Booking Details')

@section('content')

<link rel="stylesheet" href="{{ asset('css/my-package-bookings.css') }}">

<div class="my-bookings-page">
    <div class="container">

        <div class="booking-details-top">
            <a href="{{ route('my-package-bookings.index') }}" class="booking-back-link">
                <i class="fa-solid fa-arrow-left"></i>
                Back to My Package Bookings
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="booking-details-card">

            <div class="booking-details-header">
                <div>
                    <span class="booking-reference-label">Booking Reference</span>
                    <h2>{{ $booking->booking_reference }}</h2>
                </div>

                <span class="booking-status {{ $booking->status }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>

            <hr>

            <h4 class="booking-section-title">Package Information</h4>

            <div class="booking-details-grid">
                <div class="booking-detail-item">
                    <span>Package Name</span>
                    <strong>{{ $booking->package_name }}</strong>
                </div>

                <div class="booking-detail-item">
                    <span>Destination</span>
                    <strong>{{ $booking->destination }}</strong>
                </div>

                <div class="booking-detail-item">
                    <span>Travel Date</span>
                    <strong>{{ $booking->travel_date->format('d M Y') }}</strong>
                </div>

                <div class="booking-detail-item">
                    <span>Number of Travellers</span>
                    <strong>{{ $booking->travellers }}</strong>
                </div>

                <div class="booking-detail-item">
                    <span>Price Per Person</span>
                    <strong>₹{{ number_format($booking->price_per_person, 2) }}</strong>
                </div>

                <div class="booking-detail-item">
                    <span>Total Amount</span>
                    <strong class="booking-total">
                        ₹{{ number_format($booking->total_amount, 2) }}
                    </strong>
                </div>
            </div>

            <hr>

            <h4 class="booking-section-title">Customer Information</h4>

            <div class="booking-details-grid">
                <div class="booking-detail-item">
                    <span>Customer Name</span>
                    <strong>{{ $booking->customer_name }}</strong>
                </div>

                <div class="booking-detail-item">
                    <span>Email Address</span>
                    <strong>{{ $booking->customer_email }}</strong>
                </div>

                <div class="booking-detail-item">
                    <span>Phone Number</span>
                    <strong>{{ $booking->customer_phone }}</strong>
                </div>

                <div class="booking-detail-item">
                    <span>Booking Date</span>
                    <strong>{{ $booking->created_at->format('d M Y, h:i A') }}</strong>
                </div>
            </div>

            @if($booking->special_request)
                <hr>

                <h4 class="booking-section-title">Special Request</h4>

                <p class="booking-special-request">
                    {{ $booking->special_request }}
                </p>
            @endif

            <div class="booking-details-actions">

                <a href="{{ route('packages.track-booking') }}"
                   class="booking-track-btn">
                    <i class="fa-solid fa-location-dot"></i>
                    Track Booking
                </a>

                @if($booking->status === 'pending')
                    <form action="{{ route('my-package-bookings.cancel', $booking->id) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to cancel this booking?')">

                        @csrf
                        @method('PATCH')

                        <button type="submit" class="booking-cancel-btn">
                            <i class="fa-solid fa-xmark"></i>
                            Cancel Booking
                        </button>
                    </form>
                @endif

            </div>

        </div>

    </div>
</div>

@endsection