<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserFrontController extends Controller
{
    public function edit(){
        return view('front.impl.user-edit',[
            'header'=>'ข้อมูลผู้ใช้งาน',
            'nav'=>'edit',
            'user'=>Auth::user()
        ]);
    }
}
