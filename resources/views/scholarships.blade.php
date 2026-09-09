@extends('layouts.app')

@section('title', 'Semua Beasiswa')

@section('content')
<!-- Hero Sub Header -->
<section style="background: var(--gradient-primary); padding: 40px 0 30px; color: white; position: relative; overflow: hidden; margin-top: 76px;">
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem;">
                    <i class="fas fa-search me-3"></i>Semua Beasiswa
                </h2>
                <p style="opacity: 0.9; font-size: 1.1rem; margin-bottom: 0;">
                    Temukan berbagai program beasiswa dari kampus-kampus top Indonesia
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="badge" style="background: rgba(255,255,255,0.2); padding: 0.5rem 1.5rem; font-size: 1rem; backdrop-filter: blur(10px);">
                    <i class="fas fa-graduation-cap me-2"></i> {{ $scholarships->total() }} Beasiswa
                </span>
            </div>
        </div>
    </div>
    <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,0.05);"></div>
    <div style="position: absolute; bottom: -80px; left: -30px; width: 150px; height: 150px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>
</section>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <!-- Filter Section -->
        <div class="filter-section mb-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-3 mb-3 mb-lg-0">
                            <h6 style="font-weight: 700; color: #2d3436; margin-bottom: 0;">
                                <i class="fas fa-filter me-2" style="color: #667eea;"></i> Filter Beasiswa
                            </h6>
                        </div>
                        <div class="col-lg-9">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('scholarships.index') }}" class="filter-btn-modern {{ !request('type') && !request('level') && !request('search') ? 'active' : '' }}">
                                    <i class="fas fa-th-large me-1"></i> Semua
                                </a>
                                <a href="{{ route('scholarships.index', ['type' => 'full']) }}" class="filter-btn-modern {{ request('type') == 'full' ? 'active' : '' }}">
                                    <i class="fas fa-crown me-1"></i> Beasiswa Penuh
                                </a>
                                <a href="{{ route('scholarships.index', ['type' => 'partial']) }}" class="filter-btn-modern {{ request('type') == 'partial' ? 'active' : '' }}">
                                    <i class="fas fa-gift me-1"></i> Beasiswa Parsial
                                </a>
                                <a href="{{ route('scholarships.index', ['level' => 'S1']) }}" class="filter-btn-modern {{ request('level') == 'S1' ? 'active' : '' }}">
                                    <i class="fas fa-user-graduate me-1"></i> S1
                                </a>
                                <a href="{{ route('scholarships.index', ['level' => 'S2']) }}" class="filter-btn-modern {{ request('level') == 'S2' ? 'active' : '' }}">
                                    <i class="fas fa-user-tie me-1"></i> S2
                                </a>
                                <a href="{{ route('scholarships.index', ['level' => 'S3']) }}" class="filter-btn-modern {{ request('level') == 'S3' ? 'active' : '' }}">
                                    <i class="fas fa-microscope me-1"></i> S3
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Result Info -->
        @if(request('search'))
        <div class="alert alert-info alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert" style="background: #e8f0fe;">
            <i class="fas fa-search me-2"></i> Menampilkan hasil untuk: <strong>"{{ request('search') }}"</strong>
            <a href="{{ route('scholarships.index') }}" class="btn btn-sm btn-outline-primary ms-3" style="border-radius: 50px;">
                <i class="fas fa-times me-1"></i> Hapus Filter
            </a>
        </div>
        @endif

        <!-- Results -->
        @if($scholarships->count() > 0)
        <div class="row g-4">
            @foreach($scholarships as $index => $scholarship)
            <div class="col-md-6 col-xl-4 fade-in" style="animation-delay: {{ $index * 0.08 }}s;">
                <div class="scholarship-card-modern" onclick="location.href='{{ route('scholarship.show', $scholarship->id) }}'">
                    <div class="card-top">
                        <span class="badge {{ $scholarship->type == 'full' ? 'badge-full-modern' : 'badge-partial-modern' }}">
                            <i class="fas {{ $scholarship->type == 'full' ? 'fa-crown' : 'fa-gift' }} me-1"></i>
                            {{ $scholarship->type == 'full' ? 'Beasiswa Penuh' : 'Beasiswa Parsial' }}
                        </span>
                        <span class="badge-level-modern">
                            <i class="fas fa-graduation-cap me-1"></i> {{ $scholarship->level }}
                        </span>
                    </div>

                    <h5 class="card-title-modern">{{ $scholarship->title }}</h5>

                    <p class="card-description-modern">
                        {{ Illuminate\Support\Str::limit($scholarship->description, 100) }}
                    </p>

                    <div class="card-bottom">
                        <div class="university-info">
                            <span class="university-name">
                                <i class="fas fa-university me-1"></i> {{ $scholarship->university->name }}
                            </span>
                        </div>
                        <div class="deadline-info">
                            <span class="deadline-date">
                                <i class="far fa-calendar-alt me-1"></i> {{ $scholarship->deadline->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="card-action">
                        <a href="{{ route('scholarship.show', $scholarship->id) }}" class="btn-detail-modern">
                            Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper mt-5">
            {{ $scholarships->links() }}
        </div>
        @else
        <div class="empty-state">
            <div class="text-center py-5">
                <div style="font-size: 4rem; margin-bottom: 1rem;">
                    <i class="fas fa-search" style="color: #dee2e6;"></i>
                </div>
                <h4 style="font-weight: 700; color: #2d3436;">Belum ada beasiswa yang tersedia</h4>
                <p class="text-muted">Silahkan cek kembali nanti untuk informasi terbaru</p>
                <a href="{{ route('home') }}" class="btn-gradient" style="padding: 0.8rem 2.5rem; font-size: 0.95rem;">
                    <i class="fas fa-home me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

<style>
    /* Modern Filter Buttons */
    .filter-btn-modern {
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        border: 2px solid #e9ecef;
        background: white;
        color: #495057;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .filter-btn-modern:hover {
        border-color: #667eea;
        color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.15);
        text-decoration: none;
    }

    .filter-btn-modern.active {
        background: var(--gradient-primary);
        color: white;
        border-color: transparent;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
    }

    .filter-btn-modern.active:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
    }

    /* Modern Scholarship Cards */
    .scholarship-card-modern {
        background: white;
        border-radius: 20px;
        padding: 1.8rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        cursor: pointer;
        border: 1px solid rgba(0,0,0,0.04);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    .scholarship-card-modern::before {
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

    .scholarship-card-modern:hover::before {
        opacity: 1;
    }

    .scholarship-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(102, 126, 234, 0.15);
        border-color: rgba(102, 126, 234, 0.1);
    }

    .card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 8px;
    }

    .badge-full-modern {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
        padding: 0.35rem 1.2rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-partial-modern {
        background: linear-gradient(135deg, #f093fb, #f5576c);
        color: white;
        padding: 0.35rem 1.2rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-level-modern {
        background: #f8f9fa;
        color: #495057;
        padding: 0.3rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid #e9ecef;
    }

    .card-title-modern {
        font-weight: 700;
        font-size: 1.1rem;
        color: #2d3436;
        margin-bottom: 0.75rem;
        min-height: 3.2rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-description-modern {
        color: #636e72;
        font-size: 0.9rem;
        line-height: 1.6;
        min-height: 3.2rem;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .card-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #f1f3f5;
        margin-top: auto;
        flex-wrap: wrap;
        gap: 8px;
    }

    .university-info {
        flex: 1;
    }

    .university-name {
        font-weight: 600;
        color: #667eea;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .deadline-info {
        flex-shrink: 0;
    }

    .deadline-date {
        font-size: 0.8rem;
        color: #e74c3c;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #fff5f5;
        padding: 0.25rem 0.8rem;
        border-radius: 50px;
    }

    .card-action {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #f1f3f5;
        text-align: right;
    }

    .btn-detail-modern {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1.5rem;
        background: var(--gradient-primary);
        color: white;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.3s;
        border: none;
    }

    .btn-detail-modern:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* Pagination */
    .pagination-wrapper .pagination {
        justify-content: center;
        gap: 5px;
    }

    .pagination-wrapper .page-item .page-link {
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        color: #495057;
        font-weight: 600;
        transition: all 0.3s;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }

    .pagination-wrapper .page-item .page-link:hover {
        background: var(--gradient-primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
    }

    .pagination-wrapper .page-item.active .page-link {
        background: var(--gradient-primary);
        color: white;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
    }

    .pagination-wrapper .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .empty-state {
        padding: 3rem 0;
    }

    @media (max-width: 768px) {
        .filter-section .card-body {
            padding: 1.5rem !important;
        }

        .filter-btn-modern {
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
        }

        .scholarship-card-modern {
            padding: 1.2rem;
        }

        .card-title-modern {
            font-size: 1rem;
            min-height: 2.6rem;
        }

        .card-description-modern {
            font-size: 0.85rem;
            min-height: 2.6rem;
        }

        .badge-full-modern,
        .badge-partial-modern {
            font-size: 0.65rem;
            padding: 0.25rem 0.8rem;
        }

        .badge-level-modern {
            font-size: 0.65rem;
            padding: 0.2rem 0.8rem;
        }

        .deadline-date {
            font-size: 0.7rem;
            padding: 0.2rem 0.6rem;
        }

        .btn-detail-modern {
            padding: 0.4rem 1.2rem;
            font-size: 0.8rem;
        }

        .university-name {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .filter-btn-modern {
            padding: 0.3rem 0.8rem;
            font-size: 0.7rem;
        }

        .card-bottom {
            flex-direction: column;
            align-items: flex-start;
        }

        .deadline-info {
            width: 100%;
        }

        .deadline-date {
            width: 100%;
            justify-content: center;
        }
    }

    .fade-in {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
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
</style>
@endsection