<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $garded = ['id'];

    public function menuType(){
        return $this->belongsTo('App\MenuType', 'type_id');
    }

    public function menuPictures(){
        return $this->hasMany('App\MenuPicture', 'menu_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag', 'menu_tag', 'menu_id', 'tag_id');
    }
}
