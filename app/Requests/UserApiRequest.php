<?php

namespace App\Http\Requests;

use App\Constants\StatusCodes;
use App\Http\Requests\User\UserConsumerRequest;
use App\Http\Requests\User\UserFactoryRequest;
use App\Http\Requests\User\UserForeignRequest;
use App\Http\Requests\User\UserGovernmentRequest;
use App\Http\Requests\User\UserInterpriceRequest;
use App\Http\Requests\User\UserMediaRequest;
use App\Http\Requests\User\UserStudentRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $id;
    protected $formRequests;

    public function authorize()
    {
        $this->id = auth('api')->id();
        return auth('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->id ,
            'password' => 'nullable|min:6|confirmed',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'code' => StatusCodes::VALIDATION_ERROR,
            'message' => $validator->errors()->first(),
            'data' => [],
        ], StatusCodes::VALIDATION_ERROR));
    }

}
