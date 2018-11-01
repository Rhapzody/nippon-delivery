<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhishList extends Model
{
    protected $table = 'whish_list';
    public $incrementing = false;
    protected $primaryKey = ['user_id', 'menu_id'];
    public $timestamps = false;
    protected $fillable = ['user_id', 'menu_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function menu(){
        return $this->belongsTo('App\Menu');
    }
}
