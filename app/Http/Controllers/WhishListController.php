<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Menu;
use APp\WhishList;
use Illuminate\Support\Facades\DB;

class WhishListController extends Controller
{
    public function add($id){
        if (Auth::user()->whishLists()->where('menu_id','=', $id)->first() == null) {
            $newWhishList = WhishList::create([
                'user_id'=>Auth::user()->id,
                'menu_id'=>$id
            ]);
            DB::table('menu')
                ->where('id', $id)
                ->increment('hits', 1);
            return response()->json([
                'status'=>'success'
            ]);
        } else {
            return response()->json([
                'status'=>'fail'
            ]);
        }

    }
}
