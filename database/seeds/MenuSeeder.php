<?php

use Illuminate\Database\Seeder;
use App\Menu;
use App\MenuType;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $type = MenuType::where('name','like', 'ซูชิ')->get();
        // $typeId = $type[0]->id;

        $sushi = [
            // [
            //     'name'=>'ซูชิหน้าปลาแซลม่อน',
            //     'description'=>'ซูชิ ข้าวญี่ปุนโปะหน้าด้วยเนื้อปลาแซลม่อน',
            //     'price'=>5.00,
            //     'type_id'=>$typeId
            // ],
            // [
            //     'name'=>'ซูชิหน้าไข่หอยเม่น',
            //     'description'=>'ซูชิ ข้าวญี่ปุนโปะหน้าด้วยไข่หอยเม่น',
            //     'price'=>25.00,
            //     'type_id'=>$typeId
            // ],[
            //     'name'=>'ซูชิหน้าไข่กุ้ง',
            //     'description'=>'ซูชิ ข้าวญี่ปุนโปะหน้าด้วยไข่กุ้ง',
            //     'price'=>5.00,
            //     'type_id'=>$typeId
            // ],[
            //     'name'=>'ซูชิหน้ากุ้ง',
            //     'description'=>'ซูชิ ข้าวญี่ปุนโปะหน้าด้วยกุ้ง',
            //     'price'=>5.00,
            //     'type_id'=>$typeId
            // ]
        ];

        Menu::insert($sushi);

    }
}
