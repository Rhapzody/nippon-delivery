<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['name'=>'รอปรุง'],
            ['name'=>'กำลังปรุง'],
            ['name'=>'ปรุงเสร็จแล้ว'],
            ['name'=>'กำลังส่ง'],
            ['name'=>'ส่งถึงแล้ว']
        ];

        App\OrderStatus::insert($status);
    }
}
