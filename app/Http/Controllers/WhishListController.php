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

    public function delete($id){
        $whish = Auth::user()->whishLists()->where('menu_id','=', $id)->first();
        $user_id = Auth::user()->id;
        if ($whish != null){
            DB::table('whish_list')
                ->where('menu_id', $id)
                ->where('user_id', $user_id)
                ->delete();
        }
        return response()->json([
            'status'=>'success'
        ]);
    }

    public function count(){
        $number = Menu::whereHas('whishLists', function ($q) {
                $q->where('user_id', '=', Auth::user()->id);
            })->count();
        return response()->json([
            'count'=>$number
        ]);
    }

    public function whish(){
        $user_id = Auth::user()->id;
        $product = Menu::with('menuPictures', 'menuType')
        ->whereHas('whishLists', function ($q) use($user_id){
            $q->where('user_id', '=', $user_id);
        })
        ->paginate(9);

        return view('front.impl.user-whish',[
            'product'=>$product,
            'unav'=>'whish',
            'header'=>'รายการเมนูที่ชอบ',
            'searching'=>false
        ]);
    }
}
