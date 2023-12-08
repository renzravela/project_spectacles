@extends('layouts.admin_nav')

@section('content')

@php
    $cnt = 1;
@endphp
<body>
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="content">
                <h1 class="mt-5">USERS SECTION</h1>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Type</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date Created</th>
                            {{-- <th scope="col">Action</th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $cnt++ }}</td>
                                <td>{{ $user->user_type }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                {{-- <td>
                                    <!-- Replace the anchor tag with a button tag -->
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning" style="margin-bottom: 5px;">Update</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" id="deleteForm{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger delete-button" data-user-first_name="{{ $user->first_name }}" data-user-id="{{ $user->id }}" type="button">Delete</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select all elements with class "delete-button"
            var deleteButtons = document.querySelectorAll('.delete-button');

            // Attach a click event listener to each delete button
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    // Extract movie title and id from the button's data attributes
                    var movieTitle = button.getAttribute('data-movie-title');
                    var movieId = button.getAttribute('data-movie-id');

                    // Show SweetAlert confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You are about to delete the movie: ' + movieTitle,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // If the user clicks "Yes," submit the form
                        if (result.isConfirmed) {
                            document.getElementById('deleteForm' + movieId).submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
@endsection
