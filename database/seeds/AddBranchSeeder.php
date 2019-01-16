<?php

use Illuminate\Database\Seeder;
use App\SubDistrict;

class AddBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pak = SubDistrict::find(245);
        $pak->branch_id = 1;
        $pak->save();

        $kam = SubDistrict::find(5996);
        $kam->branch_id = 2;
        $kam->save();
    }
}
