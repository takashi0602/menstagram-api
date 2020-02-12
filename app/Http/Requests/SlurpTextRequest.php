<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * スラープ(テキスト)
 *
 * Class SlurpTextRequest
 * @package App\Http\Requests
 */
class SlurpTextRequest extends FormRequest
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
            'slurp_id' => ['required', 'integer', ],
            'text'     => ['required', 'string', 'between:1,256', ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'slurp_id.required' => 'スラープIDは必須項目です。',
            'slurp_id.integer'  => 'スラープIDは数値のみ使用可能です。',

            'text.required'     => 'テキストは必須項目です。',
            'text.string'       => 'テキストは文字列のみ使用可能です。',
            'text.between'      => 'テキストは1〜256文字のみ使用可能です。',
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
