<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spectacles Movies PH</title>
</head>
<body>
    @if (session('user_id'))
        <span>Hello, {{session('user_name')}}</span>
        <a href="{{ route('user.logout') }}">Logout</a>
    @endif
    @if (!session('user_id'))
        <a href="{{ route('user.index') }}">Login/Register</a>
    @endif
    <h1>Home</h1>
    @foreach ($movie_list as $movie)
        <div style="border: 1px solid #000; width: 200px">
            <p>{{ $movie->title }}</p>
            <p>{{ $movie->director }}</p>
            <p>{{ $movie->genre }}</p>
            <p>{{ $movie->description }}</p>
            <p>{{ $movie->year_release }}</p>
            <a href="">Review</a>
        </div>
    @endforeach

</body>
</html>
