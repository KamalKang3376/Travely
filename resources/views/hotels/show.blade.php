
@extends('layouts.app')

@section('title', $hotel->name . ' | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hotels.css') }}">
@endpush

@section('content')

<section class="hotel-detail-section">
    <div class="container py-5">

        <a href="{{ route('hotels.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Hotels
        </a>

        <div class="row g-4 mt-3">

            <div class="col-lg-7">
                @if($hotel->image)
                    <img src="{{ asset('storage/'.$hotel->image) }}"
                         class="hotel-detail-image"
                         alt="{{ $hotel->name }}">
                @else
                    <img src="https://placehold.co/900x600?text=Hotel"
                         class="hotel-detail-image"
                         alt="Hotel image">
                @endif
            </div>

            <div class="col-lg-5">
                <div class="hotel-detail-content">

                    <p class="hotel-location">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $hotel->city }}, {{ $hotel->country }}
                    </p>

                    <h1>{{ $hotel->name }}</h1>

                    <p class="hotel-rating">
                        <i class="fas fa-star"></i>
                        {{ number_format($hotel->rating, 1) }} / 5
                    </p>

                    <h3 class="hotel-price">
                        ₹{{ number_format($hotel->price_per_night) }}
                        <small>/ night</small>
                    </h3>

                    <hr>

                    <h5>About This Hotel</h5>
                    <p>{{ $hotel->description ?: 'Enjoy a comfortable stay at this hotel.' }}</p>

                    @if($hotel->address)
                        <p><strong>Address:</strong> {{ $hotel->address }}</p>
                    @endif

                    <h5 class="mt-4">Facilities</h5>

                    @if($hotel->facilities)
                        <div class="hotel-facilities">
                            @foreach($hotel->facilities as $facility)
                                <span>
                                    <i class="fas fa-check-circle"></i>
                                    {{ $facility }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Facilities information not available.</p>
                    @endif

                </div>
            </div>

        </div>

    </div>
</section>

@endsection
