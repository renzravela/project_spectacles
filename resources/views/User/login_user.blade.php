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

    {{-- Sweet Alerts --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Login</title>

    <style>
        body {
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
    {{-- @if (session('register_response'))
    <span>{{ session('register_response') }}</span>
    @endif --}}
    <div class="text-center">
        <h1>Login</h1>
        <form action="{{ route('user.login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="login_user_email">Email</label>
                <input type="email" class="form-control" name="email" id="login_user_email" required>
            </div>

            <div class="form-group">
                <label for="login_user_password">Password</label>
                <input type="password" class="form-control" name="password" id="login_user_password" required>
            </div>

        </br>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="mt-3">Don't have an account? <a href="{{ route('user.create') }}">Register</a></p>
    </div>

    @if(session('login_response'))
        <script>
            // Display SweetAlert based on the login response
            Swal.fire({
                icon: 'error',
                title: 'Login Failed!',
                text: '{{ session('login_response') }}',
            });
        </script>
    @endif

    @if(session('register_response'))
        <script>
            // Display SweetAlert based on the login response
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful!',
                text: '{{ session('register_response') }}',
            });
        </script>
    @endif
</body>
</html>
