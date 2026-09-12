@extends('layouts.app')

@section('title', 'Tambah Kampus')

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
        <h1 class="fw-bold mb-0">➕ Tambah Kampus</h1>
        <p class="mb-0 opacity-75">Isi form berikut untuk menambahkan kampus baru</p>
    </div>
</div>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.universities.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Kampus <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Universitas Indonesia" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Akronim <span class="text-danger">*</span></label>
                                <input type="text" name="acronym" class="form-control @error('acronym') is-invalid @enderror" placeholder="Contoh: UI" value="{{ old('acronym') }}" required maxlength="10">
                                @error('acronym')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Rank</label>
                                <input type="number" name="rank" class="form-control @error('rank') is-invalid @enderror" placeholder="Contoh: 1" value="{{ old('rank', 0) }}">
                                @error('rank')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Warna</label>
                                <div class="d-flex gap-2">
                                    <input type="color" name="color" class="form-control form-control-color @error('color') is-invalid @enderror" value="{{ old('color', '#6C5CE7') }}" style="width: 60px; padding: 5px;">
                                    <input type="text" name="color_text" class="form-control" value="{{ old('color', '#6C5CE7') }}" id="colorText" style="flex: 1;">
                                </div>
                                @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Website</label>
                                <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" placeholder="https://ui.ac.id" value="{{ old('website') }}">
                                @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Deskripsi singkat tentang kampus">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                            <a href="{{ route('admin.universities.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('input[name="color"]').addEventListener('input', function() {
        document.getElementById('colorText').value = this.value;
    });
    document.getElementById('colorText').addEventListener('input', function() {
        document.querySelector('input[name="color"]').value = this.value;
    });
</script>
@endsection