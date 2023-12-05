<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $movie_list = Movie::all();
        return view('User.home', compact('movie_list'));
    }

    public function adminAuth()
    {
        $movies = Movie::all();
        return view('Movie.movie_home')->with(compact('movies'));
    }

    public function show($id)
    {
        //
        $movie = Movie::findOrFail($id);
        return view('User.view_movie', compact('movie'));
    }
}
