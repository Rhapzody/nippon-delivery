<?php

use Illuminate\Database\Seeder;
use App\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = [
            [
                'name'=>'Pakkred',
                'lat'=>13.912645352688644,
                'long'=>100.49585080127144,
                'status'=>1,

            ],
            [
                'name'=>'Kamphaeng saen',
                'lat'=>14.029381693917161,
                'long'=>99.95429992675783,
                'status'=>1,
            ]
        ];
        Branch::insert($branches);
    }
}
