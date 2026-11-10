@extends('layouts.app')

@section('title', $package->name . ' | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/packages.css') }}">
@endpush

@section('content')

<section class="package-detail-hero"
    style="background-image: linear-gradient(rgba(0,35,40,.65), rgba(0,35,40,.65)), url('{{ $package->image ? asset('storage/' . $package->image) : asset('images/default-package.jpg') }}');">

    <div class="container">
        <div class="package-detail-hero-content">
            <span>{{ $package->category }}</span>
            <h1>{{ $package->name }}</h1>

            <p>
                <i class="fa-solid fa-location-dot"></i>
                {{ $package->destination }}
            </p>

            <div class="package-detail-duration">
                <i class="fa-regular fa-clock"></i>
                {{ $package->duration_days }} Days / {{ $package->duration_nights }} Nights
            </div>
        </div>
    </div>

</section>

<section class="package-detail-section">
    <div class="container">

        <div class="row g-5">

            <div class="col-lg-8">

                <div class="package-detail-card">

                    <h2>About This Package</h2>

                    <p class="package-detail-description">
                        {{ $package->description }}
                    </p>

                    @if($package->highlights)
                        <div class="package-detail-block">
                            <h3><i class="fa-solid fa-star"></i> Package Highlights</h3>

                            <ul class="package-detail-list">
                                @foreach($package->highlights as $highlight)
                                    <li>
                                        <i class="fa-solid fa-check"></i>
                                        {{ $highlight }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($package->inclusions)
                        <div class="package-detail-block">
                            <h3><i class="fa-solid fa-circle-check"></i> What's Included</h3>

                            <ul class="package-detail-list">
                                @foreach($package->inclusions as $inclusion)
                                    <li>
                                        <i class="fa-solid fa-check"></i>
                                        {{ $inclusion }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($package->exclusions)
                        <div class="package-detail-block">
                            <h3><i class="fa-solid fa-circle-xmark"></i> What's Not Included</h3>

                            <ul class="package-detail-list exclusion-list">
                                @foreach($package->exclusions as $exclusion)
                                    <li>
                                        <i class="fa-solid fa-xmark"></i>
                                        {{ $exclusion }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>

            </div>

            <div class="col-lg-4">

                <div class="package-booking-card">

                    <span class="package-booking-label">PACKAGE PRICE</span>

                    @if($package->discount_price)
                        <del>₹{{ number_format($package->price, 0) }}</del>
                        <h2>₹{{ number_format($package->discount_price, 0) }}</h2>
                    @else
                        <h2>₹{{ number_format($package->price, 0) }}</h2>
                    @endif

                    <p>Per person</p>

                    <hr>

                    <div class="package-booking-info">
                        <span><i class="fa-solid fa-calendar-days"></i> Duration</span>
                        <strong>{{ $package->duration_days }} Days</strong>
                    </div>

                    <div class="package-booking-info">
                        <span><i class="fa-solid fa-moon"></i> Nights</span>
                        <strong>{{ $package->duration_nights }} Nights</strong>
                    </div>

                    <div class="package-booking-info">
                        <span><i class="fa-solid fa-users"></i> Max People</span>
                        <strong>{{ $package->max_people }}</strong>
                    </div>

                    <div class="package-booking-info">
                        <span><i class="fa-solid fa-location-dot"></i> Destination</span>
                        <strong>{{ $package->destination }}</strong>
                    </div>

                    <a href="{{ route('packages.booking.create', $package->slug) }}"
                        class="package-book-now">
                            <i class="fa-solid fa-calendar-check"></i>
                            Book This Package
                    </a>

                    <small class="package-booking-note">
                        Online booking will be available soon.
                    </small>

                </div>

            </div>

        </div>

        @if($relatedPackages->count() > 0)

            <div class="related-packages">

                <h2>Related Packages</h2>

                <div class="row g-4">

                    @foreach($relatedPackages as $related)

                        <div class="col-lg-4 col-md-6">

                            <div class="package-card">

                                <div class="package-image">
                                    <img
                                        src="{{ $related->image ? asset('storage/' . $related->image) : asset('images/default-package.jpg') }}"
                                        alt="{{ $related->name }}"
                                    >
                                </div>

                                <div class="package-content">

                                    <h3>{{ $related->name }}</h3>

                                    <p class="package-destination">
                                        <i class="fa-solid fa-location-dot"></i>
                                        {{ $related->destination }}
                                    </p>

                                    <div class="package-bottom">

                                        <div class="package-price">
                                            <h4>
                                                ₹{{ number_format($related->discount_price ?? $related->price, 0) }}
                                            </h4>
                                            <small>Per person</small>
                                        </div>

                                        <a href="{{ route('packages.show', $related->slug) }}"
                                           class="package-btn">
                                            View Details
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

    </div>
</section>

@endsection