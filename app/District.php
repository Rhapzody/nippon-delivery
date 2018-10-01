<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = ['name'];
    protected $garded = ['id'];

    public function province(){
        $this->belongsTo('App\Province');
    }

    public function subDistricts(){
        $this->hasMany('App\SubDistrict');
    }


}
