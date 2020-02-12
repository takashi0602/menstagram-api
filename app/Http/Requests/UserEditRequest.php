<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * ユーザーの編集
 *
 * Class UserEditRequest
 * @package App\Http\Requests
 */
class UserEditRequest extends FormRequest
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
            'user_name' => ['string', 'between:1,16', ],
            'biography' => ['max:128', ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'user_name.string'  => 'ユーザーネームは文字列のみ使用可能です',
            'user_name.between' => 'ユーザーネームは1〜16文字のみ使用可能です',

            'biography.max'     => '自己紹介は128文字以下のみ使用可能です',
        ];
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        $response['errors'] = $validator->errors()->toArray();

        throw new HttpResponseException(
            response($response, 400)
        );
    }
}
