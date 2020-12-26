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

class UserRequest extends FormRequest
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
        $this->id = $this->route('id');
        return auth('admin')->user()->can('add_users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->id . '|unique:admins,email',
            'mobile' => 'required|numeric|unique:users,mobile,' . $this->id,
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'user_type' => 'required',
            'gender' => 'required',
            'password' => 'required_unless:_method,PUT|nullable|min:6|confirmed',
            'avatar' => 'image',
        ];

        switch ($this->request->get('user_type')){
            case 1 :
                $this->formRequests = UserStudentRequest::class;
                break;
            case 2 :
                $this->formRequests = UserConsumerRequest::class;
                break;
            case 3 :
                $this->formRequests = UserGovernmentRequest::class;
                break;
            case 4 :
                $this->formRequests = UserInterpriceRequest::class;
                break;
            case 5 :
                $this->formRequests = UserFactoryRequest::class;
                break;
            case 6 :
                $this->formRequests = UserForeignRequest::class;
                break;
            case 7 :
                $this->formRequests = UserMediaRequest::class;
                break;
            default:
                throw new HttpResponseException(response()->json([
                    'status'    => StatusCodes::VALIDATION_ERROR,
                    'msg' => 'يرجى اختيار نوع المستخدم'
                ], StatusCodes::VALIDATION_ERROR));
                break;
        }

        $rules = array_merge(
            $rules,
            (new $this->formRequests)->rules()
        );
        return $rules;
    }


    public function attributes()
    {
        $attributes =  [
            'full_name' => __('validation.attributes.name'),
            'email' => __('validation.attributes.email'),
            'mobile' => __('validation.attributes.phone'),
            'user_type' => __('validation.attributes.user_type'),
            'gender' => __('validation.attributes.gender'),
            'password' =>__('validation.attributes.password'),
            'country_id' => __('validation.attributes.country_id'),
            'city_id' => __('validation.attributes.city_id'),
        ];

        $attributes = array_merge(
            $attributes,
            (new $this->formRequests)->attributes()
        );
        return $attributes;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'    => StatusCodes::VALIDATION_ERROR,
            'msg' => $validator->errors()->first()
        ], StatusCodes::VALIDATION_ERROR));
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(response()->json([
            'status'    => StatusCodes::UNAUTHORIZED,
            'msg' => 'ليس لديك صلاحية'
        ], StatusCodes::UNAUTHORIZED));
    }
}
