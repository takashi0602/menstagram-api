<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * プライベートタイムライン
 *
 * Class TimelinePrivateRequest
 * @package App\Http\Requests
 */
class TimelinePrivateRequest extends FormRequest
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
            'slurp_id' => ['integer', 'exists:slurps,id', ],
            'type'     => ['in:old,new', ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'slurp_id.integer' => 'スラープIDは数値のみ使用可能です。',
            'slurp_id.exists'  => '存在しないスラープIDです。',

            'type.in'          => '存在しないタイプです。',
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
