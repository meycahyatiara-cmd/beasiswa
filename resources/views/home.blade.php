@extends('layouts.app')

@section('title', 'Beasiswa Kampus Top Indonesia')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-pattern"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    
    <div class="container hero-content">
        <div class="text-center">
            <div class="hero-badge">
                <i class="fas fa-award me-2"></i> 10 Kampus Terbaik Indonesia
            </div>
            <h1>
                🎓 <span class="highlight-text">10 KAMPUS</span><br>
                <span style="font-size: 0.8em;">BANYAK BEASISWA</span>
            </h1>
            <p class="subtitle">
                Temukan informasi beasiswa dari 10 kampus terbaik di Indonesia dalam satu tempat!
            </p>
            
            <form action="{{ route('scholarships.index') }}" method="GET" class="search-box" id="searchForm">
                <div class="d-flex align-items-center">
                    <i class="fas fa-search ms-4" style="color: #adb5bd;"></i>
                    <input type="text" name="search" id="searchInput" class="form-control" placeholder="Cari beasiswa, kampus, atau jurusan..." autocomplete="off">
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
<section class="py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge" style="background: var(--gradient-primary); padding: 0.5rem 1.5rem; font-size: 0.9rem;">
                <i class="fas fa-university me-2"></i> Pilihan Terbaik
            </span>
            <h2 class="section-title mt-3">10 <span class="highlight">Kampus Terbaik</span> di Indonesia</h2>
            <p class="section-subtitle">Jelajahi berbagai program beasiswa dari kampus-kampus unggulan</p>
        </div>
        
        <div class="row g-4">
            @foreach($universities as $index => $uni)
            <div class="col-md-4 col-lg-3 fade-in" style="animation-delay: {{ $index * 0.08 }}s">
                <div class="university-card" onclick="location.href='{{ route('university.show', $uni->id) }}'">
                    <span class="card-number">#{{ $index + 1 }}</span>
                    <div class="icon-wrapper" style="background: {{ $uni->color ?? '#667eea' }};">
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
                <div class="stat-number">10+</div>
                <div class="stat-label">Kampus Unggulan</div>
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
<section class="py-5" style="background: white;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge" style="background: linear-gradient(135deg, #f093fb, #f5576c); padding: 0.5rem 1.5rem; font-size: 0.9rem;">
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
                    <h5 style="font-weight: 700; font-size: 1.1rem; min-height: 50px;">{{ $scholarship->title }}</h5>
                    <p class="text-muted small" style="min-height: 50px;">{{ Illuminate\Support\Str::limit($scholarship->description, 80) }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                        <span style="font-weight: 600; color: #667eea; font-size: 0.9rem;">
                            <i class="fas fa-university me-1"></i> {{ $scholarship->university->name }}
                        </span>
                        <span class="deadline-text">
                            <i class="far fa-calendar-alt"></i> {{ $scholarship->deadline->format('d M Y') }}
                        </span>
                    </div>
                    <div class="mt-3 text-end">
                        <a href="{{ route('scholarship.show', $scholarship->id) }}" class="btn btn-sm btn-outline-gradient" style="padding: 0.4rem 1.2rem; font-size: 0.85rem;">
                            Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($featuredScholarships->count() > 0)
        <div class="text-center mt-5">
            <a href="{{ route('scholarships.index') }}" class="btn-outline-gradient">
                Lihat Semua Beasiswa <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section style="background: url('https://images.unsplash.com/photo-1523050854058-8df90110c7f1?w=1920&q=80') center/cover no-repeat; padding: 100px 0; color: white; position: relative;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(12,12,29,0.92) 0%, rgba(26,26,62,0.92) 100%);"></div>
    <div class="container text-center position-relative" style="z-index: 1;">
        <h2 style="font-weight: 900; font-size: 3.2rem; margin-bottom: 1rem;">
            🚀 <span style="background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Raih Mimpi</span>
        </h2>
        <p style="font-size: 1.3rem; opacity: 0.9; max-width: 600px; margin: 0 auto 2rem;">
            Mulai langkahmu menuju kampus impian dengan beasiswa yang tepat
        </p>
        <div>
            <a href="{{ route('scholarships.index') }}" class="btn-gradient" style="font-size: 1.2rem; padding: 1.2rem 4rem;">
                <i class="fas fa-search me-2"></i> Cari Beasiswa Sekarang
            </a>
        </div>
        <div style="margin-top: 2rem; display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap;">
            <span><i class="fas fa-check-circle me-2" style="color: #38ef7d;"></i> Gratis</span>
            <span><i class="fas fa-check-circle me-2" style="color: #38ef7d;"></i> Update Terbaru</span>
            <span><i class="fas fa-check-circle me-2" style="color: #38ef7d;"></i> 100% Terpercaya</span>
        </div>
    </div>
</section>
@endsection