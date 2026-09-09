<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Kampus Top di Indonesia')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Fonts - Font Cantik -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #6C5CE7;
            --primary-light: #A29BFE;
            --primary-soft: #D5CCFF;
            --secondary: #FD79A8;
            --secondary-soft: #FFE5EC;
            --accent: #00CEC9;
            --accent-soft: #D4FDFA;
            --gradient-primary: linear-gradient(135deg, #6C5CE7 0%, #A29BFE 100%);
            --gradient-soft: linear-gradient(135deg, #F8F0FF 0%, #FFE5EC 100%);
            --gradient-warm: linear-gradient(135deg, #FFE5EC 0%, #D5CCFF 100%);
            --shadow-soft: 0 10px 40px rgba(108, 92, 231, 0.12);
            --shadow-hover: 0 20px 60px rgba(108, 92, 231, 0.2);
            --text-primary: #2D1B69;
            --text-secondary: #6C5B7B;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #FAF8FF;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            padding: 0.8rem 0;
            box-shadow: 0 2px 30px rgba(108, 92, 231, 0.08);
            border-bottom: 1px solid rgba(108, 92, 231, 0.05);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s;
        }

        .navbar-custom.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 40px rgba(108, 92, 231, 0.12);
        }

        .navbar-custom .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--primary);
            letter-spacing: -0.5px;
        }

        .navbar-custom .navbar-brand i {
            color: var(--secondary);
            margin-right: 10px;
        }

        .navbar-custom .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
            padding: 0.5rem 1.2rem !important;
            font-size: 0.95rem;
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
            color: var(--primary) !important;
        }

        /* Hero Section - Elegant */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            background: var(--gradient-soft);
            padding: 120px 0 80px;
            margin-top: 0;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(108, 92, 231, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(253, 121, 168, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 25s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(10deg); }
            66% { transform: translate(-20px, 20px) rotate(-5deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-section .hero-badge {
            display: inline-block;
            background: rgba(108, 92, 231, 0.1);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 0.85rem;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(108, 92, 231, 0.1);
        }

        .hero-section .hero-badge i {
            margin-right: 8px;
        }

        .hero-section h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 4.2rem;
            line-height: 1.1;
            margin-bottom: 1rem;
            color: var(--text-primary);
            letter-spacing: -1.5px;
        }

        .hero-section h1 .highlight {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-section h1 .highlight-secondary {
            background: linear-gradient(135deg, #FD79A8, #6C5CE7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-section .subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            font-weight: 300;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .search-box {
            background: white;
            border-radius: 60px;
            padding: 8px;
            max-width: 700px;
            margin: 35px auto 0;
            box-shadow: var(--shadow-soft);
            position: relative;
            z-index: 2;
            transition: all 0.3s;
            border: 1px solid rgba(108, 92, 231, 0.06);
        }

        .search-box:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .search-box input {
            border: none;
            padding: 1rem 1.8rem;
            border-radius: 60px;
            background: transparent;
            width: 100%;
            font-size: 1rem;
            color: var(--text-primary);
            font-weight: 400;
        }

        .search-box input:focus {
            outline: none;
        }

        .search-box input::placeholder {
            color: #B8A9C9;
            font-weight: 300;
        }

        .search-box button {
            background: var(--gradient-primary);
            border: none;
            padding: 0.8rem 2.5rem;
            border-radius: 60px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .search-box button:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 40px rgba(108, 92, 231, 0.4);
        }

        .filter-wrapper {
            position: relative;
            z-index: 2;
            margin-top: 2rem;
        }

        .filter-btn {
            border: 1.5px solid rgba(108, 92, 231, 0.15);
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            color: var(--text-secondary);
            padding: 0.6rem 1.8rem;
            border-radius: 50px;
            transition: all 0.3s;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 0.9rem;
        }

        .filter-btn:hover {
            background: white;
            color: var(--primary);
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-soft);
        }

        .filter-btn.active {
            background: var(--gradient-primary);
            color: white;
            border-color: transparent;
            box-shadow: 0 5px 20px rgba(108, 92, 231, 0.3);
        }

        /* Decorative Elements */
        .deco-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(108, 92, 231, 0.03);
            border: 1px solid rgba(108, 92, 231, 0.05);
            z-index: 1;
            animation: float 20s ease-in-out infinite;
        }

        .deco-circle:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -50px;
            animation-delay: 0s;
        }

        .deco-circle:nth-child(2) {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
            animation-duration: 25s;
        }

        /* Section Titles */
        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            margin-bottom: 0.5rem;
            font-size: 2.8rem;
            color: var(--text-primary);
            letter-spacing: -1px;
        }

        .section-title .highlight {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            font-weight: 300;
        }

        .section-badge {
            display: inline-block;
            background: rgba(108, 92, 231, 0.08);
            padding: 0.4rem 1.5rem;
            border-radius: 50px;
            font-size: 0.8rem;
            color: var(--primary);
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* University Cards */
        .university-card {
            background: white;
            border-radius: 24px;
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: var(--shadow-soft);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            height: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(108, 92, 231, 0.04);
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
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(108, 92, 231, 0.08);
        }

        .university-card .icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            font-weight: 800;
            color: white;
            position: relative;
            transition: all 0.4s;
            background: var(--gradient-primary);
        }

        .university-card .icon-wrapper::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: inherit;
            opacity: 0.15;
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
            font-size: 1rem;
            color: var(--text-primary);
        }

        .university-card .acronym {
            color: var(--text-secondary);
            font-size: 0.8rem;
            font-weight: 500;
        }

        .university-card .badge-count {
            margin-top: 1rem;
            padding: 0.3rem 1.2rem;
            background: var(--gradient-soft);
            border-radius: 50px;
            display: inline-block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            transition: all 0.3s;
        }

        .university-card:hover .badge-count {
            background: var(--gradient-primary);
            color: white;
        }

        .university-card .arrow {
            position: absolute;
            right: 16px;
            top: 16px;
            font-size: 1rem;
            color: #D5CCFF;
            transition: all 0.4s;
            opacity: 0;
            transform: translateX(-10px);
        }

        .university-card:hover .arrow {
            color: var(--primary);
            transform: translateX(0);
            opacity: 1;
        }

        .university-card .card-number {
            position: absolute;
            top: 16px;
            left: 16px;
            font-size: 0.7rem;
            font-weight: 700;
            color: #D5CCFF;
        }

        /* Scholarship Cards */
        .scholarship-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: var(--shadow-soft);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            cursor: pointer;
            border: 1px solid rgba(108, 92, 231, 0.04);
        }

        .scholarship-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(108, 92, 231, 0.08);
        }

        .scholarship-card .scholarship-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.8rem;
            flex-wrap: wrap;
            gap: 5px;
        }

        .badge-full {
            background: linear-gradient(135deg, #00B894, #00CEC9);
            color: white;
            padding: 0.25rem 1.2rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-partial {
            background: linear-gradient(135deg, #FD79A8, #FDCB6E);
            color: white;
            padding: 0.25rem 1.2rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-level {
            background: var(--gradient-soft);
            color: var(--primary);
            padding: 0.2rem 0.8rem;
            border-radius: 50px;
            font-size: 0.65rem;
            font-weight: 600;
        }

        .deadline-text {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .deadline-text i {
            margin-right: 5px;
            color: var(--secondary);
        }

        /* Buttons */
        .btn-gradient {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 1rem 3.5rem;
            border-radius: 60px;
            font-weight: 600;
            transition: all 0.4s;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            font-size: 1rem;
            box-shadow: 0 10px 30px rgba(108, 92, 231, 0.2);
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
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(108, 92, 231, 0.3);
            color: white;
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 0.9rem 3rem;
            border-radius: 60px;
            font-weight: 600;
            transition: all 0.4s;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
        }

        .btn-outline:hover {
            background: var(--gradient-primary);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(108, 92, 231, 0.2);
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #2D1B69, #1A0A3E);
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
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .footer a {
            color: #B8A9C9;
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
            color: #B8A9C9;
        }

        .footer .social-icons a:hover {
            background: var(--gradient-primary);
            transform: translateY(-3px);
            color: white;
        }

        /* Stats Section */
        .stats-section {
            background: var(--gradient-soft);
            padding: 50px 0;
            margin-top: 0;
            position: relative;
            overflow: hidden;
        }

        .stats-section .stat-item {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .stats-section .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 0.25rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stats-section .stat-label {
            font-size: 0.95rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
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
                padding: 0.6rem 1.2rem;
                font-size: 0.85rem;
            }

            .search-box input {
                padding: 0.7rem 1.2rem;
                font-size: 0.9rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .stats-section .stat-number {
                font-size: 2rem;
            }

            .filter-btn {
                padding: 0.4rem 1.2rem;
                font-size: 0.8rem;
            }

            .navbar-custom .navbar-brand {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 1.8rem;
            }

            .university-card {
                padding: 1.5rem 1rem;
            }

            .university-card .icon-wrapper {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .search-box {
                border-radius: 20px;
                padding: 4px;
            }

            .search-box button {
                padding: 0.4rem 0.8rem;
                font-size: 0.75rem;
            }

            .search-box input {
                padding: 0.5rem 0.8rem;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-graduation-cap"></i>KampusTopID
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

    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5><i class="fas fa-graduation-cap me-2" style="color: var(--primary-light);"></i>KampusTopID</h5>
                    <p style="color: #B8A9C9; line-height: 1.8;">Website informasi kampus-kampus top di Indonesia dan program beasiswanya.</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Tautan Cepat</h5>
                    <ul class="list-unstyled" style="line-height: 2.4;">
                        <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right me-2" style="font-size: 0.6rem; color: var(--primary-light);"></i>Beranda</a></li>
                        <li><a href="{{ route('scholarships.index') }}"><i class="fas fa-chevron-right me-2" style="font-size: 0.6rem; color: var(--primary-light);"></i>Semua Beasiswa</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Update Terbaru</h5>
                    <p style="color: #B8A9C9;">Jangan sampai ketinggalan informasi!</p>
                    <div class="input-group" style="background: rgba(255,255,255,0.05); border-radius: 50px; padding: 4px;">
                        <input type="email" class="form-control" placeholder="Email Anda" style="background: transparent; border: none; color: white;">
                        <button class="btn btn-gradient" style="border-radius: 50px; padding: 0.5rem 1.5rem; font-size: 0.85rem;">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.06); margin: 2.5rem 0 1.5rem;">
            <p class="text-center" style="color: #B8A9C9; margin: 0; font-size: 0.9rem;">
                © 2024 KampusTopID. <span style="color: white; font-weight: 600;">Raih Mimpi</span>, Raih Masa Depan!
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>