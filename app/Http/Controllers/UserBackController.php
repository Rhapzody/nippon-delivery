<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Province;
use App\District;
use App\Http\Requests\AddUserRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserBackController extends Controller
{
    public function user(){
        return view('back.impl.user',[
            'nav'=>'show'
        ]);
    }

    public function addUser(){
        $roles = Role::all();
        $provinces = Province::all();

        return view('back.impl.add-user',[
            'nav'=>'add',
            'roles'=>$roles,
            'provinces'=>$provinces
        ]);
    }

    public function addUserProcess(AddUserRequest $req){

        $image_name = 'man.png';
        if($req->hasFile('image')){
            $image_filename = $req->file('image')->getClientOriginalName();
            $image_name = date('Y_m_d_His_').$image_filename;
            $storage = '/storage/app/public/';
            $destination = base_path() . $storage;
            $req->file('image')->move($destination, $image_name);
        }

        $user = User::create([
            'name'=>$req->input('user_name'),
            'first_name'=>$req->input('first_name'),
            'last_name'=>$req->input('last_name'),
            'email'=>$req->input('email'),
            'password'=>Hash::make($req->input('password_1')),
            'last_name'=>$req->input('last_name'),
            'sub_district_id'=>$req->input('sub_district'),
            'village_number'=>$req->input('village_number'),
            'house_number'=>$req->input('house_number'),
            'last_name'=>$req->input('last_name'),
            'road'=>$req->input('road'),
            'alley'=>$req->input('alley'),
            'additional_address'=>$req->input('additional_address'),
            'picture_name'=>$image_name,
            'tel_number'=>$req->input('tel_number')
        ]);

        $role = Role::find($req->input('role'));
        $user->assignRole($role);

        return redirect('/staff/user');

    }

    public function editUser(){
        return view('back.impl.edit-user',[
            'nav'=>'edit'
        ]);
    }

    public function getDistrictsByProvinceId(Request $req){
        $districts = [];
        $province_id = $req->input('province_id');
        if($province_id <= 0 ) abort(404);
        $query = Province::find($province_id)->districts;
        foreach ($query as $value) {
            $temp = [];
            $temp['id'] = $value->id;
            $temp['name'] = $value->name;
            $districts[] = $temp;
        }
        return response()->json($districts);
    }

    public function getSubDistrictsByProvinceId(Request $req){
        $subDistricts = [];
        $district_id = $req->input('district_id');
        if($district_id <= 0 ) abort(404);
        $query = District::find($district_id)->subDistricts;
        foreach ($query as $value) {
            $temp = [];
            $temp['id'] = $value->id;
            $temp['name'] = $value->name;
            $subDistricts[] = $temp;
        }
        return response()->json($subDistricts);
    }
}
