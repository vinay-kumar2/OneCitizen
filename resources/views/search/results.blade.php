@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 fw-bold text-dark" style="color: #0c2340 !important;">Search Results</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <span class="text-muted small">Showing results for: <strong class="text-dark">"{{ $query }}"</strong></span>
    </div>
</div>

@if(session('error'))
    <div class="alert alert-danger shadow-sm border-0 alert-dismissible fade show">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4 mb-4">
    <!-- Citizens Results -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-dark"><i class="bi bi-people me-2"></i> Citizens Found ({{ $citizens->count() }})</h6>
            </div>
            <div class="card-body p-0">
                @if($citizens->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($citizens as $citizen)
                            <div class="list-group-item list-group-item-action p-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 fw-bold text-dark">{{ $citizen->full_name }}</h6>
                                    <small class="text-muted">{{ $citizen->mobile_number }}</small>
                                </div>
                                <p class="mb-1 text-muted small">Aadhaar: xxxx-xxxx-{{ substr($citizen->aadhaar_number, -4) }}</p>
                                <span class="badge bg-light text-dark border">{{ $citizen->state }}</span>
                                @if($citizen->pension_status == 'Active')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2">Active</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-2">{{ $citizen->pension_status }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-search text-muted opacity-25" style="font-size: 2.5rem;"></i>
                        <p class="text-muted mt-3 mb-0 fw-medium">No citizens matched your search.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Schemes Results -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-dark"><i class="bi bi-piggy-bank me-2"></i> Pension Schemes Found ({{ $schemes->count() }})</h6>
            </div>
            <div class="card-body p-0">
                @if($schemes->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($schemes as $scheme)
                            <div class="list-group-item list-group-item-action p-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 fw-bold text-dark">{{ $scheme->scheme_name }}</h6>
                                    <small class="fw-bold text-primary">₹{{ number_format($scheme->monthly_benefit, 2) }}</small>
                                </div>
                                <p class="mb-1 text-muted small">Code: <strong>{{ $scheme->scheme_code }}</strong> | Provider: {{ $scheme->provider_type }}</p>
                                @if($scheme->status == 'Active')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2">Active</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-2">{{ $scheme->status }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-piggy-bank text-muted opacity-25" style="font-size: 2.5rem;"></i>
                        <p class="text-muted mt-3 mb-0 fw-medium">No pension schemes matched your search.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
