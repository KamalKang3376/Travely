@extends('layouts.app')

@section('title', 'Book Your Package | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/package-booking.css') }}">
@endpush

@section('content')

<section class="booking-page">

    <div class="container">

        <div class="booking-heading">
            <span>TRAVEL WITH TRAVELY</span>
            <h1>Book Your Adventure</h1>
            <p>Complete your details and get ready for an unforgettable journey.</p>
        </div>

        <div class="row g-4">

            <div class="col-lg-7">

                <div class="booking-form-card">

                    <h3>Traveller Information</h3>
                    <p class="booking-subtitle">Please enter your correct details.</p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('packages.booking.store', $package->slug) }}"
                          method="POST">

                        @csrf

                        <div class="mb-3">
                            <label>Full Name *</label>
                            <input type="text"
                                   name="customer_name"
                                   class="form-control"
                                   value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                                   placeholder="Enter your full name"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Email Address *</label>
                            <input type="email"
                                   name="customer_email"
                                   class="form-control"
                                   value="{{ old('customer_email', auth()->user()->email ?? '') }}"
                                   placeholder="Enter your email"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Phone Number *</label>
                            <input type="tel"
                                   name="customer_phone"
                                   class="form-control"
                                   value="{{ old('customer_phone') }}"
                                   placeholder="Enter your phone number"
                                   maxlength="20"
                                   required>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Travel Date *</label>
                                <input type="date"
                                       name="travel_date"
                                       class="form-control"
                                       value="{{ old('travel_date') }}"
                                       min="{{ date('Y-m-d') }}"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Number of Travellers *</label>
                                <input type="number"
                                       name="travellers"
                                       id="travellers"
                                       class="form-control"
                                       value="{{ old('travellers', 1) }}"
                                       min="1"
                                       max="{{ $package->max_people }}"
                                       required>
                                <small class="text-muted">
                                    Maximum {{ $package->max_people }} people
                                </small>
                            </div>

                        </div>

                        <div class="mb-4">
                            <label>Special Request</label>
                            <textarea name="special_request"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Any special requirements?">{{ old('special_request') }}</textarea>
                        </div>

                        <button type="submit" class="booking-submit-btn">
                            Confirm Booking
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>

                    </form>

                </div>

            </div>

            <div class="col-lg-5">

                <div class="booking-summary-card">

                    <div class="booking-summary-image">
                        @if($package->image)
                            <img src="{{ travely_image_url($package->image) }}"
                                 alt="{{ $package->name }}">
                        @else
                            <img src="{{ asset('images/default-package.jpg') }}"
                                 alt="{{ $package->name }}">
                        @endif
                    </div>

                    <div class="booking-summary-content">

                        <span class="booking-category">
                            {{ $package->category }}
                        </span>

                        <h3>{{ $package->name }}</h3>

                        <p>
                            <i class="fa-solid fa-location-dot"></i>
                            {{ $package->destination }}
                        </p>

                        <div class="booking-summary-detail">
                            <span>Duration</span>
                            <strong>
                                {{ $package->duration_days }} Days /
                                {{ $package->duration_nights }} Nights
                            </strong>
                        </div>

                        <div class="booking-summary-detail">
                            <span>Price Per Person</span>
                            <strong>
                                ₹{{ number_format($package->discount_price ?? $package->price, 2) }}
                            </strong>
                        </div>

                        <div class="booking-summary-detail">
                            <span>Travellers</span>
                            <strong id="travellerCount">1 Person</strong>
                        </div>

                        <div class="booking-total">
                            <span>Estimated Total</span>
                            <h2 id="totalPrice">
                                ₹{{ number_format($package->discount_price ?? $package->price, 2) }}
                            </h2>
                        </div>

                        <div class="booking-secure-note">
                            <i class="fa-solid fa-shield-halved"></i>
                            Your booking details are securely submitted.
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const travellerInput = document.getElementById('travellers');
    const travellerCount = document.getElementById('travellerCount');
    const totalPrice = document.getElementById('totalPrice');

    const pricePerPerson = {{ (float) ($package->discount_price ?? $package->price) }};

    function updateBookingTotal() {

        let travellers = parseInt(travellerInput.value) || 1;

        if (travellers < 1) {
            travellers = 1;
        }

        travellerCount.textContent =
            travellers + (travellers === 1 ? ' Person' : ' People');

        totalPrice.textContent = '₹' +
            (pricePerPerson * travellers).toLocaleString('en-IN', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
    }

    travellerInput.addEventListener('input', updateBookingTotal);

    updateBookingTotal();

});
</script>

@endsection