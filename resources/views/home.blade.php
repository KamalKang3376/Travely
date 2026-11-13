@extends('layouts.app')

@section('title', 'Travely - Explore The World')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<section class="hero-section">
    <div class="container">
        <div class="hero-content">

            <span class="hero-tag" data-hero="tag">
                <i class="fa-solid fa-earth-americas me-2"></i>
                EXPLORE THE WORLD WITH TRAVELY
            </span>

            <h1 data-hero="title">
                Discover Your Next
                <span>Adventure</span>
            </h1>

            <p data-hero="description">
                Explore beautiful destinations, find amazing hotels
                and create unforgettable travel memories.
            </p>

            <a href="{{ url('/destinations') }}"
                class="btn btn-primary btn-lg hero-button"
                data-hero="button">
                Explore Destinations
                <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>

        </div>
    </div>

    <div class="hero-decoration hero-decoration-one"></div>
    <div class="hero-decoration hero-decoration-two"></div>
</section>

<section class="travel-marquee" aria-label="Travel inspiration">
    <div class="marquee-track">
        <div class="marquee-content">
            <span>Explore The World</span>
            <i class="fa-solid fa-plane"></i>
            <span>Discover New Places</span>
            <i class="fa-solid fa-globe"></i>
            <span>Create Beautiful Memories</span>
            <i class="fa-solid fa-camera"></i>
            <span>Your Journey Begins Here</span>
            <i class="fa-solid fa-compass"></i>
        </div>

        <div class="marquee-content" aria-hidden="true">
            <span>Explore The World</span>
            <i class="fa-solid fa-plane"></i>
            <span>Discover New Places</span>
            <i class="fa-solid fa-globe"></i>
            <span>Create Beautiful Memories</span>
            <i class="fa-solid fa-camera"></i>
            <span>Your Journey Begins Here</span>
            <i class="fa-solid fa-compass"></i>
        </div>
    </div>
</section>

@if($destinations->count() > 0)
<section class="travel-carousel-section">

    <div class="container">

        <div class="section-heading text-center" data-reveal="up">
            <span>YOUR NEXT JOURNEY</span>
            <h2>Explore The World</h2>
            <p>Find inspiration for your next unforgettable adventure.</p>
        </div>

        <div id="travelCarousel"
            class="carousel slide carousel-fade"
            data-bs-ride="carousel"
            data-bs-interval="4500">

            <div class="carousel-indicators">

                @foreach($destinations->take(5) as $index => $destination)
                    <button type="button"
                        data-bs-target="#travelCarousel"
                        data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}"
                        aria-label="Slide {{ $index + 1 }}">
                    </button>
                @endforeach

            </div>

            <div class="carousel-inner">

                @foreach($destinations->take(5) as $index => $destination)

                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">

                        @if($destination->image)
                            <img
                                src="{{ travely_image_url($destination->image) }}"
                                class="carousel-image"
                                alt="{{ $destination->name }}">
                        @else
                            <img
                                src="https://placehold.co/1400x650?text=Explore+Destination"
                                class="carousel-image"
                                alt="{{ $destination->name }}">
                        @endif

                        <div class="carousel-overlay"></div>

                        <div class="carousel-caption">
                            <span class="carousel-tag">
                                <i class="fa-solid fa-location-dot me-2"></i>
                                {{ $destination->country }}
                            </span>

                            <h2>{{ $destination->name }}</h2>

                            <p>Discover beautiful places and create memories that last forever.</p>

                            <a href="{{ route('destinations.show', $destination->slug) }}"
                                class="btn btn-light carousel-explore-btn">
                                Explore Destination
                                <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        </div>

                    </div>

                @endforeach

            </div>

            <button class="carousel-control-prev"
                type="button"
                data-bs-target="#travelCarousel"
                data-bs-slide="prev">

                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>

            </button>

            <button class="carousel-control-next"
                type="button"
                data-bs-target="#travelCarousel"
                data-bs-slide="next">

                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>

            </button>

        </div>

    </div>

