<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class FacebookController extends Controller
{
    public function provider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handelCallback()
    {
        try {
            $fb_user = Socialite::driver('google')->user();
            $user = User::where('email', $fb_user->getEmail())->first();

            if (!$user) {
                $new_user = User::create([
                    'user_type' => 'client',
                    'first_name' => $fb_user->user['given_name'],
                    'last_name' => $fb_user->user['family_name'],
                    'email' => $fb_user->getEmail(),
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
