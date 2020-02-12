<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * ユーザーのプロフィール
 *
 * Class UserProfileRequest
 * @package App\Http\Requests
 */
class UserProfileRequest extends FormRequest
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
            'user_id' => ['regex:/^[a-zA-Z0-9_]+$/', 'min:1', 'max:16', 'exists:users,user_id', ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.regex'  => 'ユーザーIDは半角英数字とアンダーバーのみ使用可能です。',
            'user_id.min'    => 'ユーザーIDは1文字以上のみ使用可能です。',
            'user_id.max'    => 'ユーザーIDは16文字以下のみ使用可能です。',
            'user_id.exists' => '存在しないユーザーIDです。',
        ];
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        $response['errors'] = $validator->errors()->toArray();

        throw new HttpResponseException(
            response()->json($response, 400)
        );
    }
}
