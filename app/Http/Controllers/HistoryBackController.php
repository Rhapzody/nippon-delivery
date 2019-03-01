<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderStatus;
use App\Order;
use App\Branch;
class HistoryBackController extends Controller
{
    public function show(){
        $status = OrderStatus::orderBy('code', 'asc')->get();
        $branches = Branch::all();
        $orders = Order::with(['orderStatus'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('back.impl.history',[
            'unav'=>'history',
            'orders'=>$orders,
            'status'=>$status,
            'branches'=>$branches,
            'code'=>'',
            'order_id'=>'',
            'branch_id'=>'',
            'from'=>date('Y-m-d', strtotime("1995-07-05")),
            'to'=>date('Y-m-d')
        ]);
    }

    public function find(Request $req){
        $status = OrderStatus::orderBy('code', 'asc')->get();
        $branches = Branch::all();
        $selectOperator = (trim($req->input('order_id')) == '')?'>=': '=';
        $selectId = (trim($req->input('order_id')) == '')?0: $req->input('order_id');
        $orders = Order::with(['orderStatus'])
            ->where('id', $selectOperator, $selectId)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('back.impl.history',[
            'unav'=>'history',
            'orders'=>$orders,
            'status'=>$status,
            'branches'=>$branches,
            'code'=>'',
            'branch_id'=>'',
            'order_id'=>$req->input('order_id'),
            'from'=>date('Y-m-d', strtotime("1995-07-05")),
            'to'=>date('Y-m-d')
        ]);
    }

    public function order($id){
        $order = Order::with(['orderStatus', 'user', 'orderMenus', 'orderMenus.menu', 'orderMenus.menu.menuPictures'])
            ->where('id', "=", $id)
            ->first();
        if (!$order) abort(404);
        $menus = $order->orderMenus;
        $user = $order->user;
        $status = $order->orderStatus;
        $sum_qty = 0;
        $sum_price = 0;
        $ship_cost = 60;
        foreach ($menus as $key => $value) {
            $sum_qty += $value->quantity;
            $sum_price += $value->price * $value->quantity;
        }
        if($sum_price >= 500) $ship_cost = 0;

        return view('back.impl.orderhistory', [
            'unav'=>'history',
            'is_cart_empty'=>false,
            'menus'=>$menus,
            'sum_qty'=>$sum_qty,
            'sum_price'=>$sum_price,
            'ship_cost'=>$ship_cost,
            'order'=>$order
        ]);
    }

    public function search( $branch_id, $status_code, String $from, String $to, Request $req)
    {
        $status = OrderStatus::orderBy('code', 'asc')->get();
        $branches = Branch::all();

        $all_status_code = [];
        if ($status_code != -1) {
            $all_status_code[] = $status_code;
        }else {
            foreach ($status as $key => $value) {
                $all_status_code[] = $value->code;
            }
        }

        $all_branch_id = [];
        if ($branch_id != -1) {
            $all_branch_id[] = $branch_id;
        } else {
            foreach ($branches as $key => $value) {
                $all_branch_id[] = $value->id;
            }
        }

        $orders = Order::with(['orderStatus'])
            ->whereIn('status_code', $all_status_code)
            ->where(function($q) use($branch_id, $all_branch_id){
                if ($branch_id != -1) {
                    $q->where('branch_id', '=', $branch_id);
                } else {
                    $q->whereIn('branch_id',$all_branch_id)
                      ->orWhereNull('branch_id');
                }

            })
            ->whereDate('created_at', '>=',date($from . ' 00:00:00'))
            ->whereDate('created_at', '<=', date($to . ' 23:59:59'))
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('back.impl.history',[
            'unav'=>'history',
            'orders'=>$orders,
            'status'=>$status,
            'branches'=>$branches,
            'code'=>$status_code,
            'order_id'=>'',
            'branch_id'=>$branch_id,
            'from'=>date('Y-m-d', strtotime($from)),
            'to'=>date('Y-m-d', strtotime($to))
        ]);
    }
}
