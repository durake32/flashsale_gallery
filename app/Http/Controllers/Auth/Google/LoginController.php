<?php

namespace App\Http\Controllers\Auth\Google;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Auth;

use Exception;

use App\Models\User;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller

{

    use AuthenticatesUsers;

    public function __construct()

    {

        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()

    {
        return Socialite::driver('google')->redirect();

    }

    public function handleGoogleCallback()

    {

        try {

            $user = Socialite::driver('google')->user();

            $oauth_id = $user->getId();

            $finduser = User::where('google_id', $oauth_id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/');
            } else {

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

                    'random_id' => Str::random(10),

                    'google_id' => $oauth_id,

                    'password' => Hash::make($user->name . '@123456')

                ]);

                Auth::login($newUser);

                return redirect('/');
            }
        } catch (Exception $e) {

           $errors = $e->getMessage();
          
              return redirect('/')->with(['error' => 'Email Already Register.']);
        }
    }
  
  
    public function redirectToFacebook()

    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()

    {

        try {

            $user = Socialite::driver('facebook')->user();

            if($user->email == null){
                return redirect('/')->with(['error' => 'Email is empty.']);
            }

            $oauth_id = $user->getId();
            $finduser = User::where('facebook_id', $oauth_id)->first();
            if ($finduser) {

                Auth::login($finduser);

                return redirect('/');
            } else {

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

                    'random_id' => Str::random(10),

                    'facebook_id' => $oauth_id,

                    'password' => Hash::make($user->name . '@123456')

                ]);

                Auth::login($newUser);

                return redirect('/');
            }
        } catch (Exception $e) {

           $errors = $e->getMessage();
          
              return redirect('/')->with(['error' => 'Email Already Register.']);
        }
    }
}