<div class="row">
    <div class="col-4">
        @if ($user->avatar)
          <a href="{{ route('profile.show', $user->id) }}">
            <img src="{{ asset('storage/avatars/'.$user->avatar) }}" class="img-thumbnall rounded-circle d-block mx-auto profile-avatar" alt="" style="height:200px; width:200px">
          </a>
        @else
        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none">
            <i class="fa-solid fa-circle-user text-secondary d-block text-center profile-icon"></i>
        </a>
        @endif
    </div>
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 d-inline">{{ $user->name }}</h2>
            </div>
            <div class="col-auto p-2">
                @if (auth::user()->id === $user->id)
                    <a href="{{ route('profile.edit', $user->id) }}"> Edit Profile </a>
                @else
                    @if ($user->isFollowed())
                    <form action="#" class="d-inline" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm fw-sold">Unfollow</button>
                    </form>
                    @else
                    <form action="{{ route('follow.store', $user->id) }}" class="d-inline" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm fw-sold">Follow</button>
                    </form>
                    @endif
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <a href="" class="text-decoration-none text-dark">
                    <strong>{{ $user->posts->count() }}</strong>
                    {{ $user->posts->count() == 1? 'post' : 'posts' }}
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->followers->count() }}</strong>
                    {{ $user->followers->count() == 1? 'Follower' : 'Followers' }}
                </a>
            </div>
            <div class="col-auto">
                <a href="" class="text-decoration-none text-dark">
                    <strong>{{ $user->following->count() }}</strong> Following
                </a>
            </div>
        </div>
        <div class="row">
            <p class="fw-bold">{{ $user->introduction }}</p>
        </div>
    </div>
</div>
