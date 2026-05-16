@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 fw-bold text-dark" style="color: #0c2340 !important;">Assign Pension Scheme</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('citizen-pensions.index') }}" class="btn btn-sm btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="m-0 fw-bold text-dark">Assignment Details</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('citizen-pensions.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="citizen_id" class="form-label small fw-bold text-dark">Select Citizen <span class="text-danger">*</span></label>
                            <select class="form-select bg-light @error('citizen_id') is-invalid @enderror" id="citizen_id" name="citizen_id" required>
                                <option value="" selected disabled>Select a registered citizen</option>
                                @foreach($citizens as $citizen)
                                    <option value="{{ $citizen->id }}" {{ old('citizen_id') == $citizen->id ? 'selected' : '' }}>
                                        {{ $citizen->full_name }} ({{ substr($citizen->aadhaar_number, -4) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('citizen_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="pension_scheme_id" class="form-label small fw-bold text-dark">Select Pension Scheme <span class="text-danger">*</span></label>
                            <select class="form-select bg-light @error('pension_scheme_id') is-invalid @enderror" id="pension_scheme_id" name="pension_scheme_id" required>
                                <option value="" selected disabled>Select an active scheme</option>
                                @foreach($schemes as $scheme)
                                    <option value="{{ $scheme->id }}" {{ old('pension_scheme_id') == $scheme->id ? 'selected' : '' }}>
                                        {{ $scheme->scheme_name }} ({{ $scheme->scheme_code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pension_scheme_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="enrollment_number" class="form-label small fw-bold text-dark">Enrollment Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light @error('enrollment_number') is-invalid @enderror" id="enrollment_number" name="enrollment_number" value="{{ old('enrollment_number') }}" required placeholder="e.g. ENR-2026-XXXX">
                            @error('enrollment_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="pension_status" class="form-label small fw-bold text-dark">Status <span class="text-danger">*</span></label>
                            <select class="form-select bg-light @error('pension_status') is-invalid @enderror" id="pension_status" name="pension_status" required>
                                <option value="" selected disabled>Select Status</option>
                                <option value="Active" {{ old('pension_status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Pending" {{ old('pension_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Suspended" {{ old('pension_status') == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                                <option value="Terminated" {{ old('pension_status') == 'Terminated' ? 'selected' : '' }}>Terminated</option>
                            </select>
                            @error('pension_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="enrollment_date" class="form-label small fw-bold text-dark">Enrollment Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control bg-light @error('enrollment_date') is-invalid @enderror" id="enrollment_date" name="enrollment_date" value="{{ old('enrollment_date') }}" required>
                            @error('enrollment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="pension_start_date" class="form-label small fw-bold text-dark">Pension Start Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control bg-light @error('pension_start_date') is-invalid @enderror" id="pension_start_date" name="pension_start_date" value="{{ old('pension_start_date') }}" required>
                            @error('pension_start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <label for="remarks" class="form-label small fw-bold text-dark">Remarks</label>
                            <textarea class="form-control bg-light @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3" placeholder="Any additional notes...">{{ old('remarks') }}</textarea>
                            @error('remarks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <button type="reset" class="btn btn-light border fw-medium">Reset</button>
                        <button type="submit" class="btn btn-primary px-4 fw-medium shadow-sm" style="background-color: #0c2340; border-color: #0c2340;">
                            <i class="bi bi-save me-1"></i> Save Assignment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 border-top border-4 border-primary">
            <div class="card-body p-4">
                <h6 class="fw-bold text-dark mb-3">Assignment Rules</h6>
                <ul class="small text-muted ps-3 mb-0 lh-lg">
                    <li><strong>Enrollment Number</strong> must be unique to avoid conflicting payment requests.</li>
                    <li>Only <strong>Active</strong> pension schemes are available in the dropdown.</li>
                    <li>Fields marked with <span class="text-danger">*</span> are mandatory for successful mapping.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
