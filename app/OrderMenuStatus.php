<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMenuStatus extends Model
{
    protected $table = 'order_menu_status';
    protected $fillable = ['name'];
    protected $garded = ['code'];

    public function orderMenus(){
        $this->hasMany('App\OrderMenu');
    }
}
