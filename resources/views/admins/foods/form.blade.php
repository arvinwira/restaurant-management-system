@extends('layouts.admin')
@section('title', isset($food)?'Edit Food':'Add Food')

@section('content')
<div class="container-fluid">
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <div class="card border-0">
    <div class="card-body">
    <form method="POST"
      action="{{ isset($food) ? route('admins.foods.update',$food->id) : route('admins.foods.store') }}"
      enctype="multipart/form-data">
        @csrf
        @isset($food) @method('PUT') @endisset

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control"
                 value="{{ old('name', $food->name ?? '') }}" required>
        </div>

        <div class="form-group">
          <label>Category</label>
          <input type="text" name="category" class="form-control"
                 value="{{ old('category', $food->category ?? '') }}">
        </div>

        <div class="form-group">
          <label>Price</label>
          <input type="number" step="0.01" name="price" class="form-control"
                 value="{{ old('price', $food->price ?? 0) }}" required>
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea name="description" rows="4" class="form-control">{{ old('description', $food->description ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control">
            @isset($food)
            @if(!empty($food->image))
                <div class="mt-2">
                <img src="{{ asset('storage/'.$food->image) }}" alt="Food" style="height:70px;">
                </div>
            @endif
            @endisset
        </div>

        <button class="btn btn-primary rounded-pill">{{ isset($food)?'Update':'Create' }}</button>
        <a href="{{ route('admins.foods.index') }}" class="btn btn-light rounded-pill">Cancel</a>
        </form>
    </div>
  </div>
</div>
@endsection
