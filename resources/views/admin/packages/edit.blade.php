@extends('layouts.admin.app')

@section('title', 'Edit Travel Package')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-packages.css') }}">
@endpush

@section('content')

<div class="admin-packages-page">

    <div class="admin-page-header">
        <div>
            <h2>Edit Travel Package</h2>
            <p>Update package information and pricing.</p>
        </div>

        <a href="{{ route('admin.packages.index') }}" class="admin-add-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Packages
        </a>
    </div>

    <div class="admin-package-form-card">

        <form action="{{ route('admin.packages.update', $package->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row g-4">

                <div class="col-md-6">
                    <label class="admin-form-label">Package Name *</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $package->name) }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="admin-form-label">Slug</label>
                    <input type="text" name="slug" class="form-control"
                           value="{{ old('slug', $package->slug) }}">
                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="admin-form-label">Destination *</label>
                    <input type="text" name="destination" class="form-control"
                           value="{{ old('destination', $package->destination) }}" required>
                    @error('destination') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="admin-form-label">Category *</label>
                    <select name="category" class="form-select" required>
                        @foreach(['Adventure', 'Family', 'Honeymoon', 'Luxury', 'Religious', 'Beach', 'Wildlife', 'Weekend Getaway'] as $category)
                            <option value="{{ $category }}"
                                @selected(old('category', $package->category) == $category)>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    @error('category') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3">
                    <label class="admin-form-label">Duration (Days) *</label>
                    <input type="number" name="duration_days" class="form-control"
                           value="{{ old('duration_days', $package->duration_days) }}"
                           min="1" required>
                    @error('duration_days') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3">
                    <label class="admin-form-label">Duration (Nights) *</label>
                    <input type="number" name="duration_nights" class="form-control"
                           value="{{ old('duration_nights', $package->duration_nights) }}"
                           min="0" required>
                    @error('duration_nights') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3">
                    <label class="admin-form-label">Original Price (₹) *</label>
                    <input type="number" name="price" class="form-control"
                           value="{{ old('price', $package->price) }}"
                           min="0" step="0.01" required>
                    @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3">
                    <label class="admin-form-label">Discount Price (₹)</label>
                    <input type="number" name="discount_price" class="form-control"
                           value="{{ old('discount_price', $package->discount_price) }}"
                           min="0" step="0.01">
                    @error('discount_price') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="admin-form-label">Maximum People *</label>
                    <input type="number" name="max_people" class="form-control"
                           value="{{ old('max_people', $package->max_people) }}"
                           min="1" required>
                    @error('max_people') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="admin-form-label">Change Package Image</label>
                    <input type="file" name="image" class="form-control"
                           accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted">JPG, PNG or WEBP. Maximum 2 MB.</small>
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                @if($package->image)
                    <div class="col-12">
                        <label class="admin-form-label">Current Image</label>
                        <div>
                            <img src="{{ asset('storage/' . $package->image) }}"
                                 alt="{{ $package->name }}"
                                 style="width:180px;height:110px;object-fit:cover;border-radius:8px;">
                        </div>
                    </div>
                @endif

                <div class="col-12">
                    <label class="admin-form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $package->description) }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="admin-form-label">Package Highlights</label>
                    <textarea name="highlights" class="form-control" rows="5">{{ old('highlights', implode(', ', $package->highlights ?? [])) }}</textarea>
                    <small class="text-muted">Separate each item with a comma.</small>
                    @error('highlights') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="admin-form-label">What's Included</label>
                    <textarea name="inclusions" class="form-control" rows="5">{{ old('inclusions', implode(', ', $package->inclusions ?? [])) }}</textarea>
                    <small class="text-muted">Separate each item with a comma.</small>
                    @error('inclusions') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="admin-form-label">What's Excluded</label>
                    <textarea name="exclusions" class="form-control" rows="5">{{ old('exclusions', implode(', ', $package->exclusions ?? [])) }}</textarea>
                    <small class="text-muted">Separate each item with a comma.</small>
                    @error('exclusions') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <div class="admin-package-checkbox">
                        <input type="checkbox" name="featured" value="1"
                               id="featured"
                               @checked(old('featured', $package->featured))>
                        <label for="featured">Featured Package</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="admin-package-checkbox">
                        <input type="checkbox" name="status" value="1"
                               id="status"
                               @checked(old('status', $package->status))>
                        <label for="status">Active Package</label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="admin-package-submit">
                        <i class="fa-solid fa-save"></i>
                        Update Package
                    </button>
                </div>

            </div>

        </form>

    </div>

</div>

@endsection