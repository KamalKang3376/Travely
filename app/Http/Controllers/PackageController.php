<?php

namespace App\Http\Controllers;

use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::where('status', true)
            ->latest()
            ->paginate(9);

        return view('packages.index', compact('packages'));
    }

    public function show($slug)
    {
        $package = Package::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $relatedPackages = Package::where('status', true)
            ->where('id', '!=', $package->id)
            ->where('category', $package->category)
            ->latest()
            ->take(3)
            ->get();

        return view('packages.show', compact(
            'package',
            'relatedPackages'
        ));
    }
}