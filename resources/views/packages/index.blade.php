@extends('layouts.app')

@section('title', 'Travel Packages | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/packages.css') }}">
@endpush

@section('content')

<section class="packages-hero">
    <div class="container">
        <div class="packages-hero-content">
            <span>EXPLORE THE WORLD</span>
            <h1>Find Your Perfect<br>Travel Package</h1>
            <p>Discover amazing destinations and create unforgettable memories.</p>
        </div>
    </div>
</section>

<section class="packages-section">
    <div class="container">

        <div class="packages-heading">
            <div>
                <span class="section-label">OUR PACKAGES</span>
                <h2>Explore Our Best Packages</h2>
                <p>Choose your next adventure from our handpicked travel experiences.</p>
            </div>
        </div>

        <div class="row g-4">

            @forelse($packages as $package)

                <div class="col-lg-4 col-md-6">

                    <div class="package-card">

                        <div class="package-image">
                            <img
                                src="{{ $package->image ? asset('storage/' . $package->image) : asset('images/default-package.jpg') }}"
                                alt="{{ $package->name }}"
                            >

                            @if($package->featured)
                                <span class="package-featured">Featured</span>
                            @endif

                            <span class="package-duration">
                                {{ $package->duration_days }} Days / {{ $package->duration_nights }} Nights
                            </span>
                        </div>

                        <div class="package-content">

                            <span class="package-category">
                                {{ $package->category }}
                            </span>

                            <h3>{{ $package->name }}</h3>

                            <p class="package-destination">
                                <i class="fa-solid fa-location-dot"></i>
                                {{ $package->destination }}
                            </p>

                            <p class="package-description">
                                {{ Str::limit($package->description, 100) }}
                            </p>

                            <div class="package-bottom">

                                <div class="package-price">
                                    @if($package->discount_price)
                                        <del>₹{{ number_format($package->price, 0) }}</del>
                                        <h4>₹{{ number_format($package->discount_price, 0) }}</h4>
                                    @else
                                        <h4>₹{{ number_format($package->price, 0) }}</h4>
                                    @endif

                                    <small>Per person</small>
                                </div>

                                <a href="{{ route('packages.show', $package->slug) }}"
                                   class="package-btn">
                                    View Details
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="packages-empty">
                        <i class="fa-solid fa-suitcase-rolling"></i>
                        <h3>No Packages Available</h3>
                        <p>Our exciting travel packages will be available soon.</p>
                    </div>
                </div>

            @endforelse

        </div>

        <div class="packages-pagination">
            {{ $packages->links() }}
        </div>

    </div>
</section>

@endsection