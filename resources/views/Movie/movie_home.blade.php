<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spectacles - Home</title>

    <style>
        .movie-image {
    width: 200px;
    height: 300px;
    /* Add any additional styling here */
}
    </style>
</head>
<body>
    <h1>MOVIE SECTION</h1>
    <a href="/movies/create">Add Movie</a>
    <table>
        <thead>
            <th></th>
            <th>Title</th>
            <th>Director</th>
            <th>Genre</th>
            <th>Description</th>
            <th>Year Release</th>
            <th>Action</th>
        </thead>

        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>@if ($movie->image)
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
                    <td>
                        <a href="/movies/{{ $movie->id }}/edit">Update</a>
                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
