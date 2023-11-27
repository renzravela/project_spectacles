<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Models\Movie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $user_email = $request->input('email');
        $user_password = $request->input('password');

        $checkUser = User::where('email', $user_email)->first();

        if ($checkUser && Hash::check($user_password, $checkUser->password)) {

            session(['user_id' => $checkUser->id, 'user_name' => $checkUser->first_name]);
            return redirect()->route('user.dashboard');
        }

        $login_response = 'Login failed! ' . (!$checkUser ? 'Email not found.' : 'Incorrect password.');
        return redirect('/user')->with('login_response', $login_response);
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_name']);
        $movie_list = Movie::all();
        return view('User.home', compact('movie_list'));
    }

    public function dashboard()
    {
        $movie_list = Movie::all();
        return view('User.home', compact('movie_list'));
    }

    public function index()
    {
        //

        return view('User.login_user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('User.register_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user_email = $request->input('email');

        $checkEmail = User::where('email', $user_email)->get();

        if ($checkEmail->count() > 0) {
            //Email Exist
            $register_response = 'Email already registered! Please use other email.';
            return redirect('/user/create')->with('register_response', $register_response);
        } else {
            $request->merge([
                'password' => Hash::make($request->input('password'))
            ]);

            $validatedData = $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (!User::create($validatedData)) {
                $register_response = 'Registration unsuccessful. Please try again.';
                return redirect('/user')->with('register_response', $register_response);
            } else {
                $register_response = 'Registration success. Log in now.';
                return redirect('/user')->with('register_response', $register_response);
            }
        }
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
    }
}
