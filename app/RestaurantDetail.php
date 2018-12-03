<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantDetail extends Model
{
    protected $table = 'restaurant_detail';
    protected $garded = ['id'];
}
