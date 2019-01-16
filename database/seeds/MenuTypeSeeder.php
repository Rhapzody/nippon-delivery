<?php

use Illuminate\Database\Seeder;
use App\MenuType;

class MenuTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name'=>'เมนูทานเล่น'],
            ['name'=>'เมนูเซ็ท'],
            ['name'=>'ข้าวกล่อง'],
            ['name'=>'เมนูเส้น'],
            ['name'=>'ข้าวหน้า'],
            ['name'=>'ของหวาน'],
            ['name'=>'เครื่องดื่ม']
        ];

        MenuType::insert($types);
    }
}
