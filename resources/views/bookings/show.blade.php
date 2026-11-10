
@extends('layouts.app')

@section('title', 'Booking Details | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/my-bookings.css') }}">
@endpush

@section('content')

<section class="my-bookings-section">
    <div class="container">

        <div class="booking-detail-header">
            <div>
                <span>YOUR RESERVATION</span>
                <h1>Booking Details</h1>
                <p>Reference: {{ $booking->booking_reference }}</p>
            </div>

            <a href="{{ route('my-bookings') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i>
                Back to My Bookings
            </a>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="booking-detail-card">

            @if($booking->hotel && $booking->hotel->image)
                <img
                    src="{{ asset('storage/' . $booking->hotel->image) }}"
                    alt="{{ $booking->hotel->name }}"
                    class="booking-detail-image"
                >
            @endif

            <div class="booking-detail-content">

                <div class="d-flex justify-content-between flex-wrap gap-3">
                    <div>
                        <h3>{{ $booking->hotel->name ?? 'Hotel unavailable' }}</h3>

                        @if($booking->hotel)
                            <p class="text-muted">
                                <i class="fa-solid fa-location-dot"></i>
                                {{ $booking->hotel->city }},
                                {{ $booking->hotel->country }}
                            </p>
                        @endif
                    </div>

                    <span class="booking-status status-{{ $booking->status }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

                <hr>

                <h5>Guest Information</h5>

                <div class="booking-info-grid">
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
                        <strong>{{ $booking->customer_phone ?: 'Not provided' }}</strong>
                    </div>

                    <div>
                        <span>Guests</span>
                        <strong>{{ $booking->guests }}</strong>
                    </div>

                    <div>
                        <span>Rooms</span>
                        <strong>{{ $booking->rooms }}</strong>
                    </div>
                </div>

                <hr>

                <h5>Stay Information</h5>

                <div class="booking-info-grid">
                    <div>
                        <span>Check In</span>
                        <strong>{{ $booking->check_in->format('d M Y') }}</strong>
                    </div>

                    <div>
                        <span>Check Out</span>
                        <strong>{{ $booking->check_out->format('d M Y') }}</strong>
                    </div>

                    <div>
                        <span>Price Per Night</span>
                        <strong>₹{{ number_format((float) $booking->price_per_night, 2) }}</strong>
                    </div>

                    <div>
                        <span>Total Amount</span>
                        <strong class="booking-total">
                            ₹{{ number_format((float) $booking->total_price, 2) }}
                        </strong>
                    </div>
                </div>

                <hr>

                <div class="booking-detail-footer">

                    <p class="text-muted mb-0">
                        Booking created:
                        {{ $booking->created_at->format('d M Y, h:i A') }}
                    </p>

                    @if(in_array($booking->status, ['pending', 'confirmed']))
                        <form
                            action="{{ route('my-bookings.cancel', $booking->booking_reference) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to cancel this booking?');"
                        >
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-xmark me-1"></i>
                                Cancel Booking
                            </button>
                        </form>
                    @else
                        <span class="text-muted">
                            This booking cannot be cancelled.
                        </span>
                    @endif

                </div>

            </div>
        </div>

    </div>
</section>

@endsection
