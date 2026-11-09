@extends('layouts.app')

@section('title', 'Preview CV Beasiswa')

@section('content')
<div class="container" style="padding-top: 120px; padding-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('cv.create') }}" class="btn btn-outline-secondary rounded-pill">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
                <button onclick="window.print()" class="btn-gradient">
                    <i class="fas fa-print me-2"></i> Cetak / Simpan PDF
                </button>
            </div>

            <!-- Kertas CV -->
            <div class="card shadow-lg" style="border-radius: 10px; border: none; background: white;" id="cv-paper">
                <div class="card-body p-5">
                    <!-- Header -->
                    <div class="text-center border-bottom pb-4 mb-4">
                        <h1 class="mb-1" style="font-family: 'Playfair Display', serif; font-weight: 800; color: #2D1B69;">{{ $data['nama'] }}</h1>
                        <p class="text-muted mb-2">{{ $data['pendidikan'] }}</p>
                        <div class="d-flex justify-content-center gap-3 text-muted">
                            <span><i class="fas fa-envelope me-1"></i> {{ $data['email'] }}</span>
                            <span><i class="fas fa-phone me-1"></i> {{ $data['telepon'] }}</span>
                            <span><i class="fas fa-map-marker-alt me-1"></i> {{ $data['alamat'] }}</span>
                        </div>
                    </div>

                    <!-- Section Pengalaman -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #6C5CE7; border-bottom: 2px solid #6C5CE7; padding-bottom: 5px; display: inline-block;">PENGALAMAN & PRESTASI</h5>
                        <p style="line-height: 1.8; text-align: justify;">{{ $data['pengalaman'] }}</p>
                    </div>

                    <!-- Section Tambahan (Opsional) -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #6C5CE7; border-bottom: 2px solid #6C5CE7; padding-bottom: 5px; display: inline-block;">KEAHLIAN</h5>
                        <ul style="line-height: 1.8;">
                            <li>Microsoft Office (Word, Excel, PowerPoint)</li>
                            <li>Public Speaking & Leadership</li>
                            <li>Manajemen Waktu yang Baik</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS Khusus untuk Print -->
<style>
    @media print {
        body { background: white !important; }
        #navbar, footer, .btn, .d-flex.justify-content-between { display: none !important; }
        .container { padding-top: 0 !important; width: 100% !important; max-width: 100% !important; }
        .card { box-shadow: none !important; border: none !important; }
        .card-body { padding: 0 !important; }
        #cv-paper { margin: 0; }
    }
</style>
@endsection