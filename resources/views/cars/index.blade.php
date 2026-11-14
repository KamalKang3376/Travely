 @extends('layouts.app')

@section('title', 'Car Rentals - Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/cars.css') }}">
@endpush

@section('content')

<section class="car-hero">
    <div class="container"data-reveal="up">
        <div class="car-hero-content">
            <span class="car-tag">EXPLORE WITH FREEDOM</span>
            <h1>Find Your Perfect<br>Rental Car</h1>
            <p>Discover new destinations with comfort, convenience and complete freedom.</p>
        </div>
    </div>
</section>



<section class="car-search-section">
    <div class="container">
        <form action="{{ route('cars.index') }}" method="GET"
              class="car-search-form">

            <div class="car-search-field">
                <label for="car-search">Car Name</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-car"></i>
                    </span>
                    <input
                        type="text"
                        id="car-search"
                        name="search"
                        class="form-control"
                        placeholder="Search by car name">
                </div>
            </div>

            <div class="car-search-field">
                <label for="car-seats">Number of Seats</label>
                <select id="car-seats" name="seats" class="form-select">
                    <option value="">All Seats</option>
                    @foreach($seatOptions as $seat)
                        <option value="{{ $seat }}">
                            {{ $seat }} Seats
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="car-search-btn">
                <i class="fa-solid fa-magnifying-glass me-2"></i>
                Search Cars
            </button>

        </form>
    </div>
</section>

@if($hasFilters)
    <div class="car-view-all-wrapper">
        <a href="{{ route('cars.index') }}"
           class="btn btn-outline-success">
            <i class="fa-solid fa-list me-2"></i>
            View All Cars
        </a>
    </div>
@endif


<section class="car-listing-section">
    <div class="container"data-reveal="up">

        <div class="car-section-heading">
            <span>OUR RENTAL FLEET</span>
            <h2>Choose Your Ride</h2>
            <p>Find the perfect vehicle for your next journey.</p>
        </div>

        <div class="row g-4">

            @forelse($cars as $car)
                <div class="col-lg-4 col-md-6">
                    <div class="car-card">

                        <div class="car-image">
                            @if($car->image)
                                <img src="{{ travely_image_url($car->image) }}"
                                     alt="{{ $car->name }}">
                            @else
                                <div class="car-no-image">
                                    <i class="fas fa-car"></i>
                                </div>
                            @endif

                            <span class="car-category">
                                {{ $car->category }}
                            </span>
                        </div>

                        <div class="car-card-body">

                            <div class="car-title-row">
                                <div>
                                    <h4>{{ $car->name }}</h4>
                                    <p>{{ $car->brand }} {{ $car->model }}</p>
                                </div>
                                <div class="car-price">
                                    <strong>₹{{ number_format($car->price_per_day) }}</strong>
                                    <span>/ day</span>
                                </div>
                            </div>

                            <div class="car-features">
                                <span><i class="fas fa-users"></i> {{ $car->seats }} Seats</span>
                                <span><i class="fas fa-cog"></i> {{ $car->transmission }}</span>
                                <span><i class="fas fa-gas-pump"></i> {{ $car->fuel_type }}</span>
                            </div>

                            <a href="{{ route('cars.show', $car->slug) }}"
                               class="car-details-btn">
                                View Details <i class="fas fa-arrow-right"></i>
                            </a>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="car-empty">
                        <i class="fas fa-car-side"></i>
                        <h4>No Rental Cars Available</h4>
                        <p>Please check back later for available cars.</p>
                    </div>
                </div>
            @endforelse

        </div>

        <div class="car-pagination"data-reveal="up">
            {{ $cars->links() }}
        </div>

    </div>
</section>

@endsection