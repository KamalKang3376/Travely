
@extends('layouts.app')

@section('title', 'Search Flights | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/flights.css') }}">
@endpush

@section('content')

<section class="flight-hero">
    <div class="container">
        <div class="flight-hero-content">
            <span class="flight-tag">TRAVEL WITH COMFORT</span>
            <h1>Find Your Perfect Flight</h1>
            <p>Explore available flights and book your next journey with Travely.</p>
        </div>
    </div>
</section>

<section class="flight-search-section">
    <div class="container">
        <form action="{{ route('flights.index') }}" method="GET" class="flight-search-form">
            <div class="row g-3 align-items-end">

                <div class="col-lg-3 col-md-6">
                    <label class="form-label">From</label>
                    <input type="text" name="departure_city" class="form-control"
                           placeholder="Departure city"
                           value="{{ request('departure_city') }}">
                </div>

                <div class="col-lg-3 col-md-6">
                    <label class="form-label">To</label>
                    <input type="text" name="arrival_city" class="form-control"
                           placeholder="Arrival city"
                           value="{{ request('arrival_city') }}">
                </div>

                <div class="col-lg-3 col-md-6">
                    <label class="form-label">Departure Date</label>
                    <input type="date" name="departure_date" class="form-control"
                           min="{{ now()->toDateString() }}"
                           value="{{ request('departure_date') }}">
                </div>

                <div class="col-lg-3 col-md-6">
                    <button type="submit" class="btn flight-search-btn w-100">
                        <i class="fa-solid fa-magnifying-glass me-2"></i>Search Flights
                    </button>
                </div>

            </div>
        </form>
    </div>
</section>

<section class="flight-listing-section py-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Available Flights</h2>
                <p class="text-muted mb-0">Choose a flight for your journey.</p>
            </div>

            <span class="flight-count">{{ $flights->total() }} Flights Found</span>
        </div>

        <div class="row g-4">

            @forelse($flights as $flight)
                <div class="col-lg-4 col-md-6">
                    <div class="flight-card">

                        @if($flight->image)
                            <img src="{{ travely_image_url($flight->image) }}"
                                 class="flight-card-image" alt="{{ $flight->airline }}">
                        @else
                            <div class="flight-card-placeholder">
                                <i class="fa-solid fa-plane"></i>
                            </div>
                        @endif

                        <div class="flight-card-body">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $flight->airline }}</h5>
                                    <small class="text-muted">{{ $flight->flight_number }}</small>
                                </div>

                                <span class="flight-class">{{ $flight->travel_class }}</span>
                            </div>

                            <div class="flight-route">
                                <div>
                                    <h4>{{ $flight->departure_time->format('h:i A') }}</h4>
                                    <span>{{ $flight->departure_city }}</span>
                                </div>

                                <div class="flight-route-icon">
                                    <i class="fa-solid fa-plane"></i>
                                    <div></div>
                                </div>

                                <div class="text-end">
                                    <h4>{{ $flight->arrival_time->format('h:i A') }}</h4>
                                    <span>{{ $flight->arrival_city }}</span>
                                </div>
                            </div>

                            <div class="flight-date">
                                <i class="fa-regular fa-calendar me-2"></i>
                                {{ $flight->departure_time->format('d M Y') }}
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <small class="text-muted">Starting from</small>
                                    <h4 class="flight-price mb-0">
                                        ₹{{ number_format($flight->price, 2) }}
                                    </h4>
                                    <small class="text-muted">Per passenger</small>
                                </div>

                                <a href="{{ route('flights.show', $flight->id) }}"
                                   class="btn flight-view-btn">
                                    View Details
                                </a>
                            </div>

                            <div class="flight-seats mt-3">
                                <i class="fa-solid fa-chair me-1"></i>
                                {{ $flight->available_seats }} seats available
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="flight-empty">
                        <i class="fa-solid fa-plane-slash"></i>
                        <h4>No Flights Found</h4>
                        <p>Try changing your search details or check again later.</p>
                        <a href="{{ route('flights.index') }}" class="btn flight-view-btn">
                            View All Flights
                        </a>
                    </div>
                </div>
            @endforelse

        </div>

        <div class="mt-4">
            {{ $flights->links() }}
        </div>

    </div>
</section>

@endsection
