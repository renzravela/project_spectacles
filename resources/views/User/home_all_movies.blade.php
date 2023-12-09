@extends('layouts.nav')

@section('content')
<body class="bg-dark bg-opacity-50">
    <div class="container">
        <h1 style="text-align: center; font-size: 3em; font-weight: bold; color: #333;">All Movies</h1>
        <div class="row">
            @foreach ($movie_list as $movie)
                <div class="col-sm-2">
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
@endsection
