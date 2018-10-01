<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';
    protected $fillable = ['name'];
    protected $garded = ['code'];

    public function orders(){
        $this->hasMany('App\Order');
    }
}
