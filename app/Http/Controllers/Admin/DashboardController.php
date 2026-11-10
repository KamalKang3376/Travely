<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationBooking;
use App\Models\Hotel;
use App\Models\HotelBooking;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // General Dashboard Statistics
        $totalDestinations = Destination::count();
        $totalHotels = Hotel::count();
        $totalBookings = HotelBooking::count();
        $totalUsers = User::count();

        // Destination Booking Statistics
        $destinationBookings = DestinationBooking::count();

        $pendingDestinationBookings = DestinationBooking::where('status', 'pending')->count();

        $confirmedDestinationBookings = DestinationBooking::where('status', 'confirmed')->count();

        $cancelledDestinationBookings = DestinationBooking::where('status', 'cancelled')->count();

        // Hotel Booking Statistics
        $pendingHotelBookings = HotelBooking::where('status', 'pending')->count();

        $confirmedHotelBookings = HotelBooking::where('status', 'confirmed')->count();

        $cancelledHotelBookings = HotelBooking::where('status', 'cancelled')->count();

        // Revenue Statistics (Confirmed Bookings Only)
        $hotelRevenue = HotelBooking::where('status', 'confirmed')
            ->sum('total_price');

        $destinationRevenue = DestinationBooking::where('status', 'confirmed')
            ->sum('total_price');

        $totalRevenue = $hotelRevenue + $destinationRevenue;

        
// Monthly Booking Analytics
$monthlyHotelBookings = HotelBooking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    ->whereYear('created_at', now()->year)
    ->groupByRaw('MONTH(created_at)')
    ->pluck('total', 'month');

$monthlyDestinationBookings = DestinationBooking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    ->whereYear('created_at', now()->year)
    ->groupByRaw('MONTH(created_at)')
    ->pluck('total', 'month');

$bookingChartLabels = [];
$hotelBookingChartData = [];
$destinationBookingChartData = [];

for ($month = 1; $month <= 12; $month++) {
    $bookingChartLabels[] = \Carbon\Carbon::create()
        ->month($month)
        ->format('M');

    $hotelBookingChartData[] = $monthlyHotelBookings[$month] ?? 0;
    $destinationBookingChartData[] = $monthlyDestinationBookings[$month] ?? 0;
}


        // Recent Hotel Bookings
        $recentBookings = HotelBooking::with('hotel')
            ->latest()
            ->take(5)
            ->get();

        // Recent Destination Bookings
        $recentDestinationBookings = DestinationBooking::with('destination')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalDestinations',
            'totalHotels',
            'totalBookings',
            'totalUsers',

            'destinationBookings',
            'pendingDestinationBookings',
            'confirmedDestinationBookings',
            'cancelledDestinationBookings',

            'pendingHotelBookings',
            'confirmedHotelBookings',
            'cancelledHotelBookings',

            'hotelRevenue',
            'destinationRevenue',
            'totalRevenue',

            'recentBookings',
            'recentDestinationBookings',
            
            'bookingChartLabels',
            'hotelBookingChartData',
            'destinationBookingChartData',
        ));
    }
}
