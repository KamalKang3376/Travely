
@extends('layouts.app')

@section('title', 'Booking Details | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/my-destination-bookings.css') }}">
@endpush

@section('content')

<section class="destination-booking-details">
    <div class="container">

        <div class="booking-details-heading">
            <div>
                <span>YOUR TRAVEL</span>
                <h1>Booking Details</h1>
                <p>View your destination booking information.</p>
            </div>

            <a href="{{ route('my-destination-bookings') }}" class="btn btn-outline-primary">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to Bookings
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="destination-booking-detail-card">

            <div class="booking-detail-top">
                <div>
                    <span class="detail-label">Booking Reference</span>
                    <h4>{{ $booking->booking_reference }}</h4>
                </div>

                <span class="booking-status {{ strtolower($booking->status) }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>

            <hr>

            <div class="row g-4">

                <div class="col-lg-5">
                    @if($booking->destination->image)
                        <img
                            src="{{ asset('storage/' . $booking->destination->image) }}"
                            alt="{{ $booking->destination->name }}"
                            class="booking-destination-image"
                        >
                    @else
                        <div class="booking-image-placeholder">
                            <i class="fa-solid fa-mountain-sun"></i>
                        </div>
                    @endif

                    <h3 class="mt-3">{{ $booking->destination->name }}</h3>
                    <p class="text-muted">
                        <i class="fa-solid fa-location-dot me-2"></i>
                        {{ $booking->destination->city }},
                        {{ $booking->destination->country }}
                    </p>
                </div>

                <div class="col-lg-7">

                    <h5 class="booking-section-title">Traveller Information</h5>

                    <div class="booking-info-grid">
                        <div>
                            <span>Full Name</span>
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
                            <span>Number of Travellers</span>
                            <strong>{{ $booking->travellers }}</strong>
                        </div>

                        <div>
                            <span>Start Date</span>
                            <strong>{{ $booking->start_date->format('d M, Y') }}</strong>
                        </div>

                        <div>
                            <span>End Date</span>
                            <strong>{{ $booking->end_date->format('d M, Y') }}</strong>
                        </div>

                        <div>
                            <span>Price Per Person</span>
                            <strong>₹{{ number_format($booking->price_per_person, 2) }}</strong>
                        </div>

                        <div>
                            <span>Booking Date</span>
                            <strong>{{ $booking->created_at->format('d M, Y') }}</strong>
                        </div>
                    </div>

                    <div class="booking-total-box">
                        <span>Total Booking Amount</span>
                        <h3>₹{{ number_format($booking->total_price, 2) }}</h3>
                    </div>

                    @if(in_array($booking->status, ['pending', 'confirmed']))
                        <form
                            action="{{ route('my-destination-bookings.cancel', $booking->booking_reference) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to cancel this booking?')"
                            class="mt-4"
                        >
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-xmark me-2"></i>
                                Cancel Booking
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>

    </div>
</section>

@endsection
