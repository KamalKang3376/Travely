 @extends('layouts.app')

@section('title', 'My Car Bookings - Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/my-car-bookings.css') }}">
@endpush

@section('content')

<section class="my-car-bookings-section">
    <div class="container">

        <div class="my-car-heading">
            <span>YOUR JOURNEYS</span>
            <h1>My Car Bookings</h1>
            <p>Manage and track all your rental car reservations.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @forelse($bookings as $booking)

            <div class="my-car-booking-card">

                <div class="my-car-booking-image">
                    @if($booking->car->image)
                        <img src="{{ asset('storage/' . $booking->car->image) }}"
                             alt="{{ $booking->car->name }}">
                    @else
                        <i class="fas fa-car"></i>
                    @endif
                </div>

                <div class="my-car-booking-content">

                    <div class="my-car-booking-top">
                        <div>
                            <h4>{{ $booking->car->name }}</h4>
                            <span>{{ $booking->booking_reference }}</span>
                        </div>

                        <span class="car-booking-status status-{{ $booking->status }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    <div class="my-car-booking-info">
                        <div>
                            <span>Pickup</span>
                            <strong>{{ $booking->pickup_datetime->format('d M Y, h:i A') }}</strong>
                        </div>

                        <div>
                            <span>Return</span>
                            <strong>{{ $booking->return_datetime->format('d M Y, h:i A') }}</strong>
                        </div>

                        <div>
                            <span>Duration</span>
                            <strong>{{ $booking->rental_days }} Days</strong>
                        </div>

                        <div>
                            <span>Total Price</span>
                            <strong>₹{{ number_format($booking->total_price, 2) }}</strong>
                        </div>
                    </div>

                    <a href="{{ route('my-car-bookings.show', $booking->booking_reference) }}"
                       class="my-car-view-btn">
                        View Booking <i class="fas fa-arrow-right"></i>
                    </a>

                </div>
            </div>

        @empty

            <div class="my-car-empty">
                <i class="fas fa-car-side"></i>
                <h3>No Car Bookings Yet</h3>
                <p>You haven't booked any rental cars yet.</p>
                <a href="{{ route('cars.index') }}">Explore Rental Cars</a>
            </div>

        @endforelse

        <div class="my-car-pagination">
            {{ $bookings->links() }}
        </div>

    </div>
</section>

@endsection