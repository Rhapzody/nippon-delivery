<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    public $incrementing = false;
    protected $primaryKey = ['user_id', 'menu_id'];
    protected $fillable = ['menu_id', 'user_id', 'quantity'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menu_id');
    }

}
