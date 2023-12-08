@extends('layouts.admin_nav')

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
@endsection
