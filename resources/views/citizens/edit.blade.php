@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 fw-bold text-dark" style="color: #0c2340 !important;">Edit Citizen</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('citizens.index') }}" class="btn btn-sm btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="m-0 fw-bold text-dark">Citizen Personal Information</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('citizens.update', $citizen->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="full_name" class="form-label small fw-bold text-dark">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $citizen->full_name) }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="aadhaar_number" class="form-label small fw-bold text-dark">Aadhaar Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light @error('aadhaar_number') is-invalid @enderror" id="aadhaar_number" name="aadhaar_number" value="{{ old('aadhaar_number', $citizen->aadhaar_number) }}" required maxlength="12" placeholder="12-digit format">
                            @error('aadhaar_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="mobile_number" class="form-label small fw-bold text-dark">Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $citizen->mobile_number) }}" required>
                            @error('mobile_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label small fw-bold text-dark">Email Address</label>
                            <input type="email" class="form-control bg-light @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $citizen->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="gender" class="form-label small fw-bold text-dark">Gender <span class="text-danger">*</span></label>
                            <select class="form-select bg-light @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                <option value="" disabled>Select Gender</option>
                                <option value="Male" {{ old('gender', $citizen->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $citizen->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $citizen->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label small fw-bold text-dark">Date of Birth</label>
                            <input type="date" class="form-control bg-light @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $citizen->date_of_birth) }}">
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="state" class="form-label small fw-bold text-dark">State <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state', $citizen->state) }}" required>
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="district" class="form-label small fw-bold text-dark">District</label>
                            <input type="text" class="form-control bg-light @error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district', $citizen->district) }}">
                            @error('district')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label small fw-bold text-dark">Full Address</label>
                            <textarea class="form-control bg-light @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $citizen->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="pension_status" class="form-label small fw-bold text-dark">Pension Status <span class="text-danger">*</span></label>
                            <select class="form-select bg-light @error('pension_status') is-invalid @enderror" id="pension_status" name="pension_status" required>
                                <option value="" disabled>Select Status</option>
                                <option value="Pending" {{ old('pension_status', $citizen->pension_status) == 'Pending' ? 'selected' : '' }}>Pending Verification</option>
                                <option value="Eligible" {{ old('pension_status', $citizen->pension_status) == 'Eligible' ? 'selected' : '' }}>Eligible</option>
                                <option value="Not Eligible" {{ old('pension_status', $citizen->pension_status) == 'Not Eligible' ? 'selected' : '' }}>Not Eligible</option>
                                <option value="Active" {{ old('pension_status', $citizen->pension_status) == 'Active' ? 'selected' : '' }}>Active Pensioner</option>
                            </select>
                            @error('pension_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('citizens.index') }}" class="btn btn-light border fw-medium">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 fw-medium shadow-sm" style="background-color: #0c2340; border-color: #0c2340;">
                            <i class="bi bi-save me-1"></i> Update Citizen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0 border-top border-4 border-warning">
            <div class="card-body p-4">
                <h6 class="fw-bold text-dark mb-3">Update Guidelines</h6>
                <ul class="small text-muted ps-3 mb-0 lh-lg">
                    <li>Ensure the Aadhaar Number is exactly 12 digits.</li>
                    <li>Fields marked with <span class="text-danger">*</span> are mandatory.</li>
                    <li>Double-check mobile numbers for SMS notifications.</li>
                    <li>Changing status may affect pension payments.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection