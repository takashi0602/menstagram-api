<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * ユーザーの登録
 *
 * Class AuthRegisterRequest
 * @package App\Http\Requests
 */
class AuthRegisterRequest extends FormRequest
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
            'user_id'   => ['bail', 'required', 'regex:/^[a-zA-Z0-9_]+$/', 'min:1', 'max:16', 'unique:users', ],
            'user_name' => ['bail', 'required', 'string', 'min:1', 'max:16', ],
            'email'     => ['bail', 'required', 'email', 'unique:users', ],
            'password'  => ['bail', 'required', 'string', 'min:8', ],
        ];
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        $response = response('{}', 400);
        throw new HttpResponseException($response);
    }
}
