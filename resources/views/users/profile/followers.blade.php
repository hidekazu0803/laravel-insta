@extends('layouts.app')

@section('title', 'Followers')


@section('content')
    @include('users.profile.header')

    <div style="margin-top: 100px">
        @if ($user->followers->count() != 0)
            <div class="col-4">
                <h3 class="text-muted text-center">Followers</h3>

                @foreach ($user->followers as $follower)
                    <div class="row align-items-center mt-3">
                        <div class="col-auto">
                            <a href="#">
                                @if ($follower->follower->avatar)
                                    <img src="#" class="rouneded-circle" style="height: 150px; width:150px;">
                                @else
                                    <i class="fa-solid fa-circle-user text-secndary" style="font-size:70px;"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0 text-truncate">
                            <a href="">{{ $follower->follower->name }}</a>
                        </div>
                        <div class="col text-end">
                            @if ($follower->follower->id !== Auth::user()->id)
                                @if ($follower->follower->isFollowed())
                                    <form action="#" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button class="border-0 bg-transparent p-0 text-secondary btn-sm">Following</button>
                                    </form>
                                @else
                                    <form action="#" method="post">
                                        @csrf

                                        <button class="border-0 bg-transparent p-0 text-secondary btn-sm">Follow</button>
                                    </form>
                                @endif
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="text-muted text-center">No Followers yet</h3>
        @endif
    </div>


@endsection
