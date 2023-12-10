<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;
use Validator;
use Exception;


class FacebookController extends Controller
{
    public function provider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleCallback()
    {
        try {
            $fb_user = Socialite::driver('facebook')->stateless()->user();
            $user = User::where('fb-id', $fb_user->id)->first();

            // dd($user, $fb_user);

            if ($user === null) {
                $new_user = User::create([
                    'user_type' => 'client',
                    'first_name' => $fb_user->name,
                    'last_name' => $fb_user->name,
                    'email' => $fb_user->email,
                    'fb-id' => $fb_user->id,
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
