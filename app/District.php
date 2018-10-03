<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $garded = ['id'];

    public function province(){
        return $this->belongsTo('App\Province', 'province_id');
    }

    public function subDistricts(){
        return $this->hasMany('App\SubDistrict', 'district_id');
    }


}
