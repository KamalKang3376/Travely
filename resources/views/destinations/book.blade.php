
@extends('layouts.app')

@section('title', 'Book Destination | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/destination-booking.css') }}">
@endpush

@section('content')

<section class="booking-section">
    <div class="container">

        <div class="booking-heading">
            <span>PLAN YOUR JOURNEY</span>
            <h1>Book Your Destination</h1>
            <p>Complete your details and get ready for your next adventure.</p>
        </div>

        <div class="row g-4">

            <div class="col-lg-7">
                <div class="booking-form-card">

                    <h4 class="mb-4">Traveller Information</h4>

                    <form action="{{ route('destination-bookings.store', $destination->slug) }}"
                          method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text"
                                   name="customer_name"
                                   class="form-control"
                                   value="{{ old('customer_name', auth()->user()->name) }}"
                                   required>
                            @error('customer_name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="customer_email"
                                   class="form-control"
                                   value="{{ old('customer_email', auth()->user()->email) }}"
                                   required>
                            @error('customer_email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text"
                                   name="customer_phone"
                                   class="form-control"
                                   value="{{ old('customer_phone') }}">
                            @error('customer_phone')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Travel Start Date</label>
                                <input type="date"
                                       name="start_date"
                                       id="start_date"
                                       min="{{ date('Y-m-d') }}"
                                       value="{{ old('start_date') }}"
                                       class="form-control"
                                       required>
                                @error('start_date')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Travel End Date</label>
                                <input type="date"
                                       name="end_date"
                                       id="end_date"
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       value="{{ old('end_date') }}"
                                       class="form-control"
                                       required>
                                @error('end_date')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Number of Travellers</label>
                            <input type="number"
                                   name="travellers"
                                   id="travellers"
                                   class="form-control"
                                   min="1"
                                   max="20"
                                   value="{{ old('travellers', 1) }}"
                                   required>
                            @error('travellers')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="booking-total-box mb-4">
                            <span>Estimated Total Price</span>
                            <h3 id="totalPrice">
                                ₹{{ number_format((float) $destination->starting_price, 2) }}
                            </h3>
                            <small>
                                ₹{{ number_format((float) $destination->starting_price, 2) }}
                                per person
                            </small>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Confirm Destination Booking
                        </button>

                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="booking-hotel-summary">

                    @if($destination->image)
                        <img src="{{ asset('storage/' . $destination->image) }}"
                             alt="{{ $destination->name }}">
                    @endif

                    <div class="p-4">
                        <span class="text-muted">YOUR DESTINATION</span>

                        <h3 class="fw-bold mt-2">
                            {{ $destination->name }}
                        </h3>

                        <p class="text-muted">
                            <i class="fa-solid fa-location-dot me-2"></i>
                            {{ $destination->city }}, {{ $destination->country }}
                        </p>

                        <p>{{ Str::limit($destination->description, 150) }}</p>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <span>Price per person</span>
                            <strong>
                                ₹{{ number_format((float) $destination->starting_price, 2) }}
                            </strong>
                        </div>
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

    const travellerInput = document.getElementById('travellers');
    const totalPrice = document.getElementById('totalPrice');

    const pricePerPerson = {{ (float) $destination->starting_price }};

    function calculateTotal() {
        let travellers = parseInt(travellerInput.value) || 1;

        if (travellers < 1) travellers = 1;
        if (travellers > 20) travellers = 20;

        totalPrice.textContent = '₹' + (pricePerPerson * travellers)
            .toLocaleString('en-IN', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
    }

    travellerInput.addEventListener('input', calculateTotal);

    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');

    startDate.addEventListener('change', function () {
        if (startDate.value) {
            const nextDay = new Date(startDate.value + 'T00:00:00');
            nextDay.setDate(nextDay.getDate() + 1);

            const minimumEndDate = [
                nextDay.getFullYear(),
                String(nextDay.getMonth() + 1).padStart(2, '0'),
                String(nextDay.getDate()).padStart(2, '0')
            ].join('-');

            endDate.min = minimumEndDate;

            if (endDate.value && endDate.value < minimumEndDate) {
                endDate.value = '';
            }
        }
    });

    calculateTotal();
});
</script>
@endpush
