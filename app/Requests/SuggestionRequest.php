<?php

namespace App\Requests;

use App\Constants\StatusCodes;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SuggestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'required|string',
            'email'   => 'required|email',
            'shop_id'   => 'required',
            'coupon'   => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('validation.attributes.name'),
            'email' => __('validation.attributes.email'),
            'shop_id' => __('validation.attributes.shop_id'),
            'coupon' => __('validation.attributes.coupon'),
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
