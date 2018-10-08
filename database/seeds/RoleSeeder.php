<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'manager']);
        Role::create(['name'=>'chef']);
        Role::create(['name'=>'deliverman']);
        Role::create(['name'=>'customer']);
    }
}
