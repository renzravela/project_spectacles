@extends('layouts.admin_nav')

@section('content')
<body>
    <div class="container-fluid mt-5">
        <h1>Hello {{ Auth::user()->first_name }}</h1>
        <p>Total Number of movies: {{ $movie_count }}</p>
        <p>Total Number of users: {{ $user_count }}</p>
        <p>Total Number of reviews: {{ $review_count }}</p>
    </div>
</body>
@endsection
