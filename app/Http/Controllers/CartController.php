<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart(){

    }

    public function add($id, Request $req){
        $auth_user = Auth::user();
        if ($auth_user->carts()->where('menu_id','=', $id)->first() == null) {
            $newCartList = Cart::create([
                'user_id'=>Auth::user()->id,
                'menu_id'=>$id,
                'quantity'=>1
            ]);
        } else {
            DB::table('cart')
                ->where('user_id', $auth_user->id)
                ->where('menu_id', $id)
                ->increment('quantity', $req->input('quantity'));
        }
        DB::table('menu')
                ->where('id', $id)
                ->increment('hits', 1);
        return response()->json([
            'status'=>'success'
        ]);
    }
}
