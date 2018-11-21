<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    protected $table = 'sub_districts';
    protected $garded = ['id'];
    public $timestamps = false;

    public function district(){
        return $this->belongsTo('App\District', 'district_id');
    }

    public function users(){
        return $this->hasMany('App\User', 'sub_district_id');
    }

    public function branch(){
        return $this->belongsTo('App\Branch', 'branch_id');
    }
}
