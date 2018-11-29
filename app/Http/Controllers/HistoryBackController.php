<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryBackController extends Controller
{
    public function show(){
        return view('back.impl.history',[
            'unav'=>'history'
        ]);
    }
}
