<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\User;
use App\Province;
use App\District;
use App\SubDistrict;
use App\Order;
use App\OrderMenu;
use App\RestaurantDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Log;

class CheckoutController extends Controller
{
    public function checkout(){
        $user_id = Auth::user()->id;
        $product = Cart::with(['menu'=> function ($query) {
                $query->withTrashed();
            }])
            ->where('user_id', '=', $user_id)
            ->get();
        if($product->isEmpty()) return redirect('/');

        $promotion = RestaurantDetail::find(1);
        $provinces = Province::all();
        $user = User::with(['subDistrict', 'subDistrict.district', 'subDistrict.district.province'])
            ->find($user_id);
        $sum_qty = 0;
        $sum_price = 0;
        $is_cart_empty = false;
        $user_address = (
            "บ้านเลขที่ " . $user->house_number . ", " .
            "หมู่ที่ " . $user->village_number . ", " .
            "ซอย " . $user->alley . ", " .
            "ถนน " . $user->road . ", " .
            "ตำบล " . $user->subDistrict->name . ", " .
            "อำเภอ " . $user->subDistrict->district->name . ", " .
            "จังหวัด " . $user->subDistrict->district->province->name . ", " .
            "ข้อมูลเพิ่มเติม " . $user->additional_address
        );

        foreach ($product as $key => $value) {
            $sum_qty += $value->quantity;
            $sum_price += $value->menu->price * $value->quantity;
        }

        return view('front.impl.checkout',[
            'header'=>'ดำเนินการสั่งซื้อ',
            'menus'=>$product,
            'sum_qty'=>$sum_qty,
            'sum_price'=>$sum_price,
            'is_cart_empty'=>$is_cart_empty,
            'user_address'=>$user_address,
            'provinces'=>$provinces,
            'sub_district'=>$user->subDistrict,
            'promotion'=>$promotion
        ]);
    }

    public function process(Request $req){

        $user_id = Auth::user()->id;
        $product = Cart::with(['menu'=> function ($query) {
                $query->withTrashed();
            }])
            ->where('user_id', '=', $user_id)
            ->get();
        if($product->isEmpty()) return redirect('/');
        $insert = [];

        $promotion = RestaurantDetail::find(1);
        $shipCost = $promotion->shipping_cost;

        $sumPrice = 0;
        foreach ($product as $key => $menu) {
            $sumPrice += $menu->quantity * $menu->menu->price;
        }
        if ($sumPrice >= $promotion->sum_price_discount) {
            $shipCost = 0;
        }

        if ($req->input('address_option') == "origin") {
            $sub_district = SubDistrict::find($req->input('sub_district_id'));
            $branch_id;
            if($sub_district->branch_id != null){
                if ($sub_district->branch->status == 1) {
                    $branch_id = $sub_district->branch_id;
                }else{
                    $branch_id = null;
                }
            }else{
                $branch_id = null;
            }
            if ($branch_id != null) {
                $shipCost = 0;
            }

            $address = $req->input('origin_address');
            $order = Order::create([
                "user_id"=>$user_id,
                "status_code"=>1,
                "address"=>$address,
                "branch_id"=>$branch_id,
                "sub_district_id"=>$req->input('sub_district_id'),
                "shipping_cost"=>$shipCost
            ]);
            foreach ($product as $key => $menu) {
                $insert[] = [
                    'order_id'=>$order->id,
                    'menu_id'=>$menu->menu->id,
                    'status_code'=>1,
                    'quantity'=>$menu->quantity,
                    'price'=>$menu->menu->price,
                ];
            }
            OrderMenu::insert($insert);

        } else {
            $validator = Validator::make($req->all(), [
                'province'=>'required|regex:/^[+]?\d+([.]\d+)?$/',
                'district'=>'required|regex:/^[+]?\d+([.]\d+)?$/',
                'sub_district'=>'required|regex:/^[+]?\d+([.]\d+)?$/',
                'village_number'=>'required|max:3',
                'house_number'=>'required|max:10'
            ]);

            if ($validator->fails()) {
                return redirect('/');
            }

            $sub_district = SubDistrict::find($req->input('sub_district'));
            $branch_id;
            if($sub_district->branch_id != null){
                if ($sub_district->branch->status == 1) {
                    $branch_id = $sub_district->branch_id;
                }else{
                    $branch_id = null;
                }
            }else{
                $branch_id = null;
            }
            if ($branch_id != null) {
                $shipCost = 0;
            }

            $address = (
                "บ้านเลขที่ " . $req->input('house_number') . ", " .
                "หมู่ที่ " . $req->input('village_number') . ", " .
                "ซอย " . $req->input('alley') . ", " .
                "ถนน " . $req->input('road') . ", " .
                "ตำบล " . SubDistrict::find($req->input('sub_district'))->name . ", " .
                "อำเภอ " . District::find($req->input('district'))->name . ", " .
                "จังหวัด " . Province::find($req->input('province'))->name . ", " .
                "ข้อมูลเพิ่มเติม " . $req->input('additional_address')
            );
            $order = Order::create([
                "user_id"=>$user_id,
                "status_code"=>1,
                "address"=>$address,
                "branch_id"=>$branch_id,
                "sub_district_id"=>$req->input('sub_district'),
                "shipping_cost"=>$shipCost
            ]);
            foreach ($product as $key => $menu) {
                $insert[] = [
                    'order_id'=>$order->id,
                    'menu_id'=>$menu->menu->id,
                    'status_code'=>1,
                    'quantity'=>$menu->quantity,
                    'price'=>$menu->menu->price,
                ];
            }
            OrderMenu::insert($insert);
        }

        DB::table('cart')
            ->where('user_id', $user_id)
            ->delete();

        return redirect('user/history?unav=history');

    }
}
