<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = ['name', 'description', 'price'];
    protected $garded = ['id'];

    public function menuType(){
        $this->belongsTo('App\MenuType');
    }

    public function menuPictures(){
        $this->hasMany('App\MenuPicture');
    }

    public function tags(){
        $this->belongsToMany('App\Tag');
    }
}
