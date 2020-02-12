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
            'user_id'   => ['required', 'regex:/^[a-zA-Z0-9_]+$/', 'min:1', 'max:16', 'unique:users', ],
            'user_name' => ['required', 'string', 'min:1', 'max:16', ],
            'email'     => ['required', 'email', 'unique:users', ],
            'password'  => ['required', 'string', 'min:8', ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required'   => 'ユーザーIDは必須項目です。',
            'user_id.regex'      => 'ユーザーIDは半角英数字とアンダーバーのみ使用可能です。',
            'user_id.min'        => 'ユーザーIDは1文字以上のみ使用可能です。',
            'user_id.max'        => 'ユーザーIDは16文字以下のみ使用可能です。',
            'user_id.unique'     => '指定したユーザーIDはすでに存在しています。',

            'user_name.required' => 'ユーザーネームは必須項目です。',
            'user_name.string'   => 'ユーザーネームは文字列のみ使用可能です。',
            'user_name.min'      => 'ユーザーネームは1文字以上のみ使用可能です。',
            'user_name.max'      => 'ユーザーネームは16文字以下のみ使用可能です',

            'email.required'     => 'メールアドレスは必須項目です。',
            'email.email'        => 'メールアドレスの形式ではありません。',
            'email.unique'       => '指定したメールアドレスはすでに登録されています。',

            'password.required'  => 'パスワードは必須項目です。',
            'password.string'    => 'パスワードは文字列のみ使用可能です。',
            'password.min'       => 'パスワードは8文字以上のみ使用可能です。',
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
