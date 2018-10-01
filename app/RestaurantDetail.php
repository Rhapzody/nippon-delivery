<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantDetail extends Model
{
    protected $table = 'restaurant_detail';
    protected $fillable = ['detail'];
    protected $garded = ['id'];
}
