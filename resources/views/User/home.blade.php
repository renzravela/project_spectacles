@extends('layouts.nav')

@section('title', 'Spectacles Movies PH')

@section('content')



<body class="bg-dark bg-opacity-50">
    <div class="container" style="margin-bottom: 200px;">
        {{-- <h1 style="text-align: center; font-size: 3em; font-weight: bold; color: #333;">Movie List</h1> --}}
        {{-- <div class="row">
            <h1 style="font-size: 3em; font-weight: bold; color: #333;">Latest Release</h1>
            @foreach ($latest_movies as $movie)
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
        </div> --}}
        <h1 style="font-size: 3em; font-weight: bold; color: #333;">Latest Release</h1>
        <div id="latestReleaseCarousel" class="carousel slide">
            <div class="carousel-inner">
                @foreach ($latest_movies as $key => $movie)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="row g-0">
                            <div class="col-md-3">
                                @if ($movie->image)
                                    <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }} Image"
                                        class="img-fluid rounded movie-image shadow" style="height: 490px; object-fit: cover;">
                                @else
                                    <p class="text-center">No image available</p>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <div class="desc p-3">
                                    <h5>{{ $movie->title }}</h5>
                                    <p>{{ $movie->genre }} | {{ $movie->year_release }}</p>
                                    <a href="{{ route('home.show', $movie->id) }}" class="btn btn-secondary" style="color: #ffffff;">Review</a>
                                    <iframe class="embed-responsive-item shadow mt-3" src="{{ $movie->trailer_link }}" allowfullscreen
                                        style="width:100%; height: 350px; border-radius: 20px;"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#latestReleaseCarousel" role="button" data-slide="prev">
                <span class="bi bi-caret-left-square-fill" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#latestReleaseCarousel" role="button" data-slide="next">
                <span class="bi bi-caret-right-square-fill" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>

        <div class="row">
            <h1>Most Viewed</h1>
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
<style>
    /* Customize the appearance of the carousel controls */
    .carousel-control-prev,
    .carousel-control-next {
        font-size: 2em; /* Adjust the font size as needed */
        color: #fff; /* Adjust the color as needed */
        opacity: 0.7; /* Set the initial opacity */
    }

    /* Increase opacity on hover (optional) */
    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1;
    }
</style>
@include('layouts.footer')
@endsection
