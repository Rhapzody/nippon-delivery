<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetPromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurant_detail')
            ->where('id', 1)
            ->update([
                'sum_price_discount' => 500,
                'shipping_cost' => 60
            ]);
    }
}
