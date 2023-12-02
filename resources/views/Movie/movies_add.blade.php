<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spectacles - Add Movie</title>
</head>
<body>
    <h1>Add Movie</h1>
    <form action="/movies" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="Title" value="{{ old('title') }}">
        @error('title')
            <span style="color: red">*required</span>
        @enderror
        <br>
        <input type="text" name="director" placeholder="Director" value="{{ old('director') }}">
        @error('director')
            <span style="color: red">{{ $message }}</span>
        @enderror
        <br>
        <input type="text" name="genre" placeholder="Genre" value="{{ old('genre') }}">
        @error('genre')
            <span style="color: red">{{ $message }}</span>
        @enderror
        <br>
        <input type="text" name="description" placeholder="Description" value="{{ old('description') }}">
        @error('description')
            <span style="color: red">{{ $message }}</span>
        @enderror
        <br>
        <input type="text" name="year_release" placeholder="Year Release" value="{{ old('year_release') }}">
        @error('year_release')
            <span style="color: red">{{ $message }}</span>
        @enderror
        <br>
        <br>
            {{-- <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input">
                </div>
            </div>
            <br> --}}
        <input type="file" name="image">
        @error('image')
            <span style="color: red">{{ $message }}</span>
        @enderror
        <br>
        <br>
        <input type="submit" value="Add">
    </form>
</body>
</html>
