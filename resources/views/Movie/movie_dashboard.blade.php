@extends('layouts.admin_nav')

@section('content')
<body class="bg-dark bg-opacity-50">
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="jumbotron text-center">
                    <h1 class="display-4"><i class="bi bi-person-circle"></i> Hello, {{ Auth::user()->first_name }}!</h1>
                    <p class="lead">Welcome to your admin dashboard.</p>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-secondary bg-gradient mb-3" style="max-width: 18rem;">
                            <div class="card-header"><i class="bi bi-camera-reels"></i> Movies</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie_count }} <i class="bi bi-film"></i></h5>
                                <p class="card-text">Total Number of movies.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-white bg-success bg-gradient mb-3" style="max-width: 18rem;">
                            <div class="card-header"><i class="bi bi-people"></i>  Users</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $user_count }} <i class="bi bi-people-fill"></i></h5>
                                <p class="card-text">Total Number of users.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-white bg-primary bg-gradient mb-3" style="max-width: 18rem;">
                            <div class="card-header"><i class="bi bi-list-stars"></i> Reviews</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $review_count }} <i class="bi bi-person-lines-fill"></i></h5>
                                <p class="card-text">Total Number of reviews.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
