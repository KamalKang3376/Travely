@extends('layouts.app')

@section('title', 'Edit Destination | Travely')

@section('content')

<div class="container py-5">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">
            <h3 class="mb-0">Edit Destination</h3>
        </div>

        <div class="card-body p-4">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.destinations.update', $destination) }}"
                method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Destination Name</label>
                        <input type="text" name="name"
                            class="form-control"
                            value="{{ old('name', $destination->name) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" name="country"
                            class="form-control"
                            value="{{ old('country', $destination->country) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city"
                            class="form-control"
                            value="{{ old('city', $destination->city) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Starting Price (₹)</label>
                        <input type="number" name="starting_price"
                            class="form-control"
                            min="0" step="0.01"
                            value="{{ old('starting_price', $destination->starting_price) }}"
                            required>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="5"
                            class="form-control" required>{{ old('description', $destination->description) }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Current Image</label>

                        @if($destination->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $destination->image) }}"
                                    width="150" height="100"
                                    style="object-fit: cover; border-radius: 8px;">
                            </div>
                        @endif

                        <input type="file" name="image"
                            class="form-control" accept="image/*">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="1" {{ old('status', $destination->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $destination->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="d-flex gap-2 mt-3">

                    <button type="submit" class="btn btn-primary">
                        Update Destination
                    </button>

                    <a href="{{ route('admin.destinations.index') }}"
                        class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection