<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name'=>'แซลมอน'],
            ['name'=>'ซาชิมิ'],
            ['name'=>'ซูชิ'],
            ['name'=>'ราเมน'],
            ['name'=>'ข้าว'],
            ['name'=>'เทมปุระ'],
            ['name'=>'เนื้อ'],
            ['name'=>'หมู'],
            ['name'=>'ปลา'],
            ['name'=>'ไก่'],
            ['name'=>'เครืองดื่ม'],
            ['name'=>'ทานเล่น'],
            ['name'=>'ปลาหมึก']
        ];

        Tag::insert($tags);
    }
}
