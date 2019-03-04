<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChangeRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')
            ->where('id', 2)
            ->update(['name' => 'พนักงานรับออเดอร์']);

        DB::table('roles')
            ->where('id', 3)
            ->update(['name' => 'พนักงานส่งสินค้า']);

        DB::table('roles')
            ->where('id', 5)
            ->delete();
    }
}
