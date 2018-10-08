<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['menu_id', 'user_id', 'quantity'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function menu(){
        return $this->belongsTo('App\Menu', 'menu_id');
    }

}
