<?php

namespace App\Http\Controllers\Api\Auth;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    protected function rules()
    {
        return [
            'email' => 'required|email|exists:users,email'
        ];
    }

    public function sendResetLinkEmail(Request $request)
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

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }



    protected function credentials(Request $request)
    {
        return $request->only('email');
    }



    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __($response),
            'data' => [],
        ])->setStatusCode(StatusCodes::OK);
    }



    protected function sendResetLinkFailedResponse(Request $request, $response)
    {

        return response([
            'status' => false,
            'code' => StatusCodes::INTERNAL_ERROR,
            'message' => __($response),
            'data' => [],
        ])->setStatusCode(StatusCodes::INTERNAL_ERROR);

    }


}
