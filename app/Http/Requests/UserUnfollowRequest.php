<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * アンフォロー
 *
 * Class UserUnfollowRequest
 * @package App\Http\Requests
 */
class UserUnfollowRequest extends FormRequest
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
            'target_user_id' => ['required', 'regex:/^[a-zA-Z0-9_]+$/', 'between:1,16', 'exists:users,user_id', ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'target_user_id.required' => 'フォロー対象となるユーザーIDは必須項目です。',
            'target_user_id.regex'    => 'フォロー対象となるユーザーIDは半角英数字とアンダーバーのみ使用可能です。',
            'target_user_id.between'  => 'フォロー対象となるユーザーIDは1〜16文字のみ使用可能です。',
            'target_user_id.exists'   => '指定したユーザーIDは存在しません。',
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
