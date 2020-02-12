<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * スラープ
 *
 * Class SlurpRequest
 * @package App\Http\Requests
 */
class SlurpRequest extends FormRequest
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
            'image1' => ['image', 'max:5120', ],
            'image2' => ['image', 'max:5120', ],
            'image3' => ['image', 'max:5120', ],
            'image4' => ['image', 'max:5120', ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'image1.image' => '画像でないファイルは選択できません。',
            'image1.max'   => '画像のサイズは5MBが上限です。',

            'image2.image' => '画像でないファイルは選択できません。',
            'image2.max'   => '画像のサイズは5MBが上限です。',

            'image3.image' => '画像でないファイルは選択できません。',
            'image3.max'   => '画像のサイズは5MBが上限です。',

            'image4.image' => '画像でないファイルは選択できません。',
            'image4.max'   => '画像のサイズは5MBが上限です。',
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
