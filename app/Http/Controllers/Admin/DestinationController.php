<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Services\CloudinaryImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->paginate(10);

        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request, CloudinaryImageService $imageService)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'description' => 'required|string',
            'starting_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $validated['slug'] = $this->generateSlug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $imageService->upload(
                $request->file('image'),
                'destinations'
            );
        }

        Destination::create($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination added successfully.');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(
        Request $request,
        Destination $destination,
        CloudinaryImageService $imageService
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'description' => 'required|string',
            'starting_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $validated['slug'] = $this->generateSlug(
            $validated['name'],
            $destination->id
        );

        if ($request->hasFile('image')) {
            $newImage = $imageService->upload(
                $request->file('image'),
                'destinations'
            );

            $imageService->delete($destination->image);

            $validated['image'] = $newImage;
        }

        $destination->update($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    public function destroy(
        Destination $destination,
        CloudinaryImageService $imageService
    ) {
        $imageService->delete($destination->image);

        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }

    private function generateSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Destination::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
