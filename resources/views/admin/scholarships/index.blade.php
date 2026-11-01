@extends('layouts.app')

@section('title', 'Kelola Beasiswa - Admin')

@section('content')
<style>
    /* ===== HERO ADMIN STYLE ===== */
    .hero-admin {
        position: relative;
        padding: 160px 0 80px; /* Padding atas lebih besar agar tidak tertutup navbar */
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

    .breadcrumb-admin a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s;
    }
    
    .breadcrumb-admin a:hover {
        color: white;
    }

    .breadcrumb-admin .active {
        color: white;
        font-size: 0.9rem;
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

    /* Glassmorphism Card di Kanan */
    .admin-glass-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 1.8rem;
        box-shadow: 0 15px 50px rgba(0,0,0,0.2);
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
        margin-top: -40px; /* Trik agar tabel naik sedikit ke area hero */
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

    .badge-level {
        background: linear-gradient(135deg, #F8F0FF, #E8F0FE);
        color: #6C5CE7;
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.75rem;
        border: 1px solid rgba(108, 92, 231, 0.15);
    }

    .btn-action {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.3s;
        border: none;
    }

    .btn-edit { background: #FFF5E6; color: #F39C12; }
    .btn-edit:hover { background: #F39C12; color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3); }

    .btn-delete { background: #FFE8EC; color: #e74c3c; }
    .btn-delete:hover { background: #e74c3c; color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3); }

    /* Pagination Rapi */
    .pagination { justify-content: center; margin-top: 2rem; gap: 5px; }
    .page-link { border-radius: 8px !important; border: none; color: #6C5CE7; font-weight: 600; padding: 10px 15px; }
    .page-item.active .page-link { background: linear-gradient(135deg, #6C5CE7 0%, #A29BFE 100%); color: white; box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3); }
    .page-link:hover { background: #F8F0FF; color: #2D1B69; }
    .pagination svg { width: 15px !important; height: 15px !important; }
</style>

<!-- HERO ADMIN (Mirip Halaman Detail) -->
<div class="hero-admin">
    <div class="hero-admin-bg"></div>
    <div class="hero-admin-overlay"></div>
    
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb breadcrumb-admin m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('scholarships.index') }}">Semua Beasiswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Admin</li>
                    </ol>
                </nav>
                
                <div class="admin-badge">
                    <i class="fas fa-shield-alt"></i> Admin Panel
                </div>
                
                <h1 class="hero-admin-title">Kelola Data Beasiswa</h1>
                <p class="hero-admin-subtitle">Tambah, edit, dan hapus informasi beasiswa dengan mudah.</p>
            </div>
            
            <!-- Card Kanan -->
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <div class="admin-glass-card text-start">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(255,255,255,0.2);">
                            <i class="fas fa-database text-white fs-5"></i>
                        </div>
                        <div>
                            <div class="text-white-50" style="font-size: 0.8rem;">Total Beasiswa</div>
                            <h3 class="text-white mb-0 fw-bold">{{ $scholarships->total() }}</h3>
                        </div>
                    </div>
                    <a href="{{ route('admin.scholarships.create') }}" class="btn btn-light w-100 fw-bold" style="color: #6C5CE7; border-radius: 12px; padding: 0.8rem;">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AREA TABEL -->
<div class="container mb-5">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm" style="border-radius: 15px; background: linear-gradient(135deg, #00B894, #00CEC9); color: white;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card p-3 p-md-4">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Kampus</th>
                        <th>Judul Beasiswa</th>
                        <th>Jenjang</th>
                        <th>Deadline</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($scholarships as $index => $item)
                    <tr>
                        <td>{{ $scholarships->firstItem() + $index }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-university text-muted"></i>
                                <strong style="color: #2D1B69;">{{ $item->university->name }}</strong>
                            </div>
                        </td>
                        <td>{{ Str::limit($item->title, 45) }}</td>
                        <td><span class="badge-level">{{ $item->level }}</span></td>
                        <td><i class="far fa-calendar-alt me-1 text-danger"></i> {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.scholarships.edit', $item->id) }}" class="btn-action btn-edit me-1" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <!-- Form Hapus dengan Class form-delete -->
                            <form action="{{ route('admin.scholarships.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-action btn-delete btn-confirm-delete" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <h5 class="text-muted">Belum ada data beasiswa</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $scholarships->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- Script SweetAlert2 untuk Pop-up Hapus -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-confirm-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); 
                const form = this.closest('.form-delete'); 

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data beasiswa ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74c3c',
                    cancelButtonColor: '#6C5B7B',
                    confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#ffffff',
                    borderRadius: '20px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); 
                    }
                });
            });
        });
    });
</script>
@endsection