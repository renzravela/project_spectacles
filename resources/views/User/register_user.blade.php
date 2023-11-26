<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    @if (session('register_response'))
    <span>{{session('register_response')}}</span>
    @endif
    <h1>Register</h1>
    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <label for="register_user_first_name">First Name</label>
        <input type="text" name="first_name" id="register_user_first_name">
        <br>
        <label for="register_user_last_name">Last Name</label>
        <input type="text" name="last_name" id="register_user_last_name">
        <br>
        <label for="register_user_email">Email</label>
        <input type="email" name="email" id="register_user_email">
        <br>
        <label for="login_user_password">Password</label>
        <input type="password" name="password" id="register_user_password">
        <br>
        <button type="submit">Register</button>
    </form>
    <a href="{{ route('user.index') }}">Login</a>
</body>
</html>
