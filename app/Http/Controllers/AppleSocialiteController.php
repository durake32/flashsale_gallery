<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class AppleSocialiteController extends Controller
{
    private $provider;
    private $access_token;
    private $token;
    public function __construct(Request $request)
    {
        $this->provider = ($request->has('provider') ? $request->get('provider') : false);
        $this->access_token = ($request->has('access_provider_token') ? $request->get('access_provider_token') : false);
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

    public function callback(Request $request)
    {
        // authenticate the token against the provider
        $user = Socialite::driver($this->provider)->stateless()->userFromToken($this->access_token);
        // find or create an authenticated user
        if (!$authenticatedUser = User::where('apple_id', $user->getId())->first()) {
            $authenticatedUser = User::create([
                'email' => $user->email,
                'name' => $user->name ?? $user->email,
                'random_id' => Str::random(10),
                'password' => Hash::make($user->name .'@123456'),
                'apple_id' => $user->getId()
            ]);
        }
        $authenticatedUser = User::find($authenticatedUser->id);

        // login the user & get an access token for the API
        $this->token = auth()->guard('api')->login($authenticatedUser);
        // respond with the access token
        return $this->respondWithToken($this->token,$authenticatedUser,200,'Login Success');
    }

}
