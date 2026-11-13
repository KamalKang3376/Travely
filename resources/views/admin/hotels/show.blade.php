
@extends('layouts.app')

@section('title', $hotel->name . ' | Travely')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/hotels.css') }}">
@endpush

@section('content')

<section class="hotel-details-page">
    <div class="container">

        <div class="hotel-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <a href="{{ route('hotels.index') }}">Hotels</a>
            <span>/</span>
            <span>{{ $hotel->name }}</span>
        </div>

        <div class="hotel-details-card">

            @if($hotel->image)
                <div class="hotel-details-image">
                    <img src="{{ travely_image_url($hotel->image) }}"
                         alt="{{ $hotel->name }}">
                </div>
            @endif

            <div class="hotel-details-content">

                <div class="hotel-details-heading">
                    <div>
                        <span class="hotel-location">
                            <i class="fa-solid fa-location-dot"></i>
                            {{ $hotel->city }}, {{ $hotel->country }}
                        </span>

                        <h1>{{ $hotel->name }}</h1>

                        <div class="hotel-rating">
                            <i class="fa-solid fa-star"></i>
                            {{ number_format((float) $hotel->rating, 1) }} / 5
                        </div>
                    </div>

                    <div class="hotel-details-price">
                        <strong>₹{{ number_format((float) $hotel->price_per_night, 2) }}</strong>
                        <span>Per night / room</span>
                    </div>
                </div>

                <hr>

                <h4>About This Hotel</h4>

                <p class="hotel-description">
                    {{ $hotel->description ?: 'Enjoy a comfortable and memorable stay at this hotel.' }}
                </p>

                @if($hotel->address)
                    <div class="hotel-address">
                        <h5>Hotel Address</h5>
                        <p>
                            <i class="fa-solid fa-map-marker-alt"></i>
                            {{ $hotel->address }}
                        </p>
                    </div>
                @endif

                @if($hotel->facilities && count($hotel->facilities))
                    <div class="hotel-facilities">
                        <h4>Hotel Facilities</h4>

                        <div class="facility-list">
                            @foreach($hotel->facilities as $facility)
                                <span>
                                    <i class="fa-solid fa-check"></i>
                                    {{ $facility }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="hotel-booking-action">
                    <a href="{{ route('hotel-bookings.create', $hotel->slug) }}"
                       class="btn booking-submit">
                        <i class="fa-solid fa-calendar-check me-2"></i>
                        Book Now
                    </a>

                    <a href="{{ route('hotels.index') }}"
                       class="btn btn-outline-secondary">
                        Back to Hotels
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
