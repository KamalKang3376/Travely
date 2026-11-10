@extends('layouts.admin.app')

@section('title', 'Manage Packages')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-packages.css') }}">
@endpush

@section('content')

<div class="admin-packages-page">

    <div class="admin-page-header">
        <div>
            <h2>Travel Packages</h2>
            <p>Manage all your travel packages here.</p>
        </div>

        <a href="{{ route('admin.packages.create') }}" class="admin-add-btn">
            <i class="fa-solid fa-plus"></i>
            Add New Package
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-table-card">

        <div class="table-responsive">

            <table class="table admin-packages-table align-middle">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Package</th>
                        <th>Destination</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($packages as $package)

                        <tr>
                            <td>{{ $packages->firstItem() + $loop->index }}</td>

                            <td>
                                <div class="admin-package-info">

                                    @if($package->image)
                                        <img src="{{ asset('storage/' . $package->image) }}"
                                             alt="{{ $package->name }}">
                                    @else
                                        <div class="admin-package-placeholder">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    @endif

                                    <div>
                                        <strong>{{ $package->name }}</strong>
                                        <small>{{ $package->category }}</small>
                                    </div>

                                </div>
                            </td>

                            <td>{{ $package->destination }}</td>

                            <td>
                                {{ $package->duration_days }} Days /
                                {{ $package->duration_nights }} Nights
                            </td>

                            <td>
                                @if($package->discount_price)
                                    <del>₹{{ number_format($package->price, 0) }}</del>
                                    <strong>₹{{ number_format($package->discount_price, 0) }}</strong>
                                @else
                                    <strong>₹{{ number_format($package->price, 0) }}</strong>
                                @endif
                            </td>

                            <td>
                                @if($package->featured)
                                    <span class="package-badge featured-badge">Featured</span>
                                @else
                                    <span class="package-badge normal-badge">No</span>
                                @endif
                            </td>

                            <td>
                                @if($package->status)
                                    <span class="package-badge active-badge">Active</span>
                                @else
                                    <span class="package-badge inactive-badge">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <div class="admin-package-actions">

                                    <a href="{{ route('admin.packages.edit', $package->id) }}"
                                       class="edit-action"
                                       title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form action="{{ route('admin.packages.destroy', $package->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this package?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="delete-action" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fa-solid fa-suitcase-rolling empty-package-icon"></i>
                                <h5>No Packages Found</h5>
                                <p>Add your first travel package.</p>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="admin-package-pagination">
            {{ $packages->links() }}
        </div>

    </div>

</div>

@endsection