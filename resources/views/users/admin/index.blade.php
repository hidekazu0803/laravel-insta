@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')
    <table class=" table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <th></th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>CREATED AT</th>
            <th colspan="2">STATUS</th>
        </thead>
        <tbody>
            @foreach ($all_users as $user)
                <tr>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ asset('/storage/avatars/' . $user->avatar) }}"
                                class="rounded-circle d-block mx-auto admin-users-avatar" style="width: 1rem;
                                height: 1rem;
                                object-fit: cover;" alt="">
                        @else
                            <i class=" fa-solid fa-circle-user d-block text-center admin-users-icon">
                            </i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $user->id) }}"
                            class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @if ($user->trashed())
                            <i class="fa-solid fa-circle text-danger"></i>&nbsp;Non-Active
                        @else
                            <i class="fa-solid fa-circle text-success"></i>&nbsp;Active
                        @endif

                    </td>
                    <td>
                        @if (Auth::user()->id != $user->id)
                            <!-- Button trigger modal -->
                            @if ($user->trashed())
                                <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#activate-user-{{ $user->id }}">
                                    <i class="fa-solid fa-check"></i> Activate User
                                </button>
                            @else
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deactivate-user-{{ $user->id }}">
                                    <i class="fa-solid fa-user-slash"></i> Deactivate User
                                </button>
                            @endif
                        @endif
                        <!-- Modal -->
                        @include('users.admin.users.modal.status')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $all_users->links() }}
@endsection
