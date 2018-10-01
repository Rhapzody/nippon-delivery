<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = ['name'];
    protected $garded = ['id'];

    public function districts(){
        $this->hasMany('App\District');
    }
}
