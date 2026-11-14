
@extends('layouts.app')

@section('title', 'Hotels | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hotels.css') }}">
@endpush

@section('content')

<section class="hotel-banner">
    <div class="container" data-reveal="up">
        <span>STAY COMFORTABLY</span>
        <h1>Find Your Perfect Stay</h1>
        <p>Discover beautiful hotels for your next journey.</p>
    </div>
</section>


<section class="hotel-search-section">
    <div class="container" >
        <form action="{{ route('hotels.index') }}" method="GET"
              class="hotel-search-form">

            <div class="hotel-search-field">
                <label for="hotel-search">Hotel or Destination</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-location-dot"></i>
                    </span>
                    <input type="text"
                           id="hotel-search"
                           name="search"
                           class="form-control"
                           placeholder="Search hotel or city"
                           value="">
                </div>
            </div>

            <div class="hotel-search-field">
                <label for="check-in">Check In</label>
                <input type="date"
                       id="check-in"
                       name="check_in"
                       class="form-control"
                       min="{{ date('Y-m-d') }}"
                       value="{{ request('check_in') }}">
            </div>

            <div class="hotel-search-field">
                <label for="check-out">Check Out</label>
                <input type="date"
                       id="check-out"
                       name="check_out"
                       class="form-control"
                       min="{{ date('Y-m-d') }}"
                       value="{{ request('check_out') }}">
            </div>

            <div class="hotel-search-field">
                <label for="guests">Guests</label>
                <select id="guests" name="guests" class="form-select">
                    @foreach(range(1, 10) as $guest)
                        <option value="{{ $guest }}">
                            {{ $guest }} {{ $guest == 1 ? 'Guest' : 'Guests' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="hotel-search-btn">
                <i class="fa-solid fa-magnifying-glass me-2"></i>
                Search
            </button>

        </form>
    </div>
</section>

@if($hasFilters)
    <div class="container text-end mt-3" data-reveal="up">
        <a href="{{ route('hotels.index') }}"
           class="btn btn-outline-success">
            <i class="fa-solid fa-list me-2"></i>
            View All Hotels
        </a>
    </div>
@endif

<section class="hotels-section">
    <div class="container">

        <div class="section-heading text-center mb-5" data-reveal="up">
            <span>OUR ACCOMMODATIONS</span>
            <h2>Popular Hotels</h2>
            <p>Choose your favourite hotel and book your stay with Travely.</p>
        </div>

        <div class="row g-4">

            @forelse($hotels as $hotel)

                <div class="col-lg-4 col-md-6" data-reveal="up">
                    <div class="hotel-card">

                        <div class="hotel-image">

                            @if($hotel->image)
                                <img src="{{ travely_image_url($hotel->image) }}"
                                     alt="{{ $hotel->name }}">
                            @else
                                <img src="https://placehold.co/600x400?text=Hotel"
                                     alt="Hotel image">
                            @endif

                            <span class="hotel-rating">
                                <i class="fas fa-star"></i>
                                {{ number_format((float) $hotel->rating, 1) }}
                            </span>

                        </div>

                        <div class="hotel-content">

                            <p class="hotel-location">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $hotel->city }}, {{ $hotel->country }}
                            </p>

                            <h3>{{ $hotel->name }}</h3>

                            <p class="hotel-description">
                                {{ Str::limit($hotel->description, 100) }}
                            </p>

                            <div class="hotel-bottom">

                                <div>
                                    <strong>₹{{ number_format((float) $hotel->price_per_night) }}</strong>
                                    <span>/ night</span>
                                </div>

                            </div>

                            <div class="hotel-card-actions">

                                <a href="{{ route('hotels.show', $hotel->slug) }}"
                                   class="btn hotel-details-btn">
                                    View Details
                                </a>

                                <a href="{{ route('hotel-bookings.create', $hotel->slug) }}"
                                   class="btn hotel-book-now-btn">
                                    <i class="fa-solid fa-calendar-check me-1"></i>
                                    Book Now
                                </a>

                            </div>

                        </div>

                    </div>
                </div>

            @empty

                <div class="col-12 text-center py-5">
                    <h4>No hotels available yet.</h4>
                    <p>Check back soon for new hotel listings.</p>
                </div>

            @endforelse

        </div>

        <div class="mt-5" data-reveal="up">
            {{ $hotels->links() }}
        </div>

    </div>
</section>

@endsection
