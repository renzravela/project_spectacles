@extends('layouts.nav')

@section('content')
<body class="bg-dark bg-opacity-50">
    <div class="container" style="margin-bottom: 200px;">
        <h1 style="text-align: center; font-size: 3em; font-weight: bold; color: #333;">All Movies</h1>

        <!-- Filter Form -->
        <form action="{{ route('home.all') }}" method="GET">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="genre"><i class="bi bi-funnel-fill"></i> Filter by Genre:</label>
                    <select class="form-control" id="genre" name="genre">
                        <option value="" {{ request('genre') === '' ? 'selected' : '' }}>All Genres</option>
                        <option value="Action" {{ request('genre') === 'Action' ? 'selected' : '' }}>Action</option>
                        <option value="Drama" {{ request('genre') === 'Drama' ? 'selected' : '' }}>Drama</option>
                        <option value="Sci-Fi" {{ request('genre') === 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                        <option value="Thriller" {{ request('genre') === 'Thriller' ? 'selected' : '' }}>Thriller</option>
                        <option value="Adventure" {{ request('genre') === 'Adventure' ? 'selected' : '' }}>Adventure</option>
                        <option value="Horror" {{ request('genre') === 'Horror' ? 'selected' : '' }}>Horror</option>
                        <option value="Reality" {{ request('genre') === 'Reality' ? 'selected' : '' }}>Reality</option>
                        <option value="Fantasy" {{ request('genre') === 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                        <option value="K-Drama" {{ request('genre') === 'K-Drama' ? 'selected' : '' }}>K-Drama</option>

                        <!-- Add more genres as needed -->
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="year_release"><i class="bi bi-funnel-fill"></i> Filter by Release Year:</label>
                    <input type="number" class="form-control" id="year_release" name="year_release" value="{{ request('year_release') }}" min="1900" max="{{ date('Y') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary mt-4"><i class="bi bi-sort-down"></i> Apply Filters</button>
                    <a href="{{ route('home.all') }}" class="btn btn-secondary mt-4" onclick="clearFilters()"><i class="bi bi-x-circle"></i> Clear Filters</a>
                </div>
            </div>
        </form>

            <!-- Display Message if No Movies -->
            @if (count($movie_list) === 0)
            <div class="alert alert-info" role="alert" style="margin-bottom: 200px;">
                @if (request('genre') && request('year_release'))
                    No movies found with genre <span style="font-weight: bold;">{{ request('genre') }}</span> in year <span style="font-weight: bold;">{{ request('year_release') }}.</span>
                @elseif (request('genre'))
                    No movies found with genre <span style="font-weight: bold;">{{ request('genre') }}.</span>
                @elseif (request('year_release'))
                    No movies found in year <span style="font-weight: bold;">{{ request('year_release') }}.</span>
                @else
                    No movies found.
                @endif
            </div>
            @endif


        <div class="row">
            @foreach ($movie_list as $movie)
                <div class="col">
                    <div class="movie-card">
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }} Image">
                        <div class="movie-overlay">
                            <h5>{{ $movie->title }}</h5>
                            <p>{{ $movie->genre }} | {{ $movie->year_release }}</p>
                            <a href="{{ route('home.show', $movie->id) }}" style="color: #ffffff; text-decoration: none;">Review</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
@include('layouts.footer')
@endsection
