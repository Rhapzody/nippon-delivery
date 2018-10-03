<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TagSeeder::class,
            MenuTypeSeeder::class,
            MenuSeeder::class,
            MenuTagSeeder::class,
            MenuPictureSeeder::class,
            ProvinceSeeder::class,
            DistrictSeeder::class,
            SubDistrictSeeder::class,
            UserSeeder::class,
            OrderStatusSeeder::class,
            OrderMenuStatusSeeder::class,
            OrderSeeder::class,
            OrderMenuSeeder::class,
            WhishListSeeder::class,
            CartSeeder::class,
            RoleSeeder::class
        ]);
    }
}
