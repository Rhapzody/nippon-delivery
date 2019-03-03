<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Trigger;

class DeliverController extends Controller
{
    public function show(){
        $user = Auth::user();
        $third_orders = Order::with(['orderStatus','user','orderMenus','orderMenus.menu'=> function ($query) {
                $query->withTrashed();
            }])
            ->where('branch_id','=',$user->subDistrict->branch_id)
            ->where('status_code','=',3)
            ->get();

        $fourth_orders = Order::with(['orderStatus','user','orderMenus','orderMenus.menu'=> function ($query) {
                $query->withTrashed();
            }])
            ->where('branch_id','=',$user->subDistrict->branch_id)
            ->where('status_code','=',4)
            ->get();

        return view('back.impl.delivery',[
            'unav'=>'deliver',
            'third_orders'=>$third_orders,
            'fourth_orders'=>$fourth_orders
        ]);
    }

    public function threeToFour(Request $req){
        $order_id = $req->input('id');
        $order = Order::find($order_id);
        $order->status_code = 4;
        $order->save();
        (new Trigger())->send(Auth::user()->sub_district_id . '', 'my-event', 'message', 'refresh');
        return redirect('staff/deliver');
    }

    public function fourToFive(Request $req){
        $order_id = $req->input('id');
        $order = Order::find($order_id);
        $order->status_code = 5;
        $order->save();
        (new Trigger())->send(Auth::user()->sub_district_id . '', 'my-event', 'message', 'refresh');
        return redirect('staff/deliver');
    }


}
