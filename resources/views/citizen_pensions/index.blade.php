@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 fw-bold text-dark" style="color: #0c2340 !important;">Pension Assignments</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('citizen-pensions.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1 shadow-sm" style="background-color: #0c2340; border-color: #0c2340;">
            <i class="bi bi-plus-circle"></i> Assign Pension
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
            <h6 class="m-0 fw-bold text-dark">Citizen Pension Records</h6>
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                {{ $assignments->total() }} Total Assignments
            </span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted small">
                    <tr>
                        <th class="ps-4 py-3">Citizen Name</th>
                        <th class="py-3">Aadhaar Number</th>
                        <th class="py-3">Pension Scheme</th>
                        <th class="py-3">Enrollment No.</th>
                        <th class="py-3">Start Date</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assignments as $assignment)
                    <tr>
                        <td class="ps-4 py-3 fw-medium text-dark">{{ $assignment->citizen->full_name }}</td>
                        <td class="text-muted">xxxx-xxxx-{{ substr($assignment->citizen->aadhaar_number, -4) }}</td>
                        <td class="text-muted">{{ $assignment->pensionScheme->scheme_name }}</td>
                        <td class="text-muted fw-bold">{{ $assignment->enrollment_number }}</td>
                        <td class="text-muted">{{ \Carbon\Carbon::parse($assignment->pension_start_date)->format('d M Y') }}</td>
                        <td>
                            @if($assignment->pension_status == 'Active')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2">Active</span>
                            @elseif($assignment->pension_status == 'Pending')
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3 py-2">Pending</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2">{{ $assignment->pension_status }}</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('citizen-pensions.edit', $assignment->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('citizen-pensions.destroy', $assignment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this assignment?');">
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
                            <p class="mt-2 mb-0">No pension assignments created yet.</p>
                            <a href="{{ route('citizen-pensions.create') }}" class="btn btn-sm btn-primary mt-3" style="background-color: #0c2340; border-color: #0c2340;">
                                <i class="bi bi-plus-circle me-1"></i> Create First Assignment
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($assignments->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $assignments->links() }}
    </div>
    @endif
</div>
@endsection