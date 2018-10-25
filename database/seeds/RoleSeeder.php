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
        Role::create(['name'=>'เจ้าของร้าน']);
        Role::create(['name'=>'พ่อครัว/แม่ครัว']);
        Role::create(['name'=>'คนส่งสินค้า']);
        Role::create(['name'=>'ลูกค้า']);
    }
}
