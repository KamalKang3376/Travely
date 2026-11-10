<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->paginate(10);

        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:cars,slug',
            'category' => 'required|string|max:255',
            'transmission' => 'required|string|max:50',
            'fuel_type' => 'required|string|max:50',
            'seats' => 'required|integer|min:1|max:20',
            'price_per_day' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);

        if (Car::where('slug', $validated['slug'])->exists()) {
            return back()->withInput()->withErrors([
                'slug' => 'This car slug already exists. Please use a different slug.',
            ]);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        $validated['features'] = !empty($validated['features'])
            ? array_values(array_filter(array_map('trim', explode(',', $validated['features']))))
            : [];

        $validated['status'] = $request->boolean('status');

        Car::create($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car added successfully.');
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('cars', 'slug')->ignore($car->id),
            ],
            'category' => 'required|string|max:255',
            'transmission' => 'required|string|max:50',
            'fuel_type' => 'required|string|max:50',
            'seats' => 'required|integer|min:1|max:20',
            'price_per_day' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }

            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        $validated['features'] = !empty($validated['features'])
            ? array_values(array_filter(array_map('trim', explode(',', $validated['features']))))
            : [];

        $validated['status'] = $request->boolean('status');

        $car->update($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car deleted successfully.');
    }
}