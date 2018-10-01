<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuPicture extends Model
{
    protected $table = 'menu_picture';
    protected $fillable = ['path'];
    protected $garded = ['id'];

    public function menu(){
        $this->belongsTo('App\Menu');
    }
}
