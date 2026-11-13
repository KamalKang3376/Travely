 @extends('layouts.app')

@section('title', $car->name . ' - Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/cars.css') }}">
@endpush

@section('content')

<section class="car-details-section">
    <div class="container">

        <a href="{{ route('cars.index') }}" class="back-cars-link">
            <i class="fas fa-arrow-left"></i> Back to Rental Cars
        </a>

        <div class="row g-5 align-items-start">

            <div class="col-lg-7">
                <div class="car-details-image">
                    @if($car->image)
                        <img src="{{ travely_image_url($car->image) }}"
                             alt="{{ $car->name }}">
                    @else
                        <div class="car-details-placeholder">
                            <i class="fas fa-car"></i>
                        </div>
                    @endif
                </div>

                <div class="car-description">
                    <h3>About This Car</h3>
                    <p>{{ $car->description ?: 'Enjoy a comfortable and convenient journey with this rental car.' }}</p>

                    <h3>Car Features</h3>

                    <div class="row g-3">
                        @forelse($car->features ?? [] as $feature)
                            <div class="col-md-6">
                                <div class="car-feature-item">
                                    <i class="fas fa-check-circle"></i>
                                    {{ $feature }}
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">No additional features listed.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="car-details-card">

                    <span class="car-details-category">{{ $car->category }}</span>

                    <h1>{{ $car->name }}</h1>

                    <p class="car-details-brand">
                        {{ $car->brand }} {{ $car->model }}
                    </p>

                    <div class="car-details-price">
                        <strong>₹{{ number_format($car->price_per_day) }}</strong>
                        <span>/ day</span>
                    </div>

                    <hr>

                    <h5>Vehicle Information</h5>

                    <div class="car-info-row">
                        <span><i class="fas fa-users"></i> Seating Capacity</span>
                        <strong>{{ $car->seats }} Persons</strong>
                    </div>

                    <div class="car-info-row">
                        <span><i class="fas fa-cog"></i> Transmission</span>
                        <strong>{{ $car->transmission }}</strong>
                    </div>

                    <div class="car-info-row">
                        <span><i class="fas fa-gas-pump"></i> Fuel Type</span>
                        <strong>{{ $car->fuel_type }}</strong>
                    </div>

                    <div class="car-info-row">
                        <span><i class="fas fa-car"></i> Category</span>
                        <strong>{{ $car->category }}</strong>
                    </div>

                    <hr>

                    @auth
                        <a href="{{ route('cars.book', $car->slug) }}"
                           class="car-booking-btn">
                            Book This Car <i class="fas fa-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="car-booking-btn">
                            Login to Book <i class="fas fa-arrow-right"></i>
                        </a>
                        <p class="car-login-note">
                            Please login before booking a rental car.
                        </p>
                    @endauth

                    <div class="car-booking-note">
                        <i class="fas fa-shield-alt"></i>
                        Secure booking with Travely
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection