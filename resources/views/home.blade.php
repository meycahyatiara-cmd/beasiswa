@extends('layouts.app')

@section('title', 'Website Kampus Top di Indonesia')

@section('content')
<!-- Hero Section -->
<section class="hero-section" id="home">
    <div class="slideshow-container" id="slideshow">
        <div class="slide active" style="background-image: url('https://sumeks.disway.id/upload/bf2e76cbaf11201682968d219ea03c87.jpg');"></div>
        <div class="slide" style="background-image: url('https://img.okezone.com/content/2023/10/04/65/2894618/bayangi-ui-ugm-jadi-kampus-terbaik-nomor-2-di-indonesia-versi-the-wur-2024-F9DXjRirAl.jpg');"></div>
        <div class="slide" style="background-image: url('https://asset.kompas.com/crops/oqJC4iInzdR2_SKm2CfQP1JUu4Y=/0x0:1200x800/1200x800/data/photo/2022/09/27/6332aeb807329.jpg');"></div>
        <div class="slide" style="background-image: url('https://imgsrv2.voi.id/uUDjlMNxwiPs7SunDW1gDbkKn9NuVdCNx7_TBkEJ0Jo/auto/1200/675/sm/1/bG9jYWw6Ly8vcHVibGlzaGVycy80ODQ1MDEvMjAyNTA1MjQxOTIxLW1haW4uY3JvcHBlZF8xNzQ4MDg5MzY0LmpwZw.jpg');"></div>
        <div class="slide" style="background-image: url('https://imgsrv2.voi.id/t4q5BVbQnJfgDLgqYn6xgGwLST76-NloALNOSr-jQ2Q/auto/1200/675/sm/1/bG9jYWw6Ly8vcHVibGlzaGVycy81NTE0MjcvMjAyNjAxMTUxMjUyLW1haW4uY3JvcHBlZF8xNzY4NDU2MzM3LndlYnA.jpg');"></div>
        <div class="slide" style="background-image: url('https://unej.ac.id/wp-content/uploads/2024/09/bgheaderunej2024.webp');"></div>
    </div>
    
    <div class="hero-background-blur"></div>
    
    <div class="container">
        <div class="hero-content">
            <div class="text-center">
                <div class="hero-badge">
                    <i class="fas fa-award"></i> Kampus Top Indonesia
                </div>
                <h1 class="hero-title">
                    <span class="highlight">Kampus Top</span><br>
                    <span class="highlight-secondary">di Indonesia</span>
                </h1>
                <p class="hero-subtitle">
                    Temukan informasi lengkap tentang kampus-kampus terbaik di Indonesia dan program beasiswanya
                </p>
                
                <div class="hero-search">
                    <form action="{{ route('scholarships.index') }}" method="GET" class="search-box">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-search ms-4" style="color: rgba(255,255,255,0.7);"></i>
                            <input type="text" name="search" id="searchInput" class="form-control" placeholder="Cari kampus, program studi, atau beasiswa..." autocomplete="off">
                            <button type="submit">
                                <i class="fas fa-arrow-right me-2"></i>Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Universities Section -->
<section class="py-5" id="universities" style="background: white;">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="section-badge">
                <i class="fas fa-university me-2"></i> Pilihan Terbaik
            </span>
            <h2 class="section-title mt-3">Kampus <span class="highlight">Top</span> di Indonesia</h2>
            <p class="section-subtitle">Jelajahi berbagai program beasiswa dari kampus-kampus unggulan</p>
        </div>
        
        @if($universities->count() > 0)
        <div class="row g-4">
            @foreach($universities as $index => $uni)
            <div class="col-md-4 col-lg-3 reveal-scale" style="transition-delay: {{ $index * 0.08 }}s">
                <div class="university-card" onclick="location.href='{{ route('university.show', $uni->id) }}'">
                    <span class="card-number">#{{ $index + 1 }}</span>
                    
                    @if($uni->logo && file_exists(public_path($uni->logo)))
                    <div class="logo-wrapper">
                        <img src="{{ asset($uni->logo) }}" alt="{{ $uni->name }}" class="university-logo">
                    </div>
                    @else
                    <div class="icon-wrapper" style="background: {{ $uni->color ?? '#6C5CE7' }};">
                        {{ $uni->acronym }}
                    </div>
                    @endif
                    
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
        @else
        <div class="text-center py-5">
            <div style="font-size: 4rem; margin-bottom: 1rem;">
                <i class="fas fa-university" style="color: #D5CCFF;"></i>
            </div>
            <h4 style="font-weight: 700; color: var(--text-primary);">Belum ada data kampus</h4>
            <p class="text-muted">Silakan jalankan seeder atau tambahkan data kampus</p>
        </div>
        @endif

        <!-- Tombol Lihat Semua Kampus -->
        <div class="text-center mt-5 reveal">
            <a href="{{ route('universities.index') }}" class="btn-gradient">
                Lihat Semua Kampus <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3 stat-item reveal" style="transition-delay: 0.1s;">
                <div class="stat-number">{{ $universities->count() }}+</div>
                <div class="stat-label">Kampus Top</div>
            </div>
            <div class="col-6 col-md-3 stat-item reveal" style="transition-delay: 0.2s;">
                <div class="stat-number">{{ $featuredScholarships->count() * 10 }}+</div>
                <div class="stat-label">Program Beasiswa</div>
            </div>
            <div class="col-6 col-md-3 stat-item reveal" style="transition-delay: 0.3s;">
                <div class="stat-number">1000+</div>
                <div class="stat-label">Mahasiswa Terbantu</div>
            </div>
            <div class="col-6 col-md-3 stat-item reveal" style="transition-delay: 0.4s;">
                <div class="stat-number">100%</div>
                <div class="stat-label">Gratis Akses</div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Scholarships -->
<section class="py-5" style="background: #FAF8FF;">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="section-badge" style="background: rgba(253, 121, 168, 0.12); color: var(--secondary);">
                <i class="fas fa-star me-2"></i> Terbaru & Populer
            </span>
            <h3 class="section-title mt-3">🌟 <span class="highlight">Beasiswa Terbaru</span></h3>
            <p class="section-subtitle">Temukan beasiswa terbaru dari kampus-kampus top Indonesia</p>
        </div>
        
        @if($featuredScholarships->count() > 0)
        <div class="row g-4">
            @foreach($featuredScholarships as $index => $scholarship)
            <div class="col-md-6 col-lg-4 reveal" style="transition-delay: {{ $index * 0.1 }}s">
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
                    <h5 style="font-weight: 700; font-size: 1rem; min-height: 44px; color: var(--text-primary);">{{ $scholarship->title }}</h5>
                    <p class="text-muted small" style="min-height: 44px; color: var(--text-secondary); font-size: 0.85rem;">{{ Illuminate\Support\Str::limit($scholarship->description, 80) }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                        <span style="font-weight: 600; color: var(--primary); font-size: 0.8rem;">
                            <i class="fas fa-university me-1"></i> {{ $scholarship->university->name }}
                        </span>
                        <span class="deadline-text">
                            <i class="far fa-calendar-alt"></i> {{ $scholarship->deadline->format('d M Y') }}
                        </span>
                    </div>
                    <div class="mt-3 text-end">
                        <a href="{{ route('scholarship.show', $scholarship->id) }}" class="btn btn-sm btn-outline" style="padding: 0.25rem 1rem; font-size: 0.75rem; border-width: 1.5px;">
                            Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tombol Lihat Semua Beasiswa -->
        <div class="text-center mt-5 reveal">
            <a href="{{ route('scholarships.index') }}" class="btn-gradient">
                Lihat Semua Beasiswa <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        @else
        <div class="text-center py-5">
            <div style="font-size: 4rem; margin-bottom: 1rem;">
                <i class="fas fa-graduation-cap" style="color: #D5CCFF;"></i>
            </div>
            <h4 style="font-weight: 700; color: var(--text-primary);">Belum ada beasiswa tersedia</h4>
            <p class="text-muted">Silahkan tambahkan data beasiswa</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section - Modern -->
<section class="cta-section reveal">
    <div class="container">
        <div class="cta-content">
            <div class="cta-icon">🚀</div>
            <h2 class="cta-title">
                Raih <span class="highlight">Mimpi</span>mu
            </h2>
            <p class="cta-subtitle">
                Mulai langkahmu menuju kampus impian dengan informasi beasiswa yang tepat dan terpercaya
            </p>
            <div>
                <a href="{{ route('scholarships.index') }}" class="btn-cta">
                    <i class="fas fa-search"></i> Cari Beasiswa Sekarang
                </a>
            </div>
            <div class="cta-features">
                <div class="cta-feature">
                    <i class="fas fa-check-circle"></i>
                    <span>100% Gratis</span>
                </div>
                <div class="cta-feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Update Terbaru</span>
                </div>
                <div class="cta-feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Terpercaya</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Floating WhatsApp -->
<a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20konsultasi%20tentang%20beasiswa" 
   target="_blank" 
   style="position: fixed; bottom: 30px; right: 30px; z-index: 999; background: #25D366; color: white; width: 55px; height: 55px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; box-shadow: 0 5px 30px rgba(37, 211, 102, 0.4); transition: all 0.3s; text-decoration: none;">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Slideshow JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        let slideInterval;

        function goToSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            slides[index].classList.add('active');
            currentSlide = index;
        }

        function nextSlide() {
            let next = currentSlide + 1;
            if (next >= slides.length) next = 0;
            goToSlide(next);
        }

        function startSlideshow() {
            slideInterval = setInterval(nextSlide, 1000);
        }

        function stopSlideshow() {
            clearInterval(slideInterval);
        }

        const heroSection = document.querySelector('.hero-section');
        heroSection.addEventListener('mouseenter', stopSlideshow);
        heroSection.addEventListener('mouseleave', startSlideshow);

        startSlideshow();
    });
</script>
@endsection