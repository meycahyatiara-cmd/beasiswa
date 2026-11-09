@extends('layouts.app')

@section('title', 'Buat CV Beasiswa')

@section('content')
<div class="container" style="padding-top: 120px; padding-bottom: 50px; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg" style="border-radius: 20px; border: none;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="section-title">Buat <span class="highlight">CV Profesional</span></h2>
                        <p class="section-subtitle">Isi data diri kamu di bawah ini untuk membuat CV beasiswa.</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('cv.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">No. Telepon</label>
                                <input type="text" name="telepon" class="form-control" placeholder="0812xxxx" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan" class="form-control" placeholder="Contoh: S1 Teknik Informatika - Universitas Indonesia" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label font-weight-bold">Pengalaman / Organisasi</label>
                            <textarea name="pengalaman" class="form-control" rows="4" placeholder="Ceritakan pengalaman organisasi, magang, atau prestasi kamu..."></textarea>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn-gradient w-100" style="padding: 15px;">
                                <i class="fas fa-magic me-2"></i> Buat CV Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection