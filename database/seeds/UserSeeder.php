<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'peekungstory';
        $user->email = 'peeratat1995@gmail.com';
        $user->password = Hash::make('68248250');
        $user->first_name = 'peeratat';
        $user->last_name = 'mantaga';
        $user->village_number = 8;
        $user->house_number = '43/376';
        $user->sub_district_id = 5;
        $role = Role::findByName('เจ้าของร้าน');
        $user->save();
        $user->assignRole($role);
    }
}
