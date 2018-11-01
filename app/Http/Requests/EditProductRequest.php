<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'id'=>'required|numeric|min:1',
            'name'=>'required|max:255',
            'price'=>'required|numeric|min:0',
            'type'=>'required|numeric|min:1|exists:menu_type,id',
            'menu_image.*'=>'max:3000|mimes:png,jpeg,jpg'
        ];
    }
}
