<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * いいね
 *
 * Class PostLikeRequest
 * @package App\Http\Requests
 */
class PostLikeRequest extends FormRequest
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
            'post_id' => ['bail', 'required', 'integer', 'exists:posts', ],
        ];
    }
}
