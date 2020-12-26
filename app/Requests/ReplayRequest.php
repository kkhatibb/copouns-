<?php

namespace App\Requests;

use App\Constants\StatusCodes;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReplayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'   => 'required|email',
            'message'   => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('validation.attributes.email'),
            'message' => __('validation.attributes.message'),
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
