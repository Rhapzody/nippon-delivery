<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';
    protected $garded = ['id'];

    public function subDistricts(){
        return $this->hasMany('App\SubDistrict', 'branch_id');
    }
}
