@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<div class="container py-4 py-md-5">
  <div class="mb-4">
    <h1 class="h3 fw-bold mb-1">My Bookings</h1>
    <p class="text-muted mb-0">Review your table reservations and their current status.</p>
  </div>

  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
      @if ($bookings->count() === 0)
        <div class="p-5 text-center">
          <div class="mb-2 display-6">🍽️</div>
          <h2 class="h5 fw-semibold mb-2">No bookings yet</h2>
          <p class="text-muted mb-4">When you book a table, it will appear here.</p>
          <a href="{{ route('food.menu') }}" class="btn btn-primary px-4 rounded-pill">Browse Menu</a>
        </div>
      @else
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead class="small text-uppercase text-muted">
              <tr>
                <th class="border-0 ps-4">Date & Time</th>
                <th class="border-0">Guests</th>
                <th class="border-0">Name</th>
                <th class="border-0">Email</th>
                <th class="border-0">Request</th>
                <th class="border-0 pe-4 text-end">Status</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($bookings as $booking)
              <tr class="border-top">
                <td class="ps-4">
                  <div class="fw-semibold">
                    {{ optional($booking->date)->timezone(config('app.timezone', 'Asia/Jakarta'))->format('D, d M Y · H:i') }}
                  </div>
                  <div class="text-muted small">Created {{ $booking->created_at->diffForHumans() }}</div>
                </td>
                <td>{{ $booking->num_people }}</td>
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->email }}</td>
                <td class="text-truncate" style="max-width:260px;">
                  {{ $booking->request ?: '—' }}
                </td>
                <td class="pe-4 text-end">
                  @php
                    $status = strtolower($booking->status ?? 'pending');
                    $badge = match ($status) {
                      'confirmed' => 'bg-success-subtle text-success-emphasis',
                      'cancelled' => 'bg-danger-subtle text-danger-emphasis',
                      default => 'bg-warning-subtle text-warning-emphasis',
                    };
                  @endphp
                  <span class="badge rounded-pill px-3 py-2 {{ $badge }}">{{ ucfirst($status) }}</span>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-between align-items-center p-3 p-md-4">
          <div class="text-muted small">
            Showing {{ $bookings->firstItem() }}–{{ $bookings->lastItem() }} of {{ $bookings->total() }}
          </div>
          <div>
            {{ $bookings->onEachSide(1)->links() }}
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
