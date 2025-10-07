@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container py-4 py-md-5">
  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-md-5">
      <h1 class="h3 fw-bold mb-2">About Our Restaurant</h1>
      <p class="text-muted mb-4">A little story about our kitchen and craft.</p>

      <div class="row g-4">
        <div class="col-md-6">
          <div class="p-4 bg-light rounded-4 h-100">
            <h2 class="h5 fw-semibold mb-2">Our Philosophy</h2>
            <p class="mb-0">
              We serve honest, seasonal dishes crafted from fresh ingredients. From breakfast comforts
              to dinner classics, every plate is prepared with care and consistency.
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="p-4 bg-light rounded-4 h-100">
            <h2 class="h5 fw-semibold mb-2">What Makes Us Different</h2>
            <ul class="mb-0">
              <li>Locally sourced produce</li>
              <li>Made-to-order meals</li>
              <li>Warm, attentive service</li>
              <li>Inviting, family-friendly space</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="mt-4">
        <a href="{{ route('services') }}" class="btn btn-primary rounded-pill px-4">Explore Our Services</a>
      </div>
    </div>
  </div>
</div>
@endsection
