<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name'=>'required|max:255|min:6|string',
            'first_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'email'=>'required|max:255|email|unique:users,email',
            'password_1'=>'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|max:255|string',
            'password_2'=>'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|max:255|same:password_1|string',
            'province'=>'required|regex:/^[+]?\d+([.]\d+)?$/',
            'district'=>'required|regex:/^[+]?\d+([.]\d+)?$/',
            'sub_district'=>'required|regex:/^[+]?\d+([.]\d+)?$/',
            'village_number'=>'required|max:3',
            'house_number'=>'required|max:10',
            'image'=>'max:3000|mimes:png,jpeg,jpg', // 3mb
            'tel_number'=>'required|min:10|max:10|regex:/^\d{10}$/'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $image_name = 'man.png';
        if (array_key_exists('image', $data)) {
            $image_filename = $data['image']->getClientOriginalName();
            $image_name = date('Y_m_d_His_') . $image_filename;
            $storage = '/storage/app/public/';
            $destination = base_path() . $storage;
            $data['image']->move($destination, $image_name);
        }

        $user =  User::create([
            'name' => $data['user_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password_1']),
            'last_name' => $data['last_name'],
            'sub_district_id' => $data['sub_district'],
            'village_number' => $data['village_number'],
            'house_number' => $data['house_number'],
            'last_name' => $data['last_name'],
            'road' => $data['road'],
            'alley' => $data['alley'],
            'additional_address' => $data['additional_address'],
            'picture_name' => $image_name,
            'tel_number' => $data['tel_number']
        ]);

        $user->assignRole('ลูกค้า');

        return $user;
    }
}
