<?php

use Illuminate\Database\Seeder;
use App\WhishList;

class WhishListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = [
            [
                'menu_id'=>2,
                'user_id'=>1
            ],
            [
                'menu_id'=>4,
                'user_id'=>1
            ]
        ];

        WhishList::insert($lists);
    }
}
