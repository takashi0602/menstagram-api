<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * ユーザーのスラープ一覧
 *
 * Class UserSlurpsRequest
 * @package App\Http\Requests
 */
class UserSlurpsRequest extends FormRequest
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
            'user_id' => ['bail', 'regex:/^[a-zA-Z0-9_]+$/', 'min:1', 'max:16', 'exists:users,user_id', ],
            'slurp_id' => ['bail', 'integer', 'exists:slurps,id', ],
            'type'    => ['bail', 'in:old,new', ],
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
