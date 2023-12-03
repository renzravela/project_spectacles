<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $movie->title }}</title>
</head>
<body>
    <h1>{{ $movie->title }}</h1>
    @if (session('user_id'))
    <a href="" class="btn btn-outline-light">Review</a>
    @endif
    @if (!session('user_id'))
        <a href="" class="nav-link text-light">Login to review</a>
    @endif
</body>
</html>
