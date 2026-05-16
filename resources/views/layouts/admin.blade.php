<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - OneCitizen Portal</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; overflow-x: hidden; }
        .navbar-gov { background-color: #0c2340; }
        .sidebar { min-height: calc(100vh - 56px); background-color: #ffffff; box-shadow: 0 0 15px rgba(0,0,0,.05); border-right: 1px solid #e9ecef; }
        .sidebar .nav-link { color: #495057; padding: 0.8rem 1rem; font-weight: 500; display: flex; align-items: center; border-radius: 6px; margin-bottom: 0.2rem; transition: all 0.2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background-color: #f8f9fa; color: #0c2340; }
        .sidebar .nav-link.active { background-color: #0c2340; color: #ffffff; box-shadow: 0 2px 4px rgba(12, 35, 64, 0.2); }
        .sidebar .nav-link.active:hover { background-color: #0c2340; color: #ffffff; }
        .sidebar .nav-link i { margin-right: 12px; font-size: 1.1rem; }
        .main-content { padding: 2rem; }
        .card { border-radius: 8px; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.04); border: none; }
        .card-header { background-color: #ffffff; border-bottom: 1px solid #e9ecef; font-weight: 600; padding: 1rem 1.25rem; }
        .bg-opacity-10 { --bs-bg-opacity: 0.1; }
    </style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-gov shadow-sm sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
                <i class="bi bi-shield-check me-2 fs-4"></i> OneCitizen Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarAdmin">
                <ul class="navbar-nav ms-auto align-items-center">
                    <form class="d-flex me-4 d-none d-md-flex" action="{{ route('search.index') }}" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control bg-light border-0" placeholder="Search Portal..." aria-label="Search" style="width: 250px;" required>
                            <button class="btn btn-light border-0 text-muted" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                    <li class="nav-item me-3 d-none d-lg-block">
                        <span class="text-light opacity-75 small"><i class="bi bi-clock me-1"></i> {{ now()->format('M d, Y') }}</span>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-light position-relative" href="#">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="position-absolute top-25 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light d-flex align-items-center" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-5 me-2"></i> {{ Auth::user()->name ?? 'Administrator' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="adminDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2 text-muted"></i> My Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2 text-muted"></i> Preferences</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-medium">
                                        <i class="bi bi-box-arrow-right me-2"></i> Secure Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse pt-4 px-3" id="sidebarMenu">
                <div class="position-sticky">
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-2 mt-2 mb-3 text-muted text-uppercase small fw-bold" style="letter-spacing: 0.5px;">
                        <span>Core Modules</span>
                    </h6>
                    <ul class="nav flex-column mb-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-grid-1x2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('citizens.*') ? 'active' : '' }}" href="{{ route('citizens.index') }}">
                                <i class="bi bi-people"></i> Citizens
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pension-schemes.*') ? 'active' : '' }}" href="{{ route('pension-schemes.index') }}">
                                <i class="bi bi-piggy-bank"></i> Pension Schemes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('citizen-pensions.*') ? 'active' : '' }}" href="{{ route('citizen-pensions.index') }}">
                                <i class="bi bi-link-45deg"></i> Assignments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('duplicate-detection.*') ? 'active' : '' }}" href="{{ route('duplicate-detection.index') }}">
                                <i class="bi bi-intersect"></i> Duplicate Detection
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-2 mt-4 mb-3 text-muted text-uppercase small fw-bold" style="letter-spacing: 0.5px;">
                        <span>System</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                                <i class="bi bi-bar-chart-line"></i> Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                        </li>
                        <li class="nav-item mt-3 border-top pt-3">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start px-3 fw-bold">
                                    <i class="bi bi-box-arrow-left text-danger"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content Area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                @yield('content')
                
                <!-- Footer Section -->
                <footer class="pt-4 my-md-5 pt-md-4 border-top text-center text-muted small">
                    <div class="row">
                        <div class="col-12">
                            &copy; {{ date('Y') }} OneCitizen Portal Admin Panel. Authorized Personnel Only.
                        </div>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
