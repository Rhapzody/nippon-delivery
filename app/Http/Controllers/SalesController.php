<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function show(){
        return view('back.impl.sales',[
            'unav'=>'sales'
        ]);
    }
}
