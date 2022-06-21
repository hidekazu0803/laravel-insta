@extends('layouts.app')

@section('content')
    <div class="row gx-5">
        <div class="col-8">
            {{-- posts --}}
            POST
            @if ($all_posts->isNotEmpty())
                @foreach ($all_posts as $post)
                    @if ($post->user->isFollowed() || $post->user->id == Auth::user()->id)
                        <div class="card mb-4">
                            {{-- head --}}
                            @include('users.posts.contents.title')
                            {{-- body --}}
                            @include('users.posts.contents.body')
                        </div>
                    @endif
                @endforeach
            @else
                <div class="text-center">
                    <h2> Share photos</h2>
                    <p class="text-muted">When you share photos, They'll appear on your profile </p>
                    <a href="{{ route('post.create') }}" class="text-decoration-none">Share your Photos</a>
                </div>
            @endif


        </div>
        <div class="col-4">
            <div class="row align-items-center mb-5 shadow-sm rounded-3 py-3">
                <div class="col-auto">
                    @if (Auth::user()->avatar)
                        <a href="{{ route('profile.show', Auth::user()->id) }}">
                            <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" class="rounded-circle"
                                style="width: 3.5rem; height:3.5rem; object-fit:cover;" alt="">
                        </a>
                    @else
                        <i class="fa-solid fa-circle-user user-icon" style="font-size:3.5rem"></i>
                    @endif
                </div>
                <div class="col ps-0">

                </div>
            </div>

            {{-- suggestions --}}

            SUGGESTIONS

            @foreach ($suggested_users as $user)
                <div class="row my-3">
                    <div class="col-2">
                        @if ($user->avatar)
                            <a href="{{ route('profile.show', $user->id) }}">
                                <img src="{{ asset('storage/avatars/' . $user->avatar) }}" class="rounded-circle"
                                    style="width: 1.5rem; height:1.5rem; object-fit:cover;" alt="">
                            </a>
                        @else
                            <i class="fa-solid fa-circle-user user-icon" style="font-size:1.5rem"></i>
                        @endif
                    </div>
                    <div class="col-6">
                        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">
                            {{ $user->name }}
                        </a>
                    </div>
                    <div class="col-4 text-end">
                        @if ($user->id !== Auth::user()->id)
                            @if ($user->isFollowed())
                                <form action="#" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="border bg-transparent p-0 text-secondary btn-sm">Following</button>
                                </form>
                            @else
                                <form action="{{ route('follow.store', $user->id) }}" method="post">
                                    @csrf

                                    <button class="border-1 bg-transparent text-secondary btn-outline-secondary btn-sm">Follow</button>
                                </form>
                            @endif
                        @endif

                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
