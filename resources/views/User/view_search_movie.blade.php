@extends('layouts.nav')

@section('title', 'Spectacles Movie')

@section('content')
<body class="bg-dark bg-opacity-50">
    <div class="container" style="margin-bottom: 200px;">
        <h2>Search Results for "{{ $searchTerm }}"</h2>

        @if ($searchResults->isEmpty())
            <p>No movies found for the search term "{{ $searchTerm }}"</p>
        @else
            <div class="row">
                @foreach ($searchResults as $movie)
                    <div class="col-md-2 mb-4">
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
            </div>
        @endif
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
@include('layouts.footer')
@endsection
