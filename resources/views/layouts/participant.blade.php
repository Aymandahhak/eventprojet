<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Participant Dashboard') - Eventify</title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet"> <!-- Main Eventify theme styles -->
     <!-- Favicon -->
     <link href="{{ asset('asset/img/favicon.ico') }}" rel="icon">

    {{-- Commenting out the original large inline style block to avoid conflicts.
         The new styles are pushed at the end of the body via @push('styles').
    <style>
    // ... existing code ...
    </style>
    --}}

    @stack('styles_before') <!-- For styles that must be loaded before main content styles -->
    @stack('styles') <!-- For page-specific styles pushed from child views or this layout -->

</head>
<body class="dark-theme">

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('home') }}" class="sidebar-brand">
                    <span class="logo-icon">E</span>ventify
                </a>
                <button class="btn btn-icon d-lg-none" id="sidebarToggleClose"><i class="fas fa-times"></i></button>
            </div>
            <ul class="sidebar-nav nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('participant.dashboard') ? 'active' : '' }}" href="{{ route('participant.dashboard') }}">
                        <i data-feather="home" class="nav-icon"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('participant.events.discover') ? 'active' : '' }}" href="#"> {{-- Replace # with actual route --}}
                        <i data-feather="compass" class="nav-icon"></i> Discover Events
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('participant.registrations') ? 'active' : '' }}" href="#"> {{-- Replace # with actual route --}}
                        <i data-feather="calendar" class="nav-icon"></i> My Events
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('participant.tickets') ? 'active' : '' }}" href="#"> {{-- Replace # with actual route --}}
                        <i data-feather="ticket" class="nav-icon"></i> My Tickets
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('participant.profile') ? 'active' : '' }}" href="#"> {{-- Replace # with actual route --}}
                         <i data-feather="user" class="nav-icon"></i> My Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('participant.notifications') ? 'active' : '' }}" href="{{ route('participant.notifications') }}">
                        <i data-feather="bell" class="nav-icon"></i> Notifications
                         @if(auth()->user() && method_exists(auth()->user(), 'notifications') && auth()->user()->notifications()->where('is_read', false)->count() > 0)
                            <span class="badge bg-purple-soft ms-auto">{{ auth()->user()->notifications()->where('is_read', false)->count() }}</span>
                        @endif
                    </a>
                </li>
            </ul>
            <hr class="sidebar-divider">
            <div class="sidebar-user text-center">
                @auth
                    <div class="user-avatar-wrapper">
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('asset/img/default-avatar.png') }}" alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle user-avatar">
                    </div>
                    <h5 class="user-name">{{ Auth::user()->name }}</h5>
                    <p class="user-role">{{ Auth::user()->role ?? 'Participant' }}</p>
                @endauth
            </div>
            <div class="sidebar-footer mt-auto">
                 <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-gradient logout-btn">
                        <i data-feather="log-out" class="me-2"></i> Logout
                    </button>
                </form>
            </div>
        </aside>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content Wrapper -->
        <div id="page-content-wrapper" class="main-content flex-fill">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg top-navbar">
                <button class="btn btn-icon" id="menu-toggle-btn">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="ms-auto d-flex align-items-center">
                    <div class="navbar-search me-3 d-none d-md-flex">
                        <div class="search-input-wrapper">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="search-input" placeholder="Search...">
                        </div>
                    </div>
                    <div class="dropdown notifications-dropdown me-3">
                        <a href="#" class="nav-link nav-icon-link" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            @if(auth()->user() && method_exists(auth()->user(), 'notifications') && auth()->user()->notifications()->where('is_read', false)->count() > 0)
                                <span class="badge bg-purple">{{ auth()->user()->notifications()->where('is_read', false)->count() }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu notifications-dropdown-menu" aria-labelledby="notificationsDropdown">
                            <li class="dropdown-header">Notifications</li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">No new notifications</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="navbarDropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('asset/img/default-avatar.png') }}" alt="{{ Auth::user()->name }}" class="avatar-sm rounded-circle me-2">
                            <span class="d-none d-sm-inline-block user-dropdown-name">{{ Auth::user()->name ?? 'User' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdownUser">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Sign out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Top Navbar -->

            <!-- Main Content Area -->
            <div class="container-fluid content-area">
                @if(View::hasSection('dashboard-hero'))
                    @yield('dashboard-hero')
                @else
                <div class="welcome-section">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="fw-bold mb-3 text-white">Hello, {{ Auth::user()->name ?? 'Participant' }}!</h1>
                            <p class="text-light lead mb-4">Welcome to your Eventify dashboard. Manage your event activities with ease.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                            <a href="#" class="btn btn-gradient discover-btn">
                                <i class="fas fa-compass me-2"></i> Discover Events
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                
                @if(View::hasSection('profile-header'))
                    @yield('profile-header')
                @endif

                @yield('dashboard-content')
            </div>
            <!-- End Main Content Area -->

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start">
                            <p class="mb-0">&copy; {{ date('Y') }} Eventify. All rights reserved.</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <p class="mb-0">Designed with <i class="fas fa-heart text-danger"></i> by Eventify</p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End Footer -->
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Scripts -->
    <script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace();

        document.addEventListener("DOMContentLoaded", function() {
            const menuToggleBtn = document.getElementById("menu-toggle-btn");
            const sidebarToggleCloseBtn = document.getElementById("sidebarToggleClose");
            const wrapper = document.getElementById("wrapper");

            if (menuToggleBtn) {
                menuToggleBtn.addEventListener("click", function() {
                    wrapper.classList.toggle("toggled");
                });
            }
            if (sidebarToggleCloseBtn) {
                 sidebarToggleCloseBtn.addEventListener("click", function() {
                    wrapper.classList.remove("toggled");
                });
            }
        });
    </script>
    @stack('scripts_footer') <!-- For scripts that need to be at the end of body -->
</body>
</html>

@push('styles')
<style>
    /* Modern theme variables */
    :root {
        --primary-dark: #0F172A;
        --primary-medium: #111827;
        --primary-light: #1E293B;
        --accent-start: #6B46C1;
        --accent-end: #8B5CF6;
        --accent-start-rgb: 107, 70, 193;
        --accent-end-rgb: 139, 92, 246;
        --accent-hover-start: #8B5CF6;
        --accent-hover-end: #6B46C1;
        --text-white: #FFFFFF;
        --text-light: #E2E8F0;
        --text-muted: #94A3B8;
        --card-bg: rgba(30, 41, 59, 0.6);
        --border-color: rgba(255, 255, 255, 0.05);
        --bg-purple: #6B46C1;
        --bg-purple-soft: rgba(107, 70, 193, 0.15);
    }

    /* Base Styles */
    body {
        font-family: 'Montserrat', sans-serif;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
        color: var(--text-light);
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* Fixed text color styles */
    h1, h2, h3, h4, h5, h6 {
        color: var(--text-white);
    }

    .text-muted {
        color: var(--text-muted) !important;
    }

    /* Ensure card titles are visible */
    .card-title {
        color: var(--text-white) !important;
    }

    /* Fix welcome section text */
    .welcome-section h1 {
        color: var(--text-white) !important;
    }

    .welcome-section p {
        color: var(--text-light) !important;
    }

    /* Dashboard stat cards */
    .stat-card h3 {
        color: var(--text-white) !important;
    }

    .stat-card h6 {
        color: var(--text-light) !important;
    }

    /* Event cards */
    .event-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
    }

    .event-title {
        color: var(--text-white) !important;
    }

    .event-info {
        color: var(--text-light) !important;
    }

    .event-price {
        color: var(--accent-end) !important;
        font-weight: bold;
    }

    /* Fix sidebar text */
    .sidebar-nav .nav-link {
        color: var(--text-light) !important;
    }

    .sidebar-nav .nav-link.active {
        color: var(--text-white) !important;
        background-color: rgba(107, 70, 193, 0.2);
    }

    .sidebar-user .user-name {
        color: var(--text-white) !important;
    }

    .sidebar-user .user-role {
        color: var(--text-muted) !important;
    }

    /* Notifications and profile section */
    .user-dropdown-name {
        color: var(--text-white) !important;
    }

    /* Card content */
    .card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
    }

    .card-body {
        color: var(--text-light);
    }

    /* Button improvements */
    .btn-outline-purple {
        color: var(--accent-start);
        border-color: var(--accent-start);
    }

    .btn-outline-purple:hover {
        background-color: var(--accent-start);
        color: var(--text-white);
    }

    .btn-gradient {
        background: linear-gradient(to right, var(--accent-start), var(--accent-end));
        color: var(--text-white);
        border: none;
    }

    /* Fix for empty state text */
    .empty-state p {
        color: var(--text-light) !important;
    }

    /* Fix for registration items */
    .registration-title {
        color: var(--text-white) !important;
    }

    .registration-meta {
        color: var(--text-light) !important;
    }

    .registration-status .badge {
        font-weight: 600;
    }

    /* Profile section fixes */
    .account-info {
        color: var(--text-light);
    }

    .account-info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .info-label {
        color: var(--text-muted);
    }

    .info-value {
        color: var(--text-white);
        font-weight: 500;
    }

    /* Fix for list group items */
    .list-group-item {
        background-color: transparent;
        border-color: var(--border-color);
    }

    /* Footer text */
    .footer p {
        color: var(--text-muted);
    }

    /* Layout */
    #wrapper {
        display: flex;
        width: 100%;
        align-items: stretch;
    }

    #page-content-wrapper {
        flex-grow: 1;
        padding-left: 280px;
        transition: padding-left 0.35s ease;
        background-color: transparent;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    #wrapper.toggled #page-content-wrapper {
        padding-left: 0;
    }

    /* Sidebar */
    .sidebar {
        background-color: var(--primary-light);
        width: 280px;
        min-width: 280px;
        transition: all 0.35s ease;
        display: flex;
        flex-direction: column;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        overflow-y: auto;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-right: 1px solid var(--border-color);
    }

    #wrapper.toggled .sidebar {
        margin-left: -280px;
        box-shadow: none;
    }

    .sidebar-header {
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border-color);
    }

    .sidebar-brand {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-white);
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .sidebar-brand .logo-icon {
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, var(--accent-start), var(--accent-end));
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 18px;
        margin-right: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .sidebar-brand:hover {
        color: var(--text-white);
    }

    .sidebar-nav {
        padding: 1.5rem 0;
        flex-grow: 1;
    }

    .sidebar-nav .nav-item {
        margin-bottom: 0.5rem;
    }

    .sidebar-nav .nav-link {
        padding: 0.85rem 1.5rem;
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
        letter-spacing: 0.3px;
    }

    .sidebar-nav .nav-link .nav-icon {
        width: 20px;
        height: 20px;
        margin-right: 12px;
        stroke-width: 2px;
    }

    .sidebar-nav .nav-link:hover {
        color: var(--text-light);
        background-color: rgba(107, 70, 193, 0.08);
        border-left-color: var(--accent-start);
    }

    .sidebar-nav .nav-link.active {
        color: var(--text-white);
        background: linear-gradient(90deg, rgba(107, 70, 193, 0.12), rgba(139, 92, 246, 0.05));
        border-left-color: var(--accent-end);
        font-weight: 600;
    }

    .sidebar-nav .nav-link .badge {
        font-size: 0.7rem;
        padding: 0.35em 0.65em;
        margin-left: auto;
    }

    .sidebar-divider {
        margin: 1rem 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    /* User Area */
    .sidebar-user {
        padding: 1.5rem;
        text-align: center;
    }

    .user-avatar-wrapper {
        margin: 0 auto 1rem;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        padding: 3px;
        background: linear-gradient(135deg, var(--accent-start), var(--accent-end));
    }

    .user-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 3px solid var(--primary-light);
    }

    .user-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-white);
        margin-bottom: 0.25rem;
    }

    .user-role {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 0;
    }

    /* Sidebar Footer */
    .sidebar-footer {
        padding: 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    .logout-btn {
        width: 100%;
        padding: 0.65rem;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-gradient {
        background: linear-gradient(90deg, var(--accent-start) 0%, var(--accent-end) 100%);
        border: none;
        color: var(--text-white);
        box-shadow: 0 4px 15px rgba(107, 70, 193, 0.3);
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(107, 70, 193, 0.4);
        background: linear-gradient(90deg, var(--accent-hover-start) 0%, var(--accent-hover-end) 100%);
    }

    /* Top Navbar */
    .top-navbar {
        background-color: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border-color);
        padding: 0.75rem 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .btn-icon {
        background: none;
        border: none;
        color: var(--text-muted);
        font-size: 1.25rem;
        padding: 0.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-icon:hover {
        color: var(--text-light);
    }

    /* Search Bar */
    .navbar-search {
        position: relative;
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--border-color);
        border-radius: 50px;
        color: var(--text-light);
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        width: 240px;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        background-color: rgba(255, 255, 255, 0.08);
        border-color: var(--accent-start);
        box-shadow: 0 0 0 0.2rem rgba(107, 70, 193, 0.15);
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    /* Notifications Dropdown */
    .nav-icon-link {
        position: relative;
        color: var(--text-muted);
        font-size: 1.25rem;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .nav-icon-link:hover {
        color: var(--text-light);
    }

    .nav-icon-link .badge {
        position: absolute;
        top: 0;
        right: 0;
        transform: translate(25%, -25%);
    }

    .bg-purple {
        background-color: var(--bg-purple) !important;
    }

    .bg-purple-soft {
        background-color: var(--bg-purple-soft) !important;
        color: var(--accent-start) !important;
    }

    .avatar-sm {
        width: 36px;
        height: 36px;
        object-fit: cover;
    }

    /* Dropdown Menus */
    .dropdown-menu {
        background-color: var(--primary-light);
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        margin-top: 0.5rem;
        padding: 0.75rem 0;
    }

    .dropdown-header {
        color: var(--text-muted);
        font-size: 0.875rem;
        padding: 0.5rem 1.5rem;
    }

    .dropdown-item {
        color: var(--text-light);
        padding: 0.65rem 1.5rem;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover, .dropdown-item:focus {
        background-color: rgba(107, 70, 193, 0.08);
        color: var(--text-white);
    }

    .dropdown-divider {
        border-top: 1px solid var(--border-color);
        margin: 0.5rem 0;
    }

    .notifications-dropdown-menu {
        min-width: 280px;
    }

    /* Content Area */
    .content-area {
        flex-grow: 1;
        padding: 0 1.5rem 1.5rem;
    }

    .welcome-section {
        background: rgba(30, 41, 59, 0.6);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .discover-btn {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        border-radius: 50px;
    }

    /* Card Styles */
    .card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(107, 70, 193, 0.2);
        border-color: rgba(107, 70, 193, 0.3);
    }

    .card-header {
        background-color: rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid var(--border-color);
        padding: 1.25rem 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-footer {
        background-color: rgba(0, 0, 0, 0.05);
        border-top: 1px solid var(--border-color);
        padding: 1.25rem 1.5rem;
    }

    /* Footer */
    .footer {
        padding: 1.5rem 0;
        border-top: 1px solid var(--border-color);
        color: var(--text-muted);
        font-size: 0.875rem;
        margin-top: 2rem;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .sidebar {
            margin-left: -280px;
        }
        
        #wrapper.toggled .sidebar {
            margin-left: 0;
        }
        
        #page-content-wrapper {
            padding-left: 0;
        }
        
        .navbar-search {
            display: none !important;
        }

        .welcome-section {
            padding: 1.5rem;
        }
    }

    @media (max-width: 767.98px) {
        .top-navbar {
            padding: 0.5rem 1rem;
            margin-bottom: 1rem;
        }

        .content-area {
            padding: 0 1rem 1rem;
        }

        .welcome-section {
            padding: 1.25rem;
            text-align: center;
        }

        .welcome-section h1 {
            font-size: 1.5rem;
        }

        .discover-btn {
            width: 100%;
            margin-top: 1rem;
        }
    }

    /* Additional fixes for dashboard */
    .dropdown-menu {
        background-color: var(--primary-light);
        border-color: var(--border-color);
    }
    
    .dropdown-item {
        color: var(--text-light);
    }
    
    .dropdown-item:hover, .dropdown-item:focus {
        background-color: rgba(107, 70, 193, 0.2);
        color: var(--text-white);
    }
    
    .dropdown-header {
        color: var(--text-white);
        font-weight: 600;
    }
    
    .dropdown-divider {
        border-color: var(--border-color);
    }
    
    /* Topbar search input */
    .search-input {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid var(--border-color);
        color: var(--text-white);
    }
    
    .search-input::placeholder {
        color: var(--text-muted);
    }
    
    /* Navigation icons */
    .nav-icon-link {
        color: var(--text-light) !important;
    }
    
    .nav-icon-link:hover {
        color: var(--text-white) !important;
    }
    
    /* Small badges */
    .badge {
        font-weight: 600;
    }
    
    .bg-purple {
        background-color: var(--bg-purple) !important;
    }
    
    .text-purple {
        color: var(--accent-start) !important;
    }
    
    /* Notification item styling */
    .notification-item {
        border-bottom: 1px solid var(--border-color);
    }
    
    .notification-text {
        color: var(--text-light);
    }
    
    .notification-item.unread {
        background-color: rgba(107, 70, 193, 0.1);
    }
    
    /* Stat icons */
    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Card headers */
    .card-header {
        background-color: rgba(15, 23, 42, 0.5);
        border-bottom: 1px solid var(--border-color);
    }
    
    /* Progress bars */
    .progress {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    /* Button colors for better visibility */
    .btn-outline-light {
        color: var(--text-light);
        border-color: var(--text-light);
    }
    
    .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: var(--text-white);
    }
    
    /* Fix for discover event section */
    .discover-btn {
        white-space: nowrap;
    }
</style>
@endpush