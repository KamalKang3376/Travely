
@extends('layouts.admin.app')

@section('title', 'Manage Hotels | Travely')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Manage Hotels</h2>
            <p class="text-muted">Add and manage your hotel listings.</p>
        </div>

        <a href="{{ route('admin.hotels.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Hotel
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Hotel Name</th>
                        <th>Location</th>
                        <th>Price / Night</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($hotels as $hotel)
                        <tr>
                            <td>
                                @if($hotel->image)
                                    <img src="{{ travely_image_url($hotel->image) }}"
                                         width="65" height="50"
                                         style="object-fit: cover; border-radius: 6px;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>

                            <td class="fw-semibold">{{ $hotel->name }}</td>

                            <td>{{ $hotel->city }}, {{ $hotel->country }}</td>

                            <td>₹{{ number_format($hotel->price_per_night, 2) }}</td>

                            <td>
                                <i class="fas fa-star text-warning"></i>
                                {{ $hotel->rating }}
                            </td>

                            <td>
                                @if($hotel->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.hotels.edit', $hotel) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.hotels.destroy', $hotel) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this hotel?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                No hotels added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $hotels->links() }}
    </div>

</div>
@endsection
