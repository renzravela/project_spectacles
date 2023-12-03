<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spectacles - Add Movie</title>

    <!-- Bootstrap and custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    
</head>
<body class="container mt-5">
    <h1>Add Movie</h1>
    <form action="/movies" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title') }}">
            @error('title')
                <small class="text-danger">*required</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" class="form-control" name="director" id="director" placeholder="Director" value="{{ old('director') }}">
            @error('director')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" class="form-control" name="genre" id="genre" placeholder="Genre" value="{{ old('genre') }}">
            @error('genre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{ old('description') }}">
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="year_release">Year Release</label>
            <input type="text" class="form-control" name="year_release" id="year_release" placeholder="Year Release" value="{{ old('year_release') }}">
            @error('year_release')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Choose Image</label>
            <input type="file" class="form-control-file" name="image" id="image">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <br>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>

</body>
</html>
