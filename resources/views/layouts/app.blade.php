<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bibliotheek')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #1a252f;
            --accent-color: #34495e;
            --light-color: #f0f2f5;
            --dark-color: #212529;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: var(--secondary-color);
            padding: 0.8rem 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 600;
            color: white !important;
        }

        .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8) !important;
            transition: color 0.2s ease;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: white !important;
        }

        .btn-logout {
            background: none;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: white !important;
        }

        .main-content {
            flex: 1;
            padding: 2rem 0;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #2c3e50;
            border-color: #2c3e50;
        }

        footer {
            background-color: var(--secondary-color);
            color: rgba(255, 255, 255, 0.8);
            padding: 1.5rem 0;
            margin-top: auto;
            text-align: center;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            margin-left: 1.5rem;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        @media (max-width: 768px) {
            .footer-links {
                margin-top: 1rem;
            }

            .footer-links a {
                margin: 0 0.75rem;
            }
        }
    </style>

    @yield('styles')
</head>
<body>
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-book-open"></i> Bibliotheek
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-search me-1"></i> Zoeken</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-layer-group me-1"></i> Collecties</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-logout nav-link btn">
                                    <i class="fas fa-sign-out-alt me-1"></i> Uitloggen
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i> Inloggen</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i> Registreren</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    {{-- footer --}}
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="copyright">
                    &copy; {{ date('Y') }} Bibliotheeksysteem - Alle rechten voorbehouden
                </div>
                <div class="footer-links">
                    <a href="#"><i class="fas fa-info-circle me-1"></i> Over ons</a>
                    <a href="#"><i class="fas fa-envelope me-1"></i> Contact</a>
                    <a href="#"><i class="fas fa-shield-alt me-1"></i> Privacy</a>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
