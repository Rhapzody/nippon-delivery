<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuType;
use App\Menu;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){

        $new_menu = Menu::with('menuPictures', 'menuType')->orderBy('updated_at', 'desc')->take(6)->get();
        $top_menu= Menu::with('menuPictures', 'menuType')->orderBy('hits', 'desc')->take(6)->get();

        return view('front.impl.index',[
            'new_menu'=>$new_menu,
            'top_menu'=>$top_menu,
            'nav'=>'home',
            'search'=>"",
            'search_type_id'=>0
        ]);
    }

    public function staffDispatch(){
        $user = Auth::user();
        if($user->hasRole('เจ้าของร้าน')) return redirect('staff/sales');
        if($user->hasRole('ผู้จัดการสาขา')) return redirect('staff/sales');
        if($user->hasRole('พ่อครัว/แม่ครัว')) return redirect('staff/order');
        if($user->hasRole('คนส่งสินค้า')) return redirect('staff/deliver');
    }
}
