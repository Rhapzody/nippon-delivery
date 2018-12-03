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
            ['name'=>'pakkred'],
            ['name'=>'kamphaeng saen']
        ];
        Branch::insert($branches);
    }
}
