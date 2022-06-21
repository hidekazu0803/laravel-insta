<div class="card-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <a href="{{ route('profile.show', $post->user->id) }}" class="text-secondary">
                @if ($post->user->avatar)
                    <img src="{{ asset('storage/avatars/'. $post->user->avatar) }}" alt="#" class="rounded-circle user-avatar" style="height: 32px; width:32px;">
                @else
                    <i class="fa-solid fa-circle-user user-icon"></i>
                @endif
            </a>

        </div>
        <div class="col ps-0">
            <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark">{{ $post->user->name }} </a>
        </div>
        <div class="col-auto">
            <div class="dropdown">
                <button class=" btn btn-sm shadow-none" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
                @if (Auth::user()->id == $post->user->id)
                    <div class="dropdown-menu">
                        <a href="{{ route('post.edit', $post->id ) }}" class="dropdown-item">
                            <i class="fa-regular fa-pen-to-square"></i>Edit
                        </a>
                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-post-{{ $post->id }}">
                            <i class="fa-regular fa-trash-can"></i>Delete
                        </button>

                    </div>
                @else
                    <div class="dropdown-menu">
                        <form action="{{ route('follow.destroy', $post->user->id) }}" method="post">
                            @csrf
                            @method('DELETE')


                            <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="delete-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger"> <i class="fa-solid fa-circle-exclamation"></i> DELETE POST</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this post?</p>
                <div class="mt-3">
                    <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="delete-post-img">
                    <p class="text-muted">{{ $post->description }}</p>
                </div>

            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('post.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-secondasry btn-sm"
                        data-bs-dismiss="modal">Cancel</button>

                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
