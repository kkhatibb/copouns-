<?php

namespace App\Http\Controllers\Api\Auth;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AppleLoginController extends Controller
{

    public function loginByApple(Request $request)
    {

        $validator = Validator::make($request->all(), [
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
        $data['password'] = Hash::make('password');

        try {
            $user = User::query()->where( 'provider_id' , $data['provider_id'])->where('provider' , $data['provider'])->first();

            if ($user){
                $token = $user->createToken(User::class)->accessToken;
                return response([
                    'status' => true,
                    'code' => StatusCodes::OK,
                    'message' => __('front.success'),
                    'token' => $token,
                    'data' => (new UserResource($user)),
                ])->setStatusCode(StatusCodes::OK);
            }else{

                $validator = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                ]);

                if ($validator->fails()) {
                    return response([
                        'status' => false,
                        'code' => StatusCodes::VALIDATION_ERROR,
                        'message' => $validator->errors()->first(),
                        'data' => [],
                    ])->setStatusCode(StatusCodes::VALIDATION_ERROR);
                }

                $user = User::query()->create($data);

                $token = $user->createToken(User::class)->accessToken;
                return response([
                    'status' => true,
                    'code' => StatusCodes::OK,
                    'message' => __('front.success'),
                    'token' => $token,
                    'data' => (new UserResource($user)),
                ])->setStatusCode(StatusCodes::OK);
            }


        } catch (\Exception $e) {
            $message = $e->getMessage();

            if ($e->getCode() == 23000) {
                $message = __('validation.unique', ['attribute' => __('validation.attributes.email')]);
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
