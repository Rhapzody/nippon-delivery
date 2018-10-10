<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Requests\AddUserRequest;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserBackController extends Controller
{

    public function searchUser($search_mode = null, $search_text = null){
        switch ($search_mode) {
            case '0':
                $users = User::with('roles')
                    ->where('id', '=', $search_text)
                    ->orWhere('first_name', 'like', $search_text . '%')
                    ->orWhere('email', 'like', $search_text . '%')
                    ->paginate(5);
                break;

            case '1':
                $users = User::with('roles')->where('first_name', 'like', $search_text . '%')->paginate(5);
                break;

            case '2':
                $role = Role::where('name', 'like', $search_text . '%')->first();
                $users = $role->users()->with('roles')->paginate(5);
                break;

            case '3':
                $users = User::with('roles')->where('id', '=', $search_text)->paginate(5);
                break;

            case '4':
                $users = User::with('roles')->where('email', 'like', $search_text . '%')->paginate(5);
                break;

            default:
                $users = User::with('roles')->paginate(5);
                break;
            }

            return view('back.impl.user', [
                'nav' => 'show',
                'users' => $users,
                'search_mode'=>$search_mode,
                'search_text'=>$search_text
            ]);

    }

    public function addUser()
    {
        $roles = Role::all();
        $provinces = Province::all();

        return view('back.impl.add-user', [
            'nav' => 'add',
            'roles' => $roles,
            'provinces' => $provinces,
        ]);
    }

    public function addUserProcess(AddUserRequest $req)
    {

        $image_name = 'man.png';
        if ($req->hasFile('image')) {
            $image_filename = $req->file('image')->getClientOriginalName();
            $image_name = date('Y_m_d_His_') . $image_filename;
            $storage = '/storage/app/public/';
            $destination = base_path() . $storage;
            $req->file('image')->move($destination, $image_name);
        }

        $user = User::create([
            'name' => $req->input('user_name'),
            'first_name' => $req->input('first_name'),
            'last_name' => $req->input('last_name'),
            'email' => $req->input('email'),
            'password' => Hash::make($req->input('password_1')),
            'last_name' => $req->input('last_name'),
            'sub_district_id' => $req->input('sub_district'),
            'village_number' => $req->input('village_number'),
            'house_number' => $req->input('house_number'),
            'last_name' => $req->input('last_name'),
            'road' => $req->input('road'),
            'alley' => $req->input('alley'),
            'additional_address' => $req->input('additional_address'),
            'picture_name' => $image_name,
            'tel_number' => $req->input('tel_number'),
        ]);

        $role = Role::find($req->input('role'));
        $user->assignRole($role);

        return redirect('/staff/user');

    }

    public function editUser($id)
    {

        $user = User::with('roles')->find($id);
        $provinces = Province::all();
        $roles = Role::all();
        $my_role = ($user->roles)[0];

        return view('back.impl.edit-user', [
            'nav' => 'edit',
            'user' => $user,
            'provinces' => $provinces,
            'roles' => $roles,
            'my_role' => $my_role,
        ]);
    }

    public function editUserProcess()
    {

    }

    public function getDistrictsByProvinceId(Request $req)
    {
        $districts = [];
        $province_id = $req->input('province_id');
        if ($province_id <= 0 || !is_numeric($province_id)) {
            abort(404);
        }

        $query = Province::find($province_id)->districts;
        foreach ($query as $value) {
            $temp = [];
            $temp['id'] = $value->id;
            $temp['name'] = $value->name;
            $districts[] = $temp;
        }
        return response()->json($districts);
    }

    public function getSubDistrictsByProvinceId(Request $req)
    {
        $subDistricts = [];
        $district_id = $req->input('district_id');
        if ($district_id <= 0 || !is_numeric($district_id)) {
            abort(404);
        }

        $query = District::find($district_id)->subDistricts;
        foreach ($query as $value) {
            $temp = [];
            $temp['id'] = $value->id;
            $temp['name'] = $value->name;
            $subDistricts[] = $temp;
        }
        return response()->json($subDistricts);
    }

    public function getUserDetailById(Request $req)
    {

        if ($req->input('user_id') <= 0 || !is_numeric($req->input('user_id'))) {
            abort(404);
        }

        $user = User::find($req->input('user_id'));
        $roles = [];
        foreach ($user->roles as $key => $role) {
            $roles[] = $role->name;
        }

        $details = [
            'id' => $user->id,
            'username' => $user->name,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'email' => $user->email,
            'roles' => $roles,
            'subDistrict' => $user->subDistrict->name,
            'district' => $user->subDistrict->district->name,
            'province' => $user->subDistrict->district->province->name,
            'road' => $user->road,
            'alley' => $user->alley,
            'villageNumber' => $user->village_number,
            'houseNumber' => $user->house_number,
            'additionalAddress' => $user->additional_address,
            'pictureName' => $user->picture_name,
            'picturePath' => '/storage/',
        ];

        return response()->json($details);
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
    }
}
