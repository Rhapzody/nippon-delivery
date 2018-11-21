<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function subDistrict(){
        return $this->hasOne('App\SubDistrict', 'branch_id');
    }
}
