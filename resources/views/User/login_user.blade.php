<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    @if (session('register_response'))
    <span>{{session('register_response')}}</span>
    @endif
    @if (session('login_response'))
    <span>{{session('login_response')}}</span>
    @endif
    <h1>Login</h1>
    <form action="{{ route('user.login') }}" method="GET">
        @csrf

        <label for="login_user_email">Email</label>
        <input type="email" name="email" id="login_user_email" required>

        <br>

        <label for="login_user_password">Password</label>
        <input type="password" name="password" id="login_user_password" required>

        <br>

        <button type="submit">Login</button>
    </form>
    <a href="{{ route('user.create') }}">Register</a>
</body>
</html>
