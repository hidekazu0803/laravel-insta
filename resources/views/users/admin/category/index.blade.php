@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Category</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.categories/store') }}">
                            @csrf

                            <div class="row  justify-content-center mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">NAME</label>

                                <div class="col">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror shadow-none" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row  justify-content-center mb-3">
                                <label for="slug" class="col-md-4 col-form-label text-md-end">slug</label>

                                <div class="col">
                                    <input id="slug" type="slug"
                                        class="form-control @error('slug') is-invalid @enderror shadow-none" name="slug"
                                        value="{{ old('slug') }}" required autocomplete="slug">

                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">

                                <button type="submit" class="btn btn-primary btn-sm">save</button>


                            </div>


                        </form>
                        <table class=" table table-hover align-middle bg-white border text-secondary">
                            <thead class="small table-success text-secondary">
                                <th>category</th>
                                <th>name</th>
                                <th>slug</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($all_categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <a href="{{ route('admin.categories/edit', $category->id) }}">
                                                <button type="submit" class="btn btn-success btn-sm px-3">Edit</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.categories/destroy', $category->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
