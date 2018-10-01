<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    protected $table = 'sub_districts';
    protected $fillable = ['name', 'zip_code'];
    protected $garded = ['id'];

    public function district(){
        $this->belongsTo('App\District');
    }

    public function users(){
        $this->hasMany('App\User');
    }
}
