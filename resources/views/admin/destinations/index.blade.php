@extends('layouts.admin.app')

@section('title', 'Manage Destinations | Travely')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Manage Destinations</h2>
            <p class="text-muted">Add and manage travel destinations.</p>
        </div>

        <a href="{{ route('admin.destinations.create') }}"
            class="btn btn-primary">
            <i class="fa-solid fa-plus me-2"></i>Add Destination
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive bg-white rounded shadow-sm p-3">

        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Starting Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($destinations as $destination)

                    <tr>
                        <td>
                            @if($destination->image)
                                <img src="{{ asset('storage/' . $destination->image) }}"
                                    width="75" height="55"
                                    style="object-fit: cover; border-radius: 6px;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>

                        <td>{{ $destination->name }}</td>
                        <td>{{ $destination->country }}</td>
                        <td>₹{{ number_format($destination->starting_price, 2) }}</td>

                        <td>
                            @if($destination->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>

                        <td>
                            <div class="d-flex gap-2">

                                <a href="{{ route('admin.destinations.edit', $destination) }}"
                                    class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('admin.destinations.destroy', $destination) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this destination?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>

                                </form>

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center py-4">
                            No destinations found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        {{ $destinations->links('pagination::bootstrap-5') }}

    </div>

</div>

@endsection