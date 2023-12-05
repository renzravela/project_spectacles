@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - Movies</title>

    <!-- Bootstrap and custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap JS and dependencies (jQuery, Popper.js) -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

</head>
<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="sidebar-sticky ">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-light" href="#">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">
                                <i class="bi bi-film"></i> Movies
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>


            <!-- Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="content">
                <h1 class="mt-5">MOVIE SECTION</h1>
                <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Add Movie</a>
                <table class="table">
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
                                    <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning" style="margin-bottom: 5px;">Update</a>
                                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" id="deleteForm{{ $movie->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger delete-button" data-movie-title="{{ $movie->title }}" data-movie-id="{{ $movie->id }}" type="button">Delete</button>
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
</html>
@endsection
