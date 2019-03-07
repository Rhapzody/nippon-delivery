<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\RestaurantDetail;

class SetPromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RestaurantDetail::where('id', '>=', 0)->delete();
        $pro = new RestaurantDetail();
        $pro->sum_price_discount = 500;
        $pro->shipping_cost = 60;
        $pro->save();
    }
}
