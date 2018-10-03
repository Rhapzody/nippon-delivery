<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $garded = ['id'];

    //set field to Carbon object
    protected $date = ['created_at', 'updated_at'];

    public function orderStatus(){
        return $this->belongsTo('App\OrderStatus', 'status_code');
    }

    public function user(){
        return $this->belongsTo('App\Users', 'user_id');
    }

    public function OrderMenus(){
        return $this->hasMany('App\OrderMenu', 'order_id');
    }

    // //mutators
    // //change value before save
    // public function setTitleAttribute($title){
    //     $this->attributes['title'] = "Article: " . $title;
    // }

    // //scope : hiding condition
    // public function scopePublished($query){
    //     $query->where('published_at', '<=', Carbon::now());
    // }

    // public function scopeUnpublished($query){
    //     $query->where('published_at', '>', Carbon::now());
    // }

    // //Relationship
    // public function user(){
    //     return $this->belongsTo('App\User');
    // }
}
