<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = 'menu';
    protected $garded = ['id'];
    protected $dates = ['deleted_at'];

    public function menuType(){
        return $this->belongsTo('App\MenuType', 'type_id');
    }

    public function menuPictures(){
        return $this->hasMany('App\MenuPicture', 'menu_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag', 'menu_tag', 'menu_id', 'tag_id');
    }

    public function whishLists(){
        return $this->hasMany('App\WhishList', 'menu_id');
    }
}
