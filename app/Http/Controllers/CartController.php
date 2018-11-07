<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart(){


        return view('front.impl.cart',[
            'unav'=>'cart',
            'header'=>'สินค้าในตะกร้า',

        ]);
    }

    public function cartList(){
        $user_id = Auth::user()->id;
        $product = Cart::with(['menu', 'menu.menuPictures', 'menu.menuType'])
        ->where('user_id', '=', $user_id)
        ->get();
        return response($product);
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

    public function delete($id, Request $req){
        $auth_user = Auth::user();
        $cart_list = $auth_user->carts()->where('menu_id','=', $id)->first();
        if ($cart_list != null){
            if($req->input('quantity') < $cart_list->quantity && is_numeric($req->input('quantity'))){
                DB::table('cart')
                ->where('user_id', $auth_user->id)
                ->where('menu_id', $id)
                ->decrement('quantity', ceil($req->input('quantity')));
            }elseif(is_numeric($req->input('quantity'))){
                DB::table('cart')
                ->where('user_id', $auth_user->id)
                ->where('menu_id', $id)
                ->delete();
            }
            return response()->json([
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'status'=>'fail'
            ]);
        }
    }
}
