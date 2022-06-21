@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<form action="{{ route('admin.categories/update',$category->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="mb-3 mt-2 mb-3">
        <label for="name" class="foem-label text-muted">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}">
        @error('name')
        <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="slug" class="foem-label text-muted">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $category->slug) }}">
        @error('slug')
        <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary px-5">Save</button>
</form>
@endsection
