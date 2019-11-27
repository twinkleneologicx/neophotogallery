<?php

namespace Neologicx\Photogallery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Imagev extends FormRequest
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
            'cat_id'=>'required|not_in:0',
            'images.*'=>'required|mimes:jpeg,jpg,png,gif|max:2048'
        ];
    }
}
