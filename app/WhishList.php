<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhishList extends Model
{
    protected $table = 'whish_list';

    public function user(){
        $this->belongsTo('App\User');
    }

    public function menu(){
        $this->belongsTo('App\Menu');
    }
}
