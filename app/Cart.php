<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['menu_id', 'user_id', 'quantity'];

    public function user(){
        $this->belongsTo('App\User');
    }

    public function menu(){
        $this->belongsTo('App\Menu');
    }

}
