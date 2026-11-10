<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->paginate(10);

        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $validated['slug'] = $this->generateSlug($request->name);
        $validated['rating'] = $validated['rating'] ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('hotels', 'public');
        }

        Hotel::create($validated);

        return redirect()
            ->route('admin.hotels.index')
            ->with('success', 'Hotel added successfully.');
    }

    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $validated['slug'] = $this->generateSlug($request->name, $hotel->id);
        $validated['rating'] = $validated['rating'] ?? 0;

        if ($request->hasFile('image')) {
            if ($hotel->image) {
                Storage::disk('public')->delete($hotel->image);
            }

            $validated['image'] = $request->file('image')
                ->store('hotels', 'public');
        }

        $hotel->update($validated);

        return redirect()
            ->route('admin.hotels.index')
            ->with('success', 'Hotel updated successfully.');
    }

    public function destroy(Hotel $hotel)
    {
        if ($hotel->image) {
            Storage::disk('public')->delete($hotel->image);
        }

        $hotel->delete();

        return redirect()
            ->route('admin.hotels.index')
            ->with('success', 'Hotel deleted successfully.');
    }

    private function generateSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Hotel::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }
}
