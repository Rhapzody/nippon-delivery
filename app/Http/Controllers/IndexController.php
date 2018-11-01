<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuType;
use App\Menu;

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
}
