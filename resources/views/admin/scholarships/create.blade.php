@extends('layouts.app')

@section('title', 'Tambah Beasiswa - Admin')

@section('content')
<style>
    /* Header Form */
    .form-header-admin {
        background: linear-gradient(135deg, #2D1B69 0%, #6C5CE7 100%);
        padding: 130px 0 60px;
        color: white;
        margin-bottom: 2rem;
    }

    .form-header-admin h1 {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    /* Card Form Melayang */
    .form-card {
        background: white;
        border-radius: 24px;
        border: 1px solid rgba(108, 92, 231, 0.08);
        box-shadow: 0 15px 50px rgba(108, 92, 231, 0.08);
        padding: 2.5rem;
        margin-top: -80px; /* Menarik card ke atas menimpa header */
        position: relative;
        z-index: 2;
        margin-bottom: 5rem;
    }

    /* Styling Input Form */
    .form-label {
        font-weight: 600;
        color: #2D1B69;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        background-color: #FAF8FF;
        border: 2px solid #E8F0FE;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-size: 0.95rem;
        color: #4A3B72;
        transition: all 0.3s;
    }

    .form-control:focus, .form-select:focus {
        background-color: white;
        border-color: #6C5CE7;
        box-shadow: 0 0 0 4px rgba(108, 92, 231, 0.15);
    }

    .form-control::placeholder {
        color: #A29BFE;
    }

    /* Tombol Aksi */
    .btn-save {
        background: linear-gradient(135deg, #6C5CE7 0%, #A29BFE 100%);
        color: white;
        border: none;
        padding: 0.8rem 2.5rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s;
        box-shadow: 0 10px 25px rgba(108, 92, 231, 0.3);
    }

    .btn-save:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(108, 92, 231, 0.4);
        color: white;
    }

    .btn-cancel {
        background: #FAF8FF;
        color: #6C5B7B;
        border: 2px solid #E8F0FE;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cancel:hover {
        background: #FFE8EC;
        color: #e74c3c;
        border-color: #FFE8EC;
    }
</style>

<!-- Header -->
<div class="form-header-admin">
    <div class="container">
        <a href="{{ route('admin.scholarships.index') }}" class="text-white text-decoration-none mb-3 d-inline-block" style="opacity: 0.8;">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
        </a>
        <h1>Tambah Beasiswa Baru</h1>
        <p class="mb-0" style="opacity: 0.8; font-weight: 300;">Lengkapi form di bawah ini untuk menambahkan data beasiswa terbaru.</p>
    </div>
</div>

<div class="container">
    <div class="form-card">
        <form action="{{ route('admin.scholarships.store') }}" method="POST">
            @csrf
            
            <h5 class="mb-4" style="color: #6C5CE7; border-bottom: 2px solid #F0E8FF; padding-bottom: 1rem;">
                <i class="fas fa-info-circle me-2"></i> Informasi Utama
            </h5>

            <div class="row">
                <!-- Kampus -->
                <div class="col-md-6 mb-4">
                    <label class="form-label">Pilih Kampus</label>
                    <select name="university_id" class="form-select" required>
                        <option value="" disabled selected>-- Pilih Kampus --</option>
                        @foreach($universities as $univ)
                            <option value="{{ $univ->id }}" {{ old('university_id') == $univ->id ? 'selected' : '' }}>
                                {{ $univ->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('university_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Judul Beasiswa -->
                <div class="col-md-6 mb-4">
                    <label class="form-label">Judul Beasiswa</label>
                    <input type="text" name="title" class="form-control" placeholder="Cth: Beasiswa Unggulan 2026" value="{{ old('title') }}" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Jenis Beasiswa -->
                <div class="col-md-4 mb-4">
                    <label class="form-label">Jenis Beasiswa</label>
                    <select name="type" class="form-select" required>
                        <option value="full" {{ old('type') == 'full' ? 'selected' : '' }}>Beasiswa Penuh (Full)</option>
                        <option value="partial" {{ old('type') == 'partial' ? 'selected' : '' }}>Beasiswa Parsial (Partial)</option>
                    </select>
                    @error('type') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Jenjang -->
                <div class="col-md-4 mb-4">
                    <label class="form-label">Jenjang</label>
                    <select name="level" class="form-select" required>
                        <option value="" disabled selected>-- Pilih --</option>
                        @foreach(['D3', 'S1', 'S2', 'S3'] as $lvl)
                            <option value="{{ $lvl }}" {{ old('level') == $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                        @endforeach
                    </select>
                    @error('level') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Deadline -->
                <div class="col-md-4 mb-4">
                    <label class="form-label">Batas Pendaftaran (Deadline)</label>
                    <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}" required>
                    @error('deadline') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <h5 class="mb-4 mt-3" style="color: #6C5CE7; border-bottom: 2px solid #F0E8FF; padding-bottom: 1rem;">
                <i class="fas fa-list-ul me-2"></i> Detail Persyaratan & Deskripsi
            </h5>

            <div class="row">
                <!-- Bidang Studi -->
                <div class="col-md-8 mb-4">
                    <label class="form-label">Bidang Studi</label>
                    <input type="text" name="field_of_study" class="form-control" placeholder="Cth: Semua Jurusan / Teknik Informatika" value="{{ old('field_of_study') }}" required>
                    @error('field_of_study') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Kuota -->
                <div class="col-md-4 mb-4">
                    <label class="form-label">Kuota Penerima</label>
                    <input type="number" name="quota" class="form-control" placeholder="Cth: 50" value="{{ old('quota') }}" required>
                    @error('quota') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Persyaratan -->
                <div class="col-12 mb-4">
                    <label class="form-label">Persyaratan Utama</label>
                    <textarea name="requirements" class="form-control" rows="3" placeholder="Cth: IPK minimal 3.5, Mahasiswa semester 4 ke atas, dll..." required>{{ old('requirements') }}</textarea>
                    @error('requirements') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Deskripsi -->
                <div class="col-12 mb-4">
                    <label class="form-label">Deskripsi Lengkap Beasiswa</label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Jelaskan secara detail mengenai beasiswa ini..." required>{{ old('description') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top">
                <a href="{{ route('admin.scholarships.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save me-2"></i> Simpan Beasiswa
                </button>
            </div>

        </form>
    </div>
</div>
@endsection