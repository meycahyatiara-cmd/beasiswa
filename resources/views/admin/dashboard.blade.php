@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    /* ===== HERO ADMIN STYLE ===== */
    .hero-admin {
        position: relative;
        padding: 160px 0 80px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .hero-admin-bg {
        position: absolute;
        inset: 0;
        background-image: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1920&q=80');
        background-size: cover;
        background-position: center;
        z-index: 0;
        animation: zoomIn 20s ease-in-out infinite alternate;
    }

    @keyframes zoomIn {
        0% { transform: scale(1); }
        100% { transform: scale(1.05); }
    }

    .hero-admin-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, 
            rgba(45, 27, 105, 0.95) 0%, 
            rgba(108, 92, 231, 0.85) 50%, 
            rgba(162, 155, 254, 0.75) 100%);
        z-index: 1;
    }

    .admin-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #FD79A8, #FDCB6E);
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(253, 121, 168, 0.3);
    }

    .hero-admin-title {
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        font-size: 3.5rem;
        color: white;
        line-height: 1.1;
        margin-top: 1rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 4px 30px rgba(0,0,0,0.3);
    }

    .hero-admin-subtitle {
        color: rgba(255, 255, 255, 0.85);
        font-size: 1.05rem;
        font-weight: 300;
    }

    /* Glassmorphism Card untuk Statistik */
    .admin-glass-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 1.8rem;
        box-shadow: 0 15px 50px rgba(0,0,0,0.2);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .admin-glass-card:hover {
        transform: translateY(-8px);
        background: rgba(255, 255, 255, 0.18);
        box-shadow: 0 25px 60px rgba(0,0,0,0.3);
    }

    .stat-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    /* ===== TABLE ADMIN STYLE ===== */
    .admin-card {
        border-radius: 24px;
        border: 1px solid rgba(108, 92, 231, 0.08);
        box-shadow: 0 15px 50px rgba(108, 92, 231, 0.08);
        overflow: hidden;
        background: white;
        position: relative;
        z-index: 2;
        margin-top: -40px;
    }

    .table-custom th {
        background: #FAF8FF;
        color: #2D1B69;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid rgba(108, 92, 231, 0.1);
        padding: 1.2rem 1rem;
    }

    .table-custom td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        color: #6C5B7B;
        border-bottom: 1px solid #f0edf5;
    }

    .table-custom tbody tr:hover {
        background-color: #F8F0FF;
        transition: all 0.3s;
    }

    .badge-type {
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.75rem;
    }
    
    .badge-full { background: #E8F8F5; color: #00B894; }
    .badge-partial { background: #FFF5F5; color: #e74c3c; }
</style>

<!-- HERO & STATISTIK -->
<div class="hero-admin">
    <div class="hero-admin-bg"></div>
    <div class="hero-admin-overlay"></div>
    
    <div class="container position-relative" style="z-index: 2;">
        <!-- Baris Atas: Welcome (Tombol Logout Dihapus) -->
        <div class="row align-items-center mb-5">
            <div class="col-12">
                <div class="admin-badge"><i class="fas fa-shield-alt"></i> Admin Panel</div>
                <h1 class="hero-admin-title">Selamat Datang, Admin! 👋</h1>
                <p class="hero-admin-subtitle">Kelola data kampus dan beasiswa dengan mudah di satu tempat.</p>
            </div>
        </div>

        <!-- Baris Bawah: 3 Kartu Statistik Kaca -->
        <div class="row g-4">
            <!-- Card Kampus -->
            <div class="col-md-4">
                <div class="admin-glass-card h-100 d-flex flex-column">
                    <div class="stat-icon-wrapper" style="background: rgba(108, 92, 231, 0.2); color: #A29BFE;">
                        <i class="fas fa-university"></i>
                    </div>
                    <h2 class="text-white fw-bold mb-1">{{ $totalUniversities }}</h2>
                    <p class="text-white-50 mb-4">Total Kampus</p>
                    <a href="{{ route('admin.universities.index') }}" class="btn btn-light w-100 fw-bold mt-auto" style="color: #6C5CE7; border-radius: 12px;">
                        Kelola Kampus <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <!-- Card Beasiswa -->
            <div class="col-md-4">
                <div class="admin-glass-card h-100 d-flex flex-column">
                    <div class="stat-icon-wrapper" style="background: rgba(253, 121, 168, 0.2); color: #FD79A8;">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h2 class="text-white fw-bold mb-1">{{ $totalScholarships }}</h2>
                    <p class="text-white-50 mb-4">Total Beasiswa</p>
                    <a href="{{ route('admin.scholarships.index') }}" class="btn btn-light w-100 fw-bold mt-auto" style="color: #6C5CE7; border-radius: 12px;">
                        Kelola Beasiswa <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <!-- Card User -->
            <div class="col-md-4">
                <div class="admin-glass-card h-100 d-flex flex-column">
                    <div class="stat-icon-wrapper" style="background: rgba(0, 206, 201, 0.2); color: #00CEC9;">
                        <i class="fas fa-users"></i>
                    </div>
                    <h2 class="text-white fw-bold mb-1">{{ $totalUsers }}</h2>
                    <p class="text-white-50 mb-4">Total Pengguna</p>
                    <button class="btn btn-light w-100 fw-bold mt-auto disabled" style="color: #6C5CE7; border-radius: 12px; opacity: 0.7;">
                        Segera Hadir
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AREA TABEL BEASISWA TERBARU -->
<div class="container mb-5">
    <div class="admin-card p-3 p-md-4">
        <div class="d-flex justify-content-between align-items-center mb-4 px-2">
            <h5 class="fw-bold mb-0" style="color: #2D1B69;"><i class="fas fa-list-ul me-2"></i> Beasiswa Terbaru</h5>
            <a href="{{ route('admin.scholarships.index') }}" class="text-decoration-none fw-bold" style="color: #6C5CE7;">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>Judul Beasiswa</th>
                        <th>Kampus</th>
                        <th>Jenis</th>
                        <th>Deadline</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentScholarships as $scholarship)
                    <tr>
                        <td><strong style="color: #2D1B69;">{{ Str::limit($scholarship->title, 40) }}</strong></td>
                        <td>
                            <i class="fas fa-university text-muted me-1"></i> 
                            {{ $scholarship->university->name }}
                        </td>
                        <td>
                            <span class="badge-type {{ $scholarship->type == 'full' ? 'badge-full' : 'badge-partial' }}">
                                {{ $scholarship->type == 'full' ? 'Penuh' : 'Parsial' }}
                            </span>
                        </td>
                        <td>
                            <i class="far fa-calendar-alt text-danger me-1"></i>
                            {{ \Carbon\Carbon::parse($scholarship->deadline)->format('d M Y') }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.scholarships.edit', $scholarship->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Empty" style="width: 60px; opacity: 0.5; margin-bottom: 1rem;">
                            <h6 class="text-muted">Belum ada beasiswa yang ditambahkan</h6>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection