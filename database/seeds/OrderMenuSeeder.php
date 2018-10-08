<?php

use Illuminate\Database\Seeder;
use App\OrderMenu;

class OrderMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'quantity'=>2,
                'menu_id'=>1,
                'status_code'=>1,
                'order_id'=>1
            ],
            [
                'quantity'=>2,
                'menu_id'=>2,
                'status_code'=>1,
                'order_id'=>1
            ],
            [
                'quantity'=>2,
                'menu_id'=>3,
                'status_code'=>1,
                'order_id'=>1
            ]
        ];

        OrderMenu::insert($menus);
    }
}
