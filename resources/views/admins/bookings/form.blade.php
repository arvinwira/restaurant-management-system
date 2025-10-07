@extends('layouts.admin')
@section('title', isset($booking)?'Edit Booking':'Add Booking')

@section('content')
<div class="container-fluid">
  @if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
  @endif

  <div class="card border-0">
    <div class="card-body">
      <form method="POST" action="{{ isset($booking)
            ? route('admins.bookings.update',$booking->id)
            : route('admins.bookings.store') }}">
        @csrf
        @isset($booking) @method('PUT') @endisset

        <div class="form-group"><label>Name</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $booking->name ?? '') }}" required>
        </div>

        <div class="form-group"><label>Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email', $booking->email ?? '') }}" required>
        </div>

        <div class="form-group"><label>Date & Time</label>
          <input type="datetime-local" name="date" class="form-control"
                 value="{{ old('date', isset($booking->date) ? \Carbon\Carbon::parse($booking->date)->format('Y-m-d\TH:i') : '') }}">
        </div>

        <div class="form-group"><label>People</label>
          <input type="number" name="num_people" class="form-control" min="1"
                 value="{{ old('num_people', $booking->num_people ?? 1) }}" required>
        </div>

        <div class="form-group"><label>Status</label>
          @php $st = old('status', $booking->status ?? 'pending'); @endphp
          <select name="status" class="form-control">
            @foreach (['pending','confirmed','cancelled'] as $s)
              <option value="{{ $s }}" @selected($st===$s)>{{ ucfirst($s) }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group"><label>Request (optional)</label>
          <textarea name="request" rows="4" class="form-control">{{ old('request', $booking->request ?? '') }}</textarea>
        </div>

        <div class="d-flex gap-2">
          <button class="btn btn-primary rounded-pill">{{ isset($booking)?'Update':'Create' }}</button>
          <a href="{{ route('admins.bookings.index') }}" class="btn btn-light rounded-pill">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
