<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>EventPro - Event Management Platform</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

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
    </head>

    <body>
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid nav-bar sticky-top px-4 py-2 py-lg-0">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="#" class="navbar-brand p-0">
                    <h1 class="display-6 text-dark"><i class="fas fa-calendar-alt text-primary me-3"></i>EventORG</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                        <a href="#home" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="#services" class="nav-item nav-link">Services</a>
                        <a href="#packages" class="nav-item nav-link">Packages</a>
                        <a href="#contact" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="d-flex align-items-center">
                        <!-- Search Bar -->
                        <div class="search-container me-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search events by name, category, or date">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="dropdown mt-1">
                                <select class="form-select form-select-sm">
                                    <option selected>All Categories</option>
                                    <option>Conference</option>
                                    <option>Workshop</option>
                                    <option>Seminar</option>
                                </select>
                            </div>
                        </div>
                        <!-- Profile Dropdowns -->
                        <div class="dropdown me-2">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-shield"></i> Admin
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.users') }}"><i class="fas fa-users me-2"></i>Users</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.events') }}"><i class="fas fa-calendar-alt me-2"></i>Events</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user-cog me-2"></i>Profile</a></li>
                            </ul>
                        </div>
                        <div class="dropdown me-2">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="organizerDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-tie"></i> Organizer
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="organizerDropdown">
                                <li><a class="dropdown-item" href="{{ route('organizer.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('organizer.events') }}"><i class="fas fa-calendar-alt me-2"></i>My Events</a></li>
                                <li><a class="dropdown-item" href="{{ route('events.create') }}"><i class="fas fa-plus me-2"></i>Create Event</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('organizer.profile') }}"><i class="fas fa-user-cog me-2"></i>Profile</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="participantDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> Participant
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="participantDropdown">
                                <li><a class="dropdown-item" href="{{ route('participant.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('participant.events') }}"><i class="fas fa-calendar-alt me-2"></i>My Events</a></li>
                                <li><a class="dropdown-item" href="{{ route('participant.tickets') }}"><i class="fas fa-ticket-alt me-2"></i>My Tickets</a></li>
                        <!-- Authentication Links -->
                        <div class="auth-links">
                            <a href="#" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Carousel Start -->
        <div id="home" class="header-carousel owl-carousel">
            <div class="header-carousel-item">
                <img src="{{ asset('asset/img/carousel-1.jpg') }}" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="container align-items-center py-4">
                        <div class="row g-5 align-items-center">
                            <div class="col-xl-7 fadeInLeft animated" data-animation="fadeInLeft" data-delay="1s" style="animation-delay: 1s;">
                                <div class="text-start">
                                    <h4 class="text-primary text-uppercase fw-bold mb-4">Welcome To EventORG</h4>
                                    <h1 class="display-4 text-uppercase text-white mb-4">Discover and Manage Events with Ease</h1>
                                    <p class="mb-4 fs-5">Join thousands of professionals at top events. Find, register, and manage your events all in one place.
                                    </p>
                                    <div class="d-flex flex-shrink-0">
                                        <a class="btn btn-primary rounded-pill text-white py-3 px-5 me-3" href="#">Explore Events</a>
                                        <a class="btn btn-light rounded-pill text-primary py-3 px-5" href="#">Organize an Event</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 fadeInRight animated" data-animation="fadeInRight" data-delay="1s" style="animation-delay: 1s;">
                                <div class="ticket-form p-5">
                                    <h2 class="text-dark text-uppercase mb-4">Register for Event</h2>
                                    <form>
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <input type="text" class="form-control border-0 py-2" id="name" placeholder="Your Name">
                                            </div>
                                            <div class="col-12 col-xl-6">
                                                <input type="email" class="form-control border-0 py-2" id="email" placeholder="Your Email">
                                            </div>
                                            <div class="col-12 col-xl-6">
                                                <input type="phone" class="form-control border-0 py-2" id="phone" placeholder="Phone">
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select border-0 py-2" aria-label="Default select example">
                                                    <option selected>Select Event Type</option>
                                                    <option value="1">Conference</option>
                                                    <option value="2">Workshop</option>
                                                    <option value="3">Seminar</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <input class="form-control border-0 py-2" type="date">
                                            </div>
                                            <div class="col-12">
                                                <input type="number" class="form-control border-0 py-2" id="number" placeholder="Number of Tickets">
                                            </div>
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary w-100 py-2 px-5">Register Now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item">
                <img src="{{ asset('asset/img/carousel-2.jpg') }}" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="container py-4">
                        <div class="row g-5 align-items-center">
                            <div class="col-xl-7 fadeInLeft animated" data-animation="fadeInLeft" data-delay="1s" style="animation-delay: 1s;">
                                <div class="text-start">
                                    <h4 class="text-primary text-uppercase fw-bold mb-4">Welcome To EventPro</h4>
                                    <h1 class="display-4 text-uppercase text-white mb-4">Create Unforgettable Events</h1>
                                    <p class="mb-4 fs-5">Plan, organize, and manage your events with ease. Our platform provides all the tools you need for successful event management.
                                    </p>
                                    <div class="d-flex flex-shrink-0">
                                        <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="#">Create Event</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 fadeInRight animated" data-animation="fadeInRight" data-delay="1s" style="animation-delay: 1s;">
                                <div class="ticket-form p-5">
                                    <h2 class="text-dark text-uppercase mb-4">Register for Event</h2>
                                    <form>
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <input type="text" class="form-control border-0 py-2" id="name" placeholder="Your Name">
                                            </div>
                                            <div class="col-12 col-xl-6">
                                                <input type="email" class="form-control border-0 py-2" id="email" placeholder="Your Email">
                                            </div>
                                            <div class="col-12 col-xl-6">
                                                <input type="phone" class="form-control border-0 py-2" id="phone" placeholder="Phone">
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select border-0 py-2" aria-label="Default select example">
                                                    <option selected>Select Event Type</option>
                                                    <option value="1">Conference</option>
                                                    <option value="2">Workshop</option>
                                                    <option value="3">Seminar</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <input class="form-control border-0 py-2" type="date">
                                            </div>
                                            <div class="col-12">
                                                <input type="number" class="form-control border-0 py-2" id="number" placeholder="Number of Tickets">
                                            </div>
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary w-100 py-2 px-5">Register Now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->

        <!-- Categories Filter Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Event Categories</h4>
                    <h1 class="display-5 mb-4">Browse Events by Category</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="#" class="btn btn-outline-primary rounded-pill py-3 px-4 w-100 mb-2">Conference</a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="#" class="btn btn-outline-primary rounded-pill py-3 px-4 w-100 mb-2">Workshop</a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="#" class="btn btn-outline-primary rounded-pill py-3 px-4 w-100 mb-2">Seminar</a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="#" class="btn btn-outline-primary rounded-pill py-3 px-4 w-100 mb-2">Networking</a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="#" class="btn btn-outline-primary rounded-pill py-3 px-4 w-100 mb-2">Training</a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="#" class="btn btn-outline-primary rounded-pill py-3 px-4 w-100 mb-2">Exhibition</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Categories Filter End -->

        <!-- How It Works Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">How It Works</h4>
                    <h1 class="display-5 mb-4">Simple Steps to Get Started</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item p-4 text-center">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-search fa-4x text-primary"></i>
                                </div>
                                <h4 class="mb-3">Find Events</h4>
                                <p class="mb-0">Browse through our extensive collection of events and find the perfect match for you.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item p-4 text-center">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-ticket-alt fa-4x text-primary"></i>
                                </div>
                                <h4 class="mb-3">Register in Seconds</h4>
                                <p class="mb-0">Quick and easy registration process to secure your spot at any event.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item p-4 text-center">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-calendar-check fa-4x text-primary"></i>
                                </div>
                                <h4 class="mb-3">Manage Your Events</h4>
                                <p class="mb-0">Keep track of your registered events and manage your schedule efficiently.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="service-item p-4 text-center">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-chart-line fa-4x text-primary"></i>
                                </div>
                                <h4 class="mb-3">Track Attendance</h4>
                                <p class="mb-0">Monitor your event participation and access your event history anytime.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- How It Works End -->

        <!-- Feature Start -->
        <div class="container-fluid feature py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item">
                            <img src="{{ asset('asset/img/feature-1.jpg') }}" class="img-fluid rounded w-100" alt="Image">
                            <div class="feature-content p-4">
                                <div class="feature-content-inner">
                                    <h4 class="text-white">Professional Conferences</h4>
                                    <p class="text-white">Host impactful conferences with our comprehensive event management tools and professional support services.
                                    </p>
                                    <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Learn More <i class="fa fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="feature-item">
                            <img src="{{ asset('asset/img/feature-2.jpg') }}" class="img-fluid rounded w-100" alt="Image">
                            <div class="feature-content p-4">
                                <div class="feature-content-inner">
                                    <h4 class="text-white">Interactive Workshops</h4>
                                    <p class="text-white">Create engaging workshops with our interactive tools and participant management features.
                                    </p>
                                    <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Learn More <i class="fa fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="feature-item">
                            <img src="{{ asset('asset/img/feature-3.jpg') }}" class="img-fluid rounded w-100" alt="Image">
                            <div class="feature-content p-4">
                                <div class="feature-content-inner">
                                    <h4 class="text-white">Virtual Events</h4>
                                    <p class="text-white">Host seamless virtual events with our integrated streaming and engagement tools.
                                    </p>
                                    <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Learn More <i class="fa fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End -->

        <!-- About Start -->
        <div id="about" class="container-fluid about pb-5">
            <div class="container pb-5">
                <div class="row g-5">
                    <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div>
                            <h4 class="text-primary">About EventPro</h4>
                            <h1 class="display-5 mb-4">Your Complete Event Management Solution</h1>
                            <p class="mb-5">EventPro is a comprehensive event management platform designed to streamline the entire event planning process. From small workshops to large conferences, we provide all the tools you need for successful event organization.
                            </p>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="me-3"><i class="fas fa-calendar-check fa-3x text-primary"></i></div>
                                        <div>
                                            <h4>Easy Scheduling</h4>
                                            <p>Intuitive calendar and scheduling tools for seamless event planning.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="me-3"><i class="fas fa-ticket-alt fa-3x text-primary"></i></div>
                                        <div>
                                            <h4>Ticket Management</h4>
                                            <p>Efficient ticket sales and registration management system.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="me-3"><i class="fas fa-chart-line fa-3x text-primary"></i></div>
                                        <div>
                                            <h4>Analytics</h4>
                                            <p>Comprehensive analytics and reporting tools for event insights.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="me-3"><i class="fas fa-bullhorn fa-3x text-primary"></i></div>
                                        <div>
                                            <h4>Marketing Tools</h4>
                                            <p>Integrated marketing and promotion features for your events.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="position-relative rounded">
                            <div class="rounded" style="margin-top: 40px;">
                                <div class="row g-0">
                                    <div class="col-lg-12">
                                        <div class="rounded mb-4">
                                            <img src="{{ asset('asset/img/about.jpg') }}" class="img-fluid rounded w-100" alt="">
                                        </div>
                                        <div class="row gx-4 gy-0">
                                            <div class="col-6">
                                                <div class="counter-item bg-primary rounded text-center p-4 h-100">
                                                    <div class="counter-item-icon mx-auto mb-3">
                                                        <i class="fas fa-users fa-3x text-white"></i>
                                                    </div>
                                                    <div class="counter-counting mb-3">
                                                        <span class="text-white fs-2 fw-bold" data-toggle="counter-up">150</span>
                                                        <span class="h1 fw-bold text-white">K +</span>
                                                    </div>
                                                    <h5 class="text-white mb-0">Happy Users</h5>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="counter-item bg-dark rounded text-center p-4 h-100">
                                                    <div class="counter-item-icon mx-auto mb-3">
                                                        <i class="fas fa-calendar-alt fa-3x text-white"></i>
                                                    </div>
                                                    <div class="counter-counting mb-3">
                                                        <span class="text-white fs-2 fw-bold" data-toggle="counter-up">122</span>
                                                        <span class="h1 fw-bold text-white"> +</span>
                                                    </div>
                                                    <h5 class="text-white mb-0">Events Managed</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded bg-primary p-4 position-absolute d-flex justify-content-center" style="width: 90%; height: 80px; top: -40px; left: 50%; transform: translateX(-50%);">
                                <h3 class="mb-0 text-white">5 Years Experience</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Service Start -->
        <div id="services" class="container-fluid service py-5">
            <div class="container service-section py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Services</h4>
                    <h1 class="display-5 text-white mb-4">Comprehensive Event Management Solutions</h1>
                    <p class="mb-0 text-white">From event planning to execution, we provide end-to-end solutions for all your event management needs. Our platform offers powerful tools and features to make your events successful.
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-0 col-md-1 col-lg-2 col-xl-2"></div>
                    <div class="col-md-10 col-lg-8 col-xl-8 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-days p-4">
                            <div class="py-2 border-bottom border-top d-flex align-items-center justify-content-between flex-wrap"><h4 class="mb-0 pb-2 pb-sm-0">Monday - Friday</h4> <p class="mb-0"><i class="fas fa-clock text-primary me-2"></i>9:00 AM - 6:00 PM</p></div>
                            <div class="py-2 border-bottom d-flex align-items-center justify-content-between flex-shrink-1 flex-wrap"><h4 class="mb-0 pb-2 pb-sm-0">Saturday - Sunday</h4> <p class="mb-0"><i class="fas fa-clock text-primary me-2"></i>10:00 AM - 4:00 PM</p></div>
                            <div class="py-2 border-bottom d-flex align-items-center justify-content-between flex-shrink-1 flex-wrap"><h4 class="mb-0">Support Hours</h4> <p class="mb-0"><i class="fas fa-clock text-primary me-2"></i>24/7 Online Support</p></div>
                        </div>
                    </div>
                    <div class="col-0 col-md-1 col-lg-2 col-xl-2"></div>

                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item p-4">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-calendar-plus fa-4x"></i>
                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">Event Planning</a>
                                <p class="mb-0">Comprehensive tools for planning and organizing successful events.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item p-4">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-ticket-alt fa-4x"></i>
                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">Ticket Management</a>
                                <p class="mb-0">Efficient ticket sales and registration management system.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item p-4">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-bullhorn fa-4x"></i>
                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">Event Marketing</a>
                                <p class="mb-0">Powerful marketing tools to promote your events effectively.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="service-item p-4">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-chart-line fa-4x"></i>
                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">Analytics</a>
                                <p class="mb-0">Detailed analytics and reporting for event performance.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        <!-- Ticket Packages Start -->
        <div id="packages" class="container-fluid py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="packages-item h-100">
                            <h4 class="text-primary">Event Packages</h4>
                            <h1 class="display-5 mb-4">Choose The Perfect Package For Your Event</h1>
                            <p class="mb-4">Select from our range of event management packages designed to meet your specific needs. From small workshops to large conferences, we have the perfect solution for you.
                            </p>
                            <p><i class="fa fa-check text-primary me-2"></i>Professional event management tools</p>
                            <p><i class="fa fa-check text-primary me-2"></i>Customizable event packages</p>
                            <p><i class="fa fa-check text-primary me-2"></i>24/7 customer support</p>
                            <p class="mb-5"><i class="fa fa-check text-primary me-2"></i>Advanced analytics and reporting</p>
                            <a href="#" class="btn btn-primary rounded-pill py-3 px-5">Get Started</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="pricing-item bg-dark rounded text-center p-5 h-100">
                            <div class="pb-4 border-bottom">
                                <h2 class="mb-4 text-primary">Professional Package</h2>
                                <p class="mb-4">Perfect for medium-sized events and conferences</p>
                                <h2 class="mb-0 text-primary">$299<span class="text-body fs-5 fw-normal">/month</span></h2>
                            </div>
                            <div class="py-4">
                                <p class="mb-4"><i class="fa fa-check text-primary me-2"></i>Up to 500 attendees</p>
                                <p class="mb-4"><i class="fa fa-check text-primary me-2"></i>Advanced ticketing</p>
                                <p class="mb-4"><i class="fa fa-check text-primary me-2"></i>Email marketing</p>
                                <p class="mb-4"><i class="fa fa-check text-primary me-2"></i>Basic analytics</p>
                                <p class="mb-4"><i class="fa fa-check text-primary me-2"></i>24/7 support</p>
                            </div>
                            <a href="#" class="btn btn-light rounded-pill py-3 px-5">Get Started</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="pricing-item bg-primary rounded text-center p-5 h-100">
                            <div class="pb-4 border-bottom">
                                <h2 class="text-dark mb-4">Enterprise Package</h2>
                                <p class="text-white mb-4">For large-scale events and conferences</p>
                                <h2 class="text-dark mb-0">$599<span class="text-white fs-5 fw-normal">/month</span></h2>
                            </div>
                            <div class="text-white py-4">
                                <p class="mb-4"><i class="fa fa-check text-dark me-2"></i>Unlimited attendees</p>
                                <p class="mb-4"><i class="fa fa-check text-dark me-2"></i>Premium features</p>
                                <p class="mb-4"><i class="fa fa-check text-dark me-2"></i>Advanced analytics</p>
                                <p class="mb-4"><i class="fa fa-check text-dark me-2"></i>Priority support</p>
                            </div>
                            <a href="#" class="btn btn-dark rounded-pill py-3 px-5">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ticket Packages End -->

        <!-- Contact Start -->
        <div id="contact" class="container-fluid py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Contact Us</h4>
                    <h1 class="display-5 mb-4">Get In Touch For Any Query</h1>
                    <p class="mb-0">Have questions about our event management platform? Need help planning your next event? Contact us today and our team will be happy to assist you with any inquiries.</p>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 rounded">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-map-marker-alt text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Our Office</h5>
                                        <p class="mb-0">123 Event Street, City, Country</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 rounded">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-phone text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Call Us</h5>
                                        <p class="mb-0">+012 345 6789</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 rounded">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-envelope text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Email Us</h5>
                                        <p class="mb-0">info@eventpro.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 rounded">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-clock text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Office Hours</h5>
                                        <p class="mb-0">Mon-Fri: 9am-6pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="mb-4">Our dedicated support team is ready to assist you with any questions or concerns about our event management platform. We're committed to helping you create successful and memorable events.</p>
                        <div class="d-flex align-items-center">
                            <a class="btn btn-primary rounded-circle me-3" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary rounded-circle me-3" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary rounded-circle me-3" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-primary rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.4s">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->

        <!-- Footer Start -->
        <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-4 col-md-6">
                        <h4 class="text-white mb-4">About EventORG</h4>
                        <p class="mb-4">Your premier platform for discovering, managing, and organizing events. Join our community of professionals and make your events a success.</p>
                        <div class="d-flex pt-3">
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h4 class="text-white mb-4">Quick Links</h4>
                        <div class="d-flex flex-column">
                            <a class="text-white mb-2" href="#"><i class="fas fa-angle-right me-2"></i>About Us</a>
                            <a class="text-white mb-2" href="#"><i class="fas fa-angle-right me-2"></i>Contact Us</a>
                            <a class="text-white mb-2" href="#"><i class="fas fa-angle-right me-2"></i>Our Services</a>
                            <a class="text-white mb-2" href="#"><i class="fas fa-angle-right me-2"></i>Terms & Conditions</a>
                            <a class="text-white" href="#"><i class="fas fa-angle-right me-2"></i>Privacy Policy</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h4 class="text-white mb-4">Contact Info</h4>
                        <p class="mb-2"><i class="fas fa-map-marker-alt me-3"></i>123 Event Street, City, Country</p>
                        <p class="mb-2"><i class="fas fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fas fa-envelope me-3"></i>info@eventorg.com</p>
                        <div class="d-flex pt-3">
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-face