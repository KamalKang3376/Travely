@extends('layouts.admin.app')

@section('title', 'Add New Car')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-cars.css') }}">
@endpush

@section('content')
<div class="admin-cars-page">

    <div class="page-header">
        <div>
            <h2>Add New Car</h2>
            <p>Add a rental car to your Travely website.</p>
        </div>

        <a href="{{ route('admin.cars.index') }}" class="btn-add-car">
            <i class="fas fa-arrow-left"></i> Back to Cars
        </a>
    </div>

    <div class="car-form-card">
        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label>Car Name *</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name') }}" placeholder="Toyota Fortuner" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label>Brand *</label>
                    <input type="text" name="brand" class="form-control"
                           value="{{ old('brand') }}" placeholder="Toyota" required>
                    @error('brand') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label>Model *</label>
                    <input type="text" name="model" class="form-control"
                           value="{{ old('model') }}" placeholder="Fortuner 2025" required>
                    @error('model') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control"
                           value="{{ old('slug') }}" placeholder="toyota-fortuner">
                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label>Category *</label>
                    <select name="category" class="form-select" required>
                        <option value="">Select Category</option>
                        @foreach(['SUV', 'Sedan', 'Hatchback', 'Luxury', 'MUV', 'Electric'] as $category)
                            <option value="{{ $category }}" @selected(old('category') == $category)>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    @error('category') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label>Transmission *</label>
                    <select name="transmission" class="form-select" required>
                        @foreach(['Manual', 'Automatic'] as $transmission)
                            <option value="{{ $transmission }}" @selected(old('transmission', 'Manual') == $transmission)>
                                {{ $transmission }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Fuel Type *</label>
                    <select name="fuel_type" class="form-select" required>
                        @foreach(['Petrol', 'Diesel', 'Electric', 'Hybrid', 'CNG'] as $fuel)
                            <option value="{{ $fuel }}" @selected(old('fuel_type', 'Petrol') == $fuel)>
                                {{ $fuel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Number of Seats *</label>
                    <input type="number" name="seats" class="form-control"
                           value="{{ old('seats', 5) }}" min="1" max="20" required>
                    @error('seats') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label>Price Per Day (₹) *</label>
                    <input type="number" name="price_per_day" class="form-control"
                           value="{{ old('price_per_day') }}" min="0" step="0.01" required>
                    @error('price_per_day') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label>Car Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-12">
                    <label>Features</label>
                    <input type="text" name="features" class="form-control"
                           value="{{ old('features') }}"
                           placeholder="Air Conditioning, GPS, Bluetooth, USB">
                    <small class="text-muted">Separate features with commas.</small>
                </div>

                <div class="col-12">
                    <label>Description</label>
                    <textarea name="description" rows="4" class="form-control"
                              placeholder="Enter car description...">{{ old('description') }}</textarea>
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="status" value="1"
                               class="form-check-input" id="carStatus"
                               @checked(old('status', '1') == '1')>
                        <label class="form-check-label" for="carStatus">
                            Active (visible on website)
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn-save-car">
                        <i class="fas fa-save"></i> Save Car
                    </button>
                </div>

            </div>
        </form>
    </div>

</div>
@endsection