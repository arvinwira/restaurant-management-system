@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container py-4 py-md-5">
  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-md-5">
      <h1 class="h3 fw-bold mb-2">Get in Touch</h1>
      <p class="text-muted mb-4">Questions, feedback, or catering inquiries—we’d love to hear from you.</p>

      {{-- Alerts --}}
      @if (session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger rounded-3">
          <div class="fw-semibold mb-1">Please fix the following:</div>
          <ul class="mb-0">
            @foreach ($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Form --}}
      <form action="{{ route('contact.send') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
          <label class="form-label small text-muted">Your Name</label>
          <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-3" placeholder="John Doe" required>
        </div>
        <div class="col-md-6">
          <label class="form-label small text-muted">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-3" placeholder="you@example.com" required>
        </div>
        <div class="col-12">
          <label class="form-label small text-muted">Subject (optional)</label>
          <input type="text" name="subject" value="{{ old('subject') }}" class="form-control rounded-3" placeholder="How can we help?">
        </div>
        <div class="col-12">
          <label class="form-label small text-muted">Message</label>
          <textarea name="message" rows="5" class="form-control rounded-3" placeholder="Write your message here…" required>{{ old('message') }}</textarea>
        </div>
        <div class="col-12">
          <button class="btn btn-primary rounded-pill px-4">Send Message</button>
        </div>
      </form>

      {{-- Contact info (optional) --}}
      <div class="row g-4 mt-4">
        <div class="col-md-4">
          <div class="p-3 bg-light rounded-4 h-100">
            <div class="fw-semibold">Address</div>
            <div class="text-muted">123 Food Street, Jakarta</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-3 bg-light rounded-4 h-100">
            <div class="fw-semibold">Phone</div>
            <div class="text-muted">(+62) 812-3456-7890</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-3 bg-light rounded-4 h-100">
            <div class="fw-semibold">Email</div>
            <div class="text-muted">hello@yourrestaurant.com</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
