<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    protected $garded = ['id'];
    public $timestamps = false;

    public function menus(){
        return $this->belongsToMany('App\Menu', 'menu_tag', 'tag_id', 'menu_id');
    }
}
