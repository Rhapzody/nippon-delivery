<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function cart(){
        $user_id = Auth::user()->id;
        $product = Cart::with(['menu', 'menu.menuPictures'])
        ->where('user_id', '=', $user_id)
        ->get();
        $sum_qty = 0;
        $sum_price = 0;
        $ship_cost = 60;
        $is_cart_empty = false;
        if($product->isEmpty()) $is_cart_empty = true;
        foreach ($product as $key => $value) {
            $sum_qty += $value->quantity;
            $sum_price += $value->menu->price * $value->quantity;
        }
        if($sum_price >= 500) $ship_cost = 0;
        return view('front.impl.cart',[
            'unav'=>'cart',
            'header'=>'สินค้าในตะกร้า',
            'menus'=>$product,
            'sum_qty'=>$sum_qty,
            'sum_price'=>$sum_price,
            'ship_cost'=>$ship_cost,
            'is_cart_empty'=>$is_cart_empty
        ]);
    }

    public function cartList(){
        $disk = (env('APP_ENV') == 'production')?'s3':'local';
        $user_id = Auth::user()->id;
        $product = Cart::with(['menu', 'menu.menuPictures', 'menu.menuType'])
        ->where('user_id', '=', $user_id)
        ->get();
        foreach ($product as $key => $value) {
            $product[$key]['image_url'] = Storage::disk($disk)->url($value->menu->menuPictures->first()->name);
        }
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

    public function plus($id, Request $req){
        $auth_user = Auth::user();
        $cart_list = $auth_user->carts()->where('menu_id','=', $id)->first();
        if ($cart_list != null){
            if(is_numeric($req->input('quantity'))){
                DB::table('cart')
                ->where('user_id', $auth_user->id)
                ->where('menu_id', $id)
                ->increment('quantity', ceil($req->input('quantity')));
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
