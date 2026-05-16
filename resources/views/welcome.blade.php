@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8 text-center mt-5">
        <i class="bi bi-shield-check display-1 mb-4" style="color: #0c2340 !important;"></i>
        <h1 class="display-4 fw-bold mb-3" style="color: #0c2340;">Welcome to OneCitizen Portal</h1>
        <p class="lead text-muted mb-5">Your secure gateway to government services. Fast, reliable, and accessible.</p>
        
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 gap-3 rounded-pill shadow-sm" style="background-color: #0c2340; border-color: #0c2340;">
                Go to Dashboard
            </a>
            <a href="#" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Learn More</a>
        </div>
    </div>
</div>
@endsection
