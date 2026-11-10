 @extends('layouts.app')

@section('title', 'Car Booking Details - Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/my-car-bookings.css') }}">
@endpush

@section('content')

<section class="car-booking-details-section">
    <div class="container">

        <a href="{{ route('my-car-bookings') }}" class="car-details-back">
            <i class="fas fa-arrow-left"></i> Back to My Car Bookings
        </a>

        <div class="car-booking-detail-card">

            <div class="car-detail-header">
                <div>
                    <span>BOOKING REFERENCE</span>
                    <h2>{{ $booking->booking_reference }}</h2>
                </div>

                <span class="car-booking-status status-{{ $booking->status }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>

            <hr>

            <div class="row g-4">

                <div class="col-lg-5">
                    <div class="car-detail-image">
                        @if($booking->car->image)
                            <img src="{{ asset('storage/' . $booking->car->image) }}"
                                 alt="{{ $booking->car->name }}">
                        @else
                            <i class="fas fa-car"></i>
                        @endif
                    </div>

                    <h3 class="car-detail-name">{{ $booking->car->name }}</h3>
                    <p class="text-muted">
                        {{ $booking->car->brand }} {{ $booking->car->model }}
                    </p>
                </div>

                <div class="col-lg-7">

                    <h4 class="car-detail-section-title">Customer Information</h4>

                    <div class="car-detail-info">
                        <div>
                            <span>Full Name</span>
                            <strong>{{ $booking->customer_name }}</strong>
                        </div>

                        <div>
                            <span>Email</span>
                            <strong>{{ $booking->customer_email }}</strong>
                        </div>

                        <div>
                            <span>Phone</span>
                            <strong>{{ $booking->customer_phone }}</strong>
                        </div>
                    </div>

                    <hr>

                    <h4 class="car-detail-section-title">Rental Information</h4>

                    <div class="car-detail-info">
                        <div>
                            <span>Pickup Date & Time</span>
                            <strong>{{ $booking->pickup_datetime->format('d M Y, h:i A') }}</strong>
                        </div>

                        <div>
                            <span>Return Date & Time</span>
                            <strong>{{ $booking->return_datetime->format('d M Y, h:i A') }}</strong>
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
                            <span>Rental Duration</span>
                            <strong>{{ $booking->rental_days }} Days</strong>
                        </div>

                        <div>
                            <span>Price Per Day</span>
                            <strong>₹{{ number_format($booking->price_per_day, 2) }}</strong>
                        </div>
                    </div>

                    <div class="car-detail-total">
                        <span>Total Rental Amount</span>
                        <strong>₹{{ number_format($booking->total_price, 2) }}</strong>
                    </div>

                    @if(in_array($booking->status, ['pending', 'confirmed']))
                        <form action="{{ route('my-car-bookings.cancel', $booking->booking_reference) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="car-cancel-btn">
                                <i class="fas fa-times-circle"></i> Cancel Booking
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        </div>

    </div>
</section>

@endsection