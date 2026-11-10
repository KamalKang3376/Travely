
<aside class="admin-sidebar" id="adminSidebar">

    <div class="sidebar-brand">
        <i class="fa-solid fa-plane-departure"></i>
        <span>Travely Admin</span>
    </div>

    <div class="sidebar-section-title">MAIN MENU</div>

    <nav class="sidebar-nav">

        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high"></i>
            Dashboard
        </a>

        <a href="{{ route('admin.destinations.index') }}"
           class="{{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
            <i class="fa-solid fa-map-location-dot"></i>
            Destinations
        </a>

        <a href="{{ route('admin.hotels.index') }}"
           class="{{ request()->routeIs('admin.hotels.*') ? 'active' : '' }}">
            <i class="fa-solid fa-hotel"></i>
            Hotels
        </a>

        <a href="{{ route('admin.hotel-bookings.index') }}"
           class="{{ request()->routeIs('admin.hotel-bookings.*') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-check"></i>
            Hotel Bookings
        </a>

        <a href="{{ route('admin.destination-bookings.index') }}"
           class="{{ request()->routeIs('admin.destination-bookings.*') ? 'active' : '' }}">
            <i class="fa-solid fa-plane"></i>
            <span>Destination Bookings</span>
        </a>

        <a href="{{ route('admin.customers.index') }}"
           class="{{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i>
            <span>Customers</span>
        </a>

        <a href="{{ route('admin.contact-messages.index') }}"
           class="{{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
            <i class="fa-solid fa-envelope"></i>
            <span>Contact Messages</span>
        </a>

        <a href="{{ route('admin.flights.index') }}"
           class="{{ request()->routeIs('admin.flights.*') ? 'active' : '' }}">
            <i class="fa-solid fa-plane"></i>
            <span>Flights</span>
        </a>

        <a href="{{ route('admin.cars.index') }}"
           class="{{ request()->routeIs('admin.cars.*') ? 'active' : '' }}">
            <i class="fa-solid fa-car"></i>
            <span>Cars</span>
        </a>

        <a href="{{ route('admin.car-rental-bookings.index') }}"
            class="{{ request()->routeIs('admin.car-rental-bookings.*') ? 'active' : '' }}">
                <i class="fa-solid fa-car-side"></i>
                <span>Car Rental Bookings</span>
        </a>

        <a href="{{ route('admin.packages.index') }}"
            class="{{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                <i class="fa-solid fa-suitcase-rolling"></i>
                <span>Packages</span>
        </a>

        <a href="{{ route('admin.package-bookings.index') }}"
            class="{{ request()->routeIs('admin.package-bookings.*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-check"></i>
                <span>Package Bookings</span>
        </a>

    </nav>

    <div class="sidebar-section-title">WEBSITE</div>

    <nav class="sidebar-nav">
        <a href="{{ route('home') }}" target="_blank">
            <i class="fa-solid fa-globe"></i>
            Visit Website
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="sidebar-user">
            <div class="sidebar-user-icon">
                <i class="fa-solid fa-user"></i>
            </div>

            <div>
                <strong>{{ auth()->user()->name }}</strong>
                <small>Administrator</small>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>

</aside>
