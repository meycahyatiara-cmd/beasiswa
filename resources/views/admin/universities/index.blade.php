@extends('layouts.app')

@section('title', 'Kelola Kampus - Admin')

@section('content')
<style>
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
    }
    .hero-admin-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(45, 27, 105, 0.95) 0%, rgba(108, 92, 231, 0.85) 50%, rgba(162, 155, 254, 0.75) 100%);
        z-index: 1;
    }
    .breadcrumb-admin a { color: rgba(255, 255, 255, 0.7); text-decoration: none; font-size: 0.9rem; }
    .breadcrumb-admin a:hover { color: white; }
    .breadcrumb-admin .active { color: white; font-size: 0.9rem; }
    .admin-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: linear-gradient(135deg, #FD79A8, #FDCB6E);
        padding: 0.5rem 1.2rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; color: white; text-transform: uppercase;
    }
    .hero-admin-title { font-family: 'Playfair Display', serif; font-weight: 900; font-size: 3.5rem; color: white; margin-top: 1rem; margin-bottom: 0.5rem; }
    .hero-admin-subtitle { color: rgba(255, 255, 255, 0.85); font-size: 1.05rem; font-weight: 300; }
    .admin-glass-card {
        background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px; padding: 1.8rem; box-shadow: 0 15px 50px rgba(0,0,0,0.2);
    }
    .admin-card {
        border-radius: 24px; border: 1px solid rgba(108, 92, 231, 0.08); box-shadow: 0 15px 50px rgba(108, 92, 231, 0.08);
        overflow: hidden; background: white; position: relative; z-index: 2; margin-top: -40px;
    }
    .table-custom th { background: #FAF8FF; color: #2D1B69; font-weight: 700; font-size: 0.8rem; border-bottom: 2px solid rgba(108, 92, 231, 0.1); padding: 1.2rem 1rem; }
    .table-custom td { padding: 1.2rem 1rem; vertical-align: middle; color: #6C5B7B; border-bottom: 1px solid #f0edf5; }
    .table-custom tbody tr:hover { background-color: #F8F0FF; }
    .btn-action { width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; border: none; transition: 0.3s; }
    .btn-edit { background: #FFF5E6; color: #F39C12; }
    .btn-edit:hover { background: #F39C12; color: white; transform: translateY(-2px); }
    .btn-delete { background: #FFE8EC; color: #e74c3c; }
    .btn-delete:hover { background: #e74c3c; color: white; transform: translateY(-2px); }
    .pagination { justify-content: center; margin-top: 2rem; gap: 5px; }
    .page-link { border-radius: 8px !important; border: none; color: #6C5CE7; font-weight: 600; padding: 10px 15px; }
    .page-item.active .page-link { background: linear-gradient(135deg, #6C5CE7 0%, #A29BFE 100%); color: white; }
</style>

<div class="hero-admin">
    <div class="hero-admin-bg"></div>
    <div class="hero-admin-overlay"></div>
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb breadcrumb-admin m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                </nav>
                <div class="admin-badge"><i class="fas fa-university"></i> Manajemen Kampus</div>
                <h1 class="hero-admin-title">Kelola Data Kampus</h1>
                <p class="hero-admin-subtitle">Tambah, edit, dan hapus daftar kampus di sini.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <div class="admin-glass-card text-start">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(255,255,255,0.2);">
                            <i class="fas fa-building text-white fs-5"></i>
                        </div>
                        <div>
                            <div class="text-white-50" style="font-size: 0.8rem;">Total Kampus</div>
                            <h3 class="text-white mb-0 fw-bold">{{ $universities->total() }}</h3>
                        </div>
                    </div>
                    <a href="{{ route('admin.universities.create') }}" class="btn btn-light w-100 fw-bold" style="color: #6C5CE7; border-radius: 12px; padding: 0.8rem;">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Kampus
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        <th>Logo</th>
                        <th>Nama Kampus</th>
                        <th>Singkatan</th>
                        <th>Website</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($universities as $index => $item)
                    <tr>
                        <td>{{ $universities->firstItem() + $index }}</td>
                        <td>
                            @if($item->logo)
                                <img src="{{ asset('images/' . $item->logo) }}" alt="Logo" style="width: 40px; height: 40px; object-fit: contain;">
                            @else
                                <i class="fas fa-university fs-4 text-muted"></i>
                            @endif
                        </td>
                        <td><strong style="color: #2D1B69;">{{ $item->name }}</strong></td>
                        <td><span class="badge bg-light text-dark border">{{ $item->acronym }}</span></td>
                        <td>
                            @if($item->website)
                                <a href="{{ $item->website }}" target="_blank" class="text-decoration-none">Kunjungi <i class="fas fa-external-link-alt ms-1" style="font-size: 0.7rem;"></i></a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.universities.edit', $item->id) }}" class="btn-action btn-edit me-1">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.universities.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-action btn-delete btn-confirm-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5"><h5 class="text-muted">Belum ada data kampus</h5></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">{{ $universities->links('pagination::bootstrap-5') }}</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-confirm-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); 
                const form = this.closest('.form-delete'); 
                Swal.fire({
                    title: 'Hapus Kampus?',
                    text: "Data kampus ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74c3c',
                    cancelButtonColor: '#6C5B7B',
                    confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    borderRadius: '20px'
                }).then((result) => {
                    if (result.isConfirmed) form.submit(); 
                });
            });
        });
    });
</script>
@endsection