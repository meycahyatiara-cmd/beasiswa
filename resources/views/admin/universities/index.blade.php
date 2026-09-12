@extends('layouts.app')

@section('title', 'Kelola Kampus')

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
                <h1 class="fw-bold mb-0">🏛️ Kelola Kampus</h1>
                <p class="mb-0 opacity-75">Tambah, edit, atau hapus data kampus</p>
            </div>
            <a href="{{ route('admin.universities.create') }}" class="btn btn-light rounded-pill px-4">
                <i class="fas fa-plus me-2"></i>Tambah Kampus
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
                            <th>Logo</th>
                            <th>Nama</th>
                            <th>Akronim</th>
                            <th>Rank</th>
                            <th>Beasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($universities as $index => $uni)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($uni->logo && file_exists(public_path($uni->logo)))
                                <img src="{{ asset($uni->logo) }}" alt="{{ $uni->name }}" style="width: 40px; height: 40px; object-fit: contain; border-radius: 8px; background: white; padding: 4px; border: 1px solid #eee;">
                                @else
                                <div style="width: 40px; height: 40px; background: {{ $uni->color ?? '#6C5CE7' }}; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 12px;">
                                    {{ $uni->acronym }}
                                </div>
                                @endif
                            </td>
                            <td><strong>{{ $uni->name }}</strong></td>
                            <td><span class="badge bg-primary">{{ $uni->acronym }}</span></td>
                            <td>{{ $uni->rank ?? '-' }}</td>
                            <td>{{ $uni->scholarships_count ?? 0 }}</td>
                            <td>
                                <a href="{{ route('admin.universities.edit', $uni->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.universities.destroy', $uni->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kampus ini?')">
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