@extends('layouts.admin')
@section('title','Bookings')

@section('content')
<div class="container-fluid">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Bookings</h4>
    <a href="{{ route('admins.bookings.create') }}" class="btn btn-primary rounded-pill">Add Booking</a>
  </div>

  <div class="card border-0">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped mb-0">
          <thead class="small text-muted">
          <tr>
            <th>Name</th><th>Email</th><th>Date</th><th>People</th><th>Status</th><th class="text-right">Actions</th>
          </tr>
          </thead>
          <tbody>
          @forelse($bookings as $b)
            <tr>
              <td>{{ $b->name }}</td>
              <td>{{ $b->email }}</td>
              <td>{{ $b->date ? \Carbon\Carbon::parse($b->date)->format('d M Y · H:i') : '—' }}</td>
              <td>{{ $b->num_people }}</td>
              <td><span class="badge badge-{{ ['confirmed'=>'success','cancelled'=>'danger','pending'=>'warning'][$b->status] ?? 'secondary' }}">{{ ucfirst($b->status ?? 'pending') }}</span></td>
              <td class="text-right">
                <a href="{{ route('admins.bookings.edit',$b->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                <form action="{{ route('admins.bookings.destroy',$b->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Delete this booking?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-muted">No bookings.</td></tr>
          @endforelse
          </tbody>
        </table>
      </div>
      <div class="p-3">{{ $bookings->links() }}</div>
    </div>
  </div>
</div>
@endsection
