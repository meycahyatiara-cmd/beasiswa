@extends('layouts.app')

@section('title', $scholarship->title)

@section('content')
<section class="py-5" style="margin-top: 76px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #667eea; text-decoration: none;">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('scholarships.index') }}" style="color: #667eea; text-decoration: none;">Semua Beasiswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Illuminate\Support\Str::limit($scholarship->title, 30) }}</li>
                    </ol>
                </nav>

                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <!-- Card Header -->
                    <div style="background: var(--gradient-primary); padding: 2rem 2rem 1.5rem; color: white;">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div>
                                <span class="badge {{ $scholarship->type == 'full' ? 'badge-full' : 'badge-partial' }}" style="font-size: 0.9rem; padding: 0.5rem 1.5rem;">
                                    <i class="fas {{ $scholarship->type == 'full' ? 'fa-crown' : 'fa-gift' }} me-2"></i>
                                    {{ $scholarship->type == 'full' ? 'Beasiswa Penuh' : 'Beasiswa Parsial' }}
                                </span>
                                <span class="badge bg-light text-dark ms-2" style="font-size: 0.9rem; padding: 0.5rem 1.5rem;">
                                    <i class="fas fa-graduation-cap me-1"></i> {{ $scholarship->level }}
                                </span>
                            </div>
                            <span style="background: rgba(255,255,255,0.2); padding: 0.5rem 1.5rem; border-radius: 50px; font-size: 0.9rem; backdrop-filter: blur(10px);">
                                <i class="far fa-calendar-alt me-2"></i> {{ $scholarship->deadline->format('d F Y') }}
                            </span>
                        </div>
                        <h2 class="mt-3 mb-0" style="font-weight: 800; font-size: 2rem;">{{ $scholarship->title }}</h2>
                        <p style="opacity: 0.9; margin-top: 0.5rem;">
                            <i class="fas fa-university me-2"></i> {{ $scholarship->university->name }}
                        </p>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 style="font-weight: 700; color: #2d3436;">
                                <i class="fas fa-info-circle me-2" style="color: #667eea;"></i> Deskripsi
                            </h5>
                            <p style="color: #636e72; line-height: 1.8; text-align: justify;">{{ $scholarship->description }}</p>
                        </div>

                        <div class="row g-4">
                            @if($scholarship->field_of_study)
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #f8f9fa;">
                                    <h6 style="font-weight: 700; color: #2d3436;">
                                        <i class="fas fa-graduation-cap me-2" style="color: #667eea;"></i> Bidang Studi
                                    </h6>
                                    <p style="color: #636e72; margin: 0;">{{ $scholarship->field_of_study }}</p>
                                </div>
                            </div>
                            @endif

                            @if($scholarship->quota)
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #f8f9fa;">
                                    <h6 style="font-weight: 700; color: #2d3436;">
                                        <i class="fas fa-users me-2" style="color: #667eea;"></i> Kuota
                                    </h6>
                                    <p style="color: #636e72; margin: 0;">{{ $scholarship->quota }} orang</p>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #f8f9fa;">
                                    <h6 style="font-weight: 700; color: #2d3436;">
                                        <i class="fas fa-layer-group me-2" style="color: #667eea;"></i> Jenjang
                                    </h6>
                                    <p style="color: #636e72; margin: 0;">{{ $scholarship->level }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #f8f9fa;">
                                    <h6 style="font-weight: 700; color: #2d3436;">
                                        <i class="far fa-calendar-alt me-2" style="color: #667eea;"></i> Deadline
                                    </h6>
                                    <p style="color: #e74c3c; margin: 0; font-weight: 600;">
                                        {{ $scholarship->deadline->format('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($scholarship->requirements)
                        <div class="mt-4">
                            <h5 style="font-weight: 700; color: #2d3436;">
                                <i class="fas fa-check-circle me-2" style="color: #667eea;"></i> Persyaratan
                            </h5>
                            <div class="p-3 rounded-3" style="background: #f8f9fa; border-left: 4px solid #667eea;">
                                <p style="color: #636e72; margin: 0;">{{ $scholarship->requirements }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="mt-4 pt-3 border-top">
                            <div class="row g-3">
                                @if($scholarship->link)
                                <div class="col-md-6">
                                    <a href="{{ $scholarship->link }}" target="_blank" class="btn-gradient w-100" style="text-align: center;">
                                        <i class="fas fa-external-link-alt me-2"></i> Daftar Sekarang
                                    </a>
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <a href="{{ route('scholarships.index') }}" class="btn-outline-gradient w-100" style="text-align: center;">
                                        <i class="fas fa-arrow-left me-2"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 pt-3 border-top">
                            <p style="font-size: 0.9rem; color: #6c757d; margin-bottom: 0.5rem;">
                                <i class="fas fa-share-alt me-2"></i> Bagikan:
                            </p>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="https://wa.me/?text={{ urlencode($scholarship->title . ' - ' . route('scholarship.show', $scholarship->id)) }}" target="_blank" class="btn btn-sm btn-success" style="border-radius: 50px;">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($scholarship->title) }}&url={{ urlencode(route('scholarship.show', $scholarship->id)) }}" target="_blank" class="btn btn-sm btn-info" style="border-radius: 50px; color: white;">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('scholarship.show', $scholarship->id)) }}" target="_blank" class="btn btn-sm btn-primary" style="border-radius: 50px;">
                                    <i class="fab fa-facebook"></i> Facebook
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $otherScholarships = App\Models\Scholarship::where('university_id', $scholarship->university_id)
                        ->where('id', '!=', $scholarship->id)
                        ->where('is_active', true)
                        ->where('deadline', '>=', now())
                        ->take(3)
                        ->get();
                @endphp

                @if($otherScholarships->count() > 0)
                <div class="mt-5">
                    <h5 style="font-weight: 700; color: #2d3436;">
                        <i class="fas fa-lightbulb me-2" style="color: #667eea;"></i> Beasiswa Lainnya dari {{ $scholarship->university->name }}
                    </h5>
                    <div class="row g-3 mt-2">
                        @foreach($otherScholarships as $other)
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-3 h-100" onclick="location.href='{{ route('scholarship.show', $other->id) }}'" style="cursor: pointer; transition: all 0.3s;">
                                <div class="card-body p-3">
                                    <span class="badge {{ $other->type == 'full' ? 'badge-full' : 'badge-partial' }}" style="font-size: 0.65rem;">
                                        {{ $other->type == 'full' ? 'Penuh' : 'Parsial' }}
                                    </span>
                                    <h6 class="mt-2" style="font-weight: 600; font-size: 0.95rem;">{{ $other->title }}</h6>
                                    <p class="text-muted small">{{ $other->deadline->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
    .badge-full {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
        padding: 0.3rem 1.2rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-partial {
        background: linear-gradient(135deg, #f093fb, #f5576c);
        color: white;
        padding: 0.3rem 1.2rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-gradient {
        background: var(--gradient-primary);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-outline-gradient {
        background: transparent;
        color: #667eea;
        border: 2px solid #667eea;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-outline-gradient:hover {
        background: var(--gradient-primary);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    @media (max-width: 768px) {
        .card-header {
            padding: 1.5rem !important;
        }
        .card-header h2 {
            font-size: 1.5rem !important;
        }
        .row.g-3 .col-md-6 {
            margin-bottom: 0.5rem;
        }
    }
</style>
@endsection