@extends('layouts.app')

@section('title', $scholarship->title . ' - KampusTopID')

@section('content')
<!-- Hero Sub Header -->
<section class="detail-hero">
    <div class="detail-hero-bg" style="background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c7f1?w=1920&q=80');"></div>
    <div class="detail-hero-overlay"></div>
    
    <div class="container position-relative" style="z-index: 2;">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb" style="margin: 0;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('scholarships.index') }}">Semua Beasiswa</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($scholarship->title, 40) }}</li>
            </ol>
        </nav>
        
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="detail-badges">
                    <span class="detail-badge {{ $scholarship->type == 'full' ? 'badge-full-hero' : 'badge-partial-hero' }}">
                        <i class="fas {{ $scholarship->type == 'full' ? 'fa-crown' : 'fa-gift' }}"></i>
                        {{ $scholarship->type == 'full' ? 'Beasiswa Penuh' : 'Beasiswa Parsial' }}
                    </span>
                    <span class="detail-badge badge-level-hero">
                        <i class="fas fa-graduation-cap"></i>
                        {{ $scholarship->level }}
                    </span>
                </div>
                <h1 class="detail-title">{{ $scholarship->title }}</h1>
                <p class="detail-university">
                    <i class="fas fa-university me-2"></i>{{ $scholarship->university->name }}
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <div class="deadline-box">
                    <div class="deadline-box-icon">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="deadline-box-info">
                        <div class="deadline-box-label">Deadline Pendaftaran</div>
                        <div class="deadline-box-date">{{ $scholarship->deadline->format('d F Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="detail-shape shape-1"></div>
    <div class="detail-shape shape-2"></div>
</section>

<!-- Main Content -->
<section class="detail-content">
    <div class="container">
        <div class="row">
            <!-- Left Content -->
            <div class="col-lg-8 mb-4">
                <!-- Deskripsi -->
                <div class="detail-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h5 class="detail-card-title">Deskripsi Beasiswa</h5>
                    </div>
                    <div class="detail-card-body">
                        <p class="detail-text">{{ $scholarship->description }}</p>
                    </div>
                </div>

                <!-- Persyaratan -->
                @if($scholarship->requirements)
                <div class="detail-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon icon-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h5 class="detail-card-title">Persyaratan</h5>
                    </div>
                    <div class="detail-card-body">
                        <div class="requirement-list">
                            @foreach(explode(',', $scholarship->requirements) as $req)
                            <div class="requirement-item">
                                <i class="fas fa-check"></i>
                                <span>{{ trim($req) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Beasiswa Lainnya -->
                @php
                    $otherScholarships = App\Models\Scholarship::where('university_id', $scholarship->university_id)
                        ->where('id', '!=', $scholarship->id)
                        ->where('is_active', true)
                        ->where('deadline', '>=', now())
                        ->take(3)
                        ->get();
                @endphp

                @if($otherScholarships->count() > 0)
                <div class="detail-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon icon-purple">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h5 class="detail-card-title">Beasiswa Lainnya dari {{ $scholarship->university->name }}</h5>
                    </div>
                    <div class="detail-card-body">
                        <div class="row g-3">
                            @foreach($otherScholarships as $other)
                            <div class="col-md-6">
                                <a href="{{ route('scholarship.show', $other->id) }}" class="other-card">
                                    <div class="other-card-top">
                                        <span class="other-badge {{ $other->type == 'full' ? 'other-badge-full' : 'other-badge-partial' }}">
                                            {{ $other->type == 'full' ? 'Penuh' : 'Parsial' }}
                                        </span>
                                    </div>
                                    <h6 class="other-card-title">{{ Str::limit($other->title, 50) }}</h6>
                                    <div class="other-card-bottom">
                                        <span><i class="far fa-calendar-alt"></i> {{ $other->deadline->format('d M Y') }}</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <!-- Info Card -->
                <div class="sidebar-card">
                    <div class="sidebar-header">
                        <i class="fas fa-list-alt"></i>
                        <span>Informasi Beasiswa</span>
                    </div>
                    <div class="sidebar-body">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Bidang Studi</div>
                                <div class="info-value">{{ $scholarship->field_of_study ?? 'Semua Jurusan' }}</div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Kuota</div>
                                <div class="info-value">{{ $scholarship->quota ?? '-' }} {{ $scholarship->quota ? 'orang' : '' }}</div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Jenjang</div>
                                <div class="info-value">{{ $scholarship->level }}</div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon icon-red">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Deadline</div>
                                <div class="info-value text-danger">{{ $scholarship->deadline->format('d F Y') }}</div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Kampus</div>
                                <div class="info-value">
                                    <a href="{{ route('university.show', $scholarship->university->id) }}" class="university-link">
                                        {{ $scholarship->university->name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Card -->
                <div class="action-card">
                    @if($scholarship->link)
                    <a href="{{ $scholarship->link }}" target="_blank" class="btn-action-primary">
                        <i class="fas fa-external-link-alt"></i>
                        Daftar Sekarang
                    </a>
                    @endif
                    
                    @if($scholarship->university->website)
                    <a href="{{ $scholarship->university->website }}" target="_blank" class="btn-action-secondary">
                        <i class="fas fa-globe"></i>
                        Website Kampus
                    </a>
                    @endif
                    
                    <a href="{{ route('scholarships.index') }}" class="btn-action-back">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Semua Beasiswa
                    </a>
                </div>
                
                <!-- Share Card -->
                <div class="share-card">
                    <div class="share-title">
                        <i class="fas fa-share-alt"></i>
                        Bagikan Beasiswa Ini
                    </div>
                    <div class="share-buttons">
                        <a href="https://wa.me/?text={{ urlencode($scholarship->title . ' - ' . route('scholarship.show', $scholarship->id)) }}" 
                           target="_blank" class="share-btn share-wa">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($scholarship->title) }}&url={{ urlencode(route('scholarship.show', $scholarship->id)) }}" 
                           target="_blank" class="share-btn share-tw">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('scholarship.show', $scholarship->id)) }}" 
                           target="_blank" class="share-btn share-fb">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('scholarship.show', $scholarship->id)) }}" 
                           target="_blank" class="share-btn share-li">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scroll to Top Button -->
