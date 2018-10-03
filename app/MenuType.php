<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    protected $table = 'menu_type';
    protected $garded = ['id'];

    public function menus(){
        return $this->hasMany('App\Menu', 'type_id');
    }
}
