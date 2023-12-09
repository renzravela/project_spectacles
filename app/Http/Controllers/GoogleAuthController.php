<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Throwable;

class GoogleAuthController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google-id', $google_user->getId())->first();

            if ($user === null) {
                $new_user = User::create([
                    'user_type' => 'client',
                    'first_name' => $google_user->user['given_name'],
                    'last_name' => $google_user->user['family_name'],
                    'email' => $google_user->getEmail(),
                    'google-id' => $google_user->getId(),
                ]);

                Auth::login($new_user);

                return redirect()->intended('home');
            } else {
                Auth::login($user);
                return redirect()->intended('home');
            }
        } catch (Throwable $th) {
            dd('Something is wrong!' . $th->getMessage());
        }
    }
}
