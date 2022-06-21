@extends('layouts.app')


@section('title', 'Edit Profile')

@section('content')


    <form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            @if ($user->avatar)
            <img src="{{ asset('storage/avatars/'. $user->avatar) }}" alt="{{ $user->avatar }}" class="img-thumbnail avatar d-block mx-auto">
            @else
            <i class="fa-solid fa-user fa-10x d-block"></i>
            @endif
            <input type="file" name="avatar" class="form-control mt-1 shadow-none">
            @error('avatar')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label fw-bold">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            @error('name')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label fw-bold">Email Address</label>
            <input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            @error('email')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label fw-bold">Self Introduction</label>
            <textarea name="introduction" id="introduction" rows="3" class="form-control"
                placeholder="What on your mind?">{{ old('introduction', $user->introduction) }}</textarea>
            @error('introduction')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm px-5">Save</button>
    </form>
@endsection
