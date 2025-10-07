@extends('layouts.app')

@section('title', 'Our Services')

@section('content')
<div class="container py-4 py-md-5">
  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-md-5">
      <h1 class="h3 fw-bold mb-2">Services</h1>
      <p class="text-muted mb-4">Dine-in, takeaway, and more—made simple.</p>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="p-4 bg-light rounded-4 h-100">
            <span class="badge bg-success-subtle text-success-emphasis rounded-pill mb-2">Dine-In</span>
            <h2 class="h5 fw-semibold mb-2">Table Reservations</h2>
            <p class="mb-0">Book a table in seconds and enjoy a relaxed, sit-down experience with family and friends.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-4 bg-light rounded-4 h-100">
            <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill mb-2">Orders</span>
            <h2 class="h5 fw-semibold mb-2">Online Ordering</h2>
            <p class="mb-0">Add items to your cart and check out securely. Track your order status from your account.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-4 bg-light rounded-4 h-100">
            <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill mb-2">Catering</span>
            <h2 class="h5 fw-semibold mb-2">Events & Catering</h2>
            <p class="mb-0">From office lunches to celebrations, we can tailor a menu to your event size and style.</p>
          </div>
        </div>
      </div>

      <div class="mt-4 d-flex gap-2">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill px-4">Browse Menu</a>
        <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4">Contact Us</a>
      </div>
    </div>
  </div>
</div>
@endsection
