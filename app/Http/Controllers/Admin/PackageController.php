<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->paginate(10);

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:packages,slug',
            'destination' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'highlights' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'max_people' => 'required|integer|min:1',
        ]);

        $validated['slug'] = Str::slug(
            $validated['slug'] ?: $validated['name']
        );

        if (Package::where('slug', $validated['slug'])->exists()) {
            return back()
                ->withErrors(['slug' => 'This package slug already exists.'])
                ->withInput();
        }

        $validated['highlights'] = $this->convertToArray($validated['highlights'] ?? '');
        $validated['inclusions'] = $this->convertToArray($validated['inclusions'] ?? '');
        $validated['exclusions'] = $this->convertToArray($validated['exclusions'] ?? '');

        $validated['featured'] = $request->boolean('featured');
        $validated['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('packages', 'public');
        }

        Package::create($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Package added successfully.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('packages', 'slug')->ignore($package->id),
            ],
            'destination' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'highlights' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'max_people' => 'required|integer|min:1',
        ]);

        $validated['slug'] = Str::slug(
            $validated['slug'] ?: $validated['name']
        );

        $validated['highlights'] = $this->convertToArray($validated['highlights'] ?? '');
        $validated['inclusions'] = $this->convertToArray($validated['inclusions'] ?? '');
        $validated['exclusions'] = $this->convertToArray($validated['exclusions'] ?? '');

        $validated['featured'] = $request->boolean('featured');
        $validated['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }

            $validated['image'] = $request->file('image')
                ->store('packages', 'public');
        }

        $package->update($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }

        $package->delete();

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Package deleted successfully.');
    }

    private function convertToArray(string $value): array
    {
        return array_values(array_filter(
            array_map('trim', explode(',', $value)),
            fn ($item) => $item !== ''
        ));
    }
}