<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\Admin\HotelBookingController as AdminHotelBookingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\DestinationBookingController;
use App\Http\Controllers\Admin\DestinationBookingController as AdminDestinationBookingController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\FlightController as AdminFlightController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\FlightBookingController;
use App\Http\Controllers\CarRentalController;
use App\Http\Controllers\CarRentalBookingController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\CarRentalBookingController as AdminCarRentalBookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\PackageBookingController;
use App\Http\Controllers\Admin\PackageBookingController as AdminPackageBookingController;
use App\Http\Controllers\BookingTrackingController;
use App\Http\Controllers\MyPackageBookingController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/route-check', function () {
    return response()->json([
        'environment' => app()->environment(),
        'destinations_route' => Route::has('destinations.index'),
        'destination_controller' => class_exists(DestinationController::class),
    ]);
});

// Guest Routes
Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

});

// Authenticated Routes

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Customer Hotel Booking Routes
    Route::get('/hotels/{slug}/book', [
        \App\Http\Controllers\HotelBookingController::class,
        'create'
    ])->name('hotel-bookings.create');

    Route::post('/hotels/{slug}/book', [
        \App\Http\Controllers\HotelBookingController::class,
        'store'
    ])->name('hotel-bookings.store');

    // Customer My Bookings
    Route::get('/my-bookings', [
        \App\Http\Controllers\HotelBookingController::class,
        'myBookings'
    ])->name('my-bookings');

    Route::get('/my-bookings/{reference}', [
        \App\Http\Controllers\HotelBookingController::class,
        'showMyBooking'
    ])->name('my-bookings.show');

    Route::patch('/my-bookings/{reference}/cancel', [
        \App\Http\Controllers\HotelBookingController::class,
        'cancelMyBooking'
    ])->name('my-bookings.cancel');
    // Destination Booking Routes
    Route::get('/destinations/{slug}/book', [DestinationBookingController::class, 'create'])
        ->name('destination-bookings.create');

    Route::post('/destinations/{slug}/book', [DestinationBookingController::class, 'store'])
        ->name('destination-bookings.store');

    Route::get('/destination-booking-confirmation/{reference}', [DestinationBookingController::class, 'confirmation'])
        ->name('destination-bookings.confirmation');

// My Destination Bookings
Route::get('/my-destination-bookings', [DestinationBookingController::class, 'myBookings'])
    ->name('my-destination-bookings');

Route::get('/my-destination-bookings/{reference}', [DestinationBookingController::class, 'showMyBooking'])
    ->name('my-destination-bookings.show');

Route::patch('/my-destination-bookings/{reference}/cancel', [DestinationBookingController::class, 'cancelMyBooking'])
    ->name('my-destination-bookings.cancel');

    Route::get('/flights/{id}/book', [FlightBookingController::class, 'create'])
    ->name('flight-bookings.create');

Route::post('/flights/{id}/book', [FlightBookingController::class, 'store'])
    ->name('flight-bookings.store');

Route::get('/flight-booking-confirmation/{reference}', [FlightBookingController::class, 'confirmation'])
    ->name('flight-bookings.confirmation');

    Route::get('/my-flight-bookings', [FlightBookingController::class, 'myBookings'])
    ->name('my-flight-bookings');

Route::get('/my-flight-bookings/{reference}', [FlightBookingController::class, 'showMyBooking'])
    ->name('my-flight-bookings.show');

Route::patch('/my-flight-bookings/{reference}/cancel', [FlightBookingController::class, 'cancelMyBooking'])
    ->name('my-flight-bookings.cancel');

    // Car Rental Booking Routes
    Route::get('/cars/{slug}/book', [CarRentalBookingController::class, 'create'])
    ->name('cars.book');

    Route::post('/cars/{slug}/book', [CarRentalBookingController::class, 'store'])
    ->name('cars.booking.store');

    Route::get('/car-booking-confirmation/{reference}', [CarRentalBookingController::class, 'confirmation'])
    ->name('cars.booking.confirmation');

    // My Car Rental Bookings
    Route::get('/my-car-bookings', [CarRentalBookingController::class, 'myBookings'])
        ->name('my-car-bookings');

    Route::get('/my-car-bookings/{reference}', [CarRentalBookingController::class, 'showMyBooking'])
        ->name('my-car-bookings.show');

    Route::patch('/my-car-bookings/{reference}/cancel', [CarRentalBookingController::class, 'cancelMyBooking'])
    ->name('my-car-bookings.cancel');

});


// Public Destination Routes
Route::get('/destinations', [DestinationController::class, 'index'])
    ->name('destinations.index');

Route::get('/destinations/{slug}', [DestinationController::class, 'show'])
    ->name('destinations.show');

// Public Hotel Routes
Route::get('/hotels', [HotelController::class, 'index'])
    ->name('hotels.index');

Route::get('/hotels/{slug}', [HotelController::class, 'show'])
    ->name('hotels.show');

// Hotel Booking Routes
Route::get('/hotels/{slug}/book', [HotelBookingController::class, 'create'])
    ->name('hotel-bookings.create');

Route::post('/hotels/{slug}/book', [HotelBookingController::class, 'store'])
    ->name('hotel-bookings.store');

