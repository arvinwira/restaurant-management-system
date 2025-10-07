@extends('layouts.admin')

@section('title','Admin Dashboard')

@section('content')
<div class="container-fluid">

  {{-- STAT CARDS --}}
  <div class="row">
    <div class="col-md-4">
      <div class="card border-0">
        <div class="card-body">
          <div class="text-muted small">Foods</div>
          <div class="h4 mb-0">{{ number_format($foodsCount) }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0">
        <div class="card-body">
          <div class="text-muted small">Orders</div>
          <div class="h4 mb-0">{{ number_format($ordersCount) }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0">
        <div class="card-body">
          <div class="text-muted small">Bookings</div>
          <div class="h4 mb-0">{{ number_format($bookingsCount) }}</div>
        </div>
      </div>
    </div>
  </div>

  {{-- RECENT TABLES --}}
  <div class="row">
    {{-- Recent Foods --}}
    <div class="col-lg-4">
      <div class="card border-0">
        <div class="card-body">
          <h5 class="mb-3">Recent Foods</h5>
          <div class="table-responsive">
            <table class="table table-sm mb-0">
              <thead class="text-muted small">
                <tr>
                  <th class="border-0">Name</th>
                  <th class="border-0">Category</th>
                  <th class="border-0 text-right">Price</th>
                </tr>
              </thead>
              <tbody>
              @forelse($recentFoods as $f)
                <tr>
                  <td>{{ $f->name }}</td>
                  <td>{{ $f->category }}</td>
                  <td class="text-right">$ {{ number_format((float)($f->price ?? 0), 2) }}</td>
                </tr>
              @empty
                <tr><td colspan="3" class="text-muted">Belum ada data makanan.</td></tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- Recent Orders --}}
    <div class="col-lg-4">
      <div class="card border-0">
        <div class="card-body">
          <h5 class="mb-3">Recent Orders</h5>
          <div class="table-responsive">
            <table class="table table-sm mb-0">
              <thead class="text-muted small">
                <tr>
                  <th class="border-0">Order</th>
                  <th class="border-0">Status</th>
                  <th class="border-0 text-right">Total</th>
                </tr>
              </thead>
              <tbody>
              @forelse($recentOrders as $o)
                @php
                  $s = strtolower($o->status ?? 'pending');
                  $badge = [
                    'completed'=>'badge-success',
                    'paid'=>'badge-primary',
                    'processing'=>'badge-info',
                    'cancelled'=>'badge-danger',
                    'pending'=>'badge-warning',
                  ][$s] ?? 'badge-secondary';
                @endphp
                <tr>
                  <td>#{{ $o->id }}
                    <div class="small text-muted">
                      {{ \Carbon\Carbon::parse($o->created_at)->diffForHumans() }}
                    </div>
                  </td>
                  <td><span class="badge {{ $badge }}">{{ ucfirst($s) }}</span></td>
                  <td class="text-right">Rp {{ number_format((float)($o->grand_total ?? 0), 2) }}</td>
                </tr>
              @empty
                <tr><td colspan="3" class="text-muted">Belum ada order.</td></tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- Recent Bookings --}}
    <div class="col-lg-4">
      <div class="card border-0">
        <div class="card-body">
          <h5 class="mb-3">Recent Bookings</h5>
          <div class="table-responsive">
            <table class="table table-sm mb-0">
              <thead class="text-muted small">
                <tr>
                  <th class="border-0">Name</th>
                  <th class="border-0">Date</th>
                  <th class="border-0 text-right">People</th>
                </tr>
              </thead>
              <tbody>
              @forelse($recentBookings as $b)
                <tr>
                  <td>{{ $b->name }}</td>
                  <td>
                    {{ $b->date ? \Carbon\Carbon::parse($b->date)->format('d M Y · H:i') : '—' }}
                    <div class="small text-muted">{{ $b->created_at?->diffForHumans() }}</div>
                  </td>
                  <td class="text-right">{{ $b->num_people }}</td>
                </tr>
              @empty
                <tr><td colspan="3" class="text-muted">Belum ada booking.</td></tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection
