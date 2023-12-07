<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap and custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}

    {{-- Sweet Alerts --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>@yield('title', 'Spectacles Movies')</title>
</head>
<header>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand text-light" href="#">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo" style="max-height: 40px; margin-right: 10px;">
            </a>

            <!-- Toggle button for small screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links and search form -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Movies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">About us</a>
                    </li>
                </ul>

                <!-- Search form -->
                <form class="d-flex ms-auto mx-auto" action="{{ route('search') }}" method="GET"> <!-- Added mx-auto for centering -->
                    <input class="form-control me-2" type="search" id="movie_search" name="search" required placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary text-light" type="submit">Search</button>
                </form>
                <div class="search-list">
                    <ul id="search-list-container">
                    </ul>
                </div>

                    <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }}
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
                            </li>
                        @endguest
                    </ul>
            </div>
        </div>
    </nav>
</header>
    @yield('content')

    <script>
        $(document).ready(function () {
            $('#movie_search').on('keyup', function () {
                let search_value = $('#movie_search').val();

                if (search_value === "") {
                    var searchListContainer = $('#search-list-container');
                    searchListContainer.empty();
                } else {
                    fetchAllMovies(search_value);
                }
        });

            function fetchAllMovies(data) {
                var search = data;
                var movieImageBaseUrl = "{{ asset('storage/') }}";

                $.ajax({
                    type: 'POST',
                    url: '/ajax/search',
                    data: {
                        key: search,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if(response){
                            var searchMovies = response.all_movies;
                            var searchListContainer = $('#search-list-container');
                            searchListContainer.empty();
                            $.each(searchMovies, function(index, movie) {

                                var movieElement = '<li class="movie_search_item" data-id="' + movie.id + '"> ' +
                                    '<img src="' + movieImageBaseUrl + '/' + movie.image + '" alt="Image">' +
                                    '<p>' + movie.title + ' | </p>' +
                                    '<p>' + movie.year_release + '</p>' +
                                    '</li>';
                                searchListContainer.append(movieElement);

                            });
                        }else{
                            var searchListContainer = $('#search-list-container');
                            searchListContainer.empty();

                            var movieElement = '<li>' + response.message + '</li>';
                            searchListContainer.append(movieElement);
                        }

                    },
                    error: function (response) {
                        console.log(response.message);
                    }
                });
            }
        });
    </script>
</html>

