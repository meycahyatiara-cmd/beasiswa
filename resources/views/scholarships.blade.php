@extends('layouts.app')

@section('title', 'Semua Beasiswa - KampusTopID')

@section('content')
<!-- Hero Sub Header - Compact -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1920&q=80');"></div>
    <div class="page-hero-overlay"></div>
    
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="page-badge">
                    <i class="fas fa-graduation-cap"></i> Katalog Beasiswa
                </div>
                <h1 class="page-title">
                    Semua <span class="title-gradient">Beasiswa</span>
                </h1>
                <p class="page-subtitle">
                    Temukan berbagai program beasiswa dari kampus-kampus top Indonesia dalam satu tempat
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="stat-counter">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-number">{{ $scholarships->total() }}</div>
                        <div class="stat-text">Beasiswa Tersedia</div>
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
        <!-- Filter Container -->
        <div class="filter-container">
            <div class="filter-card">
                <div class="filter-header">
                    <div class="filter-title">
                        <div class="filter-icon">
                            <i class="fas fa-sliders-h"></i>
                        </div>
                        <div>
                            <h6>Filter Beasiswa</h6>
                            <p>Pilih kategori yang kamu butuhkan</p>
                        </div>
                    </div>
                </div>
                <div class="filter-buttons">
                    <a href="{{ route('scholarships.index') }}" class="filter-chip {{ !request('type') && !request('level') && !request('search') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i>
                        <span>Semua</span>
                    </a>
                    <a href="{{ route('scholarships.index', ['type' => 'full']) }}" class="filter-chip {{ request('type') == 'full' ? 'active' : '' }}">
                        <i class="fas fa-crown"></i>
                        <span>Beasiswa Penuh</span>
                    </a>
                    <a href="{{ route('scholarships.index', ['type' => 'partial']) }}" class="filter-chip {{ request('type') == 'partial' ? 'active' : '' }}">
                        <i class="fas fa-gift"></i>
                        <span>Beasiswa Parsial</span>
                    </a>
                    <a href="{{ route('scholarships.index', ['level' => 'S1']) }}" class="filter-chip {{ request('level') == 'S1' ? 'active' : '' }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>Jenjang S1</span>
                    </a>
                    <a href="{{ route('scholarships.index', ['level' => 'S2']) }}" class="filter-chip {{ request('level') == 'S2' ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i>
                        <span>Jenjang S2</span>
                    </a>
                    <a href="{{ route('scholarships.index', ['level' => 'S3']) }}" class="filter-chip {{ request('level') == 'S3' ? 'active' : '' }}">
                        <i class="fas fa-microscope"></i>
                        <span>Jenjang S3</span>
                    </a>
                </div>
            </div>
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
                <a href="{{ route('scholarships.index') }}" class="clear-filter-btn">
                    <i class="fas fa-times"></i> Hapus Filter
                </a>
            </div>
        </div>
        @endif

        <!-- Results Header -->
        <div class="results-header">
            <div class="results-count">
                <i class="fas fa-list-ul"></i>
                Menampilkan <strong>{{ $scholarships->firstItem() ?? 0 }}-{{ $scholarships->lastItem() ?? 0 }}</strong> dari <strong>{{ $scholarships->total() }}</strong> beasiswa
            </div>
        </div>

        <!-- Results Grid -->
        @if($scholarships->count() > 0)
        <div class="row g-4">
            @foreach($scholarships as $index => $scholarship)
            <div class="col-md-6 col-xl-4 fade-in" style="animation-delay: {{ $index * 0.05 }}s;">
                <div class="scholarship-card-new" onclick="location.href='{{ route('scholarship.show', $scholarship->id) }}'">
                    <div class="card-header-new">
                        <span class="badge-type {{ $scholarship->type == 'full' ? 'badge-full-new' : 'badge-partial-new' }}">
                            <i class="fas {{ $scholarship->type == 'full' ? 'fa-crown' : 'fa-gift' }}"></i>
                            {{ $scholarship->type == 'full' ? 'Beasiswa Penuh' : 'Beasiswa Parsial' }}
                        </span>
                        <span class="badge-level-new">
                            {{ $scholarship->level }}
                        </span>
                    </div>

                    <div class="card-body-new">
                        <h5 class="card-title-new">{{ $scholarship->title }}</h5>
                        <p class="card-desc-new">{{ Illuminate\Support\Str::limit($scholarship->description, 90) }}</p>

                        <div class="card-university">
                            <div class="university-icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="university-details">
                                <div class="university-label">Kampus</div>
                                <div class="university-name-new">{{ $scholarship->university->name }}</div>
                            </div>
                        </div>

                        <div class="card-deadline">
                            <div class="deadline-icon">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <div class="deadline-details">
                                <div class="deadline-label">Deadline</div>
                                <div class="deadline-date-new">{{ $scholarship->deadline->format('d F Y') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer-new">
                        <a href="{{ route('scholarship.show', $scholarship->id) }}" class="btn-view-detail">
                            Lihat Detail
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="card-decoration"></div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper mt-5">
            {{ $scholarships->links('pagination::bootstrap-5') }}
        </div>
        @else
        <div class="empty-state-new">
            <div class="empty-icon">
                <i class="fas fa-search"></i>
            </div>
            <h4>Belum ada beasiswa yang tersedia</h4>
            <p>Silakan cek kembali nanti untuk informasi terbaru</p>
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
    /* ===== PAGE HERO - Compact ===== */
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

    /* ===== MAIN SECTION ===== */
    .main-content-section {
        padding: 40px 0 80px;
        background: linear-gradient(180deg, #FAF8FF 0%, #F5F0FF 50%, #FAF8FF 100%);
    }

    /* ===== FILTER CONTAINER ===== */
    .filter-container {
        margin-bottom: 2rem;
    }

    .filter-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 1.8rem;
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 10px 40px rgba(108, 92, 231, 0.08);
    }

    .filter-header {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(108, 92, 231, 0.08);
    }

    .filter-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .filter-icon {
        width: 50px;
        height: 50px;
        background: var(--gradient-primary);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.3);
    }

    .filter-title h6 {
        font-weight: 700;
        color: #2D1B69;
        margin: 0;
        font-size: 1.05rem;
    }

    .filter-title p {
        color: #6C5B7B;
        margin: 0;
        font-size: 0.85rem;
    }

    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 0.7rem 1.4rem;
        background: white;
        border: 2px solid rgba(108, 92, 231, 0.1);
        border-radius: 50px;
        color: #6C5B7B;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .filter-chip i {
        font-size: 0.85rem;
        color: var(--primary);
        transition: all 0.3s;
    }

    .filter-chip:hover {
        transform: translateY(-3px);
        border-color: var(--primary);
        color: var(--primary);
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.15);
        text-decoration: none;
    }

    .filter-chip.active {
        background: var(--gradient-primary);
        color: white;
        border-color: transparent;
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.35);
    }

    .filter-chip.active i {
        color: white;
    }

    /* ===== SEARCH RESULT INFO ===== */
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

    .search-result-content > i {
        color: var(--primary);
        font-size: 1.3rem;
    }

    .search-result-content strong {
        color: #2D1B69;
    }

    .search-result-content span {
        color: #6C5CE7;
        font-weight: 600;
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

    /* ===== RESULTS HEADER ===== */
    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    /* ===== SCHOLARSHIP CARDS NEW ===== */
    .scholarship-card-new {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        border: 1px solid rgba(108, 92, 231, 0.06);
        box-shadow: 0 4px 20px rgba(108, 92, 231, 0.06);
    }

    .scholarship-card-new:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 60px rgba(108, 92, 231, 0.2);
        border-color: rgba(108, 92, 231, 0.15);
    }

    .card-decoration {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 120px;
        height: 120px;
        background: var(--gradient-primary);
        border-radius: 50%;
        opacity: 0.05;
        transition: all 0.4s;
    }

    .scholarship-card-new:hover .card-decoration {
        transform: scale(1.5);
        opacity: 0.08;
    }

    .card-header-new {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 1.5rem 0;
        position: relative;
        z-index: 2;
    }

    .badge-type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-full-new {
        background: linear-gradient(135deg, #00B894, #00CEC9);
        color: white;
        box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
    }

    .badge-partial-new {
        background: linear-gradient(135deg, #FD79A8, #FDCB6E);
        color: white;
        box-shadow: 0 4px 15px rgba(253, 121, 168, 0.3);
    }

    .badge-level-new {
        background: linear-gradient(135deg, #F8F0FF, #E8F0FE);
        color: var(--primary);
        padding: 0.35rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        border: 1px solid rgba(108, 92, 231, 0.15);
    }

    .card-body-new {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 2;
    }

    .card-title-new {
        font-weight: 800;
        font-size: 1.15rem;
        color: #2D1B69;
        margin-bottom: 0.75rem;
        line-height: 1.4;
        min-height: 3.2rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-desc-new {
        color: #6C5B7B;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1.2rem;
        min-height: 3rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* University Info */
    .card-university {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.9rem;
        background: linear-gradient(135deg, #F8F0FF, #FFF0F5);
        border-radius: 14px;
        margin-bottom: 0.75rem;
    }

    .university-icon {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1rem;
        box-shadow: 0 4px 15px rgba(108, 92, 231, 0.1);
        flex-shrink: 0;
    }

    .university-details {
        flex: 1;
        min-width: 0;
    }

    .university-label {
        font-size: 0.7rem;
        color: #6C5B7B;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .university-name-new {
        font-weight: 700;
        color: #2D1B69;
        font-size: 0.9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Deadline Info */
    .card-deadline {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.9rem;
        background: linear-gradient(135deg, #FFF5F5, #FFE8EC);
        border-radius: 14px;
    }

    .deadline-icon {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #e74c3c;
        font-size: 1rem;
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.1);
        flex-shrink: 0;
    }

    .deadline-details {
        flex: 1;
        min-width: 0;
    }

    .deadline-label {
        font-size: 0.7rem;
        color: #6C5B7B;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .deadline-date-new {
        font-weight: 700;
        color: #e74c3c;
        font-size: 0.9rem;
    }

    /* Card Footer */
    .card-footer-new {
        padding: 0 1.5rem 1.5rem;
        position: relative;
        z-index: 2;
    }

    .btn-view-detail {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 0.9rem;
        background: var(--gradient-primary);
        color: white;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.25);
        position: relative;
        overflow: hidden;
    }

    .btn-view-detail::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: all 0.6s;
    }

    .btn-view-detail:hover::before {
        left: 100%;
    }

    .btn-view-detail:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(108, 92, 231, 0.4);
    }

    .btn-view-detail i {
        transition: transform 0.3s;
    }

    .btn-view-detail:hover i {
        transform: translateX(5px);
    }

    /* ===== EMPTY STATE ===== */
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

    /* ===== PAGINATION ===== */
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
        max-width: 14px !important;
        max-height: 14px !important;
    }

    /* ===== SCROLL TO TOP ===== */
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
        transition: all 0.3s;
        text-decoration: none;
    }

    .scroll-top-btn.show {
        display: flex !important;
    }

    .scroll-top-btn:hover {
        transform: translateY(-5px);
        color: white;
        box-shadow: 0 15px 40px rgba(108, 92, 231, 0.5);
    }

    /* ===== FADE IN ===== */
    .fade-in {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        .page-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 768px) {
        .page-hero {
            padding: 80px 0 40px;
        }

        .page-title {
            font-size: 1.8rem;
        }

        .page-subtitle {
            font-size: 0.85rem;
        }

        .stat-counter {
            padding: 0.7rem 1.2rem;
        }

        .stat-number {
            font-size: 1.3rem;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            font-size: 1rem;
        }

        .stat-text {
            font-size: 0.7rem;
        }

        .page-badge {
            font-size: 0.7rem;
            padding: 0.3rem 1rem;
        }

        .filter-card {
            padding: 1.2rem;
        }

        .filter-chip {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        .filter-chip span {
            display: none;
        }

        .filter-chip.active span {
            display: inline;
        }

        .card-body-new {
            padding: 1.2rem;
        }

        .card-title-new {
            font-size: 1rem;
        }

        .pagination-wrapper .page-item .page-link {
            min-width: 38px;
            height: 38px;
            font-size: 0.85rem;
        }

        .scroll-top-btn {
            width: 45px;
            height: 45px;
            bottom: 90px;
            right: 20px;
        }
    }

    @media (max-width: 576px) {
        .page-title {
            font-size: 1.5rem;
        }

        .page-subtitle {
            font-size: 0.8rem;
        }

        .filter-buttons {
            gap: 6px;
        }

        .filter-chip {
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
        }
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