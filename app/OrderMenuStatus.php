<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMenuStatus extends Model
{
    protected $table = 'order_menu_status';
    protected $garded = ['code'];

    public function orderMenus(){
        return $this->hasMany('App\OrderMenu', 'status_code');
    }
}
