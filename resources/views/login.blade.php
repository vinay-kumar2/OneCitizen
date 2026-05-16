@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <!-- Flash Message Placeholders -->
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-lg rounded-3">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 text-center">
                <i class="bi bi-shield-lock text-primary display-4" style="color: #0c2340 !important;"></i>
                <h4 class="fw-bold mt-3 mb-1" style="color: #0c2340;">OneCitizen Portal</h4>
                <p class="text-muted small">Centralized Pension Verification System</p>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <!-- Validation Error Placeholders -->
                    @if ($errors->any())
                        <div class="alert alert-danger bg-danger bg-opacity-10 border-danger border-opacity-25 text-danger py-2 px-3 small rounded-3 mb-3">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium text-dark small">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" id="email-addon">
                                <i class="bi bi-envelope text-muted"></i>
                            </span>
                            <input type="email" class="form-control border-start-0 ps-0 bg-light shadow-none" style="background-color: #f8f9fa;" id="email" name="email" placeholder="admin@example.com" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label fw-medium text-dark small mb-0">Password</label>
                            <a href="#" class="text-decoration-none small" style="color: #0c2340;">Forgot Password?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" id="password-addon">
                                <i class="bi bi-lock text-muted"></i>
                            </span>
                            <input type="password" class="form-control border-start-0 ps-0 bg-light shadow-none" style="background-color: #f8f9fa;" id="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input shadow-none" id="remember" name="remember">
                        <label class="form-check-label text-muted small" for="remember">Remember me on this device</label>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn py-2 fw-medium text-white shadow-sm" style="background-color: #0c2340; border-color: #0c2340;">
                            Secure Login <i class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="card-footer bg-light border-top-0 py-3 text-center rounded-bottom-3">
                <p class="mb-0 small text-muted">Need help? <a href="#" class="text-decoration-none fw-medium" style="color: #0c2340;">Contact Support</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
