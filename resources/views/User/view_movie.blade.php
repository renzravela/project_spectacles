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
    {{-- <p>Director: {{ $movie->director }}</p>
    <p>Genre: {{ $movie->genre }}</p>
    <p>Description {{ $movie->description }}</p>
    <p>Year: {{ $movie->year_release }}</p>

    <iframe width="420" height="345" src="{{ $movie->trailer_link }}"></iframe> --}}

    <br>
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
        <a href="" class="">Login to review</a>
    @endauth

    @if (session('status'))
    <span>{{session('status')}}</span>
    @endif
    <div class="user_reviews">
        <h3>User reviews <span>{{ count($userReviews) }}</span></h3>
        @if (count($userReviews) > 0)
            @foreach ($userReviews as $reviews)
                <div class="review_container">
                    <p>{{ $reviews->review_headline }}</p>
                    <p>{{ $reviews->review }}</p>
                    <p>{{ $reviews->rating }}</p>
                </div>
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
                    // You can send the selected value to the server using an AJAX request if needed.
                });
            });
        });
    </script>
</body>
@endsection
