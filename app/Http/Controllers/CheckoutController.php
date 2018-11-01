<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(){
        $types = MenuType::all();
        return view('front.impl.checkout',[
            'types'=>$types
        ]);
    }
}
