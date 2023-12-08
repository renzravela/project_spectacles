@extends('layouts.nav')

@section('title', $movie->title)

@section('content')
<body class="bg-dark bg-opacity-50">

    @if ($movie->image)
        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }} Image" class="movie-image">
    @else
        <p>No image available</p>
    @endif

    <div class="movie_info_container">
        <h1>{{ $movie->title }}</h1>
        <p>Director: {{ $movie->director }}</p>
        <p>Genre: {{ $movie->genre }}</p>
        <p>Description {{ $movie->description }}</p>
        <p>Average Rating: <span class="text-warning">&#9733;</span> {{ $averageRating }}/5</p>
        <p>Year: {{ $movie->year_release }}</p>
        <iframe width="420" height="345" src="{{ $movie->trailer_link }}"></iframe>
    </div>
    <div class="user_add_review_container">
        @auth
            <a href="" class="">Review</a>
            <form action="{{ route('home.add_review', [Auth::user()->id, $movie->id]) }}" method="POST" class="w-50">
                @csrf
                <label for="star1">Ratings: </label>
                <div id="rating_input" class="rating">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
                </div>
                <br>
                <label for="review_headline">Review Headline</label>
                <br>
                <input type="text" name="review_headline" id="review_headline" required placeholder="Write a headline for your review here" value="{{ old('review_headline') }}">
                @error('review_headline')
                    <small class="text-danger">A required field is missing.</small>
                @enderror
                <br>
                <label for="review">Your Review</label>
                <br>
                <textarea name="review" id="review" cols="50" rows="10" placeholder="Write your review here">{{ old('review') }}</textarea>
                @error('review')
                    <small class="text-danger">A required field is missing.</small>
                @enderror
                <br>
                <button type="submit">Submit</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="">Login to review</a>
        @endauth
    </div>

    @if (session('status'))
    <span>{{session('status')}}</span>
    @endif
    <div class="user_reviews w-50">
        <h3>User reviews :<span>{{ count($userReviews) }}</span></h3>
        @if (count($userReviews) > 0)
            @foreach ($userReviews as $reviews)
                @if ($reviews->user_id === Auth::user()->id)
                <div class="review_container border">
                    <p>By: {{ $reviews->user_name }} <a href="">Edit</a></p>
                    <p><b>{{ $reviews->review_headline }}</b> <span class="text-warning">&#9733;</span> <span>{{ $reviews->rating }}/5</span></p>
                    <p>{{ $reviews->review }}</p>
                </div>
                @else
                <div class="review_container border">
                    <p>By: {{ $reviews->user_name }}</p>
                    <p><b>{{ $reviews->review_headline }}</b> <span class="text-warning">&#9733;</span> <span>{{ $reviews->rating }}/5</span></p>
                    <p>{{ $reviews->review }}</p>
                </div>
                @endif
            @endforeach
        @else
            <p>No Reviews.</p>
        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ratingInputs = document.querySelectorAll('.rating input');
            const rating_hidden = document.querySelector('#rating_hidden');
            ratingInputs.forEach(input => {
                input.addEventListener('change', () => {
                    const selectedValue = input.value;
                    console.log('Selected rating:', selectedValue);
                    rating_hidden.value = selectedValue;
                });
            });
        });
    </script>
</body>
@endsection
