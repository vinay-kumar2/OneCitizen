@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 fw-bold text-dark" style="color: #0c2340 !important;">Reports & Analytics</h1>
    <div class="btn-toolbar mb-2 mb-md-0 gap-2">
        <button type="button" class="btn btn-sm btn-outline-danger shadow-sm d-flex align-items-center gap-1">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </button>
        <button type="button" class="btn btn-sm btn-outline-success shadow-sm d-flex align-items-center gap-1">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </button>
    </div>
</div>

<!-- Filters Section -->
<div class="card shadow-sm border-0 mb-4 bg-light">
    <div class="card-body p-3">
        <form class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="stateFilter" class="form-label small fw-bold text-dark mb-1">State</label>
                <select id="stateFilter" class="form-select form-select-sm border-secondary border-opacity-25">
                    <option selected>All States</option>
                    <option>Maharashtra</option>
                    <option>Karnataka</option>
                    <option>Delhi</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="pensionStatusFilter" class="form-label small fw-bold text-dark mb-1">Pension Status</label>
                <select id="pensionStatusFilter" class="form-select form-select-sm border-secondary border-opacity-25">
                    <option selected>All Statuses</option>
                    <option>Active</option>
                    <option>Pending</option>
                    <option>Suspended</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="duplicateStatusFilter" class="form-label small fw-bold text-dark mb-1">Duplicate Status</label>
                <select id="duplicateStatusFilter" class="form-select form-select-sm border-secondary border-opacity-25">
                    <option selected>All Statuses</option>
                    <option>Pending Review</option>
                    <option>Resolved</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-sm btn-secondary w-100 d-flex align-items-center justify-content-center gap-1 shadow-sm">
                    <i class="bi bi-funnel"></i> Apply Filters
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Summary Analytics -->
<h6 class="fw-bold text-muted text-uppercase small mb-3" style="letter-spacing: 0.5px;">Portal Overview</h6>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
    <div class="col">
        <div class="card shadow-sm border-0 h-100 border-start border-4 border-primary">
            <div class="card-body">
                <h6 class="text-muted fw-semibold small mb-1">Total Citizens</h6>
                <h2 class="fw-bold text-dark mb-0">{{ number_format($totalCitizens) }}</h2>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm border-0 h-100 border-start border-4 border-success">
            <div class="card-body">
                <h6 class="text-muted fw-semibold small mb-1">Total Pension Schemes</h6>
                <h2 class="fw-bold text-dark mb-0">{{ number_format($totalSchemes) }}</h2>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm border-0 h-100 border-start border-4 border-info">
            <div class="card-body">
                <h6 class="text-muted fw-semibold small mb-1">Total Assignments</h6>
                <h2 class="fw-bold text-dark mb-0">{{ number_format($totalAssignments) }}</h2>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm border-0 h-100 border-start border-4 border-danger">
            <div class="card-body">
                <h6 class="text-muted fw-semibold small mb-1">Total Duplicate Records</h6>
                <h2 class="fw-bold text-dark mb-0">{{ number_format($totalDuplicates) }}</h2>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Analytics -->
<h6 class="fw-bold text-muted text-uppercase small mb-3 mt-4" style="letter-spacing: 0.5px;">Key Metrics</h6>
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card bg-white shadow-sm border-0 p-3 text-center h-100">
            <h6 class="text-muted small fw-bold mb-2">Active Citizens</h6>
            <h3 class="fw-bold text-primary mb-0">{{ number_format($activeCitizens) }}</h3>
            <span class="small text-success mt-1"><i class="bi bi-person-check-fill"></i> Enrolled in active pensions</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-white shadow-sm border-0 p-3 text-center h-100">
            <h6 class="text-muted small fw-bold mb-2">Detection Rate</h6>
            <h3 class="fw-bold text-danger mb-0">{{ $duplicateRate }}%</h3>
            <span class="small text-muted mt-1">Of total registered citizens</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-white shadow-sm border-0 p-3 text-center h-100">
            <h6 class="text-muted small fw-bold mb-2">Pending Verifications</h6>
            <h3 class="fw-bold text-warning mb-0">{{ number_format($pendingVerifications) }}</h3>
            <span class="small text-muted mt-1">Require clerk approval</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-white shadow-sm border-0 p-3 text-center h-100">
            <h6 class="text-muted small fw-bold mb-2">Active Schemes</h6>
            <h3 class="fw-bold text-success mb-0">{{ number_format($activeSchemes) }}</h3>
            <span class="small text-muted mt-1">Currently disbursing funds</span>
        </div>
    </div>
</div>

<!-- Recent Duplicate Records Table -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="m-0 fw-bold text-dark">Recent Duplicate Records</h6>
        <a href="{{ route('duplicate-detection.index') }}" class="btn btn-sm btn-light border small text-muted">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted small">
                    <tr>
                        <th class="ps-4 py-3">Citizen Name</th>
                        <th class="py-3">Aadhaar Number</th>
                        <th class="py-3">Detection Reason</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 pe-4">Detection Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentDuplicates as $log)
                    <tr>
                        <td class="ps-4 py-3 fw-bold text-dark">{{ $log->citizen->full_name }}</td>
                        <td class="text-muted">xxxx-xxxx-{{ substr($log->citizen->aadhaar_number, -4) }}</td>
                        <td class="text-muted small" style="max-width: 250px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">{{ $log->detection_reason }}</td>
                        <td>
                            @if($log->status == 'Resolved')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2 py-1">Resolved</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-2 py-1">{{ $log->status }}</span>
                            @endif
                        </td>
                        <td class="pe-4 text-muted small">{{ $log->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="bi bi-shield-check text-success opacity-50 fs-4"></i>
                            <p class="mb-0 mt-1 small">No recent duplicate records found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
