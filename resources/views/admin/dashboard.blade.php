@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    .admin-header {
        background: linear-gradient(135deg, #6C5CE7 0%, #A29BFE 100%);
        padding: 30px 0;
        margin-top: 60px;
        color: white;
    }
    .stat-card {
        transition: transform 0.3s;
        cursor: default;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
</style>

<div class="admin-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold mb-0">👋 Selamat Datang, Admin!</h1>
                <p class="mb-0 opacity-75">Kelola data kampus dan beasiswa dengan mudah</p>
            </div>
            <div>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light rounded-pill px-4">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card stat-card shadow-sm border-0 rounded-4">
                <div class="card-body text-center p-4">
                    <div style="font-size: 3rem; color: #6C5CE7;">🏛️</div>
                    <h3 class="fw-bold mt-2">{{ $totalUniversities }}</h3>
                    <p class="text-muted mb-0">Total Kampus</p>
                    <a href="{{ route('admin.universities.index') }}" class="btn btn-sm btn-primary rounded-pill mt-3 px-4">Kelola</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card shadow-sm border-0 rounded-4">
                <div class="card-body text-center p-4">
                    <div style="font-size: 3rem; color: #FD79A8;">🎓</div>
                    <h3 class="fw-bold mt-2">{{ $totalScholarships }}</h3>
                    <p class="text-muted mb-0">Total Beasiswa</p>
                    <a href="{{ route('admin.scholarships.index') }}" class="btn btn-sm btn-primary rounded-pill mt-3 px-4">Kelola</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card shadow-sm border-0 rounded-4">
                <div class="card-body text-center p-4">
                    <div style="font-size: 3rem; color: #00CEC9;">👤</div>
                    <h3 class="fw-bold mt-2">{{ $totalUsers }}</h3>
                    <p class="text-muted mb-0">Total User</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Scholarships -->
    <div class="card shadow-sm border-0 rounded-4 mt-4">
        <div class="card-header bg-transparent border-0 pt-4">
            <h5 class="fw-bold">📋 Beasiswa Terbaru</h5>
        </div>
        <div class="card-body">
            @if($recentScholarships->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kampus</th>
                            <th>Jenis</th>
                            <th>Deadline</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentScholarships as $scholarship)
                        <tr>
                            <td>{{ $scholarship->title }}</td>
                            <td>{{ $scholarship->university->name }}</td>
                            <td><span class="badge {{ $scholarship->type == 'full' ? 'bg-success' : 'bg-warning' }}">{{ $scholarship->type == 'full' ? 'Penuh' : 'Parsial' }}</span></td>
                            <td>{{ $scholarship->deadline->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.scholarships.edit', $scholarship->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted text-center py-3">Belum ada beasiswa</p>
            @endif
        </div>
    </div>
</div>
@endsection