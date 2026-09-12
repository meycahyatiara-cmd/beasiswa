@extends('layouts.app')

@section('title', 'Kelola Beasiswa')

@section('content')
<style>
    .admin-header {
        background: linear-gradient(135deg, #6C5CE7 0%, #A29BFE 100%);
        padding: 30px 0;
        margin-top: 60px;
        color: white;
    }
</style>

<div class="admin-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold mb-0">🎓 Kelola Beasiswa</h1>
                <p class="mb-0 opacity-75">Tambah, edit, atau hapus data beasiswa</p>
            </div>
            <a href="{{ route('admin.scholarships.create') }}" class="btn btn-light rounded-pill px-4">
                <i class="fas fa-plus me-2"></i>Tambah Beasiswa
            </a>
        </div>
    </div>
</div>

<div class="container py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kampus</th>
                            <th>Jenis</th>
                            <th>Level</th>
                            <th>Deadline</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scholarships as $index => $scholarship)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $scholarship->title }}</strong></td>
                            <td>{{ $scholarship->university->name }}</td>
                            <td><span class="badge {{ $scholarship->type == 'full' ? 'bg-success' : 'bg-warning' }}">{{ $scholarship->type == 'full' ? 'Penuh' : 'Parsial' }}</span></td>
                            <td><span class="badge bg-info">{{ $scholarship->level }}</span></td>
                            <td>{{ $scholarship->deadline->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.scholarships.edit', $scholarship->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.scholarships.destroy', $scholarship->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus beasiswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection