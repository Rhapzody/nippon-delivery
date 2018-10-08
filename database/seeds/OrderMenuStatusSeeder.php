<?php

use Illuminate\Database\Seeder;

class OrderMenuStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['name'=>'เสร็จแล้ว'],
            ['name'=>'ยังไม่เสร็จ']
        ];

        App\OrderMenuStatus::insert($status);
    }
}