Route::get('/booking-confirmation/{reference}', [HotelBookingController::class, 'confirmation'])
    ->name('hotel-bookings.confirmation');

// Contact Page
Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

// Admin Routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('destinations', AdminDestinationController::class);

        Route::resource('hotels', AdminHotelController::class)->except(['show']);

        Route::get('/hotel-bookings', [AdminHotelBookingController::class, 'index'])
            ->name('hotel-bookings.index');

        Route::get('/hotel-bookings/{reference}', [AdminHotelBookingController::class, 'show'])
            ->name('hotel-bookings.show');

        Route::patch('/hotel-bookings/{reference}/status', [AdminHotelBookingController::class, 'update'])
            ->name('hotel-bookings.update-status');
         Route::get('/hotel-bookings', [AdminHotelBookingController::class, 'index'])
            ->name('hotel-bookings.index');

        Route::get('/hotel-bookings/{reference}', [AdminHotelBookingController::class, 'show'])
            ->name('hotel-bookings.show');

        Route::patch('/hotel-bookings/{reference}/status', [AdminHotelBookingController::class, 'updateStatus'])
            ->name('hotel-bookings.update');
        Route::patch(
            '/hotel-bookings/{reference}/status',
            [AdminHotelBookingController::class, 'update']
        )->name('hotel-bookings.update');

        Route::get('/destination-bookings', [AdminDestinationBookingController::class, 'index'])
                ->name('destination-bookings.index');

        Route::get('/destination-bookings/{reference}', [AdminDestinationBookingController::class, 'show'])
                ->name('destination-bookings.show');

        Route::patch('/destination-bookings/{reference}/status', [AdminDestinationBookingController::class, 'update'])
                ->name('destination-bookings.update');

        // Customer Management
        Route::get('/customers', [AdminCustomerController::class, 'index'])
                ->name('customers.index');

        Route::get('/customers/{id}', [AdminCustomerController::class, 'show'])
                ->name('customers.show');
        // Contact Message Management
        Route::get('/contact-messages', [AdminContactMessageController::class, 'index'])
            ->name('contact-messages.index');

        Route::get('/contact-messages/{id}', [AdminContactMessageController::class, 'show'])
            ->name('contact-messages.show');
        
        Route::resource('flights', AdminFlightController::class)->except(['show']);

        Route::resource('cars', AdminCarController::class)->except(['show']);

        Route::get('/car-rental-bookings', [AdminCarRentalBookingController::class, 'index'])
    ->name('car-rental-bookings.index');

Route::get('/car-rental-bookings/{id}', [AdminCarRentalBookingController::class, 'show'])
    ->name('car-rental-bookings.show');

Route::put('/car-rental-bookings/{id}', [AdminCarRentalBookingController::class, 'update'])
    ->name('car-rental-bookings.update');

Route::resource('packages', AdminPackageController::class)
    ->except(['show']);

Route::get('/package-bookings', [AdminPackageBookingController::class, 'index'])
    ->name('package-bookings.index');

Route::get('/package-bookings/{packageBooking}', [AdminPackageBookingController::class, 'show'])
    ->name('package-bookings.show');

Route::put('/package-bookings/{packageBooking}/status', [AdminPackageBookingController::class, 'updateStatus'])
    ->name('package-bookings.update-status');

Route::delete('/package-bookings/{packageBooking}', [AdminPackageBookingController::class, 'destroy'])
    ->name('package-bookings.destroy');

                
    });

    Route::get('/flights', [FlightController::class, 'index'])
        ->name('flights.index');

    Route::get('/flights/{id}', [FlightController::class, 'show'])
        ->name('flights.show');

    // Car Rental Routes
Route::get('/cars', [CarRentalController::class, 'index'])
    ->name('cars.index');

Route::get('/cars/{slug}', [CarRentalController::class, 'show'])
    ->name('cars.show');

Route::get('/packages', [PackageController::class, 'index'])
    ->name('packages.index');

Route::get('/packages/{slug}', [PackageController::class, 'show'])
    ->name('packages.show');

Route::get('/packages/{slug}/book', [PackageBookingController::class, 'create'])
    ->name('packages.booking.create');

Route::post('/packages/{slug}/book', [PackageBookingController::class, 'store'])
    ->name('packages.booking.store');

Route::get('/package-booking/success/{reference}', [PackageBookingController::class, 'success'])
    ->name('packages.booking.success');

Route::get('/track-booking', [BookingTrackingController::class, 'index'])
    ->name('packages.track-booking');

Route::post('/track-booking', [BookingTrackingController::class, 'track'])
    ->name('packages.track-booking.search');

    Route::middleware('auth')->group(function () {

    Route::get('/my-package-bookings', [MyPackageBookingController::class, 'index'])
        ->name('my-package-bookings.index');

    Route::get('/my-package-bookings/{id}', [MyPackageBookingController::class, 'show'])
        ->name('my-package-bookings.show');

    Route::patch('/my-package-bookings/{id}/cancel', [MyPackageBookingController::class, 'cancel'])
        ->name('my-package-bookings.cancel');

});