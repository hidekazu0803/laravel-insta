@extends('layouts.app')

@section('title', 'Show Post')

@section('content')
    <style>
        .col-4 {
            overflow-y: scroll;
        }

        .card-body {
            position: absolute;
            top: 65px;
        }

    </style>
    <div class="row border shadow">
        <div class="col p-0">
            <img src="{{ asset('storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4 px-0 bg-white">
            <div class="card border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $post->user->id) }}" class="text-secondary">
                                @if ($post->user->avatar)
                                    <img src="{{ asset('storage/avatars/' . $post->user->avatar) }}" alt="#" class="rounded-circle user-avatar" style="height:32px; width:32px">
                                @else
                                    <i class="fa-solid fa-circle-user user-icon"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0">
                            <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                        </div>
                        <div class="col-auto text-end">
                            {{-- If you are the owner of the post, you can Edit or Delete this post --}}
                            @if (Auth::user()->id === $post->user->id)
                                <div class="dropdown">
                                    <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                                            <i class="fa-regular fa-pen-to-square"></i>Edit
                                        </a>
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete-post-{{ $post->id }}">
                                            <i class="fa-regular fa-trash-can"></i>Delete
                                        </button>

                                    </div>
                                </div>
                            @else
                                {{-- If you are NOT the owner of the post, show s Follow/Unfollow button. To be discussed soon. --}}
                                {{-- Show Unfollow button for now --}}
                                <form action="#" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 bg-transparent text-secondary p-0">
                                        Following
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body w-100">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            @if ( $post->isLiked() )
                            <form action="{{ route('like.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                {{-- like button --}}
                                <button type="submit" class="btn btn-sm shadow-none ps-0">
                                    <i class="fa-solid text-danger fa-heart" style="font-size: 1.5rem;"></i>
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
                    <div class="row">
                        <div class="col">
                            <strong>{{ $post->user->name }}</strong>
                            &nbsp;
                            <p class="d-inline fw-light">{{ $post->description }}</p>
                        </div>
                    </div>

                    {{-- Comments --}}
                    <div class="mt-4">
                        <form action="{{ route('comment.store' , $post->id) }}" method="post">
                            @csrf
                            <div class="input-group">
                                <textarea name="comment_body{{ $post->id }}" rows="1" class="form-control form-control-sm"
                                    placeholder="Add a comment...">{{ old('comment_body' . $post->id) }}</textarea>
                                <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
                            </div>
                            {{-- Error --}}
                            @error('comment_body' . $post->id)
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                            </form>

                            {{-- Show all comments here --}}
                            @if ($post->comments->isNotEmpty())
                            <ul class="list-group mt-3">
                                @foreach ($post->comments as $comment )
                                <li class="list-group-item border-0 p-0 mb-2">
                                    <strong>{{ $comment->user->name }}</strong>
                                    &nbsp;
                                    <p class="d-inline fw-light">{{ $comment->body }}</p>

                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="mb-0">
                                        @csrf
                                        @method('DELETE')

                                        <span class="small text-muted">{{ date('D, M d Y', strtotime($comment->created_at)) }}</span>

                                        @if ($comment->user->id === Auth::user()->id)
                                            &middot;
                                            <button type="submit" class="border-0 bg-transparent text-danger p-0 small">Delete</button>
                                        @endif
                                    </form>
                                </li>
                                @endforeach
                            </ul>
                        @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                            <img src="{{ asset('/storage/images/' . $post->image) }}" class="delete-post-img"
                                alt="{{ $post->image }}">
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

    @endsection
