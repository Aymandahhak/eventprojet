<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eventify') }}</title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('asset/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    
    <!-- Custom styles inline from index.blade.php -->
    <style>
        /* Base & Color Styles */
        :root {
            --primary-dark: #070a13;
            --primary-medium: #101624;
            --accent-start: #3a3456;
            --accent-end: #23243a;
            --accent-end-rgb: 35, 36, 58;
            --text-white: #f8f9fa;
            --text-light: #cfd2da;
            --text-muted: #7a7d8a;
            --card-bg: rgba(16, 22, 36, 0.7);
            --border-color: rgba(255, 255, 255, 0.07);
            --footer-bg: var(--primary-dark);
            --copyright-bg: #070b17;
        }
        
        body {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            color: var(--text-light);
            font-family: 'Montserrat', sans-serif; /* Modern sans-serif */
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700; /* Bold titles */
            color: var(--text-white);
        }

        h1.display-4, h1.display-5 {
            font-weight: 800; /* Even bolder for main titles */
            letter-spacing: -0.5px;
        }
        
        p {
            font-family: 'Open Sans', sans-serif; /* Readable body font */
            color: var(--text-light);
            line-height: 1.8; /* Improved readability */
            font-size: 1rem;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }
        
        .btn { /* General button reset for rounded corners */
            border-radius: 50px; /* Rounded corners for all buttons */
            padding: 10px 25px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none; /* Remove default bootstrap border */
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .btn-primary, .bg-primary {
            background: linear-gradient(90deg, var(--accent-start) 0%, var(--accent-end) 100%) !important;
            border: none !important;
            color: var(--text-white) !important;
            box-shadow: 0 4px 15px rgba(192, 108, 132, 0.3);
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(90deg, var(--accent-hover-start) 0%, var(--accent-hover-end) 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(192, 108, 132, 0.4);
        }
        
        .btn-outline-primary {
            color: var(--accent-start) !important;
            border: 1.5px solid var(--accent-start) !important;
            background: transparent !important;
            box-shadow: none;
        }
        
        .btn-outline-primary:hover {
            background: linear-gradient(90deg, var(--accent-start) 0%, var(--accent-end) 100%) !important;
            color: var(--text-white) !important;
            border-color: transparent !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(192, 108, 132, 0.3);
        }
        
        .text-primary { /* For text that needs accent color */
            color: var(--accent-start) !important;
        }

        /* Navigation Styles */
        .nav-bar {
            background-color: rgba(10, 15, 31, 0.7); /* Darker, more transparent */
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        
        .navbar-light .navbar-nav .nav-link {
            color: var(--text-white); /* Changed from --text-light to --text-white for better visibility */
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
            letter-spacing: 0.8px; /* Subtle spacing */
            font-size: 0.9rem; /* Slightly smaller nav items */
            text-transform: uppercase; /* As per image */
            padding: 0.5rem 1rem;
        }
        
        .navbar-light .navbar-nav .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px; /* Give a bit space */
            left: 50%;
            background: linear-gradient(90deg, var(--accent-start), var(--accent-end));
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 1px;
        }
        
        .navbar-light .navbar-nav .nav-link:hover:after,
        .navbar-light .navbar-nav .nav-link.active:after {
            width: 50%; /* Subtle underline */
        }
        
        .navbar-light .navbar-nav .nav-link.active,
        .navbar-light .navbar-nav .nav-link:hover {
            color: var(--text-white); /* Brighter on hover/active */
        }

        .navbar-brand .logo-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, var(--accent-start), var(--accent-end));
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px; /* E */
            margin-right: 8px;
            box-shadow: 0 2px 8px rgba(192, 108, 132, 0.3);
        }
        
        .navbar-light .navbar-brand h1 {
            color: var(--text-white);
            font-weight: 700;
            font-size: 1.75rem; /* Brand name size */
            display: inline-flex;
            align-items: center;
        }
        
        .text-dark { /* Redefine for dark theme */
            color: var(--text-white) !important;
        }

        /* Card & Content Styles */
        .bg-light { /* Will be used for cards and sections */
            background-color: var(--card-bg) !important; 
            backdrop-filter: blur(5px);
            border: 1px solid var(--border-color);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            border-radius: 15px; /* Rounded cards */
        }
        
        .card, .event-card, .service-item, .counter-item, .ticket-form, .service-days {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
            overflow: hidden;
            border-radius: 15px; /* Consistent rounded corners */
        }
        
        .card:hover, .event-card:hover, .service-item:hover {
            transform: translateY(-8px) scale(1.03); /* Increased lift and added scale */
            box-shadow: 0 15px 35px rgba(var(--accent-end-rgb), 0.25); /* Shadow using accent color */
            border-color: var(--accent-end); /* Brighter accent border on hover */
        }
        
        .form-control, .form-select {
            background-color: rgba(255, 255, 255, 0.05); /* Slightly lighter input bg */
            color: var(--text-light);
            border: 1px solid var(--border-color);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
            border-radius: 10px; /* Rounded inputs */
            padding: 12px 15px;
        }
        
        .form-control:focus, .form-select:focus {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-start);
            box-shadow: 0 0 0 3px rgba(108, 91, 123, 0.3); /* Accent glow on focus */
            color: var(--text-white);
        }
        
        .form-control::placeholder {
            color: var(--text-muted);
        }
        
        .form-floating > label {
            color: var(--text-muted);
        }
        
        /* Background pattern for subtle texture */
        body::before {
            content: '';
            position: fixed; /* Fixed so it doesn't scroll */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.02; /* Very subtle */
            background-image: 
                radial-gradient(circle at 1px 1px, rgba(255,255,255,1) 1px, transparent 0), /* Tiny dots */
                radial-gradient(circle at 25px 25px, rgba(255,255,255,1) 1px, transparent 0);
            background-size: 50px 50px;
            pointer-events: none; /* Allows clicking through */
            z-index: -1; /* Behind all content */
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--primary-dark);
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(var(--accent-start), var(--accent-end));
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(var(--accent-hover-start), var(--accent-hover-end));
        }

        /* Additional styles for event page */
        .pagination .page-item .page-link {
            color: var(--accent-start);
            background-color: var(--card-bg);
            border-color: var(--border-color);
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(90deg, var(--accent-start) 0%, var(--accent-end) 100%);
            border-color: transparent;
            color: var(--text-white);
        }
        
        .pagination .page-item .page-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text-white);
        }

        /* Footer Styles */
        .footer {
            background: var(--footer-bg);
            padding-top: 60px;
            padding-bottom: 0;
        }

        .footer h4 {
            margin-bottom: 25px;
            color: var(--text-white);
        }

        .footer p, .footer a {
            color: var(--text-muted);
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--accent-start);
        }

        .copyright {
            background-color: var(--copyright-bg);
            border-top: 1px solid var(--border-color);
            padding: 25px 0;
            font-size: 0.9rem;
        }

        .copyright a {
            color: var(--accent-start);
            font-weight: 500;
        }

        .copyright a:hover {
            color: var(--accent-end);
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <div id="app">
        <!-- Navbar Start -->
        <div class="container-fluid nav-bar sticky-top px-4 py-2 py-lg-0">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="{{ url('/') }}" class="navbar-brand p-0">
                    <h1><span class="logo-icon">E</span>ventify</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                        <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">HOME</a>
                        <a href="{{ route('events.index') }}" class="nav-item nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}">EVENTS</a>
                        @auth
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="nav-item nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">DASHBOARD</a>
                            @elseif(Auth::user()->isOrganizer())
                                <a href="{{ route('organizer.dashboard') }}" class="nav-item nav-link {{ request()->routeIs('organizer.*') ? 'active' : '' }}">DASHBOARD</a>
                            @else
                                <a href="{{ route('participant.dashboard') }}" class="nav-item nav-link {{ request()->routeIs('participant.*') ? 'active' : '' }}">DASHBOARD</a>
                            @endif
                        @endauth
                    </div>
                    <div class="d-flex align-items-center">
                        <!-- Search Icon -->
                        <a href="#" class="nav-item nav-link me-3"><i class="fas fa-search text-white"></i></a>
                        
                        <!-- Auth Links -->
                        @auth
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    @if(Auth::user()->isAdmin())
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.users') }}"><i class="fas fa-users me-2"></i>Users</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.events.index') }}"><i class="fas fa-calendar-alt me-2"></i>Events</a></li>
                                    @elseif(Auth::user()->isOrganizer())
                                        <li><a class="dropdown-item" href="{{ route('organizer.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{ route('organizer.events') }}"><i class="fas fa-calendar-alt me-2"></i>My Events</a></li>
                                        <li><a class="dropdown-item" href="{{ route('events.create') }}"><i class="fas fa-plus me-2"></i>Create Event</a></li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('participant.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{ route('participant.events') }}"><i class="fas fa-calendar-alt me-2"></i>My Events</a></li>
                                        <li><a class="dropdown-item" href="{{ route('participant.tickets') }}"><i class="fas fa-ticket-alt me-2"></i>My Tickets</a></li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                            <a href="{{ route('register') }}" class="btn contact-btn">Register</a>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->

        <main>
            @yield('content')
        </main>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid footer py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-4">About Eventify</h4>
                    <p class="mb-4">Your premier platform for discovering, managing, and organizing events. Join our community of professionals and make your events a success.</p>
                    <div class="d-flex pt-3 social-icons">
                        <a class="social-icon me-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="social-icon me-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="social-icon me-2" href=""><i class="fab fa-instagram"></i></a>
                        <a class="social-icon me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-4">Quick Links</h4>
                    <div class="d-flex flex-column">
                        <a class="mb-2" href="{{ url('/') }}"><i class="fas fa-angle-right me-2"></i>Home</a>
                        <a class="mb-2" href="{{ route('events.index') }}"><i class="fas fa-angle-right me-2"></i>Events</a>
                        <a class="mb-2" href="#"><i class="fas fa-angle-right me-2"></i>About Us</a>
                        <a class="mb-2" href="#"><i class="fas fa-angle-right me-2"></i>Contact Us</a>
                        <a class="" href="#"><i class="fas fa-angle-right me-2"></i>Privacy Policy</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-4">Contact Info</h4>
                    <p class="mb-2"><i class="fas fa-map-marker-alt text-primary me-3"></i>123 Event Street, City, Country</p>
                    <p class="mb-2"><i class="fas fa-phone-alt text-primary me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fas fa-envelope text-primary me-3"></i>info@eventify.com</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Eventify</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <span class="text-light">Designed By <a href="#" class="text-light">Eventify Team</a></span>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('asset/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('asset/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('asset/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('asset/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('asset/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('asset/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('asset/js/main.js') }}"></script>
    
    <!-- Stack for additional scripts -->
    @stack('scripts')
</body>
</html>
