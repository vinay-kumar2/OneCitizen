@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h3 fw-bold text-dark mb-0" style="color: #0c2340 !important;">Welcome back, {{ Auth::user()->name ?? 'Administrator' }}!</h1>
        <p class="text-muted small mt-1 mb-0">Here is your portal overview for today.</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2 shadow-sm">
            <button type="button" class="btn btn-sm btn-white border"><i class="bi bi-download me-1"></i> Export</button>
            <button type="button" class="btn btn-sm btn-white border"><i class="bi bi-printer me-1"></i> Print</button>
        </div>
        <a href="{{ route('citizens.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1 shadow-sm" style="background-color: #0c2340; border-color: #0c2340;">
            <i class="bi bi-plus-circle"></i> Register Citizen
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <!-- Card 1: Total Citizens -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-4 border-primary">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase small fw-bold mb-1" style="letter-spacing: 0.5px;">Total Citizens</p>
                        <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalCitizens) }}</h2>
                    </div>
                    <div class="p-3 bg-primary bg-opacity-10 rounded-3 text-primary">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('citizens.index') }}" class="text-primary small fw-medium text-decoration-none">
                        View all citizens <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Active Pension Schemes -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-4 border-success">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase small fw-bold mb-1" style="letter-spacing: 0.5px;">Active Schemes</p>
                        <h2 class="mb-0 fw-bold text-dark">{{ number_format($activeSchemes) }}</h2>
                    </div>
                    <div class="p-3 bg-success bg-opacity-10 rounded-3 text-success">
                        <i class="bi bi-piggy-bank fs-3"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('pension-schemes.index') }}" class="text-success small fw-medium text-decoration-none">
                        Manage schemes <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Total Assignments -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-4 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase small fw-bold mb-1" style="letter-spacing: 0.5px;">Total Assignments</p>
                        <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalAssignments) }}</h2>
                    </div>
                    <div class="p-3 bg-info bg-opacity-10 rounded-3 text-info">
                        <i class="bi bi-link-45deg fs-3"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('citizen-pensions.index') }}" class="text-info small fw-medium text-decoration-none">
                        View assignments <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4: Duplicate Records -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-4 {{ $duplicateRecords > 0 ? 'border-danger' : 'border-success' }}">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase small fw-bold mb-1" style="letter-spacing: 0.5px;">Duplicate Records</p>
                        <h2 class="mb-0 fw-bold text-dark">{{ number_format($duplicateRecords) }}</h2>
                    </div>
                    <div class="p-3 bg-danger bg-opacity-10 rounded-3 text-danger">
                        <i class="bi bi-intersect fs-3"></i>
                    </div>
                </div>
                <div class="mt-3">
                    @if($duplicateRecords > 0)
                        <a href="{{ route('duplicate-detection.index') }}" class="text-danger small fw-medium text-decoration-none">
                            Review duplicates <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    @else
                        <span class="text-success small fw-medium">
                            <i class="bi bi-check-circle me-1"></i> No duplicates found
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Sections -->
<div class="row g-4">
    <!-- Left Column: Recent Activities -->
    <div class="col-lg-8">
        <div class="card h-100 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-white py-3 border-bottom">
                <h6 class="m-0 fw-bold text-dark">Recent Registered Citizens</h6>
                <a href="{{ route('citizens.index') }}" class="btn btn-sm fw-medium text-decoration-none" style="color: #0c2340; border: 1px solid #0c2340;">View All</a>
            </div>
            <div class="card-body p-0">
                @if($recentCitizens->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-muted small">
                                <tr>
                                    <th class="ps-4 py-3">Name</th>
                                    <th class="py-3">Aadhaar</th>
                                    <th class="py-3">State</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3 pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentCitizens as $citizen)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <span class="fw-medium text-dark">{{ $citizen->full_name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-muted small">xxxx-xxxx-{{ substr($citizen->aadhaar_number, -4) }}</td>
                                    <td class="text-muted">{{ $citizen->state }}</td>
                                    <td>
                                        @if($citizen->pension_status == 'Active' || $citizen->pension_status == 'Eligible')
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2 py-1">{{ $citizen->pension_status }}</span>
                                        @elseif($citizen->pension_status == 'Pending')
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-2 py-1">Pending</span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-2 py-1">{{ $citizen->pension_status }}</span>
                                        @endif
                                    </td>
                                    <td class="pe-4">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('citizens.edit', $citizen->id) }}" class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-people text-muted opacity-25" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">No citizens registered yet.</p>
                        <a href="{{ route('citizens.create') }}" class="btn btn-sm btn-primary" style="background-color: #0c2340; border-color: #0c2340;">
                            <i class="bi bi-plus-circle me-1"></i> Register First Citizen
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right Column: Info & Actions -->
    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="m-0 fw-bold text-dark">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="{{ route('citizens.create') }}" class="btn btn-light border text-start d-flex justify-content-between align-items-center px-3 py-3 rounded-3 shadow-sm transition text-decoration-none">
                        <span class="fw-medium text-dark"><i class="bi bi-person-plus me-2 text-primary"></i> Register Citizen</span>
                        <i class="bi bi-chevron-right small text-muted"></i>
                    </a>
                    <a href="{{ route('pension-schemes.create') }}" class="btn btn-light border text-start d-flex justify-content-between align-items-center px-3 py-3 rounded-3 shadow-sm transition text-decoration-none">
                        <span class="fw-medium text-dark"><i class="bi bi-plus-circle me-2 text-success"></i> Create Scheme</span>
                        <i class="bi bi-chevron-right small text-muted"></i>
                    </a>
                    <a href="{{ route('citizen-pensions.create') }}" class="btn btn-light border text-start d-flex justify-content-between align-items-center px-3 py-3 rounded-3 shadow-sm transition text-decoration-none">
                        <span class="fw-medium text-dark"><i class="bi bi-link-45deg me-2 text-info"></i> Assign Pension</span>
                        <i class="bi bi-chevron-right small text-muted"></i>
                    </a>
                    <a href="{{ route('duplicate-detection.index') }}" class="btn btn-light border text-start d-flex justify-content-between align-items-center px-3 py-3 rounded-3 shadow-sm transition text-decoration-none">
                        <span class="fw-medium text-dark"><i class="bi bi-shield-exclamation me-2 text-danger"></i> Check Duplicates</span>
                        @if($duplicateRecords > 0)
                            <span class="badge bg-danger rounded-pill px-2">{{ $duplicateRecords }}</span>
                        @else
                            <i class="bi bi-chevron-right small text-muted"></i>
                        @endif
                    </a>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="m-0 fw-bold text-dark">System Status</h6>
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="small fw-bold text-dark"><i class="bi bi-people text-muted me-2"></i> Citizens Database</span>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2 py-1"><i class="bi bi-check-circle me-1"></i> {{ $totalCitizens }} Records</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="small fw-bold text-dark"><i class="bi bi-piggy-bank text-muted me-2"></i> Active Schemes</span>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2 py-1"><i class="bi bi-check-circle me-1"></i> {{ $activeSchemes }} Active</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small fw-bold text-dark"><i class="bi bi-link-45deg text-muted me-2"></i> Assignments</span>
                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-2 py-1">{{ $totalAssignments }} Total</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection