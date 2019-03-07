<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderStatus;
use App\Order;
use App\Branch;
use App\Menu;

class SalesController extends Controller
{
    public function show(){
        $branches = Branch::all();
        $top_menu = Menu::with('menuPictures', 'menuType')->orderBy('hits', 'desc')->take(20)->get();
        return view('back.impl.sales',[
            'unav'=>'sales',
            'branches'=>$branches,
            'branch_id'=>'',
            'top_menu'=>$top_menu,
            'from'=>date('Y-m-d', strtotime('-5 days')),
            'to'=>date('Y-m-d')
        ]);
    }

    public function data(Request $req){
        $compare = '=';
        $from = $req->input('from');
        $to = $req->input('to');
        $branch_id = $req->input('branch_id');
        if ($branch_id <= 0) {
            $compare = '>=';
            $branch_id = 1;
        }
        $orders = Order::with(['orderStatus', 'orderMenus', 'orderMenus.menu'=> function ($query) {
                    $query->withTrashed();
                }])
                ->where('status_code', '=', 5)
                ->where('created_at', '>=', date($from . ' 00:00:00'))
                ->where('created_at', '<=', date($to . ' 23:59:59'))
                ->where('branch_id', $compare, $branch_id)
                ->get();
        return response($orders);
    }

    public function todayStat(Request $req){
        $compare = '=';
        $branch_id = $req->input('branch_id');
        if ($branch_id <= 0) {
            $compare = '>=';
            $branch_id = 1;
        }
        $today_orders = Order::with(['orderStatus', 'orderMenus', 'orderMenus.menu'=> function ($query) {
                    $query->withTrashed();
                }])
                ->where('created_at', '>=', date('Y-m-d'))
                ->where('status_code', '=', 5)
                ->where('branch_id', $compare, $branch_id)
                ->get();
        return response($today_orders);
    }
}
