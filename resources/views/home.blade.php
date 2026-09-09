@extends('layouts.app')

@section('title', 'Website Kampus Top di Indonesia')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="deco-circle"></div>
    <div class="deco-circle"></div>
    
    <div class="container hero-content">
        <div class="text-center">
            <div class="hero-badge">
                <i class="fas fa-award"></i> Kampus Top Indonesia
            </div>
            <h1>
                <span class="highlight">Kampus Top</span><br>
                <span class="highlight-secondary">di Indonesia</span>
            </h1>
            <p class="subtitle">
                Temukan informasi lengkap tentang kampus-kampus terbaik di Indonesia dan program beasiswanya
            </p>
            
            <form action="{{ route('scholarships.index') }}" method="GET" class="search-box">
                <div class="d-flex align-items-center">
                    <i class="fas fa-search ms-4" style="color: #B8A9C9;"></i>
                    <input type="text" name="search" id="searchInput" class="form-control" placeholder="Cari kampus, program studi, atau beasiswa..." autocomplete="off">
                    <button type="submit">
                        <i class="fas fa-arrow-right me-2"></i>Cari
                    </button>
                </div>
            </form>

            <div class="filter-wrapper">
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <a href="{{ route('scholarships.index') }}" class="filter-btn active">Semua Kampus</a>
                    <a href="{{ route('scholarships.index', ['type' => 'full']) }}" class="filter-btn">Beasiswa Penuh</a>
                    <a href="{{ route('scholarships.index', ['type' => 'partial']) }}" class="filter-btn">Beasiswa Parsial</a>
                    <a href="{{ route('scholarships.index', ['level' => 'S1']) }}" class="filter-btn">Jenjang S1</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Universities Section -->
<section class="py-5" style="background: white;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">
                <i class="fas fa-university me-2"></i> Pilihan Terbaik
            </span>
            <h2 class="section-title mt-3">Kampus <span class="highlight">Top</span> di Indonesia</h2>
            <p class="section-subtitle">Jelajahi berbagai program beasiswa dari kampus-kampus unggulan</p>
        </div>
        
        <div class="row g-4">
            @foreach($universities as $index => $uni)
            <div class="col-md-4 col-lg-3 fade-in" style="animation-delay: {{ $index * 0.05 }}s">
                <div class="university-card" onclick="location.href='{{ route('university.show', $uni->id) }}'">
                    <span class="card-number">#{{ $index + 1 }}</span>
                    <div class="icon-wrapper" style="background: {{ $uni->color ?? '#6C5CE7' }};">
                        {{ $uni->acronym }}
                    </div>
                    <h5>{{ $uni->name }}</h5>
                    <div class="acronym">{{ $uni->acronym }}</div>
                    <div class="badge-count">
                        <i class="fas fa-trophy me-2"></i> {{ $uni->scholarships_count ?? 0 }} Beasiswa
                    </div>
                    <div class="arrow"><i class="fas fa-arrow-right"></i></div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('scholarships.index') }}" class="btn-gradient">
                Lihat Semua Kampus <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3 stat-item fade-in" style="animation-delay: 0.1s;">
                <div class="stat-number">{{ $universities->count() }}+</div>
                <div class="stat-label">Kampus Top</div>
            </div>
            <div class="col-6 col-md-3 stat-item fade-in" style="animation-delay: 0.2s;">
                <div class="stat-number">50+</div>
                <div class="stat-label">Program Beasiswa</div>
            </div>
            <div class="col-6 col-md-3 stat-item fade-in" style="animation-delay: 0.3s;">
                <div class="stat-number">1000+</div>
                <div class="stat-label">Mahasiswa Terbantu</div>
            </div>
            <div class="col-6 col-md-3 stat-item fade-in" style="animation-delay: 0.4s;">
                <div class="stat-number">100%</div>
                <div class="stat-label">Gratis Akses</div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Scholarships -->
<section class="py-5" style="background: #FAF8FF;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge" style="background: rgba(253, 121, 168, 0.12); color: var(--secondary);">
                <i class="fas fa-star me-2"></i> Terbaru & Populer
            </span>
            <h3 class="section-title mt-3">🌟 <span class="highlight">Beasiswa Terbaru</span></h3>
            <p class="section-subtitle">Temukan beasiswa terbaru dari kampus-kampus top Indonesia</p>
        </div>
        
        <div class="row g-4">
            @foreach($featuredScholarships as $index => $scholarship)
            <div class="col-md-6 col-lg-4 fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                <div class="scholarship-card" onclick="location.href='{{ route('scholarship.show', $scholarship->id) }}'">
                    <div class="scholarship-header">
                        <span class="badge {{ $scholarship->type == 'full' ? 'badge-full' : 'badge-partial' }}">
                            <i class="fas {{ $scholarship->type == 'full' ? 'fa-crown' : 'fa-gift' }} me-1"></i>
                            {{ $scholarship->type == 'full' ? 'Beasiswa Penuh' : 'Beasiswa Parsial' }}
                        </span>
                        <span class="badge-level">
                            {{ $scholarship->level }}
                        </span>
                    </div>
                    <h5 style="font-weight: 700; font-size: 1.05rem; min-height: 48px; color: var(--text-primary);">{{ $scholarship->title }}</h5>
                    <p class="text-muted small" style="min-height: 48px; color: var(--text-secondary);">{{ Illuminate\Support\Str::limit($scholarship->description, 80) }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                        <span style="font-weight: 600; color: var(--primary); font-size: 0.85rem;">
                            <i class="fas fa-university me-1"></i> {{ $scholarship->university->name }}
                        </span>
                        <span class="deadline-text">
                            <i class="far fa-calendar-alt"></i> {{ $scholarship->deadline->format('d M Y') }}
                        </span>
                    </div>
                    <div class="mt-3 text-end">
                        <a href="{{ route('scholarship.show', $scholarship->id) }}" class="btn btn-sm btn-outline" style="padding: 0.3rem 1.2rem; font-size: 0.8rem; border-width: 1.5px;">
                            Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($featuredScholarships->count() > 0)
        <div class="text-center mt-5">
            <a href="{{ route('scholarships.index') }}" class="btn-outline">
                Lihat Semua Beasiswa <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section style="background: linear-gradient(135deg, #2D1B69, #6C5CE7); padding: 80px 0; color: white; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%2240%22 fill=%22rgba(255,255,255,0.02)%22/></svg>') repeat; opacity: 0.3;"></div>
    <div class="container text-center position-relative" style="z-index: 1;">
        <h2 style="font-family: 'Playfair Display', serif; font-weight: 900; font-size: 3rem; margin-bottom: 1rem;">
            🚀 <span style="color: #FDCB6E;">Raih Mimpi</span>
        </h2>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto 2rem;">
            Mulai langkahmu menuju kampus impian dengan informasi yang tepat
        </p>
        <div>
            <a href="{{ route('scholarships.index') }}" class="btn-gradient" style="font-size: 1.1rem; padding: 1rem 3.5rem; background: white; color: var(--primary);">
                <i class="fas fa-search me-2"></i> Cari Beasiswa Sekarang
            </a>
        </div>
        <div style="margin-top: 2rem; display: flex; justify-content: center; gap: 2.5rem; flex-wrap: wrap;">
            <span><i class="fas fa-check-circle me-2" style="color: #00CEC9;"></i> Gratis</span>
            <span><i class="fas fa-check-circle me-2" style="color: #00CEC9;"></i> Update Terbaru</span>
            <span><i class="fas fa-check-circle me-2" style="color: #00CEC9;"></i> 100% Terpercaya</span>
        </div>
    </div>
</section>
@endsection