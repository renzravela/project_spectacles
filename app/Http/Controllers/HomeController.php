<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
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
        $movie_list = Movie::orderBy('year_release', 'desc')->limit(10)->get();
        return view('User.home', compact('movie_list'));
    }

    public function getAllMovies(Request $request)
    {
        $movie_list = Movie::query();

        // Check if a genre filter is provided
        $genreFilter = $request->input('genre');
        $yearReleaseFilter = $request->input('year_release');

        // If a genre filter is provided, filter movies by genre
        if ($genreFilter) {
            $movie_list->where('genre', $genreFilter);
        }

        if ($yearReleaseFilter) {
            $movie_list->where('year_release', $yearReleaseFilter);
        }

        $movie_list = $movie_list->get();

        // return view('User.home', compact('movie_list'));

        return view('User.home_all_movies', [
            'movie_list' => $movie_list,
            'selectedGenre' => $genreFilter,
            'selectedYearRelease' => $yearReleaseFilter, // Add this line
        ]);
        // return view('User.home_all_movies', compact('movie_list'));
    }

    public function showAbout()
    {
        return view('User.home_about_us');
    }

    public function adminAuth()
    {
        $movie_count = Movie::count();
        $user_count = User::count();
        $review_count = Review::count();
        $movies = Movie::all();

        return view('Movie.movie_dashboard', compact('movies', 'movie_count', 'user_count', 'review_count'));
    }

    public function show($id)
    {
        //
        $userReviews = Review::where('movie_id', $id)->get();
        $averageRating = round(Review::where('movie_id', $id)
            ->avg('rating'));
        $movie = Movie::findOrFail($id);
        return view('User.view_movie', compact('movie', 'userReviews', 'averageRating'));
    }

    public function add_movie_review($userId, $movieId, Request $request)
    {

        $user = User::findOrFail($userId);
        $user_name = $user->first_name . ' ' . $user->last_name;
        $movie = Movie::findOrFail($movieId);

        $hasReviewed = $user->reviews()->where('movie_id', $movieId)->exists();

        if ($hasReviewed) {
            return redirect("/home/$movieId")->with('status', 'You already review this movie.');
        }

        $validatedData = $request->validate([
            'rating' => 'required|numeric',
            'review_headline' => 'required',
            'review' => 'required'
        ]);

        $validatedData = array_merge(['user_id' => $userId, 'user_name' => $user_name, 'movie_id' => $movieId, 'movie_name' => $movie->title], $validatedData);

        $checkUserIfExist = Review::where('user_id', $userId)->where('movie_id', $movieId)->first();

        if ($checkUserIfExist) {
            return redirect("/home/$movieId")->with('status', 'You already submitted a review for this movie.');
        } else {
            Review::create($validatedData);
            return redirect("/home/$movieId")->with('status', 'Review Added!');
        }
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('search');

        $searchResults = Movie::where('title', 'like', "%{$searchTerm}%")->get();

        return view('User.view_search_movie', compact('searchResults', 'searchTerm'));
    }

    public function searchMovies(Request $request)
    {
        $search = $request->input('key');

        $movies = Movie::where('title', 'like', '%' . $search . '%')
            ->orWhere('director', 'like', '%' . $search . '%')
            ->get();

        if ($movies->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No movies found.']);
        }

        return response()->json(['success' => true, 'all_movies' => $movies]);
    }
}