@extends('layouts.app')

@section('title', 'Edit Kampus - Admin')

@section('content')
<style>
    /* Gunakan CSS yang sama persis dengan create.blade.php */
    .form-header-admin { background: linear-gradient(135deg, #2D1B69 0%, #6C5CE7 100%); padding: 130px 0 60px; color: white; margin-bottom: 2rem; }
    .form-header-admin h1 { font-family: 'Playfair Display', serif; font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem; }
    .form-card { background: white; border-radius: 24px; border: 1px solid rgba(108, 92, 231, 0.08); box-shadow: 0 15px 50px rgba(108, 92, 231, 0.08); padding: 2.5rem; margin-top: -80px; position: relative; z-index: 2; margin-bottom: 5rem; }
    .form-label { font-weight: 600; color: #2D1B69; font-size: 0.9rem; margin-bottom: 0.5rem; }
    .form-control { background-color: #FAF8FF; border: 2px solid #E8F0FE; border-radius: 12px; padding: 0.8rem 1rem; font-size: 0.95rem; color: #4A3B72; }
    .form-control:focus { background-color: white; border-color: #6C5CE7; box-shadow: 0 0 0 4px rgba(108, 92, 231, 0.15); }
    .btn-save { background: linear-gradient(135deg, #6C5CE7 0%, #A29BFE 100%); color: white; border: none; padding: 0.8rem 2.5rem; border-radius: 50px; font-weight: 700; transition: 0.3s; }
    .btn-save:hover { transform: translateY(-3px); color: white; box-shadow: 0 10px 25px rgba(108, 92, 231, 0.4); }
    .btn-cancel { background: #FAF8FF; color: #6C5B7B; border: 2px solid #E8F0FE; padding: 0.8rem 2rem; border-radius: 50px; font-weight: 600; text-decoration: none; transition: 0.3s; }
    .btn-cancel:hover { background: #FFE8EC; color: #e74c3c; border-color: #FFE8EC; }
</style>

<div class="form-header-admin">
    <div class="container">
        <a href="{{ route('admin.universities.index') }}" class="text-white text-decoration-none mb-3 d-inline-block" style="opacity: 0.8;">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
        </a>
        <h1>Edit Kampus</h1>
        <p class="mb-0" style="opacity: 0.8; font-weight: 300;">Perbarui informasi untuk: <strong>{{ $university->name }}</strong></p>
    </div>
</div>

<div class="container">
    <div class="form-card">
        <form action="{{ route('admin.universities.update', $university->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8 mb-4">
                    <label class="form-label">Nama Lengkap Kampus</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $university->name) }}" required>
                </div>
                <div class="col-md-4 mb-4">
                    <label class="form-label">Singkatan (Akronim)</label>
                    <input type="text" name="acronym" class="form-control" value="{{ old('acronym', $university->acronym) }}" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">Nama File Logo (Opsional)</label>
                    <input type="text" name="logo" class="form-control" value="{{ old('logo', $university->logo) }}">
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">Website Resmi (Opsional)</label>
                    <input type="url" name="website" class="form-control" value="{{ old('website', $university->website) }}">
                </div>
                <div class="col-12 mb-4">
                    <label class="form-label">Deskripsi Singkat (Opsional)</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $university->description) }}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top">
                <a href="{{ route('admin.universities.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection