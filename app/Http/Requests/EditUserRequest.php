<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'first_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'role'=>'required|regex:/^[+]?\d+([.]\d+)?$/',
            'province'=>'required|regex:/^[+]?\d+([.]\d+)?$/',
            'district'=>'required|regex:/^[+]?\d+([.]\d+)?$/',
            'sub_district'=>'required|regex:/^[+]?\d+([.]\d+)?$/',
            'village_number'=>'required|max:3',
            'house_number'=>'required|max:10',
            'image'=>'max:3000|mimes:png,jpeg,jpg', // 3mb
            'tel_number'=>'required|min:10|max:10|regex:/^\d{10}$/'
        ];
    }
}
