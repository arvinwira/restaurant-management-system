@extends('layouts.admin')
@section('title','Orders')

@section('content')
<div class="container-fluid">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Orders</h4>
    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary rounded-pill">Add Order</a>
  </div>

  <div class="card border-0">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped mb-0">
          <thead class="small text-muted">
          <tr>
            <th>#</th><th>User</th><th>Status</th><th class="text-right">Total</th><th class="text-right">Actions</th>
          </tr>
          </thead>
          <tbody>
          @forelse($orders as $o)
            <tr>
              <td>#{{ $o->id }}</td>
              <td>{{ $o->user_id }}</td>
              <td><span class="badge badge-{{ ['completed'=>'success','paid'=>'primary','processing'=>'info','cancelled'=>'danger','pending'=>'warning'][$o->status] ?? 'secondary' }}">
                {{ ucfirst($o->status ?? 'pending') }}</span></td>
              <td class="text-right">Rp {{ number_format((float)($o->grand_total ?? 0),2) }}</td>
              <td class="text-right">
                <a href="{{ route('admin.orders.edit',$o->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                <form action="{{ route('admin.orders.destroy',$o->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Delete this order?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-muted">No orders.</td></tr>
          @endforelse
          </tbody>
        </table>
      </div>
      <div class="p-3">{{ $orders->links() }}</div>
    </div>
  </div>
</div>
@endsection
