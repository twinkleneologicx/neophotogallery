<?php

namespace Neologicx\Photogallery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Categoryv extends FormRequest
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
            'name'=> 'required|unique:categories',
            'cover_image'=>'required|mimes:jpeg,jpg,png,gif|max:2048'
        ];
    }
}
