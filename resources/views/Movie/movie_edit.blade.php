<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spectacles - Movie Edit</title>
</head>
<body>
    <h1>Edit Movie</h1>
    <form action="{{ route('movies.update', $movie->id)}}" method="post">
        @csrf
        @method('PUT')
        {{-- <input type="hidden" name="id" value="{{ $movie->id }}"> --}}
        <input type="text" name="title" placeholder="Title" value="{{ old('title', $movie->title) }}">
        @error('title')
        <span style="color:red">*required</span>
        @enderror
        <br>
        <input type="text" name="director" placeholder="Director" value="{{ old('director', $movie->director) }}">
        @error('director')
        <span style="color: red">*required</span>
        @enderror
        <input type="text" name="genre" placeholder="Genre" value="{{ old('genre', $movie->genre) }}">
        @error('genre')
        <span style="color: red">*required</span>
        @enderror
        <input type="text" name="description" placeholder="Description" value="{{ old('description', $movie->description) }}">
        @error('description')
        <span style="color: red">*required</span>
        @enderror
        <input type="text" name="year_release" placeholder="Year Release" value="{{ old('year_release', $movie->year_release) }}">
        @error('year_release')
        <span style="color: red">*required</span>
        @enderror
        {{-- <br>
        <input type="text" name="email" placeholder="Email" value="{{ old('email', $user->email) }}">
        @error('email')
            <span style="color:red">{{ $message }}</span>
        @enderror
        <br> --}}
        <input type="submit" value="Update">
    </form>
</body>
</html>
