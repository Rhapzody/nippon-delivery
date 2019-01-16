<?php

use Illuminate\Database\Seeder;
use App\Cart;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = [
            // [
            //     'menu_id'=>2,
            //     'user_id'=>1,
            //     'quantity'=>10
            // ],
            // [
            //     'menu_id'=>4,
            //     'user_id'=>1,
            //     'quantity'=>5
            // ]
        ];

        Cart::insert($lists);
    }
}
