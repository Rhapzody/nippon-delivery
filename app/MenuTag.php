<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuTag extends Model
{
    protected $table = 'menu_tag';
    protected $fillable = ['menu_id', 'tag_id'];

    public function menu(){
        return $this->belongsTo('App\Menu', 'menu_id');
    }

    public function tag(){
        return $this->belongsTo('App\Tag', 'tag_id');
    }
}
