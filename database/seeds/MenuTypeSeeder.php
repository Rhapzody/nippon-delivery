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
            ['name'=>'ซูชิ'],
            ['name'=>'ทอด'],
            ['name'=>'ย่าง'],
            ['name'=>'เส้น'],
            ['name'=>'ข้าว'],
            ['name'=>'ซาชิมิ'],
            ['name'=>'ซุป'],
            ['name'=>'ของหวาน'],
            ['name'=>'เครื่องดื่ม'],
        ];

        MenuType::insert($types);
    }
}
