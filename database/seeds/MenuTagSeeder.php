<?php

use Illuminate\Database\Seeder;
use App\Menu;
use App\Tag;
use App\MenuType;

class MenuTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = MenuType::find(1)->menus;

        $sushiTag = Tag::where('name', '=', 'ซูชิ')
            ->orWhere( 'name', '=', 'ปลา')
            ->get();

        foreach ($menus as $key => $value) {
            # code...
            $value->tags()->saveMany($sushiTag);
        }
    }
}
