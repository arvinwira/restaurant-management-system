@extends('layouts.admin')
@section('title', isset($order)?'Edit Order':'Add Order')

@section('content')
<div class="container-fluid">
  @if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
  @endif

  <div class="card border-0">
    <div class="card-body">
      <form method="POST" action="{{ isset($order)
            ? route('admin.orders.update',$order->id)
            : route('admin.orders.store') }}">
        @csrf
        @isset($order) @method('PUT') @endisset

        <div class="form-group">
          <label>User ID</label>
          <input type="number" name="user_id" class="form-control" value="{{ old('user_id', $order->user_id ?? '') }}" required>
        </div>

        <div class="form-group">
          <label>Status</label>
          @php $st = old('status', $order->status ?? 'pending'); @endphp
          <select name="status" class="form-control">
            @foreach (['pending','paid','processing','completed','cancelled'] as $s)
              <option value="{{ $s }}" @selected($st===$s)>{{ ucfirst($s) }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Grand Total</label>
          <input type="number" step="0.01" name="grand_total" class="form-control"
                 value="{{ old('grand_total', $order->grand_total ?? 0) }}">
        </div>

        <div class="d-flex gap-2">
          <button class="btn btn-primary rounded-pill">{{ isset($order)?'Update':'Create' }}</button>
          <a href="{{ route('admin.orders.index') }}" class="btn btn-light rounded-pill">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
