<?php

namespace App\Http\Controllers\Api\Auth;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;

    public function register(Request $request)
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

        $user = $this->create($request->all());
        $token = $user->createToken(User::class)->accessToken;

        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'token' => $token,
            'data' => (new UserResource($user)),
        ])->setStatusCode(StatusCodes::OK);

    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }


    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
