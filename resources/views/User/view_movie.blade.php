@extends('layouts.nav')

@section('title', $movie->title)

@section('content')
<body class="bg-dark bg-opacity-50">
    <div class="container mx-auto mt-4 text-dark"> <!-- Added mx-auto class for centering -->
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        @if ($movie->image)
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }} Image"
                            class="img-fluid rounded movie-image shadow" style="width:100%; height: 450px;">
                        @else
                        <p>No image available</p>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <iframe class="embed-responsive-item shadow" src="{{ $movie->trailer_link }}" allowfullscreen
                            style="width:100%; height: 450px;"></iframe>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h1>{{ $movie->title }} <span class="text-warning">&#9733;{{ $averageRating }}/5</span></h1>
                        <p><strong>Director:</strong> {{ $movie->director }}</p>
                        <p><strong>Genre:</strong> {{ $movie->genre }}</p>
                        <p><strong>Description:</strong> {{ $movie->description }}</p>
                        <p><strong>Year:</strong> {{ $movie->year_release }}</p>
                    </div>
                </div>
            </div>
        </div>

        @auth
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#reviewModal">
                        <i class="bi bi-plus"></i>Add Review
                    </button>
                    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('home.add_review', [Auth::user()->id, $movie->id]) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="rating">Ratings:</label>
                                            <div class="rating">
                                                <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
                                                <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
                                                <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
                                                <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
                                                <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="review_headline">Review Headline</label>
                                            <input type="text" name="review_headline" id="review_headline"
                                                class="form-control" required
                                                placeholder="Write a headline for your review here"
                                                value="{{ old('review_headline') }}">
                                            @error('review_headline')
                                                <small class="text-danger">A required field is missing.</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="review">Your Review</label>
                                            <textarea name="review" id="review" class="form-control" rows="5"
                                                placeholder="Write your review here">{{ old('review') }}</textarea>
                                            @error('review')
                                                <small class="text-danger">A required field is missing.</small>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-3">
                <div class="col-md-12">
                    <a href="{{ route('login') }}" class="btn btn-primary">Login to review</a>
                </div>
            </div>
        @endauth

        @if (session('status'))
        <div class="row mt-3">
            <div class="col-md-12">
                <span>{{ session('status') }}</span>
            </div>
        </div>
        @endif

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>User reviews: <span>{{ count($userReviews) }}</span></h3>
                @if (count($userReviews) > 0)
                    @foreach ($userReviews as $reviews)
                        @auth
                            @if($reviews->user_id === Auth::user()->id)
                                <div class="card mb-3" style="width: 50rem;">
                                    <div class="card-body shadow">
                                        <h5 class="card-title">{{ $reviews->review_headline }} <span><a href="">Edit</a></span></h5>
                                        <p class="card-text">{{ $reviews->review }}</p>
                                        <p class="card-text"><strong>Rating:</strong> {{ $reviews->rating }}/5</p>
                                    </div>
                                </div>
                            @else
                                <div class="card mb-3" style="width: 50rem;">
                                    <div class="card-body shadow">
                                        <h5 class="card-title">{{ $reviews->review_headline }}</h5>
                                        <p class="card-text">{{ $reviews->review }}</p>
                                        <p class="card-text"><strong>Rating:</strong> {{ $reviews->rating }}/5</p>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="card mb-3" style="width: 50rem;">
                                <div class="card-body shadow">
                                    <h5 class="card-title">{{ $reviews->review_headline }}</h5>
                                    <p class="card-text">{{ $reviews->review }}</p>
                                    <p class="card-text"><strong>Rating:</strong> {{ $reviews->rating }}/5</p>
                                </div>
                            </div>
                        @endauth
                    @endforeach
                @else
                    <p>No Reviews.</p>
                @endif
            </div>
        </div>
    </div>
</body>
@include('layouts.footer')
@endsection


{{--
@extends('layouts.nav')

@section('title', $movie->title)

@section('content')
<body>
    <div class="container mt-4 text-dark">
        <div class="row">
            <div class="col-md-3">
                @if ($movie->image)
                    <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }} Image" class="img-fluid rounded movie-image">
                @else
                    <p>No image available</p>
                @endif
            </div>

            <div class="col-md-9">
                <h1 class="fw-bolder">{{ $movie->title }}</h1>
                <p >Director:{{ $movie->director }}</p>
                <p >Genre: {{ $movie->genre }}</p>
                <p>Description: {{ $movie->description }}</p>
                <p>Year: {{ $movie->year_release }}</p>

                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{ $movie->trailer_link }}" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        @auth
            <div class="row mt-3">
                <div class="col-md-12">
                    <a href="#" class="btn btn-primary mb-3">Write a Review</a>
                    <form action="{{ route('home.add_review', [Auth::user()->id, $movie->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="rating">Ratings:</label>
                            <div class="rating">
                                <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
                                <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
                                <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
                                <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
                                <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="review_headline">Review Headline</label>
                            <input type="text" name="review_headline" id="review_headline" class="form-control" required placeholder="Write a headline for your review here" value="{{ old('review_headline') }}">
                            @error('review_headline')
                                <small class="text-danger">A required field is missing.</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="review">Your Review</label>
                            <textarea name="review" id="review" class="form-control" rows="5" placeholder="Write your review here">{{ old('review') }}</textarea>
                            @error('review')
                                <small class="text-danger">A required field is missing.</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        @else
            <div class="row mt-3">
                <div class="col-md-12">
                    <a href="#" class="btn btn-primary">Login to review</a>
                </div>
            </div>
        @endauth

        @if (session('status'))
            <div class="row mt-3">
                <div class="col-md-12">
                    <span>{{ session('status') }}</span>
                </div>
            </div>
        @endif

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>User reviews <span>{{ count($userReviews) }}</span></h3>
                @if (count($userReviews) > 0)
                    @foreach ($userReviews as $reviews)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $reviews->review_headline }}</h5>
                                <p class="card-text">{{ $reviews->review }}</p>
                                <p class="card-text"><strong>Rating:</strong> {{ $reviews->rating }}/5</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No Reviews.</p>
                @endif
            </div>
        </div>
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
@endsection --}}
