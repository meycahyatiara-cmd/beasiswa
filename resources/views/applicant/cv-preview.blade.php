@extends('layouts.app')

@section('title', 'Hasil CV & Surat Permohonan')

@section('content')
<style>
    body {
        background: #f4f7f6;
    }

    .document-wrapper {
        background: white;
        padding: 60px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin: 100px auto 50px;
        max-width: 800px;
        border-radius: 4px;
        color: #333;
        font-family: 'Inter', sans-serif;
    }

    /* ===== DESAIN CV FORMAL ===== */
    .cv-header { 
        text-align: center; 
        border-bottom: 2px solid #333; 
        padding-bottom: 15px; 
        margin-bottom: 30px; 
    }
    
    .cv-name { 
        font-family: 'Playfair Display', serif; 
        font-size: 2.2rem; 
        font-weight: 700; 
        color: #111; 
        margin-bottom: 8px; 
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    
    .cv-contact { 
        font-size: 0.9rem; 
        color: #555; 
    }
    
    .cv-section-title { 
        font-weight: 700; 
        color: #111; 
        text-transform: uppercase; 
        font-size: 0.9rem;
        letter-spacing: 1px;
        margin-top: 25px; 
        margin-bottom: 10px; 
        border-bottom: 1px solid #ccc; 
        padding-bottom: 5px;
    }

    .cv-text {
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 10px;
    }
    
    /* ===== DESAIN SURAT ===== */
    .table-biodata { width: auto; margin-bottom: 1rem; }
    .table-biodata td { padding: 4px 15px 4px 0; vertical-align: top; font-size: 0.95rem;}

    .surat-text {
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* CSS Khusus untuk Print/PDF */
    @media print {
        body { background: white; }
        #navbar, .footer, .btn-print, #ai-chatbox-container { display: none !important; }
        .document-wrapper { box-shadow: none; margin: 0; padding: 0; max-width: 100%; }
        
        /* MEMBUAT NAMA TURUN DARI ATAS KERTAS */
        .cv-header {
            padding-top: 2cm !important; /* Jarak 2 cm dari atas kertas */
        }
        
        .biodata-section { page-break-inside: avoid; }
        
        /* TANGGAL DI HALAMAN 1, DISESUAIKAN AGAR TETAP MUAT */
        .date-section {
            margin-top: 80px !important; /* Dikurangi sedikit karena header sudah turun */
            margin-bottom: 0 !important;
        }

        /* ISI SURAT PINDAH KE HALAMAN 2 & DIBERI JARAK 3CM DARI ATAS */
        .surat-section {
            page-break-before: always;
            padding-top: 3cm; 
        }
    }
</style>

<div class="container">
    <div class="document-wrapper" id="print-area">
        
        <!-- ================= BAGIAN 1: CV FORMAL ================= -->
        <div class="cv-header">
            <div class="cv-name">{{ $profile->full_name }}</div>
            <div class="cv-contact">
                {{ $profile->phone }} | {{ $profile->address }} <br>
                {{ $profile->university }} | {{ $profile->major }} | IPK: {{ $profile->gpa }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="cv-section-title">Profil Singkat</div>
                <p class="cv-text">Mahasiswa aktif {{ $profile->major }} di {{ $profile->university }}, saat ini berada di semester {{ $profile->semester }} dengan IPK {{ $profile->gpa }}. Memiliki semangat belajar yang tinggi dan aktif dalam berbagai kegiatan.</p>

                <div class="cv-section-title">Pengalaman</div>
                <p class="cv-text" style="white-space: pre-line;">{{ $profile->experiences }}</p>

                <div class="cv-section-title">Keahlian</div>
                <p class="cv-text">{{ $profile->skills }}</p>
            </div>
            <div class="col-md-4">
                <div class="cv-section-title">Pendidikan</div>
                <p class="cv-text">
                    <strong>{{ $profile->university }}</strong><br>
                    {{ $profile->major }}<br>
                    Semester {{ $profile->semester }}<br>
                    IPK: {{ $profile->gpa }}
                </p>
            </div>
        </div>

        <!-- ================= BAGIAN TANGGAL (TETAP DI HALAMAN 1) ================= -->
        <div class="text-end date-section">
            <p class="mb-0 cv-text">Jakarta, {{ date('d F Y') }}</p>
        </div>

        <!-- ================= BAGIAN ISI SURAT (PINDAH KE HALAMAN 2) ================= -->
        <div class="surat-section">
            
            <div class="mb-4 surat-text">
                <p class="fw-bold mb-0">Perihal: Surat Permohonan Beasiswa</p>
            </div>
            
            <div class="mb-4 surat-text">
                <p>Kepada Yth,<br>Panitia Penyelenggara Beasiswa<br>Di Tempat</p>
            </div>
            
            <div class="surat-text">
                <p>Dengan hormat,</p>
                <p>Saya yang bertanda tangan di bawah ini:</p>
                
                <div class="biodata-section ms-3 mb-4">
                    <table class="table-biodata">
                        <tr><td>Nama</td><td>: <strong>{{ $profile->full_name }}</strong></td></tr>
                        <tr><td>NIM/NIK</td><td>: {{ $profile->nim }}</td></tr>
                        <tr><td>Kampus</td><td>: {{ $profile->university }}</td></tr>
                    </table>
                </div>

                <p class="mt-3">Bermaksud untuk mengajukan permohonan beasiswa. Adapun motivasi dan alasan saya adalah sebagai berikut:</p>
                <p style="white-space: pre-line; font-style: italic; background: #f8f9fa; padding: 15px; border-left: 3px solid #333;">"{{ $profile->motivation }}"</p>
                <p>Demikian surat permohonan ini saya buat dengan sebenar-benarnya. Besar harapan saya untuk dapat diterima. Atas perhatian Bapak/Ibu, saya ucapkan terima kasih.</p>
            </div>
            
            <div class="mt-5 text-end surat-text">
                <p>Hormat saya,</p>
                <br><br><br>
                <p class="fw-bold text-decoration-underline">{{ $profile->full_name }}</p>
            </div>
        </div>

    </div>

    <!-- Tombol Aksi -->
    <div class="text-center mb-5 btn-print">
        <button onclick="window.print()" class="btn btn-dark rounded-pill px-5 py-3 fw-bold shadow">
            <i class="fas fa-print me-2"></i> Simpan / Cetak PDF
        </button>
        <a href="{{ route('cv.create') }}" class="btn btn-outline-secondary rounded-pill px-4 py-3 ms-2 fw-bold bg-white">
            Buat Baru
        </a>
    </div>
</div>
@endsection