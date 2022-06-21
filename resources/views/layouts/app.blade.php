<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    {{-- a search bar will be created here --}}
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                              {{-- home --}}
                              <li class="nav-item" title="Home">
                                  <a href="{{route('index')}}" class="nav-link">
                                    <i class="fa-solid fa-house text-dark nav-icon"></i>
                                </a>
                              </li>

                              {{-- create post --}}
                              <li class="nav-item" title="Create Post">
                                  <a href="{{ route('post.create') }}" class="nav-link">
                                      <i class="fa-solid fa-circle-plus text-dark nav-icon"></i>
                                  </a>
                              </li>

                              {{-- account --}}
                              <li class="dropdown nav-item">
                                  <button class="btn btn-shadow-none nav-link" id="account-dropdown" data-bs-toggle="dropdown">
                                      @if(Auth::user()->avatar)
                                      <img src="{{ asset('/storage/avatars/'.Auth::user()->avatar) }}" alt="#" style="height:32px; width:32px" class="img-fluid rounded-circle">
                                      @else
                                      <i class="fa-solid fa-circle-user text-dark nav-icon"></i>
                                      @endif
                                  </button>

                                  <div class="dropdown-menu dropdown-menu-end" aria-describedby="account-dropdown">
                                      {{-- admin controls --}}
                                      @can('admin')
                                      <a href="{{ route('admin.users') }}" class="dropdown-item">
                                        <i class="fa-solid fa-user-gear"></i>Admin
                                    </a>
                                      @endcan
                                      {{-- profile --}}
                                      <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
                                          <i class="fa-solid fa-circle-user"></i>Profile
                                      </a>

                                      {{-- Logout --}}
                                      <a href="{{route('logout')}}" class="dropdown-item"
                                      onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                      <i class="fa-solid fa-right-from-bracket"></i>
                                      {{ __('logout') }}
                                    </a>

                                    <form action="{{ route('logout')}}" method="post" id="logout-form" class="d-none">
                                        @csrf
                                    </form>
                                  </div>

                              </li>
                            {{-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li> --}}
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    @if (request()->is('admin/*'))
                        <div class="col-3">
                            <div class="list-group">
                                <a href="{{ route('admin.users') }}" class="list-group-item {{ request()->is('admin/users') ? 'active': '' }}">
                                    <i class="fa-solid fa-users"></i>Users
                                </a>
                                <a href="{{ route('admin.posts') }}" class="list-group-item {{ request()->is('admin/posts') ? 'active': '' }}">
                                    <i class="fa-solid fa-newspaper"></i>Posts
                                </a>
                                <a href="{{ route('admin.categories') }}" class="list-group-item">
                                    <i class="fa-solid fa-tags"></i>Categories
                                </a>
                            </div>
                        </div>
                    @endif
                      <div class="col-9">
                          @yield('content')
                      </div>
                </div>
            </div>

        </main>
    </div>
</body>
</html>
