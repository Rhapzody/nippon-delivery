<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Province;
use App\SubDistrict;
use App\Trigger;

class OrderReceptionController extends Controller
{
    public function showPage(){
        $first_orders = Order::with(['orderStatus'])
            ->where('status_code', '=', 1)
            ->where('branch_id', '=', Auth::user()->subDistrict->branch_id)
            ->get();

        $second_orders = Order::with(['orderMenus', 'orderMenus.menu', 'orderStatus'])
            ->where('status_code', '=', 2)
            ->where('branch_id', '=', Auth::user()->subDistrict->branch_id)
            ->get();

        $district_orders = Order::with(['orderStatus', 'subDistrict', 'subDistrict.district', 'user'])
            ->whereHas('subDistrict.district', function ($q) {
                $q->where('id', '=', Auth::user()->subDistrict->district->id);
            })
            ->where('status_code', '=', 1)
            ->where('branch_id','=', null)
            ->get();

        $province_orders = Order::with(['orderStatus', 'subDistrict', 'subDistrict.district', 'subDistrict.district.province', 'user'])
            ->whereHas('subDistrict.district', function ($q) {
                $q->where('id', '!=', Auth::user()->subDistrict->district->id);
            })
            ->whereHas('subDistrict.district.province', function ($q) {
                $q->where('id', '=', Auth::user()->subDistrict->district->province->id);
            })
            ->where('status_code', '=', 1)
            ->where('branch_id','=', null)
            ->get();

        $have_branch_sub_districts = SubDistrict::with(['district', 'district.province'])
            ->where('branch_id', '!=', null)
            ->get();
        $have_branch_province_id = [];
        foreach ($have_branch_sub_districts as $key => $subDistrict) {
            $have_branch_province_id[] = $subDistrict->district->province->id;
        }
        $have_branch_province_id = array_unique($have_branch_province_id);
        $all_province_id = Province::all()->pluck('id')->toArray();
        $no_branch_province_id = array_values(array_diff($all_province_id, $have_branch_province_id));
        $out_province_orders = Order::with(['orderStatus', 'subDistrict', 'subDistrict.district', 'subDistrict.district.province', 'user'])
            ->whereHas('subDistrict.district.province', function ($q) use($no_branch_province_id) {
                $q->where('id', '!=', Auth::user()->subDistrict->district->province->id)
                  ->whereIn('id', $no_branch_province_id);
            })
            ->where('status_code', '=', 1)
            ->where('branch_id','=', null)
            ->get();

        return view('back.impl.order-recept',[
            'unav'=>'order',
            'first_orders'=>$first_orders,
            'second_orders'=>$second_orders,
            'district_orders'=>$district_orders,
            'province_orders'=>$province_orders,
            'out_province_orders'=>$out_province_orders
        ]);
    }

    public function oneToTwo(Request $req){
        $order_id = $req->input('id');
        $order = Order::find($order_id);
        $order->status_code = 2;
        $order->save();
        (new Trigger())->send('order', 'my-event', 'message', $order_id);
        return redirect('staff/order');
    }

    public function twoToThree(Request $req){
        $order_id = $req->input('id');
        $order = Order::find($order_id);
        $order->status_code = 3;
        $order->save();
        (new Trigger())->send('order', 'my-event', 'message', $order_id);
        (new Trigger())->send(Auth::user()->sub_district_id . '', 'my-event', 'message', 'refresh');
        return redirect('staff/order');
    }

    public function addToBranch(Request $req){
        $order_id = $req->input('id');
        $branch_id = Auth::user()->subDistrict->branch_id;
        $order = Order::find($order_id);
        $order->branch_id = $branch_id;
        $order->save();
        (new Trigger())->send('order', 'my-event', 'message', $order_id);
        return redirect('staff/order');
    }

    public function remove(Request $req){
        $order_id = $req->input('id');
        $order = Order::find($order_id);
        $order->branch_id = null;
        $order->save();
        (new Trigger())->send('order', 'my-event', 'message', $order_id);
        return redirect('staff/order');
    }

    public function cancle(Request $req){
        $order_id = $req->input('id');
        $order = Order::find($order_id);
        $order->delete();
        (new Trigger())->send('order', 'my-event', 'message', $order_id);
        return redirect('staff/order');
    }
}
