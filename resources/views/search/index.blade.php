@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 fw-bold text-dark" style="color: #0c2340 !important;">Search Portal</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        @if($query)
            <span class="text-muted small">Showing results for: <strong class="text-dark">"{{ $query }}"</strong></span>
        @endif
    </div>
</div>

<div class="row justify-content-center mb-4">
    <div class="col-lg-8">
        <form action="{{ route('search.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="q" class="form-control form-control-lg" placeholder="Search citizens, pension schemes, or enrollment numbers..." value="{{ $query ?? '' }}" required>
            <button type="submit" class="btn btn-primary px-4" style="background-color: #0c2340; border-color: #0c2340;">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
</div>

@if($query && $results)
    @if($totalResults > 0)
        <div class="alert alert-info bg-info bg-opacity-10 border-0 mb-4">
            <i class="bi bi-info-circle-fill me-2"></i> Found <strong>{{ $totalResults }}</strong> results for "<strong>{{ $query }}</strong>"
        </div>
    @endif

    <div class="row g-4">
        <!-- Citizens Results -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-dark"><i class="bi bi-people me-2"></i> Citizens ({{ $results['citizens']->count() }})</h6>
                    <a href="{{ route('citizens.index') }}" class="btn btn-sm btn-link text-decoration-none">View All</a>
                </div>
                <div class="card-body p-0">
                    @if($results['citizens']->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($results['citizens'] as $citizen)
                                <a href="{{ route('citizens.edit', $citizen->id) }}" class="list-group-item list-group-item-action p-3 text-decoration-none">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1 fw-bold text-dark">{{ $citizen->full_name }}</h6>
                                        <small class="text-muted">{{ $citizen->mobile_number }}</small>
                                    </div>
                                    <p class="mb-1 text-muted small">Aadhaar: xxxx-xxxx-{{ substr($citizen->aadhaar_number, -4) }}</p>
                                    <span class="badge bg-light text-dark border">{{ $citizen->state }}</span>
                                    @if($citizen->pension_status == 'Active')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2">Active</span>
                                    @elseif($citizen->pension_status == 'Pending')
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-2">Pending</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-2">{{ $citizen->pension_status }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-people text-muted opacity-25" style="font-size: 2.5rem;"></i>
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
                    <h6 class="m-0 fw-bold text-dark"><i class="bi bi-piggy-bank me-2"></i> Pension Schemes ({{ $results['schemes']->count() }})</h6>
                    <a href="{{ route('pension-schemes.index') }}" class="btn btn-sm btn-link text-decoration-none">View All</a>
                </div>
                <div class="card-body p-0">
                    @if($results['schemes']->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($results['schemes'] as $scheme)
                                <a href="{{ route('pension-schemes.edit', $scheme->id) }}" class="list-group-item list-group-item-action p-3 text-decoration-none">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1 fw-bold text-dark">{{ $scheme->scheme_name }}</h6>
                                        <small class="fw-bold text-primary">₹{{ number_format($scheme->monthly_benefit, 2) }}</small>
                                    </div>
                                    <p class="mb-1 text-muted small">Code: <strong>{{ $scheme->scheme_code }}</strong> | Provider: {{ $scheme->provider_type }}</p>
                                    @if($scheme->status == 'Active')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2">Active</span>
                                    @elseif($scheme->status == 'Draft')
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-2">Draft</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-2">Inactive</span>
                                    @endif
                                </a>
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

        <!-- Assignments Results -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-dark"><i class="bi bi-link-45deg me-2"></i> Pension Assignments ({{ $results['assignments']->count() }})</h6>
                    <a href="{{ route('citizen-pensions.index') }}" class="btn btn-sm btn-link text-decoration-none">View All</a>
                </div>
                <div class="card-body p-0">
                    @if($results['assignments']->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($results['assignments'] as $assignment)
                                <a href="{{ route('citizen-pensions.edit', $assignment->id) }}" class="list-group-item list-group-item-action p-3 text-decoration-none">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1 fw-bold text-dark">{{ $assignment->citizen->full_name ?? 'N/A' }}</h6>
                                        <small class="fw-bold text-primary">{{ $assignment->enrollment_number }}</small>
                                    </div>
                                    <p class="mb-1 text-muted small">{{ $assignment->pensionScheme->scheme_name ?? 'N/A' }} | Start: {{ \Carbon\Carbon::parse($assignment->pension_start_date)->format('d M Y') }}</p>
                                    @if($assignment->pension_status == 'Active')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2">Active</span>
                                    @elseif($assignment->pension_status == 'Pending')
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-2">Pending</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-2">{{ $assignment->pension_status }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-link-45deg text-muted opacity-25" style="font-size: 2.5rem;"></i>
                            <p class="text-muted mt-3 mb-0 fw-medium">No assignments matched your search.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@elseif($query && $totalResults === 0)
    <div class="card shadow-sm border-0">
        <div class="card-body text-center py-5">
            <i class="bi bi-search text-muted opacity-25" style="font-size: 4rem;"></i>
            <h5 class="mt-4 text-dark">No Results Found</h5>
            <p class="text-muted">We couldn't find anything matching "<strong>{{ $query }}</strong>".</p>
            <p class="text-muted small">Try checking for typos or using different keywords.</p>
        </div>
    </div>
@else
    <div class="card shadow-sm border-0">
        <div class="card-body text-center py-5">
            <i class="bi bi-search text-muted opacity-25" style="font-size: 4rem;"></i>
            <h5 class="mt-4 text-dark">Search the Portal</h5>
            <p class="text-muted">Enter a search term to find citizens, pension schemes, or assignments.</p>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8">
                    <div class="row g-3 text-start">
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3">
                                <i class="bi bi-people text-primary fs-4"></i>
                                <h6 class="mt-2 mb-1">Citizens</h6>
                                <p class="small text-muted mb-0">Search by name, Aadhaar, or mobile</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3">
                                <i class="bi bi-piggy-bank text-success fs-4"></i>
                                <h6 class="mt-2 mb-1">Schemes</h6>
                                <p class="small text-muted mb-0">Find pension schemes by name or code</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3">
                                <i class="bi bi-link-45deg text-warning fs-4"></i>
                                <h6 class="mt-2 mb-1">Assignments</h6>
                                <p class="small text-muted mb-0">Search by enrollment number</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection