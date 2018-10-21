<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuPicture extends Model
{
    protected $table = 'menu_picture';
    protected $garded = ['id'];
    public $timestamps = false;

    public function menu(){
        return $this->belongsTo('App\Menu', 'menu_id');
    }
}
