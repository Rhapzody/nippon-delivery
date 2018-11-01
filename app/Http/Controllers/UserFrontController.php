<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Requests\ChangeUserDetailRequest;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserFrontController extends Controller
{
    public function edit(){
        $types = MenuType::all();
        $provinces = Province::all();
        return view('front.impl.user-edit',[
            'provinces' => $provinces,
            'header'=>'ข้อมูลผู้ใช้งาน',
            'nav'=>'edit',
            'user'=>Auth::user(),
            'types'=>$types
        ]);
    }

    public function editProcess(ChangeUserDetailRequest $req)
    {
        $user = User::find($req->input('user_id'));
        if ($req->hasFile('image')) {
            $image_filename = $req->file('image')->getClientOriginalName();
            $image_name = date('Y_m_d_His_') . $image_filename;
            $storage = '/storage/app/public/';
            $destination = base_path() . $storage;
            $req->file('image')->move($destination, $image_name);
            if($user->picture_name != 'man.png'){
                File::delete(base_path() . $storage . $user->picture_name);
            }
            $user->picture_name = $image_name;
        }
        $user->first_name = $req->input('first_name');
        $user->last_name = $req->input('last_name');
        $user->sub_district_id = $req->input('sub_district');
        $user->road = $req->input('road');
        $user->alley = $req->input('alley');
        $user->tel_number = $req->input('tel_number');
        $user->village_number = $req->input('village_number');
        $user->house_number = $req->input('house_number');
        $user->additional_address = $req->input('additional_address');
        $user->save();

        return \App::make('redirect')->back()->with('message', 'บันทึกสำเร็จ');
    }
}
