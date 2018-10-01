<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMenu extends Model
{
    protected $table = 'order_menu';
    protected $fillable = ['quantity'];

    public function orderMenuStatus(){
        $this->belongsTo('App\OrderMenuStatus');
    }

    public function menu(){
        $this->belongsTo('App\Menu');
    }

    public function order(){
        $this->belongsTo('App\Order');
    }
}
