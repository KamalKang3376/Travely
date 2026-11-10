
@extends('layouts.app')

@section('title', 'Edit Hotel | Travely')

@section('content')
<div class="container py-5">

    <h2 class="fw-bold mb-4">Edit Hotel</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('admin.hotels.update', $hotel) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Hotel Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $hotel->name) }}" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control"
                               value="{{ old('city', $hotel->city) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control"
                               value="{{ old('country', $hotel->country) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control"
                               value="{{ old('address', $hotel->address) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Price Per Night (₹)</label>
                        <input type="number" name="price_per_night"
                               class="form-control" min="0" step="0.01"
                               value="{{ old('price_per_night', $hotel->price_per_night) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Rating (0–5)</label>
                        <input type="number" name="rating" class="form-control"
                               min="0" max="5" step="0.1"
                               value="{{ old('rating', $hotel->rating) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="4"
                                  class="form-control">{{ old('description', $hotel->description) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Hotel Facilities</label>

                        @php
                            $selectedFacilities = old('facilities', $hotel->facilities ?? []);
                        @endphp

                        <div class="row">
                            @foreach(['Free WiFi', 'Swimming Pool', 'Restaurant', 'Parking', 'Gym', 'Spa', 'Air Conditioning', 'Airport Transfer'] as $facility)
                                <div class="col-md-3 col-6 mb-2">
                                    <label>
                                        <input type="checkbox" name="facilities[]"
                                               value="{{ $facility }}"
                                               @checked(in_array($facility, $selectedFacilities))>
                                        {{ $facility }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Current Image</label><br>

                        @if($hotel->image)
                            <img src="{{ asset('storage/'.$hotel->image) }}"
                                 width="150" height="100"
                                 style="object-fit: cover; border-radius: 8px;"
                                 class="mb-3">
                        @else
                            <p class="text-muted">No image uploaded.</p>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Change Hotel Image</label>
                        <input type="file" name="image"
                               class="form-control" accept="image/*">
                        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="1" @selected(old('status', $hotel->status ? '1' : '0') == '1')>Active</option>
                            <option value="0" @selected(old('status', $hotel->status ? '1' : '0') == '0')>Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        Update Hotel
                    </button>

                    <a href="{{ route('admin.hotels.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
