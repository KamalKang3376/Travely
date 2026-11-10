@extends('layouts.app')

@section('title', 'Add Destination | Travely')

@section('content')

<div class="container py-5">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">
            <h3 class="mb-0">Add New Destination</h3>
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

            <form action="{{ route('admin.destinations.store') }}"
                method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Destination Name</label>
                        <input type="text" name="name"
                            class="form-control"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" name="country"
                            class="form-control"
                            value="{{ old('country') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city"
                            class="form-control"
                            value="{{ old('city') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Starting Price (₹)</label>
                        <input type="number" name="starting_price"
                            class="form-control"
                            min="0" step="0.01"
                            value="{{ old('starting_price', 0) }}" required>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="5"
                            class="form-control" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Destination Image</label>
                        <input type="file" name="image"
                            class="form-control" accept="image/*">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="d-flex gap-2 mt-3">

                    <button type="submit" class="btn btn-primary">
                        Save Destination
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