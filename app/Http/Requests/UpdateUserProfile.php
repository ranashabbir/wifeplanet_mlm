<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfile extends FormRequest
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
            'location'          => '',
            'gender'            => '',
            'age'               => '',
            'weight'            => '',
            'height'            => '',
            'relationship'      => '',
            'avatar'            => '',
            'hair'              => '',
            'occupation'        => '',
            'body_type'         => '',
            'children'          => '',
            'sports'            => '',
            'personality'       => '',
            'nationality'       => '',
            'religion'          => '',
            'smoking'           => '',
            'city'              => '',
            'state'             => '',
            'country'           => '',
            'interests'         => '',
        ];
    }
}
