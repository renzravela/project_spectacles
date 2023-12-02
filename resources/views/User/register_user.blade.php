<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

     <!-- Add Bootstrap JS and Popper.js links -->
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <title>Register</title>

    <style>
        body {
            padding: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        form {
            max-width: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    @if (session('register_response'))
    <span>{{ session('register_response') }}</span>
    @endif
    <div class="text-center">
        <h1>Register</h1>
        <form action="{{ route('user.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="register_user_first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="register_user_first_name" required>
            </div>

            <div class="form-group">
                <label for="register_user_last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="register_user_last_name" required>
            </div>

            <div class="form-group">
                <label for="register_user_email">Email</label>
                <input type="email" class="form-control" name="email" id="register_user_email" required>
            </div>

            <div class="form-group">
                <label for="register_user_password">Password</label>
                <input type="password" class="form-control" name="password" id="register_user_password" required>
            </div>

        </br>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p class="mt-3">Already have an account? <a href="{{ route('user.index') }}">Login</a></p>
    </div>

</body>
</html>
