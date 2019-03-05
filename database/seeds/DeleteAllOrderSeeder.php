<?php

use Illuminate\Database\Seeder;
use App\Order;

class DeleteAllOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::where('id', '>=', 0)->delete();
    }
}
