<?php

namespace App\Http\Controllers\Api;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserApiRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{


    public function updateProfile(UserApiRequest $request)
    {
        $user = auth('api')->user();
        $data = $request->all();

        if (!$request->filled('password')) {
            $data['password'] = $user->password;
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        $token = $user->createToken(User::class)->accessToken;
        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'token' => $token,
            'data' => (new UserResource($user)),
        ])->setStatusCode(StatusCodes::OK);

    }

}
