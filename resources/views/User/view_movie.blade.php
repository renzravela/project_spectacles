@extends('layouts.nav')

@section('title', $movie->title)

@section('content')
<body class="bg-dark bg-opacity-50">

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
    @auth
        <a href="" class="">Review</a>
    @else
        <a href="" class="">Login to review</a>
    @endauth

</body>
@endsection