</section>
@endif


<!-- WHY CHOOSE TRAVELY SECTION -->
<section class="why-travely-section">

    <div class="why-travely-overlay"></div>

    <div class="container position-relative">

        <div class="why-travely-heading text-center">
            <span>WHY CHOOSE TRAVELY</span>

            <h2>Travel With Confidence</h2>

            <p>
                We make every journey simple, comfortable and memorable.
            </p>
        </div>

        <div class="row g-4 mt-4">

            <div class="col-lg-3 col-md-6">
                <div class="why-travely-card">
                    <div class="why-travely-icon">
                        <i class="fa-solid fa-earth-americas"></i>
                    </div>

                    <h4>Best Destinations</h4>

                    <p>
                        Explore amazing places around the world.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="why-travely-card">
                    <div class="why-travely-icon">
                        <i class="fa-solid fa-hotel"></i>
                    </div>

                    <h4>Quality Hotels</h4>

                    <p>
                        Stay in comfort and style during your journey.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="why-travely-card">
                    <div class="why-travely-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>

                    <h4>Secure Booking</h4>

                    <p>
                        Your booking details and payments stay protected.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="why-travely-card">
                    <div class="why-travely-icon">
                        <i class="fa-solid fa-headset"></i>
                    </div>

                    <h4>24/7 Support</h4>

                    <p>
                        We're here to help you whenever you need us.
                    </p>
                </div>
            </div>

        </div>

    </div>

</section>

<section class="search-section">
    <div class="container">

        <div class="search-box" data-reveal="up">

            <form action="#" method="GET">

                <div class="row align-items-end gy-3">

                    <div class="col-lg-4 col-md-6">
                        <label>Where to go?</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-location-dot"></i>
                            </span>
                            <input type="text" class="form-control"
                                name="destination"
                                placeholder="Search destinations">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label>Check In</label>
                        <input type="date" name="check_in" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label>Guests</label>
                        <select name="guests" class="form-select">
                            <option value="1">1 Guest</option>
                            <option value="2" selected>2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                            <option value="5">5+ Guests</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <button type="submit" class="btn btn-primary w-100 search-button">
                            <i class="fa-solid fa-magnifying-glass me-1"></i>
                            Search
                        </button>
                    </div>

                </div>

            </form>

        </div>

    </div>
</section>

<section class="destination-section">

    <div class="container">

        <div class="section-heading text-center" data-reveal="up">
            <span>EXPLORE PLACES</span>
            <h2>Popular Destinations</h2>
            <p>Discover some of the world's most beautiful destinations.</p>
        </div>

       
<div class="row g-4">

    @forelse($destinations as $destination)

        <div class="col-xl-4 col-md-6"
             data-reveal="up"
             style="--card-index: {{ $loop->index }}">

            <div class="destination-card">

                @if($destination->image)
                    <img src="{{ travely_image_url($destination->image) }}"
                         alt="{{ $destination->name }}"
                         loading="lazy">
                @else
                    <img src="https://placehold.co/600x450?text=Destination"
                         alt="{{ $destination->name }}"
                         loading="lazy">
                @endif

                <div class="destination-top">
                    <span>
                        <i class="fa-solid fa-location-dot me-1"></i>
                        {{ $destination->country }}
                    </span>
                </div>

                <div class="destination-info">

                    <h4>{{ $destination->name }}</h4>

                    <div class="destination-bottom">

                        <div class="destination-price">
                            <small>Starting from</small>
                            <h5>₹{{ number_format($destination->starting_price) }}</h5>
                        </div>

                        <a href="{{ route('destinations.show', $destination->slug) }}"
                           class="destination-button">
                            Explore
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12 text-center">
            <p>No destinations available yet.</p>
        </div>

    @endforelse

</div>

        <div class="text-center mt-5" data-reveal="up">
            <a href="{{ route('destinations.index') }}"
                class="btn btn-primary view-destinations-button">
                View All Destinations
                <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>

    </div>

</section>

@endsection