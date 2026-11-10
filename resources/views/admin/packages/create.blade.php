@extends('layouts.admin.app')

@section('title', 'Add Travel Package')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-packages.css') }}">
@endpush

@section('content')

<div class="admin-packages-page">

    <div class="admin-page-header">
        <div>
            <h2>Add New Package</h2>
            <p>Add a new travel package to your website.</p>
        </div>

        <a href="{{ route('admin.packages.index') }}" class="admin-add-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Packages
        </a>
    </div>

    <div class="admin-package-form-card">

        <form action="{{ route('admin.packages.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row g-4">

                <div class="col-md-6">
                    <label class="admin-form-label">Package Name *</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name') }}"
                           placeholder="e.g. Manali Adventure Tour" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="admin-form-label">Slug</label>
                    <input type="text" name="slug" class="form-control"
                           value="{{ old('slug') }}"
                           placeholder="Leave blank to generate automatically">
                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="admin-form-label">Destination *</label>
                    <input type="text" name="destination" class="form-control"
                           value="{{ old('destination') }}"
                           placeholder="e.g. Manali, Himachal Pradesh" required>
                    @error('destination') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="admin-form-label">Category *</label>
                    <select name="category" class="form-select" required>
                        <option value="">Select Category</option>
                        @foreach(['Adventure', 'Family', 'Honeymoon', 'Luxury', 'Religious', 'Beach', 'Wildlife', 'Weekend Getaway'] as $category)
                            <option value="{{ $category }}" @selected(old('category') == $category)>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    @error('category') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3">
                    <label class="admin-form-label">Duration (Days) *</label>
                    <input type="number" name="duration_days" class="form-control"
                           value="{{ old('duration_days', 3) }}" min="1" required>
                    @error('duration_days') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3">
                    <label class="admin-form-label">Duration (Nights) *</label>
                    <input type="number" name="duration_nights" class="form-control"
                           value="{{ old('duration_nights', 2) }}" min="0" required>
                    @error('duration_nights') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3">
                    <label class="admin-form-label">Original Price (₹) *</label>
                    <input type="number" name="price" class="form-control"
                           value="{{ old('price') }}" min="0" step="0.01" required>
                    @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3">
                    <label class="admin-form-label">Discount Price (₹)</label>
                    <input type="number" name="discount_price" class="form-control"
                           value="{{ old('discount_price') }}" min="0" step="0.01">
                    @error('discount_price') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="admin-form-label">Maximum People *</label>
                    <input type="number" name="max_people" class="form-control"
                           value="{{ old('max_people', 10) }}" min="1" required>
                    @error('max_people') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="admin-form-label">Package Image</label>
                    <input type="file" name="image" class="form-control"
                           accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted">JPG, PNG or WEBP. Maximum 2 MB.</small>
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-12">
                    <label class="admin-form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4"
                              placeholder="Describe this travel package...">{{ old('description') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="admin-form-label">Package Highlights</label>
                    <textarea name="highlights" class="form-control" rows="5"
                              placeholder="Mountain sightseeing, River rafting, Local markets">{{ old('highlights') }}</textarea>
                    <small class="text-muted">Separate each item with a comma.</small>
                    @error('highlights') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="admin-form-label">What's Included</label>
                    <textarea name="inclusions" class="form-control" rows="5"
                              placeholder="Hotel accommodation, Breakfast, Transportation">{{ old('inclusions') }}</textarea>
                    <small class="text-muted">Separate each item with a comma.</small>
                    @error('inclusions') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="admin-form-label">What's Excluded</label>
                    <textarea name="exclusions" class="form-control" rows="5"
                              placeholder="Personal expenses, Travel insurance, Lunch">{{ old('exclusions') }}</textarea>
                    <small class="text-muted">Separate each item with a comma.</small>
                    @error('exclusions') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <div class="admin-package-checkbox">
                        <input type="checkbox" name="featured" value="1"
                               id="featured" @checked(old('featured'))>
                        <label for="featured">Mark as Featured Package</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="admin-package-checkbox">
                        <input type="checkbox" name="status" value="1"
                               id="status" @checked(old('status', '1'))>
                        <label for="status">Publish Package (Active)</label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="admin-package-submit">
                        <i class="fa-solid fa-save"></i>
                        Save Package
                    </button>
                </div>

            </div>

        </form>

    </div>

</div>

@endsection