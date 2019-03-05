<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMenu extends Model
{
    protected $table = 'order_menu';
    protected $fillable = ['quantity', 'menu_id', 'order_id', 'status_code', 'price'];

    public function orderMenuStatus(){
        return $this->belongsTo('App\OrderMenuStatus', 'status_code');
    }

    public function menu(){
        return $this->belongsTo('App\Menu', 'menu_id');
    }

    public function order(){
        return $this->belongsTo('App\Order', 'order_id');
    }
}
