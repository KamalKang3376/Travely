
@extends('layouts.app')

@section('title', 'Book Flight | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/flight-booking.css') }}">
@endpush

@section('content')

<section class="flight-booking-section py-5">
    <div class="container">

        <div class="mb-4">
            <a href="{{ route('flights.show', $flight->id) }}" class="booking-back-link">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to Flight Details
            </a>

            <h2 class="fw-bold mt-3">Complete Your Flight Booking</h2>
            <p class="text-muted">Enter your passenger details to continue.</p>
        </div>

        <div class="row g-4">

            <div class="col-lg-7">
                <div class="booking-form-card">

                    <h4 class="fw-bold mb-4">Passenger Information</h4>

                    <form action="{{ route('flight-bookings.store', $flight->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text"
                                   name="customer_name"
                                   class="form-control"
                                   value="{{ old('customer_name', auth()->user()->name) }}"
                                   required>
                            @error('customer_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email"
                                   name="customer_email"
                                   class="form-control"
                                   value="{{ old('customer_email', auth()->user()->email) }}"
                                   required>
                            @error('customer_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel"
                                   name="customer_phone"
                                   class="form-control"
                                   value="{{ old('customer_phone') }}"
                                   required>
                            @error('customer_phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Number of Passengers *</label>
                            <select name="passengers" id="passengers" class="form-select" required>
                                @for($i = 1; $i <= min(10, $flight->available_seats); $i++)
                                    <option value="{{ $i }}"
                                        {{ old('passengers', 1) == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ $i == 1 ? 'Passenger' : 'Passengers' }}
                                    </option>
                                @endfor
                            </select>
                            @error('passengers')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn booking-submit-btn w-100">
                            Confirm Booking
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>

                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="flight-summary-card">

                    <h4 class="fw-bold mb-3">Flight Summary</h4>

                    @if($flight->image)
                        <img src="{{ travely_image_url($flight->image) }}"
                             class="summary-flight-image"
                             alt="{{ $flight->airline }}">
                    @endif

                    <h5 class="fw-bold mt-3">{{ $flight->airline }}</h5>
                    <p class="text-muted mb-3">{{ $flight->flight_number }}</p>

                    <div class="summary-route">
                        <div>
                            <h5>{{ $flight->departure_city }}</h5>
                            <small>{{ $flight->departure_time->format('h:i A') }}</small>
                        </div>

                        <i class="fa-solid fa-plane"></i>

                        <div class="text-end">
                            <h5>{{ $flight->arrival_city }}</h5>
                            <small>{{ $flight->arrival_time->format('h:i A') }}</small>
                        </div>
                    </div>

                    <div class="summary-info">
                        <p>
                            <span>Departure Date</span>
                            <strong>{{ $flight->departure_time->format('d M Y') }}</strong>
                        </p>

                        <p>
                            <span>Travel Class</span>
                            <strong>{{ $flight->travel_class }}</strong>
                        </p>

                        <p>
                            <span>Available Seats</span>
                            <strong>{{ $flight->available_seats }}</strong>
                        </p>

                        <p>
                            <span>Price Per Passenger</span>
                            <strong>₹{{ number_format($flight->price, 2) }}</strong>
                        </p>
                    </div>

                    <div class="summary-total">
                        <span>Estimated Total</span>
                        <h3 id="totalPrice">₹{{ number_format($flight->price, 2) }}</h3>
                    </div>

                    <small class="text-muted">Final booking status will be pending confirmation.</small>

                </div>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const passengers = document.getElementById('passengers');
    const totalPrice = document.getElementById('totalPrice');
    const pricePerSeat = {{ (float) $flight->price }};

    function updateTotal() {
        const total = pricePerSeat * Number(passengers.value);

        totalPrice.textContent = '₹' + total.toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    passengers.addEventListener('change', updateTotal);
    updateTotal();
});
</script>

@endsection
