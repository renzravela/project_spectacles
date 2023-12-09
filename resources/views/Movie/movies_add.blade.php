{{-- @extends('layouts.admin_nav')

@section('content')
<body class="bg-dark bg-opacity-50">
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Add Movie</h1>
                <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title') }}">
                        @error('title')
                            <small class="text-danger">*required</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="director">Director</label>
                        <input type="text" class="form-control" name="director" id="director" placeholder="Director" value="{{ old('director') }}">
                        @error('director')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select class="form-control" name="genre" id="genre">
                            <option value="" disabled selected>Select genre</option>
                            <option value="Action">Action</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Drama">Drama</option>
                            <!-- Add more genre options as needed -->
                        </select>
                        @error('genre')
                            <small class="text-danger">*required</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{ old('description') }}">
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="year_release">Year Release</label>
                        <input type="text" class="form-control" name="year_release" id="year_release" placeholder="Year Release" value="{{ old('year_release') }}">
                        @error('year_release')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Choose Image</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="trailer_link">Trailer Link</label>
                        <input type="text" class="form-control" name="trailer_link" id="trailer_link" placeholder="Trailer Link" value="{{ old('trailer_link') }}">
                        @error('trailer_link')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add</button>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection --}}

@extends('layouts.admin_nav')

@section('content')
<body>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Add Movie</h1>
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title') }}">
                    @error('title')
                        <small class="text-danger">*required</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="director">Director</label>
                    <input type="text" class="form-control" name="director" id="director" placeholder="Director" value="{{ old('director') }}">
                    @error('director')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <select class="form-control" name="genre" id="genre">
                        <option value="" disabled selected>Select genre</option>
                        <option value="Action">Action</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Drama">Drama</option>
                        <option value="Adventure">Adventure</option>
                        <option value="Horror">Horror</option>
                        <option value="Thriller">Thriller</option>
                        <option value="Sci-Fi">Sci-Fi</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Reality">Reality</option>
                        <option value="K-Drama">K-Drama</option>
                    </select>
                    @error('genre')
                        <small class="text-danger">*required</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    {{-- <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{ old('description') }}"> --}}
                    <textarea class="form-control" name="description" id="description" placeholder="Description">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="year_release">Year Release</label>
                    <input type="text" class="form-control" name="year_release" id="year_release" placeholder="Year Release" value="{{ old('year_release') }}">
                    @error('year_release')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Choose Image</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="trailer_link">Trailer Link</label>
                    <input type="text" class="form-control" name="trailer_link" id="trailer_link" placeholder="Trailer Link" value="{{ old('trailer_link') }}">
                    @error('trailer_link')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add</button>
            </form>
            </div>
        </div>
    </div>
</body>
@endsection
