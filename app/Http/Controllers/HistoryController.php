<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderStatus;
use App\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function history(){
        $user_id = Auth::user()->id;
        $status = OrderStatus::orderBy('code', 'asc')->get();
        $orders = Order::with(['orderStatus'])
            ->where('user_id', '=', $user_id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('front.impl.history',[
            'unav'=>'history',
            'header'=>'ประวัติการสั่งซื้อ',
            'orders'=>$orders,
            'status'=>$status,
            'code'=>""
        ]);
    }

    public function statSearch($code){
        $user_id = Auth::user()->id;
        $status = OrderStatus::orderBy('code', 'asc')->get();
        $orders = Order::with(['orderStatus'])
            ->whereHas('orderStatus', function ($query) use($code) {
                $query->where('code', '=', $code);
            })
            ->where('user_id', '=', $user_id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('front.impl.history',[
            'unav'=>'history',
            'header'=>'ประวัติการสั่งซื้อ',
            'orders'=>$orders,
            'status'=>$status,
            'code'=>$code
        ]);
    }

    public function order($id){
        $user_id = Auth::user()->id;
        $order = Order::with(['orderStatus', 'user', 'orderMenus', 'orderMenus.menu', 'orderMenus.menu.menuPictures'])
            ->where('user_id', '=', $user_id)
            ->where('id', "=", $id)
            ->first();
        if (!$order) abort(404);
        $menus = $order->orderMenus;
        $user = $order->user;
        $status = $order->orderStatus;
        $sum_qty = 0;
        $sum_price = 0;
        $ship_cost = $order->shipping_cost;
        foreach ($menus as $key => $value) {
            $sum_qty += $value->quantity;
            $sum_price += $value->price * $value->quantity;
        }

        return view('front.impl.orderhistory', [
            'unav'=>'history',
            'header'=>'ประวัติการสั่งซื้อ',
            'menus'=>$menus,
            'is_cart_empty'=>false,
            'sum_qty'=>$sum_qty,
            'sum_price'=>$sum_price,
            'ship_cost'=>$ship_cost,
            'order'=>$order
        ]);
    }
}
