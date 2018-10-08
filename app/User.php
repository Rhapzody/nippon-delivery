<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name',
        'last_name', 'road', 'alley','village_number',
        'house_number', 'additional_address','sub_district_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders(){
        return $this->hasMany('App\Order', 'user_id');
    }

    public function carts(){
        return $this->hasMany('App\Cart', 'user_id');
    }

    public function whishLists(){
        return $this->hasMany('App\WhishList', 'user_id');
    }
}
