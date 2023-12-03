<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spectacles - Movie Edit</title>

    <!-- Bootstrap and custom CSS-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="container mt-5">
    <h1>Edit Movie</h1>
    <form action="{{ route('movies.update', $movie->id)}}" method="post" id="updateForm">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title', $movie->title) }}">
            @error('title')
                <small class="text-danger">*required</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" class="form-control" name="director" id="director" placeholder="Director" value="{{ old('director', $movie->director) }}">
            @error('director')
                <small class="text-danger">*required</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" class="form-control" name="genre" id="genre" placeholder="Genre" value="{{ old('genre', $movie->genre) }}">
            @error('genre')
                <small class="text-danger">*required</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{ old('description', $movie->description) }}">
            @error('description')
                <small class="text-danger">*required</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="year_release">Year Release</label>
            <input type="text" class="form-control" name="year_release" id="year_release" placeholder="Year Release" value="{{ old('year_release', $movie->year_release) }}">
            @error('year_release')
                <small class="text-danger">*required</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="trailer_link">Year Release</label>
            <input type="text" class="form-control" name="trailer_link" id="trailer_link" placeholder="Trailer Link" value="{{ old('trailer_link', $movie->trailer_link) }}">
            @error('trailer_link')
                <small class="text-danger">*required</small>
            @enderror
        </div>

        <br>
        <button type="button" class="btn btn-primary" id="updateButton">Update</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var updateButton = document.getElementById('updateButton');
            var updateForm = document.getElementById('updateForm');

            updateButton.addEventListener('click', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to update the movie.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        updateForm.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
