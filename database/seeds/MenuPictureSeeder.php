<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuPictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_picture')->truncate();
        $pic = [
            [
                'name'=>'2018_10_03_182150_salmon_sushi.jpg',
                'menu_id'=>'1'
            ],
            [
                'name'=>'2018_10_03_182150_unangi_sushi.jpg',
                'menu_id'=>'2'
            ],
            [
                'name'=>'2018_10_03_182150_abi_egg_sushi.jpg',
                'menu_id'=>'3'
            ],
            [
                'name'=>'2018_10_03_182150_abi_sushi.jpg',
                'menu_id'=>'4'
            ]
        ];

        App\MenuPicture::insert($pic);
    }
}
