@extends('layouts.admin_nav')

@section('content')
{{-- <body>
    <div class="container-fluid mt-5">
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
    </div>

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
</body> --}}
<body>
    <div class="container-fluid mt-5">
        <h1>Edit Movie</h1>
        <form action="{{ route('movies.update', $movie->id)}}" method="post" id="updateForm"  enctype="multipart/form-data">
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
                <select class="form-control" name="genre" id="genre">
                    <option value="{{ $movie->genre }}" selected>{{ old('genre', $movie->genre) }}</option>
                    <option value="Action" {{ old('genre') === 'Action' ? 'selected' : '' }}>Action</option>
                    <option value="Comedy" {{ old('genre') === 'Comedy' ? 'selected' : '' }}>Comedy</option>
                    <option value="Drama" {{ old('genre') === 'Drama' ? 'selected' : '' }}>Drama</option>
                    <option value="Adventure" {{ old('genre') === 'Adventure' ? 'selected' : '' }}>Adventure</option>
                    <option value="Horror" {{ old('genre') === 'Horror' ? 'selected' : '' }}>Horror</option>
                    <option value="Thriller" {{ old('genre') === 'Thriller' ? 'selected' : '' }}>Thriller</option>
                    <option value="Sci-Fi" {{ old('genre') === 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                    <option value="Fantasy" {{ old('genre') === 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                    <option value="Reality" {{ old('genre') === 'Reality' ? 'selected' : '' }}>Reality</option>
                    <option value="K-Drama" {{ old('genre') === 'K-Drama' ? 'selected' : '' }}>K-Drama</option>
                </select>
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
                <label for="image">Choose Image</label>
                <input type="file" class="form-control-file" name="image" id="image" placeholder="Movie Image" value="{{ old('image', $movie->image) }}">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="trailer_link">Trailer Link</label>
                <input type="text" class="form-control" name="trailer_link" id="trailer_link" placeholder="Trailer Link" value="{{ old('trailer_link', $movie->trailer_link) }}">
                @error('trailer_link')
                    <small class="text-danger">*required</small>
                @enderror
            </div>
            <br>
            <button type="button" class="btn btn-primary" id="updateButton">Update</button>
        </form>
    </div>

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
@endsection
