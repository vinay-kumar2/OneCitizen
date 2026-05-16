@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 fw-bold text-dark" style="color: #0c2340 !important;">Create Pension Scheme</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('pension-schemes.index') }}" class="btn btn-sm btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="m-0 fw-bold text-dark">Scheme Details</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('pension-schemes.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-8">
                            <label for="scheme_name" class="form-label small fw-bold text-dark">Scheme Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light @error('scheme_name') is-invalid @enderror" id="scheme_name" name="scheme_name" value="{{ old('scheme_name') }}" required>
                            @error('scheme_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="scheme_code" class="form-label small fw-bold text-dark">Scheme Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light @error('scheme_code') is-invalid @enderror" id="scheme_code" name="scheme_code" value="{{ old('scheme_code') }}" required placeholder="e.g. OAP-2026">
                            @error('scheme_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="scheme_type" class="form-label small fw-bold text-dark">Scheme Type <span class="text-danger">*</span></label>
                            <select class="form-select bg-light @error('scheme_type') is-invalid @enderror" id="scheme_type" name="scheme_type" required>
                                <option value="" selected disabled>Select Type</option>
                                <option value="Old Age Pension" {{ old('scheme_type') == 'Old Age Pension' ? 'selected' : '' }}>Old Age Pension</option>
                                <option value="Widow Pension" {{ old('scheme_type') == 'Widow Pension' ? 'selected' : '' }}>Widow Pension</option>
                                <option value="Disability Pension" {{ old('scheme_type') == 'Disability Pension' ? 'selected' : '' }}>Disability Pension</option>
                                <option value="Special Allowance" {{ old('scheme_type') == 'Special Allowance' ? 'selected' : '' }}>Special Allowance</option>
                            </select>
                            @error('scheme_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="provider_type" class="form-label small fw-bold text-dark">Provider Type <span class="text-danger">*</span></label>
                            <select class="form-select bg-light @error('provider_type') is-invalid @enderror" id="provider_type" name="provider_type" required>
                                <option value="" selected disabled>Select Provider</option>
                                <option value="Central Government" {{ old('provider_type') == 'Central Government' ? 'selected' : '' }}>Central Government</option>
                                <option value="State Government" {{ old('provider_type') == 'State Government' ? 'selected' : '' }}>State Government</option>
                                <option value="Joint Funding" {{ old('provider_type') == 'Joint Funding' ? 'selected' : '' }}>Joint Funding</option>
                            </select>
                            @error('provider_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="monthly_benefit" class="form-label small fw-bold text-dark">Monthly Benefit Amount (₹) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">₹</span>
                                <input type="number" step="0.01" min="0" class="form-control bg-light border-start-0 ps-0 @error('monthly_benefit') is-invalid @enderror" id="monthly_benefit" name="monthly_benefit" value="{{ old('monthly_benefit') }}" required>
                                @error('monthly_benefit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label small fw-bold text-dark">Status <span class="text-danger">*</span></label>
                            <select class="form-select bg-light @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="" selected disabled>Select Status</option>
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <label for="eligibility_criteria" class="form-label small fw-bold text-dark">Eligibility Criteria</label>
                            <textarea class="form-control bg-light @error('eligibility_criteria') is-invalid @enderror" id="eligibility_criteria" name="eligibility_criteria" rows="4" placeholder="Enter specific requirements (e.g., Age > 60, BPL Category)">{{ old('eligibility_criteria') }}</textarea>
                            @error('eligibility_criteria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <button type="reset" class="btn btn-light border fw-medium">Reset</button>
                        <button type="submit" class="btn btn-primary px-4 fw-medium shadow-sm" style="background-color: #0c2340; border-color: #0c2340;">
                            <i class="bi bi-save me-1"></i> Save Scheme
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 border-top border-4 border-primary">
            <div class="card-body p-4">
                <h6 class="fw-bold text-dark mb-3">System Rules</h6>
                <ul class="small text-muted ps-3 mb-0 lh-lg">
                    <li><strong>Scheme Code</strong> must be completely unique across the entire portal.</li>
                    <li>Fields marked with <span class="text-danger">*</span> are strictly mandatory.</li>
                    <li>Setting a scheme to <strong>Active</strong> will make it immediately available for citizen mapping.</li>
                    <li>You can save as <strong>Draft</strong> if eligibility details are not finalized.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
