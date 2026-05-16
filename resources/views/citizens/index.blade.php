@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 fw-bold text-dark" style="color: #0c2340 !important;">Citizens Management</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('citizens.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1 shadow-sm" style="background-color: #0c2340; border-color: #0c2340;">
            <i class="bi bi-plus-circle"></i> Add Citizen
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold text-dark">Citizens Directory</h6>
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                {{ $citizens->total() }} Total Records
            </span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted small">
                    <tr>
                        <th class="ps-4 py-3">Name</th>
                        <th class="py-3">Aadhaar Number</th>
                        <th class="py-3">Mobile</th>
                        <th class="py-3">State</th>
                        <th class="py-3">Pension Status</th>
                        <th class="py-3 text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($citizens as $citizen)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                    {{ strtoupper(substr($citizen->full_name, 0, 1)) }}
                                </div>
                                <span class="fw-medium text-dark">{{ $citizen->full_name }}</span>
                            </div>
                        </td>
                        <td class="text-muted fw-medium">xxxx-xxxx-{{ substr($citizen->aadhaar_number, -4) }}</td>
                        <td class="text-muted">{{ $citizen->mobile_number }}</td>
                        <td class="text-muted">{{ $citizen->state }}</td>
                        <td>
                            @if($citizen->pension_status == 'Eligible' || $citizen->pension_status == 'Active')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2">{{ $citizen->pension_status }}</span>
                            @elseif($citizen->pension_status == 'Pending')
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3 py-2">{{ $citizen->pension_status }}</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2">{{ $citizen->pension_status }}</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('citizens.edit', $citizen->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('citizens.destroy', $citizen->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this citizen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 text-light"></i>
                            <p class="mt-2 mb-0">No citizens registered yet.</p>
                            <a href="{{ route('citizens.create') }}" class="btn btn-sm btn-primary mt-3" style="background-color: #0c2340; border-color: #0c2340;">
                                <i class="bi bi-plus-circle me-1"></i> Add First Citizen
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($citizens->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $citizens->links() }}
    </div>
    @endif
</div>
@endsection