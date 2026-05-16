@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 fw-bold text-dark" style="color: #0c2340 !important;">Pension Schemes Management</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('pension-schemes.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1 shadow-sm" style="background-color: #0c2340; border-color: #0c2340;">
            <i class="bi bi-plus-circle"></i> Add Scheme
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
            <h6 class="m-0 fw-bold text-dark">Active Pension Schemes</h6>
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                {{ $schemes->total() }} Total Schemes
            </span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted small">
                    <tr>
                        <th class="ps-4 py-3">Scheme Name</th>
                        <th class="py-3">Scheme Code</th>
                        <th class="py-3">Type</th>
                        <th class="py-3">Provider</th>
                        <th class="py-3">Monthly Benefit</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schemes as $scheme)
                    <tr>
                        <td class="ps-4 py-3 fw-medium text-dark">{{ $scheme->scheme_name }}</td>
                        <td class="text-muted"><span class="badge bg-light text-dark border">{{ $scheme->scheme_code }}</span></td>
                        <td class="text-muted">{{ $scheme->scheme_type }}</td>
                        <td class="text-muted">{{ $scheme->provider_type }}</td>
                        <td class="fw-bold text-dark">₹{{ number_format($scheme->monthly_benefit, 2) }}</td>
                        <td>
                            @if($scheme->status == 'Active')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2">Active</span>
                            @elseif($scheme->status == 'Draft')
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-3 py-2">Draft</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2">Inactive</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('pension-schemes.edit', $scheme->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('pension-schemes.destroy', $scheme->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this scheme?');">
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
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 text-light"></i>
                            <p class="mt-2 mb-0">No pension schemes available.</p>
                            <a href="{{ route('pension-schemes.create') }}" class="btn btn-sm btn-primary mt-3" style="background-color: #0c2340; border-color: #0c2340;">
                                <i class="bi bi-plus-circle me-1"></i> Add First Scheme
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($schemes->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $schemes->links() }}
    </div>
    @endif
</div>
@endsection