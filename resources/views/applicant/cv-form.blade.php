@extends('layouts.app')

@section('title', 'Buat CV & Surat Permohonan Beasiswa')

@section('content')
<div class="container py-5" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(135deg, #6C5CE7, #A29BFE); border-radius: 20px 20px 0 0;">
                    <h3 class="mb-0 fw-bold" style="font-family: 'Playfair Display', serif;">Persiapan Beasiswa</h3>
                    <p class="mb-0 text-white-50">Isi data diri untuk membuat CV & Surat Permohonan otomatis</p>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('cv.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="full_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NIM / NIK</label>
                                <input type="text" name="nim" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Universitas / Kampus</label>
                                <input type="text" name="university" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jurusan / Prodi</label>
                                <input type="text" name="major" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Semester</label>
                                <input type="text" name="semester" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">IPK Terakhir</label>
                                <input type="text" name="gpa" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">No. HP / WhatsApp</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Alamat Lengkap</label>
                                <textarea name="address" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Keahlian (Pisahkan dengan koma)</label>
                                <textarea name="skills" class="form-control" rows="2" placeholder="Contoh: Microsoft Office, Desain Grafis, Public Speaking" required></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Pengalaman Organisasi / Kerja</label>
                                <textarea name="experiences" class="form-control" rows="3" placeholder="Contoh: Ketua BEM 2025, Panitia Seminar Nasional..." required></textarea>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="form-label fw-bold">Motivasi & Alasan Mendaftar Beasiswa</label>
                                <textarea name="motivation" class="form-control" rows="4" placeholder="Tuliskan alasan mengapa Anda berhak menerima beasiswa ini..." required></textarea>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 fw-bold" style="background: var(--gradient-primary); border: none;">
                                <i class="fas fa-magic me-2"></i> Generate CV & Surat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection