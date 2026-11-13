@extends('layouts.app')

@section('title', 'Book Hotel | Travely')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endpush

@section('content')
<section class="booking-page">
    <div class="container">
        <div class="booking-heading">
            <span class="booking-tag">YOUR NEXT STAY</span>
            <h1>Book Your Stay</h1>
            <p>Complete the details below to request your hotel booking.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="booking-card">
                    <h4>Guest Details</h4>

                    <form action="{{ route('hotel-bookings.store', $hotel->slug) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Full Name</label>
                            <input type="text" id="customer_name" name="customer_name"
                                class="form-control @error('customer_name') is-invalid @enderror"
                                value="{{ old('customer_name', auth()->user()?->name) }}"
                                placeholder="Enter your full name" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="customer_email" class="form-label">Email Address</label>
                                <input type="email" id="customer_email" name="customer_email"
                                    class="form-control @error('customer_email') is-invalid @enderror"
                                    value="{{ old('customer_email', auth()->user()?->email) }}"
                                    placeholder="Enter your email" required>
                                @error('customer_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="customer_phone" class="form-label">Phone Number</label>
                                <input type="text" id="customer_phone" name="customer_phone"
                                    class="form-control @error('customer_phone') is-invalid @enderror"
                                    value="{{ old('customer_phone') }}"
                                    placeholder="Enter phone number">
                                @error('customer_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <h4 class="mt-4">Stay Details</h4>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="check_in" class="form-label">Check-in Date</label>
                                <input type="date" id="check_in" name="check_in"
                                    min="{{ now()->toDateString() }}"
                                    class="form-control @error('check_in') is-invalid @enderror"
                                    value="{{ old('check_in') }}" required>
                                @error('check_in')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="check_out" class="form-label">Check-out Date</label>
                                <input type="date" id="check_out" name="check_out"
                                    min="{{ now()->toDateString() }}"
                                    class="form-control @error('check_out') is-invalid @enderror"
                                    value="{{ old('check_out') }}" required>
                                @error('check_out')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="guests" class="form-label">Guests</label>
                                <input type="number" id="guests" name="guests"
                                    class="form-control @error('guests') is-invalid @enderror"
                                    min="1" max="20" value="{{ old('guests', 1) }}" required>
                                @error('guests')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="rooms" class="form-label">Rooms</label>
                                <input type="number" id="rooms" name="rooms"
                                    class="form-control @error('rooms') is-invalid @enderror"
                                    min="1" max="10" value="{{ old('rooms', 1) }}" required>
                                @error('rooms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn booking-submit w-100 mt-3">
                            Submit Booking
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="booking-summary">
                    @if($hotel->image)
                        <img src="{{ travely_image_url($hotel->image) }}"
                            alt="{{ $hotel->name }}" class="summary-image">
                    @endif

                    <div class="summary-content">
                        <span class="summary-label">YOUR SELECTED HOTEL</span>
                        <h3>{{ $hotel->name }}</h3>
                        <p>
                            <i class="fa-solid fa-location-dot me-2"></i>
                            {{ $hotel->city }}, {{ $hotel->country }}
                        </p>

                        <div class="summary-price">
                            <strong>₹{{ number_format((float) $hotel->price_per_night, 2) }}</strong>
                            <span>/ night / room</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Price per night</span>
                            <strong>₹{{ number_format((float) $hotel->price_per_night, 2) }}</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Number of nights</span>
                            <strong id="nightCount">0</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Rooms</span>
                            <strong id="roomCount">1</strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between summary-total">
                            <span>Estimated Total</span>
                            <strong id="estimatedTotal">₹0.00</strong>
                        </div>

                        <small class="text-muted d-block mt-3">
                            Final booking amount is calculated by the server when you submit.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkIn = document.getElementById('check_in');
    const checkOut = document.getElementById('check_out');
    const rooms = document.getElementById('rooms');
    const nightCount = document.getElementById('nightCount');
    const roomCount = document.getElementById('roomCount');
    const estimatedTotal = document.getElementById('estimatedTotal');

    const price = Number(@json((float) $hotel->price_per_night));

    function updateTotal() {
        const start = checkIn.value ? new Date(checkIn.value + 'T00:00:00') : null;
        const end = checkOut.value ? new Date(checkOut.value + 'T00:00:00') : null;

        let nights = 0;

        if (start && end && end > start) {
            nights = Math.round((end - start) / 86400000);
        }

        const roomTotal = Math.max(1, Number(rooms.value) || 1);
        const total = price * nights * roomTotal;

        nightCount.textContent = nights;
        roomCount.textContent = roomTotal;
        estimatedTotal.textContent = '₹' + total.toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    checkIn.addEventListener('change', function () {
        checkOut.min = checkIn.value;

        if (checkOut.value && checkOut.value <= checkIn.value) {
            checkOut.value = '';
        }

        updateTotal();
    });

    checkOut.addEventListener('change', updateTotal);
    rooms.addEventListener('input', updateTotal);

    updateTotal();
});
</script>
@endsection
