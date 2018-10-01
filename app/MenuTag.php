<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuTag extends Model
{
    protected $table = 'menu_tag';

    public function menu(){
        $this->belongsTo('App\Menu');
    }

    public function tag(){
        $this->belongsTo('App\Tag');
    }
}