<a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;" 
   id="scrollTopBtn"
   class="scroll-top-btn">
    <i class="fas fa-arrow-up"></i>
</a>

<style>
    /* ===== DETAIL HERO ===== */
    .detail-hero {
        position: relative;
        padding: 120px 0 60px;
        overflow: hidden;
        margin-top: 0;
    }

    .detail-hero-bg {
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

    .detail-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, 
            rgba(45, 27, 105, 0.92) 0%, 
            rgba(108, 92, 231, 0.85) 50%, 
            rgba(162, 155, 254, 0.75) 100%);
        z-index: 1;
    }

    .detail-hero .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 1rem;
    }

    .detail-hero .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.3s;
    }

    .detail-hero .breadcrumb-item a:hover {
        color: white;
    }

    .detail-hero .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.95);
    }

    .detail-hero .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.5);
    }

    .detail-badges {
        display: flex;
        gap: 10px;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .detail-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 0.4rem 1.2rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-full-hero {
        background: linear-gradient(135deg, #00B894, #00CEC9);
        color: white;
        box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
    }

    .badge-partial-hero {
        background: linear-gradient(135deg, #FD79A8, #FDCB6E);
        color: white;
        box-shadow: 0 4px 15px rgba(253, 121, 168, 0.3);
    }

    .badge-level-hero {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .detail-title {
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        font-size: 2.8rem;
        color: white;
        line-height: 1.2;
        margin-bottom: 0.5rem;
        letter-spacing: -1px;
        text-shadow: 0 4px 30px rgba(0,0,0,0.3);
    }

    .detail-university {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        font-weight: 400;
        margin: 0;
    }

    .deadline-box {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(20px);
        padding: 1rem 1.5rem;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .deadline-box-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #FDCB6E, #FD79A8);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: white;
        box-shadow: 0 8px 25px rgba(253, 121, 168, 0.4);
    }

    .deadline-box-label {
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .deadline-box-date {
        color: white;
        font-weight: 800;
        font-size: 1.1rem;
        font-family: 'Playfair Display', serif;
    }

    .detail-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        z-index: 1;
    }

    .detail-shape.shape-1 {
        width: 200px;
        height: 200px;
        top: -80px;
        right: -80px;
        animation: float 15s ease-in-out infinite;
    }

    .detail-shape.shape-2 {
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

    /* ===== DETAIL CONTENT ===== */
    .detail-content {
        padding: 50px 0 80px;
        background: linear-gradient(180deg, #FAF8FF 0%, #F5F0FF 50%, #FAF8FF 100%);
    }

    /* ===== DETAIL CARDS ===== */
    .detail-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(108, 92, 231, 0.06);
        border: 1px solid rgba(108, 92, 231, 0.06);
        transition: all 0.3s;
    }

    .detail-card:hover {
        box-shadow: 0 10px 40px rgba(108, 92, 231, 0.1);
    }

    .detail-card-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f0edf5;
    }

    .detail-card-icon {
        width: 50px;
        height: 50px;
        background: var(--gradient-primary);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        box-shadow: 0 8px 20px rgba(108, 92, 231, 0.25);
        flex-shrink: 0;
    }

    .detail-card-icon.icon-success {
        background: linear-gradient(135deg, #00B894, #00CEC9);
        box-shadow: 0 8px 20px rgba(0, 184, 148, 0.25);
    }

    .detail-card-icon.icon-purple {
        background: linear-gradient(135deg, #6C5CE7, #FD79A8);
        box-shadow: 0 8px 20px rgba(108, 92, 231, 0.25);
    }

    .detail-card-title {
        font-weight: 800;
        color: #2D1B69;
        margin: 0;
        font-size: 1.15rem;
    }

    .detail-text {
        color: #6C5B7B;
        line-height: 1.8;
        font-size: 1rem;
        margin: 0;
    }

    /* Requirements */
    .requirement-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .requirement-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 0.75rem 1rem;
        background: linear-gradient(135deg, #F8F0FF, #FFF0F5);
        border-radius: 12px;
        border-left: 4px solid #00B894;
    }

    .requirement-item i {
        color: #00B894;
        font-size: 1rem;
        margin-top: 3px;
        flex-shrink: 0;
    }

    .requirement-item span {
        color: #6C5B7B;
        font-weight: 500;
    }

    /* Other Scholarships */
    .other-card {
        display: block;
        background: linear-gradient(135deg, #F8F0FF, #FFF0F5);
        border-radius: 14px;
        padding: 1.2rem;
        text-decoration: none;
        transition: all 0.3s;
        border: 1px solid rgba(108, 92, 231, 0.08);
        height: 100%;
    }

    .other-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(108, 92, 231, 0.15);
        border-color: rgba(108, 92, 231, 0.2);
    }

    .other-card-top {
        margin-bottom: 0.75rem;
    }

    .other-badge {
        display: inline-block;
        padding: 0.25rem 0.8rem;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .other-badge-full {
        background: linear-gradient(135deg, #00B894, #00CEC9);
        color: white;
    }

    .other-badge-partial {
        background: linear-gradient(135deg, #FD79A8, #FDCB6E);
        color: white;
    }

    .other-card-title {
        font-weight: 700;
        color: #2D1B69;
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .other-card-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #6C5B7B;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .other-card-bottom i {
        color: var(--primary);
    }

    /* ===== SIDEBAR ===== */
    .sidebar-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(108, 92, 231, 0.06);
        border: 1px solid rgba(108, 92, 231, 0.06);
    }

    .sidebar-header {
        background: var(--gradient-primary);
        color: white;
        padding: 1.2rem 1.5rem;
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-header i {
        font-size: 1.1rem;
    }

    .sidebar-body {
        padding: 1.5rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.9rem 0;
        border-bottom: 1px solid #f0edf5;
    }

    .info-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-item:first-child {
        padding-top: 0;
    }

    .info-icon {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #F8F0FF, #E8F0FE);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1rem;
        flex-shrink: 0;
    }

    .info-icon.icon-red {
        background: linear-gradient(135deg, #FFF5F5, #FFE8EC);
        color: #e74c3c;
    }

    .info-content {
        flex: 1;
        min-width: 0;
    }

    .info-label {
        font-size: 0.75rem;
        color: #6C5B7B;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .info-value {
        font-weight: 700;
        color: #2D1B69;
        font-size: 0.9rem;
        word-wrap: break-word;
    }

    .university-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s;
    }

    .university-link:hover {
        color: #FD79A8;
    }

    /* Action Card */
    .action-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(108, 92, 231, 0.06);
        border: 1px solid rgba(108, 92, 231, 0.06);
    }

    .btn-action-primary {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 1rem;
        background: var(--gradient-primary);
        color: white;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 8px 20px rgba(108, 92, 231, 0.25);
        margin-bottom: 10px;
        border: none;
    }

    .btn-action-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(108, 92, 231, 0.4);
        color: white;
    }

    .btn-action-secondary {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 0.9rem;
        background: white;
        color: var(--primary);
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s;
        border: 2px solid var(--primary);
        margin-bottom: 10px;
    }

    .btn-action-secondary:hover {
        background: var(--gradient-primary);
        color: white;
        border-color: transparent;
        transform: translateY(-3px);
    }

    .btn-action-back {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 0.8rem;
        background: transparent;
        color: #6C5B7B;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.3s;
        border: 1px solid #e9ecef;
    }

    .btn-action-back:hover {
        background: #f8f9fa;
        color: #2D1B69;
        border-color: #dee2e6;
    }

    /* Share Card */
    .share-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(108, 92, 231, 0.06);
        border: 1px solid rgba(108, 92, 231, 0.06);
    }

    .share-title {
        font-weight: 700;
        color: #2D1B69;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .share-title i {
        color: var(--primary);
    }

    .share-buttons {
        display: flex;
        gap: 10px;
    }

    .share-btn {
        flex: 1;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        color: white;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .share-btn:hover {
        transform: translateY(-3px);
        color: white;
    }

    .share-wa {
        background: linear-gradient(135deg, #25D366, #128C7E);
    }

    .share-tw {
        background: linear-gradient(135deg, #1DA1F2, #0d8ddb);
    }

    .share-fb {
        background: linear-gradient(135deg, #1877F2, #0c5dc7);
    }

    .share-li {
        background: linear-gradient(135deg, #0077B5, #005885);
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
        transition: all 0.3s;
    }

    .scroll-top-btn.show {
        display: flex !important;
    }

    .scroll-top-btn:hover {
        transform: translateY(-5px);
        color: white;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .detail-title { font-size: 2.2rem; }
    }

    @media (max-width: 768px) {
        .detail-hero {
            padding: 100px 0 50px;
        }

        .detail-title { font-size: 1.8rem; }

        .detail-university { font-size: 0.95rem; }

        .deadline-box {
            padding: 0.8rem 1.2rem;
        }

        .deadline-box-icon {
            width: 42px;
            height: 42px;
            font-size: 1.1rem;
        }

        .deadline-box-date { font-size: 1rem; }

        .detail-content { padding: 30px 0 60px; }

        .detail-card { padding: 1.5rem; }

        .detail-card-icon {
            width: 42px;
            height: 42px;
            font-size: 1rem;
        }

        .detail-card-title { font-size: 1rem; }

        .sidebar-body, .action-card, .share-card {
            padding: 1.2rem;
        }

        .scroll-top-btn {
            width: 45px;
            height: 45px;
            bottom: 90px;
            right: 20px;
        }
    }

    @media (max-width: 576px) {
        .detail-title { font-size: 1.5rem; }
        .detail-badge { font-size: 0.7rem; padding: 0.3rem 1rem; }
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