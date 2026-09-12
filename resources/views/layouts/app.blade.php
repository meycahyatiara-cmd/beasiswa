<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Kampus Top di Indonesia')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #6C5CE7;
            --primary-light: #A29BFE;
            --secondary: #FD79A8;
            --gradient-primary: linear-gradient(135deg, #6C5CE7 0%, #A29BFE 100%);
            --text-primary: #2D1B69;
            --text-secondary: #6C5B7B;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #FAF8FF;
            overflow-x: hidden;
        }

        /* LOADING SCREEN */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.8s ease, visibility 0.8s ease;
            overflow: hidden;
        }

        .loading-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            z-index: 0;
            animation: zoomIn 3s ease-in-out;
        }

        @keyframes zoomIn {
            0% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(26, 10, 62, 0.85) 0%, rgba(45, 27, 105, 0.75) 50%, rgba(108, 92, 231, 0.65) 100%);
            z-index: 1;
        }

        #loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-container {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .loader-icon {
            font-size: 4rem;
            color: white;
            margin-bottom: 1.5rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .loader-title {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 2.5rem;
            color: white;
            letter-spacing: -1px;
            margin-bottom: 0.5rem;
            text-shadow: 0 4px 40px rgba(0,0,0,0.3);
        }

        .loader-title span {
            background: linear-gradient(135deg, #FDCB6E, #FD79A8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .loader-subtitle {
            color: rgba(255,255,255,0.6);
            font-size: 0.9rem;
            font-weight: 300;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .loader-ring-container {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            position: relative;
        }

        .loader-ring-spinner {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid transparent;
            animation: spin 1.2s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
        }

        .loader-ring-spinner:nth-child(1) { border-top-color: #FDCB6E; }

        .loader-ring-spinner:nth-child(2) {
            border-right-color: #FD79A8;
            animation-delay: 0.4s;
            width: 70%;
            height: 70%;
            top: 15%;
            left: 15%;
        }

        .loader-ring-spinner:nth-child(3) {
            border-bottom-color: #00CEC9;
            animation-delay: 0.8s;
            width: 40%;
            height: 40%;
            top: 30%;
            left: 30%;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-bar-container {
            width: 200px;
            height: 2px;
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
            margin: 20px auto 0;
            overflow: hidden;
        }

        .loading-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #FDCB6E, #FD79A8, #A29BFE);
            border-radius: 10px;
            animation: loadingBar 2.5s ease-in-out forwards;
        }

        @keyframes loadingBar {
            0% { width: 0%; }
            30% { width: 20%; }
            60% { width: 65%; }
            100% { width: 100%; }
        }

        /* NAVBAR */
        /* NAVBAR - Background Gelap Transparan */
.navbar-custom {
    background: linear-gradient(135deg, rgba(45, 27, 105, 0.85) 0%, rgba(108, 92, 231, 0.75) 100%);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    padding: 0.5rem 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.navbar-custom.scrolled {
    background: linear-gradient(135deg, rgba(45, 27, 105, 0.95) 0%, rgba(108, 92, 231, 0.9) 100%);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    box-shadow: 0 8px 40px rgba(0,0,0,0.15);
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
}

.navbar-custom .navbar-brand {
    font-family: 'Playfair Display', serif;
    font-weight: 800;
    font-size: 1.4rem;
    color: #FFFFFF;
    letter-spacing: -0.5px;
    text-shadow: 0 2px 20px rgba(0,0,0,0.3);
}

.navbar-custom .navbar-brand i {
    color: #FFFFFF;
    margin-right: 8px;
}

.navbar-custom .nav-link {
    color: #FFFFFF !important;
    font-weight: 600;
    transition: all 0.3s;
    padding: 0.4rem 1rem !important;
    font-size: 0.9rem;
    text-shadow: 0 1px 15px rgba(0,0,0,0.3);
}

.navbar-custom .nav-link:hover {
    color: #FFFFFF !important;
    opacity: 0.9;
}

/* DROPDOWN */
.dropdown-beasiswa .dropdown-toggle {
    color: #FFFFFF !important;
    font-weight: 600;
    padding: 0.4rem 1rem !important;
    font-size: 0.9rem;
    border-radius: 50px;
    transition: all 0.3s;
    text-shadow: 0 1px 15px rgba(0,0,0,0.2);
}

.dropdown-beasiswa .dropdown-toggle:hover {
    color: #FFFFFF !important;
    background: rgba(255, 255, 255, 0.12);
}

.dropdown-beasiswa .dropdown-toggle::after {
    color: #FFFFFF;
}

.dropdown-beasiswa .dropdown-menu {
    border: none !important;
    border-radius: 16px !important;
    box-shadow: 0 15px 50px rgba(0,0,0,0.25) !important;
    padding: 8px !important;
    margin-top: 8px !important;
    min-width: 220px !important;
    background: rgba(45, 27, 105, 0.4) !important;
    backdrop-filter: blur(25px) !important;
    -webkit-backdrop-filter: blur(25px) !important;
    border: 1px solid rgba(255, 255, 255, 0.18) !important;
}

.dropdown-beasiswa .dropdown-menu.show {
    background: rgba(45, 27, 105, 0.4) !important;
    backdrop-filter: blur(25px) !important;
    -webkit-backdrop-filter: blur(25px) !important;
}

.dropdown-beasiswa .dropdown-item {
    border-radius: 10px !important;
    padding: 0.5rem 1rem !important;
    font-size: 0.85rem;
    font-weight: 500;
    color: #FFFFFF !important;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 10px;
    background: transparent !important;
}

.dropdown-beasiswa .dropdown-item i {
    color: rgba(255, 255, 255, 0.85);
    font-size: 0.9rem;
    width: 20px;
    text-align: center;
}

.dropdown-beasiswa .dropdown-item:hover,
.dropdown-beasiswa .dropdown-item:focus {
    background: rgba(255, 255, 255, 0.15) !important;
    color: #FFFFFF !important;
}

.dropdown-beasiswa .dropdown-item:hover i,
.dropdown-beasiswa .dropdown-item:focus i {
    color: #FFFFFF;
}

.dropdown-beasiswa .dropdown-divider {
    margin: 6px 0;
    border-color: rgba(255, 255, 255, 0.15) !important;
}

        /* HERO */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 80px 0 60px;
            margin-top: 0;
            overflow: hidden;
        }

        .slideshow-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            z-index: 0;
        }

        .slide.active { opacity: 1; }

        .hero-background-blur {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    background: rgba(0, 0, 0, 0.3);
    z-index: 1;
}

        .hero-content {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 50px 40px;
            text-align: center;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1.8rem;
            border-radius: 50px;
            font-size: 1rem;
            color: white;
            font-weight: 600;
            margin-bottom: 1.2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            opacity: 0;
            animation: fadeInDown 0.8s ease forwards;
            animation-delay: 0.3s;
        }

        .hero-badge i { margin-right: 8px; }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 5rem;
            line-height: 1.1;
            margin-bottom: 1rem;
            color: white;
            letter-spacing: -2px;
            text-shadow: 0 4px 40px rgba(0,0,0,0.3);
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
            animation-delay: 0.6s;
        }

        .hero-title .highlight {
            background: linear-gradient(135deg, #FDCB6E, #FD79A8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-title .highlight-secondary {
            background: linear-gradient(135deg, #00CEC9, #A29BFE);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 300;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.8;
            text-shadow: 0 2px 20px rgba(0,0,0,0.2);
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
            animation-delay: 0.9s;
        }

        .hero-search {
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
            animation-delay: 1.2s;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .search-box {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(20px);
            border-radius: 60px;
            padding: 8px;
            max-width: 650px;
            margin: 35px auto 0;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .search-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
            background: rgba(255, 255, 255, 0.18);
        }

        .search-box input {
            border: none;
            padding: 1rem 1.8rem;
            border-radius: 60px;
            background: transparent;
            width: 100%;
            font-size: 1rem;
            color: white;
            font-weight: 400;
        }

        .search-box input:focus { outline: none; }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.7);
            font-weight: 300;
        }

        .search-box button {
            background: var(--gradient-primary);
            border: none;
            padding: 0.9rem 2.5rem;
            border-radius: 60px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
            white-space: nowrap;
            font-size: 1rem;
        }

        .search-box button:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 40px rgba(108, 92, 231, 0.5);
        }

        /* SECTION TITLES */
        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            margin-bottom: 0.5rem;
            font-size: 2.5rem;
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
            font-size: 1rem;
            font-weight: 300;
        }

        .section-badge {
            display: inline-block;
            background: rgba(108, 92, 231, 0.08);
            padding: 0.3rem 1.2rem;
            border-radius: 50px;
            font-size: 0.75rem;
            color: var(--primary);
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* UNIVERSITY CARDS */
        .university-card {
            background: white;
            border-radius: 20px;
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s;
            cursor: pointer;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .university-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
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
            font-weight: 700;
            color: white;
            transition: all 0.3s;
        }

        .logo-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 50%;
            padding: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 2px solid #f0edf5;
            transition: all 0.3s;
        }

        .university-card:hover .logo-wrapper {
            border-color: var(--primary);
        }

        .university-logo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .university-card h5 {
            font-weight: 700;
            margin-bottom: 0.25rem;
            font-size: 1rem;
            color: var(--text-primary);
        }

        .university-card .acronym {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .university-card .badge-count {
            margin-top: 1rem;
            padding: 0.25rem 1rem;
            background: #e9ecef;
            border-radius: 50px;
            display: inline-block;
            font-size: 0.85rem;
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
            font-size: 1.5rem;
            color: #dee2e6;
            transition: all 0.3s;
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
            top: 20px;
            left: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            color: #dee2e6;
        }

        /* SCHOLARSHIP CARDS */
        .scholarship-card {
            background: white;
            border-radius: 18px;
            padding: 1.3rem;
            box-shadow: 0 10px 40px rgba(108, 92, 231, 0.12);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            cursor: pointer;
            border: 1px solid rgba(108, 92, 231, 0.04);
        }

        .scholarship-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(108, 92, 231, 0.2);
        }

        .badge-full {
            background: linear-gradient(135deg, #00B894, #00CEC9);
            color: white;
            padding: 0.2rem 1rem;
            border-radius: 50px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-partial {
            background: linear-gradient(135deg, #FD79A8, #FDCB6E);
            color: white;
            padding: 0.2rem 1rem;
            border-radius: 50px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-level {
            background: #F8F0FF;
            color: var(--primary);
            padding: 0.15rem 0.7rem;
            border-radius: 50px;
            font-size: 0.6rem;
            font-weight: 600;
        }

        .deadline-text {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .deadline-text i {
            margin-right: 4px;
            color: var(--secondary);
        }

        /* BUTTONS */
        .btn-gradient {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 0.8rem 3rem;
            border-radius: 60px;
            font-weight: 600;
            transition: all 0.4s;
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
            box-shadow: 0 10px 30px rgba(108, 92, 231, 0.2);
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
            padding: 0.7rem 2.5rem;
            border-radius: 60px;
            font-weight: 600;
            transition: all 0.4s;
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
        }

        .btn-outline:hover {
            background: var(--gradient-primary);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
        }

        /* CTA SECTION */
        .cta-section {
            position: relative;
            padding: 100px 0;
            background: linear-gradient(135deg, #2D1B69 0%, #6C5CE7 50%, #A29BFE 100%);
            color: white;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 15s ease-in-out infinite;
        }

        .cta-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(253, 121, 168, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(10deg); }
            66% { transform: translate(-20px, 20px) rotate(-5deg); }
        }

        .cta-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .cta-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            display: inline-block;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .cta-title {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 3.5rem;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .cta-title .highlight {
            background: linear-gradient(135deg, #FDCB6E, #FD79A8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .cta-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 2rem;
            font-weight: 300;
            line-height: 1.8;
        }

        .btn-cta {
            background: white;
            color: var(--primary);
            padding: 1rem 3rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1.05rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.4s;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .btn-cta:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            color: var(--primary);
        }

        .cta-features {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            flex-wrap: wrap;
        }

        .cta-feature {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            opacity: 0.95;
        }

        .cta-feature i {
            color: #00CEC9;
            font-size: 1.1rem;
        }

        /* FOOTER */
        .footer {
            background: linear-gradient(135deg, #1A0A3E 0%, #2D1B69 100%);
            color: white;
            padding: 4rem 0 0;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #6C5CE7, #FD79A8, #00CEC9, #FDCB6E);
            background-size: 300% 100%;
            animation: gradientMove 3s linear infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            100% { background-position: 300% 50%; }
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .footer-brand-icon {
            width: 45px;
            height: 45px;
            background: var(--gradient-primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: white;
            box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
        }

        .footer-brand h5 {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 1.3rem;
            margin: 0;
            background: linear-gradient(135deg, #FFFFFF, #B8A9C9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-desc {
            color: #B8A9C9;
            line-height: 1.8;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .footer-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 35px;
            height: 3px;
            background: linear-gradient(90deg, #6C5CE7, #FD79A8);
            border-radius: 10px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #B8A9C9;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .footer-links a i {
            font-size: 0.6rem;
            color: var(--primary-light);
            transition: all 0.3s;
        }

        .footer-links a:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer-links a:hover i {
            color: #FD79A8;
        }

        .footer-social {
            display: flex;
            gap: 10px;
            margin-top: 1rem;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.06);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #B8A9C9;
            font-size: 0.95rem;
            transition: all 0.3s;
            text-decoration: none;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .footer-social a:hover {
            background: var(--gradient-primary);
            color: white;
            transform: translateY(-5px);
            border-color: transparent;
            box-shadow: 0 10px 25px rgba(108, 92, 231, 0.4);
        }

        .subscribe-form {
            background: rgba(255,255,255,0.05);
            border-radius: 50px;
            padding: 5px;
            display: flex;
            align-items: center;
            border: 1px solid rgba(255,255,255,0.08);
            transition: all 0.3s;
        }

        .subscribe-form:focus-within {
            border-color: var(--primary);
            background: rgba(255,255,255,0.08);
            box-shadow: 0 0 0 4px rgba(108, 92, 231, 0.15);
        }

        .subscribe-form input {
            background: transparent;
            border: none;
            color: white;
            font-size: 0.85rem;
            padding: 0.6rem 1.2rem;
            flex: 1;
            outline: none;
        }

        .subscribe-form input::placeholder {
            color: #B8A9C9;
        }

        .subscribe-form button {
            background: var(--gradient-primary);
            border: none;
            border-radius: 50px;
            color: white;
            padding: 0.6rem 1.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .subscribe-form button:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(108, 92, 231, 0.4);
        }

        .footer-bottom {
            margin-top: 3rem;
            padding: 1.5rem 0;
            border-top: 1px solid rgba(255,255,255,0.06);
            text-align: center;
            color: #B8A9C9;
            font-size: 0.85rem;
        }

        .footer-bottom .highlight {
            background: linear-gradient(135deg, #FDCB6E, #FD79A8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        /* ALERT SUCCESS */
        .alert-success-custom {
            background: linear-gradient(135deg, #00B894, #00CEC9);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            font-weight: 500;
            box-shadow: 0 10px 30px rgba(0, 184, 148, 0.3);
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* STATS SECTION */
        .stats-section {
            background: #F8F0FF;
            padding: 40px 0;
        }

        .stats-section .stat-item { text-align: center; }

        .stats-section .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 0.2rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stats-section .stat-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* REVEAL ANIMATIONS */
        .reveal, .reveal-left, .reveal-right, .reveal-scale {
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .reveal { transform: translateY(50px); }
        .reveal-left { transform: translateX(-50px); }
        .reveal-right { transform: translateX(50px); }
        .reveal-scale { transform: scale(0.8); }

        .reveal.active, .reveal-left.active, .reveal-right.active, .reveal-scale.active {
            opacity: 1;
            transform: translate(0) scale(1);
        }

        /* FADE IN CARD */
        .fade-in {
            opacity: 0;
            animation: fadeInCard 0.8s ease forwards;
        }

        @keyframes fadeInCard {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero-title { font-size: 2.5rem; }
            .hero-subtitle { font-size: 1rem; }
            .section-title { font-size: 1.8rem; }
            .stats-section .stat-number { font-size: 2rem; }
            .navbar-custom .navbar-brand { font-size: 1.1rem; }
            .cta-title { font-size: 2rem; }
            .footer { padding: 3rem 0 0; }
            .footer-brand-icon { width: 40px; height: 40px; font-size: 1.1rem; }
            .footer-brand h5 { font-size: 1.1rem; }
        }

        @media (max-width: 576px) {
            .hero-title { font-size: 1.8rem; }
            .loader-title { font-size: 1.4rem; }
            .cta-title { font-size: 1.6rem; }
            .cta-icon { font-size: 3rem; }
        }
    </style>
</head>
<body>
    <!-- LOADING SCREEN -->
    <div id="loading-screen">
        <div class="loading-background" style="background-image: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1920&q=80');"></div>
        <div class="loading-overlay"></div>
        <div class="loader-container">
            <div class="loader-ring-container">
                <div class="loader-ring-spinner"></div>
                <div class="loader-ring-spinner"></div>
                <div class="loader-ring-spinner"></div>
            </div>
            <div class="loader-icon"><i class="fas fa-graduation-cap"></i></div>
            <div class="loader-title"><span>KampusTop</span>Indonesia</div>
            <div class="loader-subtitle">Loading...</div>
            <div class="loading-bar-container"><div class="loading-bar"></div></div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-custom" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-graduation-cap"></i>KampusTopIndonesia
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-beasiswa">
                        <a class="nav-link dropdown-toggle" href="#" id="beasiswaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-graduation-cap me-1"></i>Beasiswa
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="beasiswaDropdown">
                            <li><a class="dropdown-item" href="{{ route('scholarships.index') }}"><i class="fas fa-th-large"></i> Semua Kampus</a></li>
                            <li><a class="dropdown-item" href="{{ route('scholarships.index', ['type' => 'full']) }}"><i class="fas fa-crown"></i> Beasiswa Penuh</a></li>
                            <li><a class="dropdown-item" href="{{ route('scholarships.index', ['type' => 'partial']) }}"><i class="fas fa-gift"></i> Beasiswa Parsial</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('scholarships.index', ['level' => 'S1']) }}"><i class="fas fa-user-graduate"></i> Jenjang S1</a></li>
                            <li><a class="dropdown-item" href="{{ route('scholarships.index', ['level' => 'S2']) }}"><i class="fas fa-user-tie"></i> Jenjang S2</a></li>
                            <li><a class="dropdown-item" href="{{ route('scholarships.index', ['level' => 'S3']) }}"><i class="fas fa-microscope"></i> Jenjang S3</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <div class="footer-brand-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h5>KampusTopID</h5>
                    </div>
                    <p class="footer-desc">
                        Website informasi kampus-kampus top di Indonesia dan program beasiswanya. Temukan beasiswa impianmu di sini!
                    </p>
                    <div class="footer-social">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-title">Tautan Cepat</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i>Beranda</a></li>
                        <li><a href="{{ route('scholarships.index') }}"><i class="fas fa-chevron-right"></i>Semua Beasiswa</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i>Tentang</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i>Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-title">Kategori</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('scholarships.index', ['type' => 'full']) }}"><i class="fas fa-chevron-right"></i>Beasiswa Penuh</a></li>
                        <li><a href="{{ route('scholarships.index', ['type' => 'partial']) }}"><i class="fas fa-chevron-right"></i>Beasiswa Parsial</a></li>
                        <li><a href="{{ route('scholarships.index', ['level' => 'S1']) }}"><i class="fas fa-chevron-right"></i>Jenjang S1</a></li>
                        <li><a href="{{ route('scholarships.index', ['level' => 'S2']) }}"><i class="fas fa-chevron-right"></i>Jenjang S2</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-title">Update Terbaru</h6>
                    <p style="color: #B8A9C9; font-size: 0.9rem; margin-bottom: 1rem;">
                        Dapatkan notifikasi beasiswa terbaru langsung di email kamu!
                    </p>

                    @if(session('subscribe_success'))
                    <div class="alert-success-custom">
                        <i class="fas fa-check-circle me-2"></i>{{ session('subscribe_success') }}
                    </div>
                    @endif

                    @if(session('subscribe_error'))
                    <div class="alert alert-danger" style="border-radius: 12px;">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('subscribe_error') }}
                    </div>
                    @endif

                    <form action="{{ route('subscribe') }}" method="POST" class="subscribe-form">
                        @csrf
                        <input type="email" name="email" placeholder="Masukkan email kamu..." required>
                        <button type="submit">
                            <i class="fas fa-paper-plane"></i> Subscribe
                        </button>
                    </form>
                    @error('email')
                    <small style="color: #FD79A8; display: block; margin-top: 0.5rem;">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </small>
                    @enderror
                </div>
            </div>

            <div class="footer-bottom">
                © 2024 KampusTopID. <span class="highlight">Raih Mimpi</span>, Raih Masa Depan! 🎓
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // LOADING SCREEN
            const loadingScreen = document.getElementById('loading-screen');
            if (loadingScreen) {
                setTimeout(function() {
                    loadingScreen.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }, 2500);
                document.body.style.overflow = 'hidden';
            }

            // NAVBAR SCROLL
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // REVEAL ANIMATIONS
            const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
            
            function revealOnScroll() {
                const windowHeight = window.innerHeight;
                const revealPoint = 100;
                
                revealElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    if (elementTop < windowHeight - revealPoint) {
                        element.classList.add('active');
                    } else {
                        element.classList.remove('active');
                    }
                });
            }

            window.addEventListener('scroll', revealOnScroll);
            window.addEventListener('load', revealOnScroll);
            revealOnScroll();

            // DROPDOWN
            const dropdownItems = document.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                item.addEventListener('click', function() {
                    dropdownItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            document.addEventListener('click', function(event) {
                const dropdown = document.querySelector('.dropdown-beasiswa');
                if (dropdown && !dropdown.contains(event.target)) {
                    const toggle = dropdown.querySelector('.dropdown-toggle');
                    if (toggle && toggle.getAttribute('aria-expanded') === 'true') {
                        toggle.click();
                    }
                }
            });
        });
    </script>
</body>
</html>