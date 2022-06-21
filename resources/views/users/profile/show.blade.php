@extends('layouts.app')

@section('title', 'Profile')

@section('content')
{{-- Show header [include header] --}}
@include('users.profile.header')

{{-- show all posts here --}}
<div class="row" style="margin-top:100px">
@foreach ($user->posts as $post )
     <div class="col-4 mb-3">
         <a href="{{ route('post.show', $post->id) }}">
             <img src="{{ asset('storage/images/'.$post->image) }}" class="grid-img" alt="">
        </a>
     </div>
@endforeach
</div>

@endsection
