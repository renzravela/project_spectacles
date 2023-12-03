<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spectacles Movies PH</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    {{-- Sweet Alerts --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .movie-list-container {
            margin-top: 20px;
            padding: 0 20px;
        }

        .movie-card {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .movie-card img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }

        .movie-card:hover img {
            transform: scale(1.1);
        }

        .movie-overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .movie-card:hover .movie-overlay {
            opacity: 1;
        }

        .movie-overlay h5,
        .movie-overlay p {
            margin: 0;
            color: white;
        }

        .movie-overlay a {
            margin-top: 10px;
            color: #ffc107;
            text-decoration: none;
        }

        .movie-overlay a:hover {
            text-decoration: underline;
        }

        .container h1{
            margin-top: 20px
        }
    </style>
</head>
<body class="bg-dark bg-opacity-50" >
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand text-light" href="#">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
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
                <form class="d-flex ms-auto mx-auto"> <!-- Added mx-auto for centering -->
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary text-light" type="submit">Search</button>
                </form>

                <!-- Display user information or login/register link -->
                @if (session('user_id'))
                    <span class="navbar-text text-light mr-auto" style="width: 100px">Hello, {{ session('user_name') }}</span>
                    <a href="{{ route('user.logout') }}" class="btn btn-outline-light">Logout</a>
                @endif
                @if (!session('user_id'))
                    <a href="{{ route('user.index') }}" class="nav-link text-light">Login/Register</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Movie List</h1>
    
        <div class="row">
            @foreach ($movie_list as $movie)
                <div class="col-md-3">
                    <div class="movie-card">
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }} Image">
                        <div class="movie-overlay">
                            <h5>{{ $movie->title }}</h5>
                            <p>{{ $movie->genre }} | {{ $movie->year_release }}</p>
                            <a href="{{ route('app.show', $movie->id) }}" style="color: #ffc107; text-decoration: none;">Review</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
