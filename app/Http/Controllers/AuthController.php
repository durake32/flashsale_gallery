<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as ProviderUser;
use App\Models\CalendarEvent;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgot_password','googlesocialLogin','facebooksocialLogin']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'The Email or password you entered is incorrect !!'], 401);
        }
        if(auth('api')->user()->status == 0) {
            return response()->json(['error' => 'User not exists'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            [
                'password' => bcrypt($request->password),
                'random_id' => Str::random(10),
            ]
        ));
        return response()->json([
            'message' => 'User successfully registered',
            'status' => true,
            'user' => $user,
        ], 201);

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {

        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth('api')->user(),
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function deactiveAccount(Request $request){
        $id = auth('api')->user()->id;
        $validator = Validator::make($request->all(), [
            'remarks' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
            ]);
        }
        $users = User::find($id);
        $users->remarks = $request->remarks;
        $users->save();
        return response()->json(['status' => true, 'message' => 'Account deactivated']);
    }

    public function changePassword(Request $request)
    {
        $input = $request->all();
        $userid = auth('api')->user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => false, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((Hash::check(request('old_password'), auth('api')->user()->password)) == false) {
                    $arr = array("status" => false, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('new_password'), auth('api')->user()->password)) == true) {
                    $arr = array("status" => false, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => true, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                $msg = $ex->getMessage();
                $arr = array("status" => true, "message" => $msg, "data" => array());
            }
        }
        return response()->json($arr);
    }


    public function updateProfile(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'contact_no' => 'required',
            'dob' => 'required',
            'gender' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
            ]);
        }
        $users = User::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->address = $request->address;
        $users->contact_no = $request->contact_no;
        $users->dob = $request->dob;
        $users->gender = $request->gender;
        $users->save();

        if ($users) {
            return response()->json(['status' => true, 'message' => 'Details updated successfully!']);
        }
    }


    public function updateProfileImage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
            ]);
        }

        $users = User::find($id);
        $random = Str::random(10);
        if ($request->hasFile('image')) {
            $image_temp = $request->file('image');
            if ($image_temp->isValid()) {
                $extension = $image_temp->getClientOriginalExtension();
                $filename = $random . '.' . $extension;
                $image_path = 'uploads/users/profile/' . $filename;
                Image::make($image_temp)->resize(400, 400)->save($image_path);
                $users->image = $filename;
            }
        }
        $users->save();

        if ($users) {
            return response()->json(['status' => true, 'message' => 'Details updated successfully!', 'data' => $users]);
        }
    }

    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return response()->json(array("status" => 200, "message" => trans($response), "data" => array()));
                    case Password::INVALID_USER:
                        return response()->json(array("status" => 400, "message" => trans($response), "data" => array()));
                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (\Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        return response()->json($arr);
    }

    public function calendar()
    {
        $events = CalendarEvent::where('user_id',auth()->user()->id)->get();
        return response()->json(['status' => true, 'message' => 'Calendar Data', 'data' => $events]);
    }

    /**
     * Social Login
     */
    public function googlesocialLogin(Request $request)
    {
         $providerUser = null;

        $accessToken = request()->get('access_token');
        $provider = request()->get('provider');

        try {
            $providerUser = Socialite::driver($provider)->userFromToken($accessToken);
        } catch (Exception $exception) {
            return $exception;
        }

        if ($providerUser) {
            return $this->googlefindOrCreate($providerUser, $provider);
        }

        return $providerUser;
    }


      public function facebooksocialLogin(Request $request)
    {
         $providerUser = null;

        $accessToken = request()->get('access_token');
        $provider = request()->get('provider');

        try {
            $providerUser = Socialite::driver($provider)->userFromToken($accessToken);
        } catch (Exception $exception) {
            return $exception;
        }

        if ($providerUser) {
            return $this->googlefindOrCreate($providerUser, $provider);
        }

        return $providerUser;
    }


   protected function googlefindOrCreate(ProviderUser $providerUser, string $provider): User
    {
        $linkedSocialAccount = User::where('google_id', $providerUser->getId())
            ->first();

        if ($linkedSocialAccount) {
          $data =  [
            'token' => $linkedSocialAccount->user->respondWithToken('Sanctom+Socialite')->plainTextToken,
            'user' => $linkedSocialAccount->user,
        ];
        return response()->json($data, 200);

        } else {
            $user = null;

            if ($email = $providerUser->getEmail()) {
                $user = User::where('email', $email)->first();
            }

            if (! $user) {
                $user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                ]);
            }

            $user->users()->create([
                'google_id' => $providerUser->getId(),
            ]);

            return $user;
        }
    }


  protected function facebookfindOrCreate(ProviderUser $providerUser, string $provider): User
    {
        $linkedSocialAccount = User::where('facebook_id', $providerUser->getId())
            ->first();

        if ($linkedSocialAccount) {
            return $linkedSocialAccount;
        } else {
            $user = null;

            if ($email = $providerUser->getEmail()) {
                $user = User::where('email', $email)->first();
            }

            if (! $user) {
                $user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                ]);
            }

            $user->users()->create([
                'google_id' => $providerUser->getId(),
            ]);

            return $user;
        }
    }

}
