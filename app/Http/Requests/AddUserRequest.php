<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
     * ^[+]?\d+([.]\d+)?$
     * @return array
     */
    public function rules()
    {
        return [
            'user_name'=>'required|max:255|min:6|string',
            'first_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'email'=>'required|max:255|email|unique:users,email',
            'password_1'=>'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|max:255|string',
            'password_2'=>'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|max:255|same:password_1|string',
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

    public function messages(){
        return [

        ];
    }
}
