@extends('layouts.nav')

@section('title', 'Spectacles Movie')

@section('content')
<body class="bg-dark bg-opacity-50">
    <div class="container">
        <h2>Search Results for "{{ $searchTerm }}"</h2>

        @if ($searchResults->isEmpty())
            <p>No movies found for the search term "{{ $searchTerm }}"</p>
        @else
            <ul>
                @foreach ($searchResults as $movie)
                <div class="col-md-3">
                    <div class="movie-card">
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }} Image">
                        <div class="movie-overlay">
                            <h5>{{ $movie->title }}</h5>
                            <p>{{ $movie->genre }} | {{ $movie->year_release }}</p>
                            <a href="{{ route('home.show', $movie->id) }}" style="color: #ffc107; text-decoration: none;">Review</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </ul>
        @endif
    </div>
</body>
@endsection
