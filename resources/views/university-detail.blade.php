@extends('layouts.app')

@section('title', $university->name)

@section('content')
<section class="py-5" style="margin-top: 76px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden sticky-top" style="top: 100px;">
                    <div style="background: {{ $university->color ?? '#667eea' }}; padding: 2.5rem 2rem; text-align: center; color: white;">
                        <div style="width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 3rem; font-weight: 800; backdrop-filter: blur(10px); border: 3px solid rgba(255,255,255,0.3);">
                            {{ $university->acronym }}
                        </div>
                        <h4 class="mt-3 mb-0" style="font-weight: 700;">{{ $university->name }}</h4>
                        <p style="opacity: 0.9;">{{ $university->acronym }}</p>
                    </div>
                    <div class="card-body p-4">
                        @if($university->description)
                        <p style="color: #636e72; line-height: 1.6;">{{ $university->description }}</p>
                        <hr>
                        @endif
                        
                        @if($university->website)
                        <a href="{{ $university->website }}" target="_blank" class="btn-gradient w-100" style="text-align: center;">
                            <i class="fas fa-globe me-2"></i> Kunjungi Website
                        </a>
                        @endif
                        
                        <div class="mt-3">
                            <a href="{{ route('scholarships.index', ['search' => $university->name]) }}" class="btn-outline-gradient w-100" style="text-align: center;">
                                <i class="fas fa-search me-2"></i> Cari Beasiswa di Sini
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h4 class="mb-4" style="font-weight: 700; color: #2d3436;">
                    <i class="fas fa-graduation-cap me-2" style="color: #667eea;"></i> 
                    Beasiswa di {{ $university->name }}
                    <span class="badge" style="background: var(--gradient-primary); font-size: 0.8rem; padding: 0.3rem 1rem;">{{ $university->scholarships->count() }} Beasiswa</span>
                </h4>

                @if($university->scholarships->count() > 0)
                <div class="row">
                    @foreach($university->scholarships as $scholarship)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0 rounded-4 h-100" onclick="location.href='{{ route('scholarship.show', $scholarship->id) }}'" style="cursor: pointer; transition: all 0.3s;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge {{ $scholarship->type == 'full' ? 'badge-full' : 'badge-partial' }}" style="font-size: 0.7rem;">
                                        {{ $scholarship->type == 'full' ? 'Penuh' : 'Parsial' }}
                                    </span>
                                    <span class="badge bg-light text-dark" style="font-size: 0.7rem;">
                                        {{ $scholarship->level }}
                                    </span>
                                </div>
                                <h6 style="font-weight: 700; font-size: 1rem; min-height: 3rem;">{{ $scholarship->title }}</h6>
                                <p class="text-muted small" style="min-height: 3rem;">{{ Illuminate\Support\Str::limit($scholarship->description, 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                                    <span class="text-muted small">
                                        <i class="far fa-calendar-alt me-1"></i> {{ $scholarship->deadline->format('d M Y') }}
                                    </span>
                                    <a href="{{ route('scholarship.show', $scholarship->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 50px; border-color: #667eea; color: #667eea;">
                                        Detail <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-5 bg-light rounded-4">
                    <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                    <h5 style="font-weight: 600;">Belum ada beasiswa tersedia</h5>
                    <p class="text-muted">Saat ini belum ada program beasiswa di kampus ini</p>
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

    .sticky-top {
        position: sticky;
        top: 100px;
        z-index: 1;
    }

    @media (max-width: 768px) {
        .sticky-top {
            position: relative;
            top: 0;
        }
    }
</style>
@endsection