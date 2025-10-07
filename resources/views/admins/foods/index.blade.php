@extends('layouts.admin')
@section('title','Foods')

@section('content')
<div class="container-fluid">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Foods</h4>
    <a href="{{ route('admins.foods.create') }}" class="btn btn-primary rounded-pill">Add Food</a>
  </div>

  <div class="card border-0">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped mb-0">
          <thead class="small text-muted">
          <tr>
            <th>Name</th><th>Category</th><th class="text-right">Price</th><th class="text-right">Actions</th>
          </tr>
          </thead>
          <tbody>
          @forelse($foods as $f)
            <tr>
              <td>{{ $f->name }}</td>
              <td>{{ $f->category }}</td>
              <td class="text-right">$ {{ number_format((float)($f->price ?? 0),2) }}</td>
              <td class="text-right">
                <a href="{{ route('admins.foods.edit',$f->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                <form action="{{ route('admins.foods.destroy',$f->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Delete this food?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="4" class="text-muted">No foods.</td></tr>
          @endforelse
          </tbody>
        </table>
      </div>
      <div class="p-3">{{ $foods->links() }}</div>
    </div>
  </div>
</div>
@endsection
