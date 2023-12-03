<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spectacles Movies: {{ $movie->title }}</title>
</head>
<body>
    @if ($movie->image)
        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }} Image" class="movie-image">
    @else
        <p>No image available</p>
    @endif

    <h1>{{ $movie->title }}</h1>
    <p>Director: {{ $movie->director }}</p>
    <p>Genre: {{ $movie->genre }}</p>
    <p>Description {{ $movie->description }}</p>
    <p>Year: {{ $movie->year_release }}</p>

    <iframe width="420" height="345" src="{{ $movie->trailer_link }}"></iframe>

    <br>
    @if (session('user_id'))
        <a href="" class="btn btn-outline-light">Review</a>
    @endif
    @if (!session('user_id'))
        <a href="" class="nav-link text-light">Login to review</a>
    @endif
</body>
</html>
