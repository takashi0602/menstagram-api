<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * フォロー一覧
 *
 * Class UserGetFollowRequest
 * @package App\Http\Requests
 */
class UserGetFollowRequest extends FormRequest
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
            'user_id'   => ['regex:/^[a-zA-Z0-9_]+$/', 'between:1,16', 'exists:users,user_id', ],
            'follow_id' => ['integer', 'exists:follows,id', ],
            'type'      => ['in:old,new', ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.regex'     => 'ユーザーIDは半角英数字とアンダーバーのみ使用可能です。',
            'user_id.between'   => 'ユーザーIDは1〜16文字のみ使用可能です。',
            'user_id.exists'    => '指定したユーザーIDは存在しません。',

            'follow_id.integer' => 'フォローIDは数値のみ使用可能です',
            'follow_id.exists'  => '指定したフォローIDは存在しません',

            'type.in'           => '存在しないタイプです。',
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
