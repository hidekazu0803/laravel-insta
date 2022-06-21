@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')

    @if ($all_posts->isNotEmpty())
        <table class="table table-hover align-middle bg-white border text-secondary">
            <thead class="table-primary text-secondary smail">
                <th></th>
                <th></th>
                <th>CATEGORY</th>
                <th>OWNER</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($all_posts as $post)
                    <tr>
                        <td class="text-end">{{ $post->id }}</td>
                        <td>
                            <a href="{{ route('post.show', $post->id) }}">
                                <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}"
                                    class="b-block mx-auto img-fluid"
                                    style="width: 7rem; height:7rem; object-fit:cover;"></a>
                        </td>
                        <td>
                            @foreach ($post->categoryPost as $category_post)
                                <span class="badge bg-secondary bg-opacity-50">
                                    {{ $category_post->category->name }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('profile.show', $post->user->id) }}"
                                class="text-decoration-none">{{ $post->user->name }}</a>
                        </td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            @if ($post->trashed())
                            <i class="fa-solid fa-circle text-danger"></i>hidden
                            @else
                            <i class="fa-solid fa-circle text-primary"></i> Visible
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if ($post->trashed())
                                    <button class="dropdown-item text-success btn btn-sm shadow-none" data-bs-toggle="modal"
                                        data-bs-target="#visible-post-{{ $post->id }}">
                                        <i class="fa-solid fa-eye-slash"></i> Visible Post {{ $post->id }}
                                    </button>
                                    @else
                                    <button class="dropdown-item text-danger btn btn-sm shadow-none" data-bs-toggle="modal"
                                        data-bs-target="#hide-post-{{ $post->id }}">
                                        <i class="fa-solid fa-eye-slash"></i> Hide Post {{ $post->id }}
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>

                    {{-- include modal here --}}
                    @include('users.admin.posts.modal.status')
                @endforeach
            </tbody>
        </table>
        {{ $all_posts->links() }}
    @else
    @endif
@endsection
