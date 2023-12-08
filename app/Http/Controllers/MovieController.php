<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $movies = Movie::all();

    //     return view('Movie.movie_home', compact('movies'));
    // }

    public function index(Request $request)
    {
        // Get all movies
        $movies = Movie::query();

        // Check if a genre filter is provided
        $genreFilter = $request->input('genre');
        $yearReleaseFilter = $request->input('year_release');


        // If a genre filter is provided, filter movies by genre
        if ($genreFilter) {
            $movies->where('genre', $genreFilter);
        }

        if ($yearReleaseFilter) {
            $movies->where('year_release', $yearReleaseFilter);
        }

        // Retrieve the filtered movies
        $movies = $movies->get();

        return view('Movie.movie_home', [
            'movies' => $movies,
            'selectedGenre' => $genreFilter,
            'selectedYearRelease' => $yearReleaseFilter, // Add this line
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Movie.movies_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required',
            'director' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'year_release' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'trailer_link' => 'required'
        ]);

        // Check if an image is provided
        if ($request->hasFile('image')) {
            try {
                // Handle file upload if an image is provided
                $imagePath = $request->file('image')->store('movies/images', 'public');
                $validatedData['image'] = $imagePath;
            } catch (\Exception $e) {
                // Handle any exceptions during file upload
                return redirect('/admin/movies')->with('error', 'Error uploading image: ' . $e->getMessage());
            }
        } else {
            // If no image is provided, set 'image' to a default value ("default-image-path" in this case)
            $validatedData['image'] = "default-image-path";
        }

        $validatedData['trailer_link'] = preg_replace('/(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)/', 'https://www.youtube.com/embed/', $validatedData['trailer_link']);

        // Create a new movie with the validated data
        Movie::create($validatedData);

        // Redirect to a specific route after adding the movie
        return redirect('/admin/movies')->with('status', 'Movie added successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $movie = Movie::find($id);

        return view('Movie.movie_edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    //     // Validate the incoming request data
    //     $validatedData = $request->validate([
    //         'title' => 'required',
    //         'director' => 'required',
    //         'genre' => 'required',
    //         'description' => 'required',
    //         'year_release' => 'required',
    //         'trailer_link' => 'required'
    //     ]);

    //     // Find the movie by its ID
    //     $movie = Movie::findOrFail($id);

    //     // Update the movie with the validated data
    //     $movie->update($validatedData);

    //     // Redirect back to the movies index page
    //     return redirect('/admin')->with('status', 'Movie updated successfully');
    // }


    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required',
            'director' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'year_release' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'trailer_link' => 'required'
        ]);

        // Find the movie by its ID
        $movie = Movie::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($movie->image) {
                Storage::delete($movie->image);
            }
            // Upload the new image
            try {
                $imagePath = $request->file('image')->store('movies/images', 'public');
                $validatedData['image'] = $imagePath;
            } catch (\Exception $e) {
                // Handle any exceptions during file upload
                return redirect('/movies')->with('error', 'Error uploading image: ' . $e->getMessage());
            }
        }

        // Update the movie with the validated data
        $movie->update($validatedData);

        // Redirect back to the movies index page
        return redirect('/admin/movies')->with('status', 'Movie updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect('/admin/movies');
    }

    public function getUsers()
    {
        $users = User::all();

        return view('Movie.movie_users', compact('users'));
    }
}
