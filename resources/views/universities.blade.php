@extends('layouts.app')

@section('title', 'Semua Kampus - KampusTopID')

@section('content')
<!-- Hero Sub Header -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1920&q=80');"></div>
    <div class="page-hero-overlay"></div>
    
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="page-badge">
                    <i class="fas fa-university"></i> Katalog Kampus
                </div>
                <h1 class="page-title">
                    Semua <span class="title-gradient">Kampus</span>
                </h1>
                <p class="page-subtitle">
                    Jelajahi kampus-kampus top di Indonesia dan temukan beasiswa impianmu
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="stat-counter">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-number">{{ $universities->total() }}</div>
                        <div class="stat-text">Kampus Tersedia</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-shape shape-1"></div>
    <div class="hero-shape shape-2"></div>
</section>

<!-- Main Content -->
<section class="main-content-section">
    <div class="container">
        <!-- Search Section -->
        <div class="search-section-card">
            <form action="{{ route('universities.index') }}" method="GET" class="search-form-new">
                <div class="search-icon">
                    <i class="fas fa-search"></i>
                </div>
                <input type="text" name="search" placeholder="Cari kampus berdasarkan nama atau akronim..." value="{{ request('search') }}" autocomplete="off">
                <button type="submit">
                    <i class="fas fa-arrow-right"></i> Cari
                </button>
            </form>
        </div>

        <!-- Search Result Info -->
        @if(request('search'))
        <div class="search-result-info">
            <div class="search-result-content">
                <i class="fas fa-search"></i>
                <div>
                    <strong>Hasil pencarian:</strong>
                    <span>"{{ request('search') }}"</span>
                </div>
                <a href="{{ route('universities.index') }}" class="clear-filter-btn">
                    <i class="fas fa-times"></i> Hapus
                </a>
            </div>
        </div>
        @endif

        <!-- Results Header -->
        <div class="results-header">
            <div class="results-count">
                <i class="fas fa-list-ul"></i>
                Menampilkan <strong>{{ $universities->firstItem() ?? 0 }}-{{ $universities->lastItem() ?? 0 }}</strong> dari <strong>{{ $universities->total() }}</strong> kampus
            </div>
        </div>

        <!-- Universities Grid -->
        @if($universities->count() > 0)
        <div class="row g-4">
            @foreach($universities as $index => $uni)
            <div class="col-md-6 col-lg-4 col-xl-3 fade-in" style="animation-delay: {{ $index * 0.05 }}s;">
                <div class="university-card-new" onclick="location.href='{{ route('university.show', $uni->id) }}'">
                    <span class="card-number-new">#{{ $uni->rank ?? ($index + 1) }}</span>
                    
                    <div class="university-logo-container">
                        @if($uni->logo && file_exists(public_path($uni->logo)))
                        <img src="{{ asset($uni->logo) }}" alt="{{ $uni->name }}" class="university-logo-new">
                        @else
                        <div class="university-icon-fallback" style="background: {{ $uni->color ?? '#6C5CE7' }};">
                            {{ $uni->acronym }}
                        </div>
                        @endif
                    </div>
                    
                    <h5 class="university-name">{{ $uni->name }}</h5>
                    <div class="university-acronym">{{ $uni->acronym }}</div>
                    
                    <div class="university-badge">
                        <i class="fas fa-trophy"></i>
                        <span>{{ $uni->scholarships_count ?? 0 }} Beasiswa</span>
                    </div>
                    
                    <div class="card-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper mt-5">
            {{ $universities->links('pagination::bootstrap-5') }}
        </div>
        @else
        <div class="empty-state-new">
            <div class="empty-icon">
                <i class="fas fa-university"></i>
            </div>
            <h4>Belum ada kampus yang tersedia</h4>
            <p>Silakan cek kembali nanti</p>
            <a href="{{ route('home') }}" class="btn-back-home">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Scroll to Top Button -->
<a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;" 
   id="scrollTopBtn"
   class="scroll-top-btn">
    <i class="fas fa-arrow-up"></i>
</a>

