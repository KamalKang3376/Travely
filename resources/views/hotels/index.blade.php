
@extends('layouts.app')

@section('title', 'Hotels | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hotels.css') }}">
@endpush

@section('content')

<section class="hotel-banner">
    <div class="container">
        <span>STAY COMFORTABLY</span>
        <h1>Find Your Perfect Stay</h1>
        <p>Discover beautiful hotels for your next journey.</p>
    </div>
</section>

<section class="hotels-section">
    <div class="container">

        <div class="section-heading text-center mb-5">
            <span>OUR ACCOMMODATIONS</span>
            <h2>Popular Hotels</h2>
            <p>Choose your favourite hotel and book your stay with Travely.</p>
        </div>

        <div class="row g-4">

            @forelse($hotels as $hotel)

                <div class="col-lg-4 col-md-6">
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

        <div class="mt-5">
            {{ $hotels->links() }}
        </div>

    </div>
</section>

@endsection
