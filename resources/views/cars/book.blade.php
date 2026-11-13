 @extends('layouts.app')

@section('title', 'Book ' . $car->name . ' - Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/car-booking-form.css') }}">
@endpush

@section('content')

<section class="rental-booking-section">
    <div class="container">

        <a href="{{ route('cars.show', $car->slug) }}" class="booking-back-link">
            <i class="fas fa-arrow-left"></i> Back to Car Details
        </a>

        <div class="booking-heading">
            <span>RESERVE YOUR RIDE</span>
            <h1>Car Rental Booking</h1>
            <p>Complete your details and get ready for your journey.</p>
        </div>

        <div class="row g-4">

            <div class="col-lg-8">
                <div class="rental-form-card">

                    <form action="{{ route('cars.booking.store', $car->slug) }}"
                          method="POST">
                        @csrf

                        <h4>Customer Information</h4>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label>Full Name</label>
                                <input type="text" name="customer_name"
                                       class="form-control"
                                       value="{{ old('customer_name', auth()->user()->name) }}"
                                       required>
                                @error('customer_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>Email Address</label>
                                <input type="email" name="customer_email"
                                       class="form-control"
                                       value="{{ old('customer_email', auth()->user()->email) }}"
                                       required>
                                @error('customer_email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label>Phone Number</label>
                                <input type="text" name="customer_phone"
                                       class="form-control"
                                       value="{{ old('customer_phone') }}"
                                       required>
                                @error('customer_phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <hr>

                        <h4>Rental Information</h4>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label>Pickup Date & Time</label>
                                <input type="datetime-local"
                                       name="pickup_datetime"
                                       id="pickup_datetime"
                                       class="form-control"
                                       min="{{ now()->format('Y-m-d\TH:i') }}"
                                       value="{{ old('pickup_datetime') }}"
                                       required>
                                @error('pickup_datetime')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>Return Date & Time</label>
                                <input type="datetime-local"
                                       name="return_datetime"
                                       id="return_datetime"
                                       class="form-control"
                                       value="{{ old('return_datetime') }}"
                                       required>
                                @error('return_datetime')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>Pickup Location</label>
                                <input type="text" name="pickup_location"
                                       class="form-control"
                                       value="{{ old('pickup_location') }}"
                                       placeholder="Enter pickup location"
                                       required>
                                @error('pickup_location')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>Drop-off Location</label>
                                <input type="text" name="dropoff_location"
                                       class="form-control"
                                       value="{{ old('dropoff_location') }}"
                                       placeholder="Enter drop-off location"
                                       required>
                                @error('dropoff_location')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <div class="rental-estimate">
                            <span>Estimated Rental Days</span>
                            <strong id="rental_days">0 Days</strong>
                        </div>

                        <button type="submit" class="rental-submit-btn">
                            Confirm Booking <i class="fas fa-arrow-right"></i>
                        </button>

                    </form>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="rental-summary-card">

                    @if($car->image)
                        <img src="{{ travely_image_url($car->image) }}"
                             alt="{{ $car->name }}">
                    @endif

                    <span>{{ $car->category }}</span>
                    <h4>{{ $car->name }}</h4>

                    <div class="summary-info">
                        <span>Brand</span>
                        <strong>{{ $car->brand }}</strong>
                    </div>

                    <div class="summary-info">
                        <span>Seats</span>
                        <strong>{{ $car->seats }}</strong>
                    </div>

                    <div class="summary-info">
                        <span>Transmission</span>
                        <strong>{{ $car->transmission }}</strong>
                    </div>

                    <div class="summary-price">
                        <span>Price per day</span>
                        <strong>₹{{ number_format($car->price_per_day) }}</strong>
                    </div>

                    <p><i class="fas fa-shield-alt"></i> Secure booking with Travely</p>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const pickup = document.getElementById('pickup_datetime');
    const returnDate = document.getElementById('return_datetime');
    const daysDisplay = document.getElementById('rental_days');

    function updateRentalDays() {
        if (!pickup.value || !returnDate.value) {
            daysDisplay.textContent = '0 Days';
            return;
        }

        const start = new Date(pickup.value);
        const end = new Date(returnDate.value);

        if (end <= start) {
            daysDisplay.textContent = 'Invalid dates';
            return;
        }

        const difference = end - start;
        const days = Math.ceil(difference / (1000 * 60 * 60 * 24));

        daysDisplay.textContent = days + (days === 1 ? ' Day' : ' Days');
    }

    pickup.addEventListener('change', function () {
        returnDate.min = pickup.value;
        updateRentalDays();
    });

    returnDate.addEventListener('change', updateRentalDays);

    if (pickup.value) {
        returnDate.min = pickup.value;
    }

    updateRentalDays();
});
</script>
@endpush