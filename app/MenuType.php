<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    protected $table = 'menu_type';
    protected $fillable = ['name'];
    protected $garded = ['id'];

    public function menus(){
        $this->hasMany('App\Menu');
    }
}
