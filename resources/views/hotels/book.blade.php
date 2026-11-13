
@extends('layouts.app')

@section('title', 'Book ' . $hotel->name . ' | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endpush

@section('content')

<section class="booking-section">
    <div class="container">

        <div class="booking-heading">
            <span>RESERVE YOUR STAY</span>
            <h1>Book Your Hotel</h1>
            <p>Complete your details to reserve your stay.</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">

            <div class="col-lg-7">
                <div class="booking-form-card">

                    <h4>Guest Information</h4>

                    <form action="{{ route('hotel-bookings.store', $hotel->slug) }}"
                          method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text"
                                   name="customer_name"
                                   class="form-control"
                                   value="{{ old('customer_name', auth()->user()?->name ?? '') }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="customer_email"
                                   class="form-control"
                                   value="{{ old('customer_email', auth()->user()?->email ?? '') }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text"
                                   name="customer_phone"
                                   class="form-control"
                                   value="{{ old('customer_phone') }}">
                        </div>

                        <hr>

                        <h4>Stay Information</h4>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Check In</label>
                                <input type="date"
                                       name="check_in"
                                       id="checkIn"
                                       class="form-control"
                                       min="{{ date('Y-m-d') }}"
                                       value="{{ old('check_in') }}"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Check Out</label>
                                <input type="date"
                                       name="check_out"
                                       id="checkOut"
                                       class="form-control"
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       value="{{ old('check_out') }}"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Guests</label>
                                <input type="number"
                                       name="guests"
                                       class="form-control"
                                       min="1"
                                       max="20"
                                       value="{{ old('guests', 1) }}"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Rooms</label>
                                <input type="number"
                                       name="rooms"
                                       id="rooms"
                                       class="form-control"
                                       min="1"
                                       max="10"
                                       value="{{ old('rooms', 1) }}"
                                       required>
                            </div>

                        </div>

                        <div class="booking-price-preview mt-4">
                            <span>Estimated Total</span>
                            <strong id="estimatedTotal">₹0.00</strong>
                            <small>Final amount depends on your selected dates and rooms.</small>
                        </div>

                        <button type="submit" class="btn booking-submit w-100 mt-4">
                            <i class="fa-solid fa-calendar-check me-2"></i>
                            Confirm Booking
                        </button>

                    </form>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="booking-hotel-summary">

                    @if($hotel->image)
                        <img src="{{ travely_image_url($hotel->image) }}"
                             alt="{{ $hotel->name }}">
                    @endif

                    <div class="p-4">
                        <span class="text-muted">YOUR SELECTED HOTEL</span>

                        <h3>{{ $hotel->name }}</h3>

                        <p>
                            <i class="fa-solid fa-location-dot"></i>
                            {{ $hotel->city }}, {{ $hotel->country }}
                        </p>

                        <h4>
                            ₹{{ number_format((float) $hotel->price_per_night, 2) }}
                            <small>/ night</small>
                        </h4>

                        <hr>

                        <a href="{{ route('hotels.show', $hotel->slug) }}"
                           class="btn btn-outline-secondary w-100">
                            Back to Hotel Details
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const checkIn = document.getElementById('checkIn');
    const checkOut = document.getElementById('checkOut');
    const rooms = document.getElementById('rooms');
    const total = document.getElementById('estimatedTotal');

    const pricePerNight = {{ (float) $hotel->price_per_night }};

    function calculateTotal() {
        if (!checkIn.value || !checkOut.value) {
            total.textContent = '₹0.00';
            return;
        }

        const start = new Date(checkIn.value + 'T00:00:00');
        const end = new Date(checkOut.value + 'T00:00:00');

        const nights = Math.round((end - start) / 86400000);
        const roomCount = Math.max(1, Number(rooms.value) || 1);

        const amount = nights > 0
            ? nights * pricePerNight * roomCount
            : 0;

        total.textContent = '₹' + amount.toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    checkIn.addEventListener('change', function () {
        if (checkIn.value) {
            const nextDay = new Date(checkIn.value + 'T00:00:00');
            nextDay.setDate(nextDay.getDate() + 1);

            const minCheckout = [
                nextDay.getFullYear(),
                String(nextDay.getMonth() + 1).padStart(2, '0'),
                String(nextDay.getDate()).padStart(2, '0')
            ].join('-');

            checkOut.min = minCheckout;

            if (checkOut.value && checkOut.value <= checkIn.value) {
                checkOut.value = '';
            }
        }

        calculateTotal();
    });

    checkOut.addEventListener('change', calculateTotal);
    rooms.addEventListener('input', calculateTotal);

    calculateTotal();
});
</script>
@endpush
