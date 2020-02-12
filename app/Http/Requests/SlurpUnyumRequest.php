<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * ヤムを外す
 *
 * Class SlurpUnyumRequest
 * @package App\Http\Requests
 */
class SlurpUnyumRequest extends FormRequest
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
            'slurp_id' => ['required', 'integer', 'exists:slurps,id', ],
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
            'slurp_id.exists'   => '存在しないスラープIDです。。',
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $response['errors'] = $validator->errors()->toArray();

        throw new HttpResponseException(
            response($response, 400)
        );
    }
}
