@extends('layouts.app')

@section('title', 'Edit Beasiswa')

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
        <h1 class="fw-bold mb-0">✏️ Edit Beasiswa</h1>
        <p class="mb-0 opacity-75">Edit data beasiswa: {{ $scholarship->title }}</p>
    </div>
</div>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.scholarships.update', $scholarship->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kampus <span class="text-danger">*</span></label>
                            <select name="university_id" class="form-select @error('university_id') is-invalid @enderror" required>
                                <option value="">Pilih Kampus</option>
                                @foreach($universities as $uni)
                                <option value="{{ $uni->id }}" {{ old('university_id', $scholarship->university_id) == $uni->id ? 'selected' : '' }}>{{ $uni->name }}</option>
                                @endforeach
                            </select>
                            @error('university_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Beasiswa <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $scholarship->title) }}" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $scholarship->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jenis <span class="text-danger">*</span></label>
                                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="full" {{ old('type', $scholarship->type) == 'full' ? 'selected' : '' }}>Beasiswa Penuh</option>
                                    <option value="partial" {{ old('type', $scholarship->type) == 'partial' ? 'selected' : '' }}>Beasiswa Parsial</option>
                                </select>
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Level <span class="text-danger">*</span></label>
                                <select name="level" class="form-select @error('level') is-invalid @enderror" required>
                                    <option value="S1" {{ old('level', $scholarship->level) == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('level', $scholarship->level) == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('level', $scholarship->level) == 'S3' ? 'selected' : '' }}>S3</option>
                                    <option value="D3" {{ old('level', $scholarship->level) == 'D3' ? 'selected' : '' }}>D3</option>
                                </select>
                                @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Deadline <span class="text-danger">*</span></label>
                                <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline', $scholarship->deadline->format('Y-m-d')) }}" required>
                                @error('deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kuota</label>
                                <input type="number" name="quota" class="form-control @error('quota') is-invalid @enderror" value="{{ old('quota', $scholarship->quota) }}">
                                @error('quota')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Bidang Studi</label>
                            <input type="text" name="field_of_study" class="form-control @error('field_of_study') is-invalid @enderror" value="{{ old('field_of_study', $scholarship->field_of_study) }}">
                            @error('field_of_study')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Persyaratan</label>
                            <textarea name="requirements" class="form-control @error('requirements') is-invalid @enderror" rows="3">{{ old('requirements', $scholarship->requirements) }}</textarea>
                            @error('requirements')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Link Pendaftaran</label>
                            <input type="url" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $scholarship->link) }}">
                            @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                            <a href="{{ route('admin.scholarships.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection