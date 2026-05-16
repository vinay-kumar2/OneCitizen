@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 fw-bold text-dark" style="color: #0c2340 !important;">Duplicate Pension Detection</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <form action="{{ route('duplicate-detection.scan') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center gap-2 shadow-sm px-3">
                <i class="bi bi-search"></i> Run Duplicate Scan
            </button>
        </form>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
        <i class="bi bi-shield-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-primary bg-opacity-10 border-primary border-opacity-25 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold text-primary"><i class="bi bi-info-circle me-1"></i> How Detection Works</h6>
                <p class="small text-dark mb-0">The automated scan algorithm checks the entire database for citizens enrolled in <strong>multiple active pension schemes simultaneously</strong>. It also flags records where multiple active pensioners are using the <strong>exact same mobile number</strong>. Aadhaar duplication is prevented automatically at the registration level.</p>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h6 class="m-0 fw-bold text-dark">Detected Anomalies / Duplicates</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted small">
                    <tr>
                        <th class="ps-4 py-3">Detection Date</th>
                        <th class="py-3">Citizen Name</th>
                        <th class="py-3">Aadhaar Number</th>
                        <th class="py-3">Detection Type</th>
                        <th class="py-3 w-25">Reason</th>
                        <th class="py-3 pe-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                    <tr>
                        <td class="ps-4 py-3 text-muted small fw-medium">{{ $log->created_at->format('d M Y, h:i A') }}</td>
                        <td class="fw-bold text-dark">{{ $log->citizen->full_name }}</td>
                        <td class="text-muted">xxxx-xxxx-{{ substr($log->citizen->aadhaar_number, -4) }}</td>
                        <td>
                            <span class="badge bg-dark bg-opacity-10 text-dark border border-dark border-opacity-25 rounded-pill px-3 py-1">
                                {{ $log->duplicate_type }}
                            </span>
                        </td>
                        <td class="text-muted small">{{ $log->detection_reason }}</td>
                        <td class="pe-4">
                            @if($log->status == 'Resolved')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2">Resolved</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2">{{ $log->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-shield-check fs-1 text-success opacity-50"></i>
                            <p class="mt-2 mb-0 fw-medium">System is clean. No duplicates detected.</p>
                            <span class="small">Click 'Run Duplicate Scan' to perform a fresh system check.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($logs->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $logs->links() }}
    </div>
    @endif
</div>
@endsection
