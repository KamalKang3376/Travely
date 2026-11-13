
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm travely-navbar">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="fa-solid fa-plane-departure"></i>
            <span>Travely</span>
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
            aria-controls="mainNavbar"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('destinations.*') ? 'active' : '' }}"
                       href="{{ route('destinations.index') }}">Destinations</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('hotels.*') ? 'active' : '' }}"
                       href="{{ route('hotels.index') }}">Hotels</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('flights*') ? 'active' : '' }}"
                       href="{{ url('/flights') }}">Flights</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cars*') ? 'active' : '' }}"
                       href="{{ url('/cars') }}">Car Rental</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('packages*') ? 'active' : '' }}"
                       href="{{ url('/packages') }}">Packages</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-track-booking {{ request()->routeIs('packages.track-booking*') ? 'active' : '' }}"
                       href="{{ route('packages.track-booking') }}"
                       title="Track Booking"
                       aria-label="Track Booking">
                        <i class="fa-solid fa-location-dot"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact*') ? 'active' : '' }}"
                       href="{{ route('contact') }}"
                       title="Contact Us"
                       aria-label="Contact Us">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                </li>

            </ul>

            <div class="d-flex align-items-center gap-2 navbar-actions">

                @auth

                    @if(Auth::user()->role === 'admin')

                        <a href="{{ route('admin.dashboard') }}"
                           class="btn btn-outline-primary">
                            <i class="fa-solid fa-gauge-high me-1"></i>
                            Admin
                        </a>

                    @else

                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle
                                {{ request()->routeIs('my-bookings', 'my-destination-bookings', 'my-flight-bookings', 'my-package-bookings.*', 'my-car-bookings*') ? 'active' : '' }}
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-calendar-check me-1"></i>
                                My Bookings
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                                <li>
                                    <a class="dropdown-item py-2 {{ request()->routeIs('my-bookings') ? 'active' : '' }}"
                                       href="{{ route('my-bookings') }}">
                                        <i class="fa-solid fa-hotel me-2 text-success"></i>
                                        Hotel Bookings
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item py-2 {{ request()->routeIs('my-destination-bookings') ? 'active' : '' }}"
                                       href="{{ route('my-destination-bookings') }}">
                                        <i class="fa-solid fa-plane me-2 text-success"></i>
                                        Destination Bookings
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item py-2 {{ request()->routeIs('my-flight-bookings') ? 'active' : '' }}"
                                       href="{{ route('my-flight-bookings') }}">
                                        <i class="fa-solid fa-plane me-2"></i>
                                        Flight Bookings
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item py-2 {{ request()->routeIs('my-package-bookings.*') ? 'active' : '' }}"
                                       href="{{ route('my-package-bookings.index') }}">
                                        <i class="fa-solid fa-suitcase-rolling me-2 text-success"></i>
                                        Package Bookings
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 {{ request()->routeIs('my-car-bookings*') ? 'active' : '' }}"
                                    href="{{ route('my-car-bookings') }}">
                                        <i class="fa-solid fa-car me-2 text-success"></i>
                                        Car Rental Bookings
                                    </a>
                                </li>


                            </ul>
                        </div>

                    @endif

                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user me-1"></i>
                            {{ Auth::user()->name }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                            <li>
                                <a class="dropdown-item py-2"
                                   href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                                    <i class="fa-solid fa-user-circle me-2"></i>
                                    My Dashboard
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </div>

                @else

                    <a href="{{ route('login') }}" class="btn btn-outline-primary">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-primary">
                        Sign Up
                    </a>

                @endauth

            </div>

        </div>
    </div>
</nav>
