<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['status_code', 'user_id'];
    protected $garded = ['id'];

    //set field to Carbon object
    protected $date = ['created_at', 'updated_at'];

    public function orderStatus(){
        $this->belongsTo('App\OrderStatus');
    }

    public function user(){
        $this->belongsTo('App\Users');
    }

    public function OrderMenus(){
        $this->hasMany('App\OrderMenu');
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
