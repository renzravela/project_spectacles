{{-- @extends('layouts.admin_nav')

@section('content')
<body class="bg-dark bg-opacity-50">
    <div class="container">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="content">
                <h1 class="mt-5">MOVIE SECTION</h1>
                <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus"></i> Add Movie</a>
                <table class="table table-hover table-dark" >
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Title</th>
                            <th scope="col">Director</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Description</th>
                            <th scope="col">Year Release</th>
                            <th scope="col">Trailer Link</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <td>
                                    @if ($movie->image)
                                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }} Image" class="movie-image">
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </td>
                                <td>{{ $movie->title }}</td>
                                <td>{{ $movie->director }}</td>
                                <td>{{ $movie->genre }}</td>
                                <td>{{ $movie->description }}</td>
                                <td>{{ $movie->year_release }}</td>
                                <td>{{ $movie->trailer_link }}</td>
                                <td>
                                    <!-- Replace the anchor tag with a button tag -->
                                    <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning mb-1"><i class="bi bi-pencil-square"></i> Update</a>
                                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" id="deleteForm{{ $movie->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger delete-button" data-movie-title="{{ $movie->title }}" data-movie-id="{{ $movie->id }}" type="button"><i class="bi bi-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select all elements with class "delete-button"
            var deleteButtons = document.querySelectorAll('.delete-button');

            // Attach a click event listener to each delete button
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    // Extract movie title and id from the button's data attributes
                    var movieTitle = button.getAttribute('data-movie-title');
                    var movieId = button.getAttribute('data-movie-id');

                    // Show SweetAlert confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You are about to delete the movie: ' + movieTitle,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // If the user clicks "Yes," submit the form
                        if (result.isConfirmed) {
                            document.getElementById('deleteForm' + movieId).submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
@endsection --}}

@extends('layouts.admin_nav')

{{-- <style>
    .movie-image-container {
        border: 1px solid #ccc;
        padding: 5px;
        overflow: hidden;
    }

    .movie-image {
        width: 10rem;
        height: auto;
        display: block;
        margin: auto;
    }
</style> --}}

@section('content')
    @php
        $cnt = 1;
    @endphp

    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="content">
                <h1 class="mt-3"><i class="bi bi-film"></i> MOVIE SECTION</h1>
                <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3"><i class="bi bi-file-earmark-plus-fill"></i> Add Movie</a>

                <!-- Filter Form -->
            <form action="{{ route('movies.index') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="genre"><i class="bi bi-funnel-fill"></i> Filter by Genre:</label>
                        <select class="form-control" id="genre" name="genre">
                            <option value="" {{ request('genre') === '' ? 'selected' : '' }}>All Genres</option>
                            <option value="Action" {{ request('genre') === 'Action' ? 'selected' : '' }}>Action</option>
                            <option value="Drama" {{ request('genre') === 'Drama' ? 'selected' : '' }}>Drama</option>
                            <option value="Sci-Fi" {{ request('genre') === 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                            <option value="Thriller" {{ request('genre') === 'Thriller' ? 'selected' : '' }}>Thriller</option>
                            <option value="Adventure" {{ request('genre') === 'Adventure' ? 'selected' : '' }}>Adventure</option>
                            <option value="Horror" {{ request('genre') === 'Horror' ? 'selected' : '' }}>Horror</option>
                            <option value="Reality" {{ request('genre') === 'Reality' ? 'selected' : '' }}>Reality</option>
                            <option value="Fantasy" {{ request('genre') === 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                            <option value="K-Drama" {{ request('genre') === 'K-Drama' ? 'selected' : '' }}>K-Drama</option>

                            <!-- Add more genres as needed -->
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="year_release"><i class="bi bi-funnel-fill"></i> Filter by Release Year:</label>
                        <input type="number" class="form-control" id="year_release" name="year_release" value="{{ request('year_release') }}" min="1900" max="{{ date('Y') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mt-4"><i class="bi bi-sort-down"></i> Apply Filters</button>
                    </div>
                    <!-- Add a "Clear Filters" button -->
                    <div class="col-md-3">
                        <a href="{{ route('movies.index') }}" class="btn btn-secondary mt-4">Clear Filters</a>
                    </div>
                </div>
            </form>

                <!-- Display Message if No Movies -->
                @if (count($movies) === 0)
                <div class="alert alert-info" role="alert">
                    @if (request('genre') && request('year_release'))
                        No movies found with genre <span style="font-weight: bold;">{{ request('genre') }}</span> in year <span style="font-weight: bold;">{{ request('year_release') }}.</span>
                    @elseif (request('genre'))
                        No movies found with genre <span style="font-weight: bold;">{{ request('genre') }}.</span>
                    @elseif (request('year_release'))
                        No movies found in year <span style="font-weight: bold;">{{ request('year_release') }}.</span>
                    @else
                        No movies found.
                    @endif
                </div>
                @endif


                <!-- Movie Table -->
                <table class="table table-hover">
                    <!-- Table Header -->
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"></th>
                            <th scope="col">Title</th>
                            <th scope="col">Director</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Description</th>
                            <th scope="col">Year Release</th>
                            <th scope="col">Trailer Link</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <td>{{ $cnt++ }}</td>
                                <td>
                                    @if ($movie->image)
                                        <div class="movie-image-container">
                                            <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }} Image" class="movie-image">
                                        </div>
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </td>
                                <td>{{ $movie->title }}</td>
                                <td>{{ $movie->director }}</td>
                                <td>{{ $movie->genre }}</td>
                                <td>{{ $movie->description }}</td>
                                <td>{{ $movie->year_release }}</td>
                                <td>{{ $movie->trailer_link }}</td>
                                <td>
                                    <!-- Replace the anchor tag with a button tag -->
                                    <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning" style="margin-bottom: 5px;"><i class="bi bi-pencil-square"></i> Update</a>
                                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" id="deleteForm{{ $movie->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger delete-button" data-movie-title="{{ $movie->title }}" data-movie-id="{{ $movie->id }}" type="button"><i class="bi bi-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select all elements with class "delete-button"
            var deleteButtons = document.querySelectorAll('.delete-button');

            // Attach a click event listener to each delete button
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    // Extract movie title and id from the button's data attributes
                    var movieTitle = button.getAttribute('data-movie-title');
                    var movieId = button.getAttribute('data-movie-id');

                    // Show SweetAlert confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You are about to delete the movie: ' + movieTitle,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // If the user clicks "Yes," submit the form
                        if (result.isConfirmed) {
                            document.getElementById('deleteForm' + movieId).submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
@endsection
