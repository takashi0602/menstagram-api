<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * 画像の送信
 *
 * Class PostImagesRequest
 * @package App\Http\Requests
 */
class PostImagesRequest extends FormRequest
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
            'image1' => ['bail', 'image', 'max:4096', ],
            'image2' => ['bail', 'image', 'max:4096', ],
            'image3' => ['bail', 'image', 'max:4096', ],
            'image4' => ['bail', 'image', 'max:4096', ],
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
