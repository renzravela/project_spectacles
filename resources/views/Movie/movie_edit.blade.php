@extends('layouts.admin_nav')

@section('content')
<body>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Edit Movie</h1>
                <form action="{{ route('movies.update', $movie->id)}}" method="post" id="updateForm" enctype="multipart/form-data">
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
                            <!-- Add more genre options as needed -->
                        </select>
                        @error('genre')
                            <small class="text-danger">*required</small>
                        @enderror
                    </div>
                    <!-- Add other form fields as needed -->

                    <div class="form-group">
                        <label for="trailer_link">Trailer Link</label>
                        <input type="text" class="form-control" name="trailer_link" id="trailer_link" placeholder="Trailer Link" value="{{ old('trailer_link', $movie->trailer_link) }}">
                        @error('trailer_link')
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
                        <label for="year_release">Year Release</label>
                        <input type="text" class="form-control" name="year_release" id="year_release" placeholder="Year Release" value="{{ old('year_release', $movie->year_release) }}">
                        @error('year_release')
                            <small class="text-danger">*required</small>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary mt-3" id="updateButton"><i class="bi bi-pencil"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
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
