<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beasiswa Kampus Top Indonesia')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-dark: linear-gradient(135deg, #0c0c1d 0%, #1a1a3e 100%);
            --gradient-overlay: linear-gradient(135deg, rgba(102, 126, 234, 0.92) 0%, rgba(118, 75, 162, 0.92) 100%);
            --shadow-sm: 0 4px 20px rgba(102, 126, 234, 0.15);
            --shadow-md: 0 10px 40px rgba(102, 126, 234, 0.2);
            --shadow-lg: 0 20px 60px rgba(102, 126, 234, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 0.8rem 0;
            box-shadow: 0 2px 30px rgba(0,0,0,0.08);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s;
        }

        .navbar-custom.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 40px rgba(0,0,0,0.12);
        }

        .navbar-custom .navbar-brand {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 900;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
        }

        .navbar-custom .navbar-brand i {
            -webkit-text-fill-color: initial;
            color: #667eea;
            margin-right: 10px;
        }

        .navbar-custom .nav-link {
            color: #4a4a4a !important;
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
            padding: 0.5rem 1.2rem !important;
        }

        .navbar-custom .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: var(--gradient-primary);
            transition: all 0.3s;
            border-radius: 10px;
        }

        .navbar-custom .nav-link:hover::after {
            width: 60%;
        }

        .navbar-custom .nav-link:hover {
            color: #667eea !important;
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            background: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1920&q=80') center/cover no-repeat;
            padding: 120px 0 80px;
            margin-top: 0;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--gradient-overlay);
            z-index: 1;
        }

        .hero-section .hero-pattern {
            position: absolute;
            inset: 0;
            z-index: 1;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255,255,255,0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(255,255,255,0.05) 0%, transparent 50%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-weight: 900;
            font-size: 4rem;
            margin-bottom: 1rem;
            letter-spacing: -1.5px;
            color: white;
            text-shadow: 0 4px 30px rgba(0,0,0,0.2);
        }

        .hero-section h1 .highlight-text {
            background: rgba(255,255,255,0.15);
            padding: 0.1rem 1.5rem;
            border-radius: 20px;
            display: inline-block;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .hero-section .subtitle {
            font-size: 1.3rem;
            opacity: 0.95;
            font-weight: 300;
            color: rgba(255,255,255,0.9);
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(20px);
            padding: 0.6rem 2rem;
            border-radius: 50px;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255,255,255,0.25);
            color: white;
            font-weight: 500;
        }

        .hero-badge i {
            margin-right: 8px;
        }

        .search-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 60px;
            padding: 8px;
            max-width: 750px;
            margin: 35px auto 0;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            position: relative;
            z-index: 2;
            transition: all 0.3s;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .search-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
        }

        .search-box input {
            border: none;
            padding: 1.2rem 1.8rem;
            border-radius: 60px;
            background: transparent;
            width: 100%;
            font-size: 1rem;
            color: #333;
        }

        .search-box input:focus {
            outline: none;
        }

        .search-box input::placeholder {
            color: #adb5bd;
            font-weight: 300;
        }

        .search-box button {
            background: var(--gradient-primary);
            border: none;
            padding: 0.9rem 2.5rem;
            border-radius: 60px;
            color: white;
            font-weight: 700;
            transition: all 0.3s;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .search-box button:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.5);
        }

        .filter-wrapper {
            position: relative;
            z-index: 2;
            margin-top: 2rem;
        }

        .filter-btn {
            border: 2px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            color: white;
            padding: 0.6rem 1.8rem;
            border-radius: 50px;
            transition: all 0.3s;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
        }

        .filter-btn:hover {
            background: white;
            color: #667eea;
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .filter-btn.active {
            background: white;
            color: #667eea;
            border-color: white;
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.05);
            z-index: 1;
            animation: float 20s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -50px;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
            animation-duration: 25s;
        }

        .floating-element:nth-child(3) {
            width: 150px;
            height: 150px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -10s;
            animation-duration: 30s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg) scale(1); }
            33% { transform: translate(30px, -30px) rotate(120deg) scale(1.1); }
            66% { transform: translate(-20px, 20px) rotate(240deg) scale(0.9); }
        }

        /* Section Titles */
        .section-title {
            font-weight: 800;
            margin-bottom: 0.5rem;
            position: relative;
            font-size: 2.5rem;
            letter-spacing: -1px;
        }

        .section-title .highlight {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            font-weight: 300;
        }

        /* University Cards */
        .university-card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem 1.5rem 2rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            height: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.04);
        }

        .university-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            opacity: 0;
            transition: all 0.4s;
        }

        .university-card:hover::before {
            opacity: 1;
        }

        .university-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(102, 126, 234, 0.1);
        }

        .university-card .icon-wrapper {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            position: relative;
            transition: all 0.4s;
        }

        .university-card .icon-wrapper::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: inherit;
            opacity: 0.2;
            transform: scale(1.1);
            transition: all 0.4s;
        }

        .university-card:hover .icon-wrapper::after {
            transform: scale(1.3);
            opacity: 0.1;
        }

        .university-card h5 {
            font-weight: 700;
            margin-bottom: 0.25rem;
            font-size: 1.1rem;
        }

        .university-card .acronym {
            color: #6c757d;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .university-card .badge-count {
            margin-top: 1.2rem;
            padding: 0.35rem 1.2rem;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 50px;
            display: inline-block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #495057;
            transition: all 0.3s;
        }

        .university-card:hover .badge-count {
            background: var(--gradient-primary);
            color: white;
        }

        .university-card .arrow {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 1.2rem;
            color: #dee2e6;
            transition: all 0.4s;
            opacity: 0;
            transform: translateX(-10px);
        }

        .university-card:hover .arrow {
            color: #667eea;
            transform: translateX(0);
            opacity: 1;
        }

        .university-card .card-number {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            color: #dee2e6;
        }

        /* Scholarship Cards */
        .scholarship-card {
            background: white;
            border-radius: 20px;
            padding: 1.8rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            cursor: pointer;
            border: 1px solid rgba(0,0,0,0.04);
        }

        .scholarship-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(102, 126, 234, 0.1);
        }

        .scholarship-card .scholarship-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .badge-full {
            background: linear-gradient(135deg, #11998e, #38ef7d);
            color: white;
            padding: 0.3rem 1.2rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-partial {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            padding: 0.3rem 1.2rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-level {
            background: #e9ecef;
            color: #495057;
            padding: 0.2rem 0.8rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .deadline-text {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .deadline-text i {
            margin-right: 5px;
            color: #f5576c;
        }

        /* Buttons */
        .btn-gradient {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 1rem 3.5rem;
            border-radius: 60px;
            font-weight: 700;
            transition: all 0.4s;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            font-size: 1.05rem;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.6s;
        }

        .btn-gradient:hover::before {
            left: 100%;
        }

        .btn-gradient:hover {
            transform: scale(1.05) translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-outline-gradient {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
            padding: 0.9rem 3rem;
            border-radius: 60px;
            font-weight: 700;
            transition: all 0.4s;
            text-decoration: none;
            display: inline-block;
            font-size: 1.05rem;
        }

        .btn-outline-gradient:hover {
            background: var(--gradient-primary);
            color: white;
            border-color: transparent;
            transform: scale(1.05) translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
        }

        /* Footer */
        .footer {
            background: #0c0c1d;
            color: white;
            padding: 4rem 0 2rem;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .footer h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .footer a {
            color: #b2bec3;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 400;
        }

        .footer a:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            transition: all 0.3s;
            margin-right: 8px;
        }

        .footer .social-icons a:hover {
            background: var(--gradient-primary);
            transform: translateY(-3px);
        }

        /* Stats Section */
        .stats-section {
            background: var(--gradient-dark);
            padding: 60px 0;
            color: white;
            margin-top: 0;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
        }

        .stats-section .stat-item {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .stats-section .stat-number {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 0.25rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stats-section .stat-label {
            font-size: 1rem;
            opacity: 0.8;
            font-weight: 300;
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-section h1 {
                font-size: 3rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: 100vh;
                padding: 100px 0 60px;
            }

            .hero-section h1 {
                font-size: 2.2rem;
            }

            .hero-section .subtitle {
                font-size: 1rem;
            }

            .search-box {
                margin: 20px 15px 0;
                border-radius: 30px;
                padding: 5px;
            }

            .search-box button {
                padding: 0.7rem 1.5rem;
                font-size: 0.9rem;
            }

            .search-box input {
                padding: 0.8rem 1.2rem;
                font-size: 0.9rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .stats-section .stat-number {
                font-size: 2rem;
            }

            .filter-btn {
                padding: 0.4rem 1.2rem;
                font-size: 0.85rem;
            }

            .navbar-custom .navbar-brand {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 1.8rem;
            }

            .hero-section .highlight-text {
                padding: 0.1rem 0.8rem;
                border-radius: 12px;
            }

            .university-card {
                padding: 1.5rem 1rem;
            }

            .university-card .icon-wrapper {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
            }

            .search-box {
                border-radius: 20px;
                padding: 4px;
            }

            .search-box button {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }

            .search-box input {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-graduation-cap"></i>BeasiswaKampus
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('scholarships.index') }}">
                            <i class="fas fa-search me-1"></i>Semua Beasiswa
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5><i class="fas fa-graduation-cap me-2" style="background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>BeasiswaKampus</h5>
                    <p style="color: #b2bec3; line-height: 1.8;">Temukan informasi beasiswa dari 10 kampus terbaik di Indonesia dalam satu tempat!</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Tautan Cepat</h5>
                    <ul class="list-unstyled" style="line-height: 2.4;">
                        <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right me-2" style="font-size: 0.6rem;"></i>Beranda</a></li>
                        <li><a href="{{ route('scholarships.index') }}"><i class="fas fa-chevron-right me-2" style="font-size: 0.6rem;"></i>Semua Beasiswa</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right me-2" style="font-size: 0.6rem;"></i>Tentang Kami</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right me-2" style="font-size: 0.6rem;"></i>Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Update Terbaru</h5>
                    <p style="color: #b2bec3;">Jangan sampai ketinggalan deadline!</p>
                    <div class="input-group" style="background: rgba(255,255,255,0.05); border-radius: 50px; padding: 4px;">
                        <input type="email" class="form-control" placeholder="Email Anda" style="background: transparent; border: none; color: white;">
                        <button class="btn btn-gradient" style="border-radius: 50px; padding: 0.6rem 1.5rem; font-size: 0.9rem;">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.08); margin: 2.5rem 0 1.5rem;">
            <p class="text-center" style="color: #b2bec3; margin: 0; font-size: 0.9rem;">
                © 2024 BeasiswaKampus. <span style="background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 600;">Raih Mimpi</span>, Mulai langkahmu menuju kampus impian!
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navbar scroll effect
            const navbar = document.getElementById('navbar');
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 100) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }

            // Search Form - NO AUTO REDIRECT
            const searchForm = document.querySelector('.search-box');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    // Form akan submit normal
                });
            }

            // Filter buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Counter animation
            function animateCounters() {
                const counters = document.querySelectorAll('.stat-number');
                counters.forEach(counter => {
                    const target = counter.textContent;
                    const isPercentage = target.includes('%');
                    const isPlus = target.includes('+');
                    const num = parseInt(target);
                    
                    if (!isNaN(num)) {
                        let current = 0;
                        const increment = Math.ceil(num / 40);
                        const stepTime = 2000 / 40;
                        
                        const updateCounter = () => {
                            current += increment;
                            if (current >= num) {
                                current = num;
                                counter.textContent = target;
                                return;
                            }
                            counter.textContent = current + (isPlus ? '+' : '') + (isPercentage ? '%' : '');
                            setTimeout(updateCounter, stepTime);
                        };
                        updateCounter();
                    }
                });
            }

            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounters();
                            observer.unobserve(entry.target);
                        }
                    });
                });
                observer.observe(statsSection);
            }
        });
    </script>
</body>
</html>