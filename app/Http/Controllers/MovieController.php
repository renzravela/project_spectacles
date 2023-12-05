<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $movies = Movie::all();
        return view('Movie.movie_home')->with(compact('movies'));
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
                return redirect('/admin')->with('error', 'Error uploading image: ' . $e->getMessage());
            }
        } else {
            // If no image is provided, set 'image' to a default value ("default-image-path" in this case)
            $validatedData['image'] = "default-image-path";
        }

        $validatedData['trailer_link'] = preg_replace('/(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)/', 'https://www.youtube.com/embed/', $validatedData['trailer_link']);

        // Create a new movie with the validated data
        Movie::create($validatedData);

        // Redirect to a specific route after adding the movie
        return redirect('/admin')->with('status', 'Movie added successfully');
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
    public function update(Request $request, $id)
    {
        //
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required',
            'director' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'year_release' => 'required',
            'trailer_link' => 'required'
        ]);

        // Find the movie by its ID
        $movie = Movie::findOrFail($id);

        // Update the movie with the validated data
        $movie->update($validatedData);

        // Redirect back to the movies index page
        return redirect('/admin')->with('status', 'Movie updated successfully');
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
        return redirect('/admin');
    }
}
