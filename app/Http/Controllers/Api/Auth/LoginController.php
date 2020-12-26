<?php

namespace App\Http\Controllers\Api\Auth;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response([
                'status' => false,
                'code' => StatusCodes::VALIDATION_ERROR,
                'message' => $validator->errors()->first(),
                'data' => [],
            ])->setStatusCode(StatusCodes::VALIDATION_ERROR);
        }


        if ($user = $this->attemptLogin($request)) {

            $token = $user->createToken(User::class)->accessToken;
            return response([
                'status' => true,
                'code' => StatusCodes::OK,
                'message' => __('front.success'),
                'token' => $token,
                'data' => (new UserResource($user)),
            ])->setStatusCode(StatusCodes::OK);
        } else {
            return response([
                'status' => false,
                'code' => StatusCodes::UNAUTHORIZED,
                'message' => __('auth.failed'),
                'data' => [],
            ])->setStatusCode(StatusCodes::UNAUTHORIZED);
        }


    }


    protected function rules()
    {
        return [
            $this->username() => 'required|email',
            'password' => 'required|string',
        ];
    }


    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        $user = User::where($this->username(), $request->email)->first();
        if (!$user) return false;
        if ($this->hasValidCredentials($user, $credentials)) {
            return $user;
        }
        return false;
    }

    protected function hasValidCredentials($user, $credentials)
    {
        return !is_null($user) && $this->validateCredentials($user, $credentials);
    }


    public function validateCredentials(User $user, array $credentials)
    {
        $plain = $credentials['password'];
        return $this->check($plain, $user->getAuthPassword());
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    public function check($value, $hashedValue, array $options = [])
    {
        if (strlen($hashedValue) === 0) {
            return false;
        }

        return Hash::check($value, $hashedValue);

    }


    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $user = User::find(auth('api')->id());
        $user->fcm_token = null;
        $user->save();
        DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'data' => [],
        ])->setStatusCode(StatusCodes::OK);
    }

    public function fcmToken(Request $request)
    {
        $user = User::find(auth('api')->id());
        $user->fcm_token = $request->fcm_token;
        $user->save();
        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'data' => (new UserResource($user)),
        ])->setStatusCode(StatusCodes::OK);

    }


    function socialLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', Rule::in(['facebook', 'google'])],
            'token' => 'required',

        ]);
        if ($validator->fails()) {
            return response([
                'status' => false,
                'code' => StatusCodes::VALIDATION_ERROR,
                'message' => $validator->errors()->first(),
                'data' => [],
            ])->setStatusCode(StatusCodes::VALIDATION_ERROR);
        }

        try {
            if ($request->type != 'google') {
                $user = Socialite::driver($request->type)->userFromToken($request->token);
            } else {
                $check = $this->checkGoogle($request->token);
                if ($check == false)
                    return response([
                        'status' => false,
                        'code' => StatusCodes::UNAUTHORIZED,
                        'message' => __('auth.invalid_token'),
                        'data' => [],
                    ])->setStatusCode(StatusCodes::UNAUTHORIZED);

                $user = $check;
            }
        } catch (\Exception $ex) {
            return response([
                'status' => false,
                'code' => StatusCodes::UNAUTHORIZED,
                'message' => __('auth.invalid_token'),
                'data' => [],
            ])->setStatusCode(StatusCodes::UNAUTHORIZED);
        }

        $data['email'] = $user->email;
        $data['provider'] = $request->type;


        $authUser = User::where('email', $user->email)
            ->orWhere('provider_id', $user->id)
            ->orWhere('provider', $data['provider'])
            ->first();

        if ($authUser) {

            $authUser->name = $user->name;
            $authUser->save();

        } else {
            $validator = Validator::make($data, [
                'email' => 'required|email|unique:users,email',
            ]);

            if ($validator->fails()) {
                return response([
                    'status' => false,
                    'code' => StatusCodes::VALIDATION_ERROR,
                    'message' => $validator->errors()->first(),
                    'data' => [],
                ])->setStatusCode(StatusCodes::VALIDATION_ERROR);
            }

            $authUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider' => $request->type,
                'avatar' => $request->type == 'google' ? $user->picture : $user->avatar,
                'provider_id' => $user->id,
                'password'  => Hash::make('password')
            ]);
        }


        $token = $authUser->createToken(User::class)->accessToken;
        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'token' => $token,
            'data' => (new UserResource($authUser)),
        ])->setStatusCode(StatusCodes::OK);

    }


    function checkGoogle($accessToken)
    {

        $userDetails = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $accessToken);
        $userData = json_decode($userDetails);

        if (!empty($userData)) {
            return $userData;
        } else {
            return false;
        }
    }

    public function loginByApple(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'provider_id' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return response([
                'status' => false,
                'code' => StatusCodes::VALIDATION_ERROR,
                'message' => $validator->errors()->first(),
                'data' => [],
            ])->setStatusCode(StatusCodes::VALIDATION_ERROR);
        }

        $data = $request->all();
        $data['provider'] = 'apple';
        $data['password'] =  Hash::make('password');


        try {
            $user = User::query()->updateOrCreate([
                'provider_id'   => $data['provider_id'],
                'provider'   => $data['provider'],
                'email'   => $data['email'],
            ] ,$data);


            $token = $user->createToken(User::class)->accessToken;
            return response([
                'status' => true,
                'code' => StatusCodes::OK,
                'message' => __('front.success'),
                'token' => $token,
                'data' => (new UserResource($user)),
            ])->setStatusCode(StatusCodes::OK);

        }catch (\Exception $e){
            $message = $e->getMessage();
            if ($e->getCode() == 23000){
                $message = __('validation.unique' , ['attribute' =>  __('validation.attributes.email')]);
            }

            return response([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $message,
                'data' => [],
            ])->setStatusCode(StatusCodes::VALIDATION_ERROR);

        }

    }

}
