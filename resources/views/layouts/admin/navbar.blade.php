
<header class="admin-navbar">

    <button type="button" class="sidebar-toggle" id="sidebarToggle"
        aria-label="Toggle sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="admin-page-heading">
        <span>Travely Management</span>
        <h5>@yield('page-heading', 'Dashboard')</h5>
    </div>

    <div class="admin-navbar-user">
        <div class="admin-avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div>
            <strong>{{ auth()->user()->name }}</strong>
            <small>Admin</small>
        </div>
    </div>

</header>
