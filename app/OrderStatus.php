<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';
    protected $garded = ['code'];

    public function orders(){
        return $this->hasMany('App\Order', 'statys_code');
    }
}