<style>
    /* PAGE HERO */
    .page-hero {
        position: relative;
        padding: 100px 0 50px;
        overflow: hidden;
        margin-top: 0;
    }

    .page-hero-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        z-index: 0;
        animation: zoomIn 20s ease-in-out infinite alternate;
    }

    @keyframes zoomIn {
        0% { transform: scale(1); }
        100% { transform: scale(1.05); }
    }

    .page-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, 
            rgba(45, 27, 105, 0.92) 0%, 
            rgba(108, 92, 231, 0.85) 50%, 
            rgba(162, 155, 254, 0.75) 100%);
        z-index: 1;
    }

    .page-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 0.4rem 1.2rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        color: white;
        margin-bottom: 0.8rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        font-size: 2.8rem;
        color: white;
        line-height: 1.1;
        margin-bottom: 0.4rem;
        letter-spacing: -1px;
        text-shadow: 0 4px 30px rgba(0,0,0,0.3);
    }

    .title-gradient {
        background: linear-gradient(135deg, #FDCB6E, #FD79A8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.95rem;
        font-weight: 300;
        max-width: 500px;
        line-height: 1.5;
        text-shadow: 0 2px 20px rgba(0,0,0,0.2);
    }

    .stat-counter {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(20px);
        padding: 0.9rem 1.5rem;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #FDCB6E, #FD79A8);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
        box-shadow: 0 8px 25px rgba(253, 121, 168, 0.4);
    }

    .stat-number {
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        font-size: 1.6rem;
        color: white;
        line-height: 1;
    }

    .stat-text {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.75rem;
        margin-top: 2px;
    }

    .hero-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        z-index: 1;
    }

    .shape-1 {
        width: 200px;
        height: 200px;
        top: -80px;
        right: -80px;
        animation: float 15s ease-in-out infinite;
    }

    .shape-2 {
        width: 150px;
        height: 150px;
        bottom: -60px;
        left: -40px;
        animation: float 20s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(20px, -20px); }
    }

    /* MAIN SECTION */
    .main-content-section {
        padding: 40px 0 80px;
        background: linear-gradient(180deg, #FAF8FF 0%, #F5F0FF 50%, #FAF8FF 100%);
    }

    /* Search Section */
    .search-section-card {
        margin-bottom: 2rem;
    }

    .search-form-new {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 60px;
        padding: 8px;
        box-shadow: 0 10px 40px rgba(108, 92, 231, 0.1);
        border: 2px solid rgba(108, 92, 231, 0.08);
        transition: all 0.3s;
        max-width: 700px;
        margin: 0 auto;
    }

    .search-form-new:focus-within {
        border-color: var(--primary);
        box-shadow: 0 15px 50px rgba(108, 92, 231, 0.2);
    }

    .search-icon {
        padding: 0 1rem 0 1.5rem;
        color: #6C5B7B;
    }

    .search-form-new input {
        border: none;
        flex: 1;
        padding: 0.8rem 0.5rem;
        font-size: 1rem;
        background: transparent;
        color: #2D1B69;
        outline: none;
    }

    .search-form-new input::placeholder {
        color: #B8A9C9;
    }

    .search-form-new button {
        background: var(--gradient-primary);
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .search-form-new button:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(108, 92, 231, 0.4);
    }

    /* Search Result Info */
    .search-result-info {
        background: linear-gradient(135deg, #E8F0FE, #F0E8FF);
        border-radius: 16px;
        padding: 1.2rem 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(108, 92, 231, 0.1);
    }

    .search-result-content {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .clear-filter-btn {
        margin-left: auto;
        padding: 0.4rem 1rem;
        background: white;
        color: #e74c3c;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid rgba(231, 76, 60, 0.2);
        transition: all 0.3s;
    }

    .clear-filter-btn:hover {
        background: #e74c3c;
        color: white;
    }

    /* Results Header */
    .results-header {
        margin-bottom: 2rem;
        padding: 0 5px;
    }

    .results-count {
        color: #6C5B7B;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .results-count i {
        color: var(--primary);
    }

    .results-count strong {
        color: #2D1B69;
    }

    /* University Cards New */
    .university-card-new {
        background: white;
        border-radius: 20px;
        padding: 2rem 1.5rem;
        text-align: center;
        box-shadow: 0 4px 20px rgba(108, 92, 231, 0.06);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        height: 100%;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(108, 92, 231, 0.06);
    }

    .university-card-new::before {
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

    .university-card-new:hover::before {
        opacity: 1;
    }

    .university-card-new:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(108, 92, 231, 0.2);
    }

    .card-number-new {
        position: absolute;
        top: 15px;
        left: 15px;
        font-size: 0.75rem;
        font-weight: 700;
        color: #B8A9C9;
    }

    .university-logo-container {
        width: 80px;
        height: 80px;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 50%;
        padding: 12px;
        box-shadow: 0 4px 20px rgba(108, 92, 231, 0.1);
        border: 2px solid #f0edf5;
        transition: all 0.3s;
    }

    .university-card-new:hover .university-logo-container {
        border-color: var(--primary);
        box-shadow: 0 8px 30px rgba(108, 92, 231, 0.2);
    }

    .university-logo-new {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .university-icon-fallback {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 1.3rem;
        border-radius: 50%;
    }

    .university-name {
        font-weight: 700;
        font-size: 1rem;
        color: #2D1B69;
        margin-bottom: 0.25rem;
        line-height: 1.4;
        min-height: 2.8rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .university-acronym {
        color: #6C5B7B;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .university-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.35rem 1rem;
        background: linear-gradient(135deg, #F8F0FF, #E8F0FE);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--primary);
        border: 1px solid rgba(108, 92, 231, 0.1);
        transition: all 0.3s;
    }

    .university-card-new:hover .university-badge {
        background: var(--gradient-primary);
        color: white;
        border-color: transparent;
        box-shadow: 0 5px 20px rgba(108, 92, 231, 0.3);
    }

    .card-arrow {
        position: absolute;
        right: 15px;
        top: 15px;
        font-size: 0.9rem;
        color: #D5CCFF;
        transition: all 0.3s;
        opacity: 0;
        transform: translateX(-10px);
    }

    .university-card-new:hover .card-arrow {
        color: var(--primary);
        transform: translateX(0);
        opacity: 1;
    }

    /* Empty State */
    .empty-state-new {
        text-align: center;
        padding: 5rem 2rem;
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(108, 92, 231, 0.06);
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #F8F0FF, #E8F0FE);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--primary);
    }

    .empty-state-new h4 {
        font-weight: 800;
        color: #2D1B69;
        margin-bottom: 0.5rem;
    }

    .empty-state-new p {
        color: #6C5B7B;
        margin-bottom: 1.5rem;
    }

    .btn-back-home {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 0.9rem 2.5rem;
        background: var(--gradient-primary);
        color: white;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 10px 30px rgba(108, 92, 231, 0.3);
    }

    .btn-back-home:hover {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(108, 92, 231, 0.4);
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
    }

    .pagination-wrapper .pagination {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .pagination-wrapper .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 45px;
        height: 45px;
        padding: 0;
        border: none;
        border-radius: 12px;
        color: #6C5B7B;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s;
        background: white;
        box-shadow: 0 2px 10px rgba(108, 92, 231, 0.06);
        text-decoration: none;
    }

    .pagination-wrapper .page-item .page-link:hover {
        background: var(--gradient-primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.3);
    }

    .pagination-wrapper .page-item.active .page-link {
        background: var(--gradient-primary);
        color: white;
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.3);
    }

    .pagination-wrapper .page-item.disabled .page-link {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .pagination-wrapper svg {
        width: 14px !important;
        height: 14px !important;
    }

    /* Scroll to Top */
    .scroll-top-btn {
        position: fixed;
        bottom: 100px;
        right: 30px;
        z-index: 998;
        background: var(--gradient-primary);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
        text-decoration: none;
    }

    .scroll-top-btn.show {
        display: flex !important;
    }

    .scroll-top-btn:hover {
        transform: translateY(-5px);
        color: white;
    }

    /* Fade In */
    .fade-in {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 992px) {
        .page-title { font-size: 2.2rem; }
    }

    @media (max-width: 768px) {
        .page-hero {
            padding: 80px 0 40px;
        }

        .page-title { font-size: 1.8rem; }
        .page-subtitle { font-size: 0.85rem; }

        .stat-counter { padding: 0.7rem 1.2rem; }
        .stat-number { font-size: 1.3rem; }
        .stat-icon { width: 38px; height: 38px; font-size: 1rem; }

        .search-form-new {
            padding: 5px;
        }

        .search-form-new button {
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
        }

        .search-form-new input {
            padding: 0.6rem 0.5rem;
            font-size: 0.9rem;
        }

        .university-card-new {
            padding: 1.5rem 1rem;
        }

        .university-logo-container {
            width: 65px;
            height: 65px;
            padding: 8px;
        }

        .university-name {
            font-size: 0.9rem;
        }

        .scroll-top-btn {
            width: 45px;
            height: 45px;
            bottom: 90px;
            right: 20px;
        }
    }

    @media (max-width: 576px) {
        .page-title { font-size: 1.5rem; }
        .page-subtitle { font-size: 0.8rem; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollTopBtn = document.getElementById('scrollTopBtn');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });
    });
</script>
@endsection