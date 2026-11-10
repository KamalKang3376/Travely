<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarRentalController extends Controller
{
    public function index()
    {
        $cars = Car::where('status', true)
            ->latest()
            ->paginate(9);

        return view('cars.index', compact('cars'));
    }

    public function show($slug)
    {
        $car = Car::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('cars.show', compact('car'));
    }
}