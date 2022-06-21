<div class="container p-0">
    <a href="{{ route('post.show', $post->id) }}">
        <img src="{{ asset('storage/images/' . $post->image) }}" class="card-img rounded-0" alt="{{ $post->image }}">
    </a>
</div>
<div class="card-body">
    <div class="row align-items-center">
        <div class="col-auto">
            @if ( $post->isLiked() )
            <form action="{{ route('like.destroy', $post->id) }}" method="post">
                @csrf
                @method('DELETE')
                {{-- like button --}}
                <button type="submit" class="btn btn-sm shadow-none ps-0">
                    <i class="fa-solid text-danger fa-heart"></i>
                </button>


                {{-- number of likes --}}
                <span>{{ $post->likes->count() }}</span>
            </form>
            @else
            <form action="{{ route('like.store', $post->id) }}" method="post">
                @csrf
                {{-- like button --}}
                <button type="submit" class="btn btn-sm shadow-none ps-0">
                    <i class="fa-regular fa-heart" style="font-size: 1.5rem;"></i>
                </button>


                {{-- number of likes --}}
                <span>{{ $post->likes->count() }}</span>
            </form>

            @endif
        </div>
        <div class="col text-end">
            @foreach ($post->categoryPost as $category_post)
                <div class="badge bg-secondary bg-opacity-50 text-wrap">
                    {{ $category_post->category->name }}
                </div>
            @endforeach
        </div>
    </div>
    {{-- owner + description --}}
    <div class="row">
        <div class="col">
            <strong>{{ $post->user->name }}</strong>
            &nbsp;
            <p class="d-inline fw-light">{{ $post->description }}</p>
        </div>
    </div>

    {{-- Comments --}}
    @include('users.posts.contents.comments')
</div>
