<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SocialiteController extends Controller
{

    private $provider;
    private $access_provider_token;
    private $token;

    public function __construct(Request $request)
    {
        $this->provider = ($request->has('provider') ? $request->get('provider') : false);
        $this->access_provider_token = ($request->has('access_provider_token') ? $request->get('access_provider_token') : false);
    }

    
    public function googlehandleProviderCallback()
    {
        // authenticate the token against the provider
        $user = Socialite::driver($this->provider)->stateless()->userFromToken($this->access_provider_token);

        // find or create an authenticated user
        if (!$authenticatedUser = User::where('google_id', $user->id)->first()) {
            $authenticatedUser = User::create([
                'email' => $user->email,
                'name' => $user->name,
                'random_id' => Str::random(10),
                'password' => Hash::make($user->name .'@123456'),
                'google_id' => $user->id
            ]);
        }

        $authenticatedUser = User::find($authenticatedUser->id);
        // login the user & get an access token for the API
        $this->token = auth()->guard('api')->login($authenticatedUser);

        // respond with the access token
        return $this->respondWithToken($this->token,$authenticatedUser,200,'Login Success');
    }
  
  
    public function facebookhandleProviderCallback()
    {
        $user = Socialite::driver($this->provider)->stateless()->userFromToken($this->access_provider_token);

        if($user->email == null){
            return $this->respondWithToken(null,null,204,'User Email is Empty. Please Provide Your Email');            
        }
        if (!$authenticatedUser = User::where('facebook_id', $user->id)->first()) {
            $authenticatedUser = User::create([
                'email' => $user->email,
                'name' => $user->name,
                'random_id' => Str::random(10),
                'password' => Hash::make($user->name .'@123456'),
                'facebook_id' => $user->id
            ]);
        }
        $authenticatedUser = User::find($authenticatedUser->id);

        $this->token = auth()->guard('api')->login($authenticatedUser);

        return $this->respondWithToken($this->token,$authenticatedUser,200,'Login Success');
    }
    protected function respondWithToken($token,$user,$status,$message)
    {
        return response()->json([
            'status' => $status,
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
            'message'=> $message,
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}